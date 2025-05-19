<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Imports\FileImport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Bus;
use Maatwebsite\Excel\Facades\Excel;
use Src\domain\_Shared\Api\Error\Error;
use Src\domain\_Shared\Api\Response\Response;
use Src\domain\File\DTO\GetAllFilesInputDto;
use Src\domain\File\DTO\GetFileByFilterInputDto;
use Src\domain\File\DTO\GetFileContentByFilterInputDto;
use Src\domain\File\Facades\FileFacade;
use Src\domain\File\Helpers\FileHelper;
use Src\domain\File\Jobs\FileImportJob;

class FileController extends Controller
{
    public function getByFilter(Request $request)
    {
        try {
            $fileName = $request->input('name');
            $date = $request->input('date');

            $input = new GetFileByFilterInputDto(
                $fileName,
                $date
            );

            $output = FileFacade::getFileByFilter($input);

            $response = new Response();
            $responseApi = $response->mountGetFileResponseApi($output);

            return response()->json($responseApi);

        }catch (\Throwable $e) {
            $error = new Error();
            $errorApi = $error->mountErrorApi($e->getMessage());

            return response()->json($errorApi, 500);
        }
    }

    public function getContentByFilter(Request $request)
    {
        try{
            $name = $request->input('name');
            $email = $request->input('email');

            if(empty($name) && empty($email)) {
                throw new \InvalidArgumentException('É ncessário o preenchimento dos campos nome ou email.', 422);
            }

            $input = new GetFileContentByFilterInputDto(
                $name,
                $email
            );

            $output = FileFacade::getContentByFilter($input);

            $response = new Response();
            $responseApi = $response->mountFileContentResponseApi($output);

            return response()->json($responseApi);

        }catch (\Throwable $e) {
            $error = new Error();
            $errorApi = $error->mountErrorApi($e->getMessage());

            return response()->json($errorApi, $e->getCode());
        }
    }

    public function getAll(Request $request)
    {
        try{
            $offset = $request->input('offset') ?? 0;
            $limit = $request->input('limit') ?? 10;
            $sentAt = $request->input('sent_at');

            $input = new GetAllFilesInputDto(
                $offset,
                $limit,
                $sentAt
            );

            $output = FileFacade::getAll($input);

            $response = new Response();
            $responseApi = $response->mountGetAllFilesResponseApi($output, $offset, $limit);

            return response()->json($responseApi);

        }catch (\Throwable $e) {
            $error = new Error();
            $errorApi = $error->mountErrorApi($e->getMessage());

            return response()->json($errorApi, $e->getCode());
        }
    }

    public function upload(Request $request)
    {
        try{
            $request->validate([
                'file' => 'required|file|mimes:csv',
            ]);

            $file = $request->file('file');
            $path = $request->file('file')->store('imports');
            $name = $file->getClientOriginalName();

            $fileInfo = explode('.', $name);
            $fileName = $fileInfo[0];
            $extension = $fileInfo[1];

            Excel::import(new FileImport($fileName, $extension), $path, null, \Maatwebsite\Excel\Excel::CSV);

            $response = new Response();
            $responseApi = $response->mountResponseApi('Importação realizada com sucesso!');

            return response()->json($responseApi);

        }catch (\Throwable $e){
            $error = new Error();
            $errorApi = $error->mountErrorApi($e->getMessage());

            return response()->json($errorApi, $e->getCode());
        }
    }
}

<?php

namespace Src\domain\_Shared\Api\Response;

use Illuminate\Pagination\LengthAwarePaginator;
use Src\domain\File\DTO\FileContentDto;
use Src\domain\File\DTO\FileDto;

class Response
{
    public function mountGetFileResponseApi(?FileDto $fileDto): array
    {
        if(!empty($fileDto)){
            $content = [];

            foreach($fileDto->content as $item) {
                $content[] = [
                    'Nome' => $item->name,
                    'Idade' => $item->age,
                    'Email' => $item->email,
                    'Código' => $item->code,
                ];
            }

            return [
                'data' => [
                    'name' => $fileDto->name,
                    'sent_at' => $fileDto->sentAt->format('d/m/Y'),
                    'extension' => $fileDto->extension,
                    'content' => $content
                ]
            ];
        }

        return [
            'data' => null
        ];
    }

    /**
     * @param array|null $fileContentDto
     * @return array[]|null
     */
    public function mountFileContentResponseApi(?array $fileContentDto): ?array
    {
        if(!empty($fileContentDto)){
            $fileContent = [];
            foreach($fileContentDto as $item) {
                $fileContent[] = [
                    'Nome' => $item->name,
                    'Idade' => $item->age,
                    'Email' => $item->email,
                    'Código' => $item->code,
                ];
            }

            return [
                'data' => $fileContent
            ];
        }

        return [
            'data' => null
        ];
    }

    /**
     * @param FileDto[]|null $data
     * @param int $offset
     * @param int $limit
     * @return array|null
     */
    public function mountGetAllFilesResponseApi(?array $data, int $offset, int $limit) : ?array
    {
        if(!empty($data)){
            $files = [];
            $contents = [];
            foreach($data as $file) {
                foreach($file->content as $content){
                    $contents[] = [
                        'Nome' => $content->name,
                        'Idade' => $content->age,
                        'Email' => $content->email,
                        'Código' => $content->code,
                    ];
                }

                $files[] = [
                    'Nome' => $file->name,
                    'Data de Envio' => $file->sentAt->format('d/m/Y'),
                    'Extensão' => $file->extension,
                    'Conteúdo' => $contents
                ];
            }


            return [
                'data' => $files,
                'metadata' => [
                    'total' => count($data),
                    'limit' => $limit,
                    'offset' => $offset,
                    'next' => '/files?offset=' . ($offset + $limit) . '&limit=' . $limit,
                    'previous' => '/files?offset=' . (max($offset - $limit, 0)) . '&limit=' . $limit,
                ]
            ];
        }

        return [
            'data' => null
        ];
    }

    public function mountGetFilesResponseApi(LengthAwarePaginator $files)
    {
        return [
            'data' => $files
        ];
    }

    public function mountResponseApi(string $message)
    {
        return [
            'message' => $message,
        ];
    }
}

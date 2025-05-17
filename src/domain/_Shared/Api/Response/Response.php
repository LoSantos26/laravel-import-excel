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
                'result' => [
                    'name' => $fileDto->name,
                    'sent_at' => $fileDto->sentAt->format('d/m/Y'),
                    'extension' => $fileDto->extension,
                    'content' => $content
                ]
            ];
        }

        return [
            'result' => null
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
                'result' => $fileContent
            ];
        }

        return [
            'result' => null
        ];
    }

    public function mountGetFilesResponseApi(LengthAwarePaginator $files)
    {
        return [
            'result' => $files
        ];
    }

    public function mountResponseApi(string $message)
    {
        return [
            'message' => $message,
        ];
    }
}

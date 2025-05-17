<?php

namespace Src\domain\File\Actions;

use Illuminate\Pagination\LengthAwarePaginator;
use Src\domain\File\Contracts\FileRepositoryInterface;
use Src\domain\File\DTO\FileDto;
use Src\domain\File\DTO\GetAllFilesInputDto;
use Src\domain\File\DTO\GetFileByFilterInputDto;
use Src\domain\File\Mappers\FileMapper;

class GetAllFilesAction
{
    public function __construct(private FileRepositoryInterface $fileRepository)
    { }

    public function execute(GetAllFilesInputDto $inputDto)
    {
        $files = $this->fileRepository->getAll($inputDto->toArray());

        if(empty($files)){
            return null;
        }

        return array_map(function ($file) {
            return FileMapper::entityToDto($file);
        }, $files);
    }

}

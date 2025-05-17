<?php

namespace Src\domain\File\Actions;

use Illuminate\Pagination\LengthAwarePaginator;
use Src\domain\File\Contracts\FileRepositoryInterface;
use Src\domain\File\DTO\FileContentDto;
use Src\domain\File\DTO\FileDto;
use Src\domain\File\DTO\GetFileByFilterInputDto;
use Src\domain\File\DTO\GetFileContentByFilterInputDto;
use Src\domain\File\Entities\FileContent;
use Src\domain\File\Mappers\FileMapper;

class GetFileContentByFilterAction
{
    public function __construct(private FileRepositoryInterface $fileRepository)
    { }

    /**
     * @param GetFileContentByFilterInputDto $inputDto
     * @return FileContentDto[]|null
     */
    public function execute(GetFileContentByFilterInputDto $inputDto): ?array
    {
        $contents = $this->fileRepository->getContentByFilter($inputDto->toArray());

        if(empty($contents)){
            return null;
        }

        $fileContents = [];
        foreach($contents as $content){
            $fileContents[] = FileMapper::entityToDtoContent($content);
        }

        return $fileContents;
    }
}

<?php

namespace Src\domain\File\Actions;

use Src\domain\File\Contracts\FileRepositoryInterface;
use Src\domain\File\DTO\FileDto;
use Src\domain\File\Entities\File;
use Src\domain\File\Entities\FileContent;
use Src\domain\File\Mappers\FileMapper;

class CreateFileAction
{
    public function __construct(private FileRepositoryInterface $fileRepository)
    { }

    public function execute(FileDto $fileDto): FileDto
    {
        $file = $this->fileRepository->getFileByName($fileDto->name);

        if(!empty($file)) {
            throw new \Exception('Arquivo com este nome já existe.');
        }

        $content = [];
        foreach($fileDto->content as $contentDto){
            $content[] = new FileContent(
                $contentDto->id,
                $contentDto->name,
                $contentDto->age,
                $contentDto->email,
                $contentDto->code
            );
        }

        $file = new File(
            null,
            $fileDto->name,
            $fileDto->extension,
            $fileDto->sentAt,
            $content
        );

        $fileCreated = $this->fileRepository->createFile($file);

        return FileMapper::entityToDto($fileCreated);
    }
}

<?php

namespace Src\domain\File\Mappers;

use Src\domain\File\DTO\FileContentDto;
use Src\domain\File\DTO\FileDto;
use Src\domain\File\Entities\File;
use Src\domain\File\Entities\FileContent;

class FileMapper
{
    public static function dtoToEntity(FileDto $fileDto)
    {
        $fileContent = [];
        foreach($fileDto->content as $content){
            $fileContent[] = new FileContent(
                $content->id,
                $content->name,
                $content->age,
                $content->email,
                $content->code
            );
        }

        return new File(
            $fileDto->id,
            $fileDto->name,
            $fileDto->extension,
            new \DateTimeImmutable($fileDto->sentAt),
            $fileContent
        );
    }

    public static function entityToDto(File $file)
    {
        $fileContent = [];
        foreach($file->getContent() as $content){
            $fileContent[] = new FileContentDto(
                $content->getId(),
                $content->getName(),
                $content->getAge(),
                $content->getEmail(),
                $content->getCode()
            );
        }

        return new FileDto(
            $file->getId(),
            $file->getFileName(),
            $file->getExtension(),
            $file->getSentAt(),
            $fileContent
        );
    }

    public static function entityToDtoContent(FileContent $content)
    {
        return new FileContentDto(
            $content->getId(),
            $content->getName(),
            $content->getAge(),
            $content->getEmail(),
            $content->getCode()
        );
    }
}

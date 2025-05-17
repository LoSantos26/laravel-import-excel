<?php

namespace Src\domain\File\DTO;

use Src\domain\File\Helpers\FileHelper;

class FileDto
{
    /**
     * @param int|null $id
     * @param string $name
     * @param string $extension
     * @param \DateTimeImmutable $sentAt
     * @param FileContentDto[] $content
     */
    public function __construct(
        public ?int               $id,
        public string             $name,
        public string             $extension,
        public \DateTimeImmutable $sentAt,
        public array              $content
    ){ }
}

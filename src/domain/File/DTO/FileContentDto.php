<?php

namespace Src\domain\File\DTO;

class FileContentDto
{
    /**
     * @param int|null $id
     * @param string $name
     * @param string $age
     * @param string $email
     * @param string $code
     */
    public function __construct(
        public ?int $id,
        public string $name,
        public string $age,
        public string $email,
        public string $code
    ) { }
}

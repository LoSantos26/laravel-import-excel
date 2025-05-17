<?php

namespace Src\domain\File\DTO;

class GetFileContentByFilterInputDto
{
    public function __construct(
        public ?string $name,
        public ?string $email
    )
    { }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'email' => $this->email
        ];
    }
}

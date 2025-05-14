<?php

namespace Src\domain\File\DTO;

class GetFileContentByFilterInputDto
{
    public function __construct(
        public ?string $name,
        public ?string $age
    )
    { }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'age' => $this->age
        ];
    }
}

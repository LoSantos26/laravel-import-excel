<?php

namespace Src\domain\File\DTO;

class GetFileByFilterInputDto
{
    /**
     * @param string|null $name
     * @param string|null $sentAt
     */
    public function __construct(
        public ?string $name,
        public ?string $sentAt
    ){ }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'sent_at' => $this->sentAt,
        ];
    }
}

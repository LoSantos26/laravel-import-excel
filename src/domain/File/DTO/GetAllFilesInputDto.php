<?php

namespace Src\domain\File\DTO;

class GetAllFilesInputDto
{
    public function __construct(
        public ?int $offset,
        public ?int $limit,
        public ?string $sentAt
    )
    { }

    public function toArray()
    {
        return [
            'offset' => $this->offset,
            'limit' => $this->limit,
            'sent_at' => $this->sentAt
        ];

    }
}

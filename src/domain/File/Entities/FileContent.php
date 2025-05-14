<?php

namespace Src\domain\File\Entities;

class FileContent
{
    public function __construct(
        private ?int $id,
        private string $name,
        private string $age,
        private string $email,
        private string $code
    ) { }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getAge(): string
    {
        return $this->age;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }
}

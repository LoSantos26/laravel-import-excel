<?php

namespace Src\domain\File\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;
use Src\domain\File\Entities\File;
use Src\domain\File\Entities\FileContent;

interface FileRepositoryInterface
{
    /**
     * @param array|null $filter
     * @return File[]|null
     */
    public function getAll(?array $filter): ?array;

    public function getFileByName(string $name): ?File;

    public function createFile(File $file): File;

    public function getFileByFilter(array $filter): ?File;

    /**
     * @param array $filter
     * @return FileContent[]|null
     */
    public function getContentByFilter(array $filter): ?array;
}

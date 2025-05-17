<?php

namespace Src\domain\File\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Src\domain\File\Contracts\FileRepositoryInterface;
use Src\domain\File\Entities\File;
use Src\domain\File\Entities\FileContent;
use Src\domain\File\Models\FileContentModel;
use Src\domain\File\Models\FilesModel;

class FileRepository implements FileRepositoryInterface
{
    public function createFile(File $file): File
    {
        $fileModel = FilesModel::query()
            ->updateOrCreate([
                'name' => $file->getFileName()
            ],
            [
                'extension' => $file->getExtension(),
                'sent_at' => $file->getSentAt()->format('Y-m-d')
            ]);

        foreach($file->getContent() as $content){
            FileContentModel::query()
                ->create([
                    'file_id' => $fileModel->id,
                    'name' => $content->getName(),
                    'age' => $content->getAge(),
                    'email' => $content->getEmail(),
                    'code' => $content->getCode()
                ]);
        }

        return $this->mapFile($fileModel);
    }

    public function getAll(): LengthAwarePaginator
    {
        $fileModel = FilesModel::query()->select('files.*');

        $files = $fileModel->paginate(10);
        $files->getCollection()->transform(function ($file) {
            return $this->mapFile($file);
        });

        return $files;
    }

    public function getFileByFilter(array $filter): ?File
    {
        $query = FilesModel::query();

        if(!empty($filter['name'])){
            $query->where('name', '=', $filter['name']);
        }

        if(!empty($filter['sent_at'])){
            $query->where('sent_at', '=', $filter['sent_at']);
        }

        $fileModel = $query->first();

        if(empty($fileModel)){
            return null;
        }

        return $this->mapFile($fileModel);
    }

    public function getFileByName(string $name): ?File
    {
        $fileModel = FilesModel::query()
            ->where('name', '=', $name)
            ->first();

        if(empty($fileModel)){
            return null;
        }

        return $this->mapFile($fileModel);
    }

    /**
     * @param array $filter
     * @return FileContent[]|null
     */
    public function getContentByFilter(array $filter): ?array
    {
        $query = FileContentModel::query();

        if(!empty($filter['name'])){
            $query->where('name', 'LIKE', "%{$filter['name']}%");
        }

        if(!empty($filter['email'])){
            $query->where('email', 'LIKE', "%{$filter['email']}%");
        }

        $fileContentModel = $query->get();

        if(count($fileContentModel) <= 0){
            return null;
        }

        $fileContents = [];
        foreach($fileContentModel as $content){
            $fileContents[] = $this->mapFileContent($content);
        }

        return $fileContents;
    }

    private function mapFile(object $fileData): File
    {
        $contentData = [];

        foreach($fileData->content as $content){
            $contentData[] = new FileContent(
                $content->id,
                $content->name,
                $content->age,
                $content->email,
                $content->code
            );
        }

        return new File(
            $fileData->id,
            $fileData->name,
            $fileData->extension,
            new \DateTimeImmutable($fileData->sent_at),
            $contentData
        );
    }

    private function mapFileContent(object $contentData): FileContent
    {
        return new FileContent(
            $contentData->id,
            $contentData->name,
            $contentData->age,
            $contentData->email,
            $contentData->code
        );

    }
}

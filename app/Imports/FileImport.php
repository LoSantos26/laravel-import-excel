<?php

namespace App\Imports;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Src\domain\File\DTO\FileContentDto;
use Src\domain\File\DTO\FileDto;
use Src\domain\File\Facades\FileFacade;

class FileImport implements ToCollection, WithHeadingRow, WithCustomCsvSettings
{
    /**
     * @param string $fileName
     * @param string $extension
     */
    public function __construct(
        private string $fileName,
        private string $extension
    ){}

    public function collection(Collection $collection)
    {
        $contentInputs = [];
        foreach($collection as $row){
            $contentInputs[] = new FileContentDto(
                null,
                $row['nome'],
                $row['idade'],
                $row['email'],
                $row['codigo'],
            );
        }

        $input = new FileDto(
            null,
            $this->fileName,
            $this->extension,
            new \DateTimeImmutable(),
            $contentInputs
        );

        FileFacade::create($input);
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ","
        ];
    }
}

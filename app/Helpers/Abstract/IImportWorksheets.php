<?php

namespace App\Helpers\Abstract;

use App\Enums\WorksheetType;
use App\Models\Rmsp\ImportedFile;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

abstract class IImportWorksheets
{
    protected Worksheet $worksheet;
    protected DateTime $date;

    public function     __construct(
        protected WorksheetType $worksheetType,
        protected string $fileName
    )
    {
    }

    public function handle(): void
    {

        foreach (Storage::disk('public')->files($this->fileName) as $path) {
            $filename = basename($path);

            $isImportedBefore = ImportedFile::query()
                ->where('name', $filename)
                ->where('type', $this->worksheetType->name)
                ->exists();

            if ($isImportedBefore) continue;

            $importedFile = ImportedFile::query()->create([
                'name' => $filename,
                'type' => $this->worksheetType->name
            ]);

            $filenameDate = str_replace('.xlsx', '', $filename);
            $this->date = Carbon::createFromFormat('Y_m_d', $filenameDate)->toDate();

            $xslx = IOFactory::load(public_path("storage/$path"));
            $this->worksheet = $xslx->setActiveSheetIndex(2);

            $this->import($importedFile);
        }
    }

    protected abstract function import(Model $importedFile);
}

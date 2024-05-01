<?php

namespace App\Services\RmspImport;

use App\Enums\WorksheetType;
use App\Helpers\Abstract\IImportWorksheets;
use App\Helpers\Rmsp\BusinessTypeable;
use App\Models\Rmsp\District;
use Illuminate\Database\Eloquent\Model;

class ImportPeopleBySubjectsService extends IImportWorksheets
{
    protected int $startIndex = 9;

    public function __construct(WorksheetType $worksheetType, string $fileName)
    {
        parent::__construct($worksheetType, $fileName);
    }

    protected function import(Model $importedFile) : void
    {
        $currentDistrict = '';

        for ($rowIndex = $this->startIndex; ; $rowIndex++) {
            $regionCode = $this->worksheet->getCell("A$rowIndex")->getValue();
            $regionName = $this->worksheet->getCell("B$rowIndex")->getValue();

            if (empty($regionName)) break;

            if (empty($regionCode)) {
                $currentDistrict = District::query()->firstOrCreate([
                    'name' => $regionName
                ]);
            } else {
                $importService = new ImportSupportByRegion(
                    $currentDistrict->id,
                    $importedFile,
                    $this->date,
                    new BusinessTypeable(
                        $this->worksheet->getCell("E$rowIndex")->getValue(),
                        $this->worksheet->getCell("F$rowIndex")->getValue(),
                        $this->worksheet->getCell("G$rowIndex")->getValue()
                    ),
                    new BusinessTypeable(
                        $this->worksheet->getCell("I$rowIndex")->getValue(),
                        $this->worksheet->getCell("J$rowIndex")->getValue(),
                        $this->worksheet->getCell("K$rowIndex")->getValue(),
                    ),
                    $this->worksheet->getCell("L$rowIndex")->getValue()
                );

                $importService->import($regionCode, $regionName, 'Получатели');
            }
        }
    }
}

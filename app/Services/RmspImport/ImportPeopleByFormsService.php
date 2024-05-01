<?php

namespace App\Services\RmspImport;

use App\Enums\WorksheetType;
use App\Helpers\Abstract\IImportWorksheets;
use App\Helpers\Rmsp\BusinessTypeable;
use Illuminate\Database\Eloquent\Model;

class ImportPeopleByFormsService extends IImportWorksheets
{
    protected int $startIndex = 11;

    public function __construct(WorksheetType $worksheetType, string $fileName)
    {
        parent::__construct($worksheetType, $fileName);
    }

    protected function import(Model $importedFile) : void
    {
        for ($rowIndex = $this->startIndex; ; $rowIndex++) {
            $supportForm = $this->worksheet->getCell("A$rowIndex")->getValue();
            $supportType = $this->worksheet->getCell("B$rowIndex")->getValue();

            if (empty($supportType) || empty($supportForm)) break;

            $importService = new ImportSupportByForm(
                $importedFile,
                $this->date,
                new BusinessTypeable(
                    $this->worksheet->getCell("E$rowIndex")->getValue(),
                    $this->worksheet->getCell("F$rowIndex")->getValue(),
                    $this->worksheet->getCell("G$rowIndex")->getValue(),
                ),
                new BusinessTypeable(
                    $this->worksheet->getCell("I$rowIndex")->getValue(),
                    $this->worksheet->getCell("J$rowIndex")->getValue(),
                    $this->worksheet->getCell("K$rowIndex")->getValue(),
                ),
                $this->worksheet->getCell("L$rowIndex")->getValue()
            );

            $importService->import($supportForm, $supportType, 'Получатели');
        }
    }
}

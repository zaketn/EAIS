<?php

namespace App\Services\RmspImport;

use App\Enums\WorksheetType;
use App\Helpers\Abstract\IImportWorksheets;
use App\Helpers\Rmsp\BusinessTypeable;
use Illuminate\Database\Eloquent\Model;

class ImportMoneyByFormsService extends IImportWorksheets
{
    protected int $startIndex = 14;

    public function __construct(WorksheetType $worksheetType, string $fileName)
    {
        parent::__construct($worksheetType, $fileName);
    }

    protected function import(Model $importedFile): void
    {
        for ($rowIndex = $this->startIndex; ; $rowIndex++) {
            $supportForm = $this->worksheet->getCell("A$rowIndex")->getValue();
            $supportType = $this->worksheet->getCell("B$rowIndex")->getValue();
            $unitType = $this->worksheet->getCell("C$rowIndex")->getValue();

            if (empty($supportForm) || empty($supportType) || empty($unitType)) break;

            $importService = new ImportSupportByForm(
                $importedFile,
                $this->date,
                new BusinessTypeable(
                    $this->worksheet->getCell("F$rowIndex")->getValue(),
                    $this->worksheet->getCell("G$rowIndex")->getValue(),
                    $this->worksheet->getCell("H$rowIndex")->getValue()
                ),
                new BusinessTypeable(
                    $this->worksheet->getCell("J$rowIndex")->getValue(),
                    $this->worksheet->getCell("K$rowIndex")->getValue(),
                    $this->worksheet->getCell("L$rowIndex")->getValue(),
                ),
                $this->worksheet->getCell("M$rowIndex")->getValue()
            );

            $importService->import($supportForm, $supportType, $unitType);
        }
    }
}

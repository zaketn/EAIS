<?php

namespace App\Services\RmspImport;

use App\Helpers\Abstract\IImportService;
use App\Helpers\Rmsp\BusinessTypeable;
use App\Models\Rmsp\SupportForm;
use App\Models\Rmsp\SupportType;
use App\Models\Rmsp\SupportUnitType;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class ImportSupportByForm extends IImportService
{
    public function __construct(
        Model $importedFile,
        DateTime $date,
        BusinessTypeable $legalCompany,
        BusinessTypeable $individualCompany,
        string $selfEmployedAmount
    )
    {
        parent::__construct($importedFile, $date, $legalCompany, $individualCompany, $selfEmployedAmount);
    }

    public function import(string $supportForm, string $supportType, string $unitType) : void
    {
        $supportForm = SupportForm::query()->firstOrCreate([
            'name' => $supportForm
        ]);

        $supportType = SupportType::query()->firstOrCreate([
            'name' => $supportType,
            'support_form_id' => $supportForm->id
        ]);

        $unitType = SupportUnitType::query()->firstOrCreate([
            'name' => $unitType
        ]);

        $this->importRow($supportType, $unitType);
    }
}

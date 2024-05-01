<?php

namespace App\Services\RmspImport;

use App\Helpers\Abstract\IImportService;
use App\Helpers\Rmsp\BusinessTypeable;
use App\Models\Rmsp\Region;
use App\Models\Rmsp\SupportUnitType;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class ImportSupportByRegion extends IImportService
{
    public function __construct(
        protected int $districtId,
        Model $importedFile,
        DateTime $date,
        BusinessTypeable $legalCompany,
        BusinessTypeable $individualCompany,
        string $selfEmployedAmount,
    )
    {
        parent::__construct($importedFile, $date, $legalCompany, $individualCompany, $selfEmployedAmount);
    }

    public function import(?string $regionCode, string $regionName, string $unitType): void
    {
        $region = Region::query()->firstOrCreate([
            'id' => $regionCode,
            'name' => $regionName,
            'district_id' => $this->districtId
        ]);

        $unitType = SupportUnitType::query()->firstOrCreate([
            'name' => $unitType
        ]);

        $this->importRow($region, $unitType);
    }
}

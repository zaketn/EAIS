<?php

namespace App\Helpers\Abstract;

use App\Helpers\Rmsp\BusinessTypeable;
use App\Models\Rmsp\CompanyType;
use App\Models\Rmsp\OwnerType;
use DateTime;
use Illuminate\Database\Eloquent\Model;

abstract class IImportService
{
    public function __construct(
        protected Model $importedFile,
        protected DateTime $date,
        protected BusinessTypeable $legalCompany,
        protected BusinessTypeable $individualCompany,
        protected string $selfEmployedAmount
    )
    {
    }

    public abstract function import(string $supportForm, string $supportType, string $unitType);

    protected function importRow(Model $supportableEntity, Model $unitType): void
    {
        $companyTypes = CompanyType::all();
        $ownerTypes = OwnerType::all();

        foreach ($companyTypes as $companyType) {
            foreach ($ownerTypes as $ownerType) {
                $value = match ($companyType->name) {
                    'Микропредприятия' => $ownerType->name === 'Юридические лица' ? $this->legalCompany->microBusiness : $this->individualCompany->microBusiness,
                    'Малые предприятия' => $ownerType->name === 'Юридические лица' ? $this->legalCompany->smallBusiness : $this->individualCompany->smallBusiness,
                    'Средние предприятия' => $ownerType->name === 'Юридические лица' ? $this->legalCompany->mediumBusiness : $this->individualCompany->mediumBusiness,
                    default => null
                };

                if ($value === null) continue;

                $supportableEntity->supports()->firstOrCreate([
                    'support_unit_type_id' => $unitType->id,
                    'company_type_id' => $companyType->id,
                    'date' => $this->date,
                    'amount' => $value,
                    'imported_file_id' => $this->importedFile->id
                ]);
            }

            $supportableEntity->supports()->firstOrCreate([
                'support_unit_type_id' => $unitType->id,
                'company_type_id' => CompanyType::query()->firstWhere('name', 'Самозанятые')->id,
                'date' => $this->date,
                'amount' => $this->selfEmployedAmount,
                'imported_file_id' => $this->importedFile->id
            ]);
        }
    }
}

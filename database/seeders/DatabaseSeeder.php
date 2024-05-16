<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Rmsp\CompanyType;
use App\Models\Rmsp\OwnerType;
use App\Models\Rmsp\SupportUnitType;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->fillOwnerTypes();
        $this->fillCompanyTypes();
        $this->fillSupportUnitType();
    }

    protected function fillOwnerTypes() :void
    {
        $ownerTypes = [
            'Индивидуальные предприниматели',
            'Юридические лица'
        ];

        foreach ($ownerTypes as $ownerType) {
            OwnerType::query()->create([
                'name' => $ownerType
            ]);
        }
    }

    protected function fillCompanyTypes() : void
    {
        $ownerTypes = OwnerType::all();
        $companyTypes = [
            'Микропредприятия',
            'Малые предприятия',
            'Средние предприятия'
        ];

        foreach($ownerTypes as $ownerType) {
            foreach($companyTypes as $companyType) {
                CompanyType::query()->create([
                    'name' => $companyType,
                    'owner_type_id' => $ownerType->id
                ]);
            }
        }

        CompanyType::query()->create([
            'name' => 'Самозанятые',
        ]);
    }

    protected function fillSupportUnitType() :void
    {
        $supportUnitTypes = [
          'Получатели',
          'Рубли'
        ];

        foreach ($supportUnitTypes as $supportUnitType) {
            SupportUnitType::query()->create([
                'name' => $supportUnitType
            ]);
        }
    }
}

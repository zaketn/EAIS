<?php

namespace App\Console\Commands\ExcelImport;

use App\Models\Rmsp\CompanyType;
use App\Models\Rmsp\District;
use App\Models\Rmsp\OwnerType;
use App\Models\Rmsp\Region;
use App\Models\Rmsp\StatisticByRegion;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PeopleBySubjects extends Command
{
    protected $signature = 'import:people-by-subjects';

    protected $description = 'Command description';

    protected int $startIndex = 9;

    public function handle()
    {
        $path = 'exports/people_by_subjects';

        foreach(Storage::disk('public')->files($path) as $path) {
            $date = str_replace('.xlsx', '', basename($path));

            $xslx = IOFactory::load(public_path("storage/$path"));
            $worksheet = $xslx->setActiveSheetIndex(2);

            $this->import($worksheet, $date);
        }
    }

    protected function import(Worksheet $worksheet, string $date): void
    {
        $currentDistrict = '';

        for ($i = $this->startIndex; ; $i++) {
            $regionCode = $worksheet->getCell("A$i")->getValue();
            $regionName = $worksheet->getCell("B$i")->getValue();

            if (empty($regionName)) break;

            $currentDistrict = $this->importRegions($regionName, $regionCode, $currentDistrict, $worksheet, $i, $date);
        }
    }

    protected function importRegions(string $regionName, ?string $regionCode, $currentDistrict, Worksheet $worksheet, int $rowIndex, string $date)
    {
        if (empty($regionCode)) {
            return District::query()->firstOrCreate([
                'name' => $regionName
            ]);
        } else {
            Region::query()->firstOrCreate([
                'id' => $regionCode,
                'name' => $regionName,
                'district_id' => $currentDistrict->id
            ]);

            $this->importSupportData($worksheet, $rowIndex, $regionCode, $date);
        }

        return $currentDistrict;
    }

    protected function importSupportData(Worksheet $worksheet, int $rowIndex, int $regionCode, string $date)
    {
        $companyTypes = CompanyType::all();
        $ownerTypes = OwnerType::all();

        foreach ($companyTypes as $companyType) {
            foreach ($ownerTypes as $ownerType) {
                $value = match ($companyType->name) {
                    'Микропредприятия' => $ownerType->name === 'Юридические лица' ? $worksheet->getCell("E$rowIndex")->getValue() : $worksheet->getCell("I$rowIndex")->getValue(),
                    'Малые предприятия' => $ownerType->name === 'Юридические лица' ? $worksheet->getCell("F$rowIndex")->getValue() : $worksheet->getCell("J$rowIndex")->getValue(),
                    'Средние предприятия' => $ownerType->name === 'Юридические лица' ? $worksheet->getCell("G$rowIndex")->getValue() : $worksheet->getCell("K$rowIndex")->getValue(),
                    default => null
                };

                if($value === null) continue;

                StatisticByRegion::query()->create([
                    'region_id' => $regionCode,
                    'company_type_id' => $companyType->id,
                    'date_of_support' => Carbon::createFromFormat('Y_m_d', $date)->toDate(),
                    'amount' => $value
                ]);
            }

            StatisticByRegion::query()->create([
                'region_id' => $regionCode,
                'company_type_id' => CompanyType::query()->firstWhere('name', 'Самозанятые')->id,
                'date_of_support' => Carbon::createFromFormat('Y_m_d', $date)->toDate(),
                'amount' => $worksheet->getCell("L$rowIndex")->getValue()
            ]);
        }
    }
}

<?php

namespace App\Console\Commands\ExcelImport;

use App\Enums\WorksheetType;
use App\Services\RmspImport\ImportPeopleByFormsService;
use App\Services\RmspImport\ImportPeopleBySubjectsService;
use Illuminate\Console\Command;

class PeopleBySubjects extends Command
{
    protected $signature = 'import:people-by-subjects';

    protected $description = 'Импорт информации в БД из эксель докуметов, в которых отражается количество получателей по регионам.';


    public function handle()
    {
        $service = new ImportPeopleBySubjectsService(
            WorksheetType::PEOPLE_BY_REGIONS,
            'exports/people_by_subjects'
        );
        $service->handle();
    }
}

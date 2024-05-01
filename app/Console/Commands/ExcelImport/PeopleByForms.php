<?php

namespace App\Console\Commands\ExcelImport;

use App\Enums\WorksheetType;
use App\Services\RmspImport\ImportPeopleByFormsService;
use Illuminate\Console\Command;

class PeopleByForms extends Command
{
    protected $signature = 'import:people-by-forms';

    protected $description = 'Импорт информации в БД из эксель докуметов, в которых отражается количество получаетелей поддержки, по формам поддержки.';

    public function handle() : void
    {
        $service = new ImportPeopleByFormsService(
            WorksheetType::PEOPLE_BY_FORMS,
            'exports/people_by_forms'
        );

        $service->handle();
    }
}

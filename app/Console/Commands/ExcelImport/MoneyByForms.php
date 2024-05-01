<?php

namespace App\Console\Commands\ExcelImport;

use App\Enums\WorksheetType;
use App\Services\RmspImport\ImportMoneyByFormsService;
use Illuminate\Console\Command;

class MoneyByForms extends Command
{
    protected $signature = 'import:money-by-forms';

    protected $description = 'Импорт информации в БД из эксель докуметов, в которых отражаются выделяемые средства по формам поддержки.';

    public function handle() : void
    {
        $service = new ImportMoneyByFormsService(
            WorksheetType::MONEY_BY_FORMS,
            'exports/money_by_forms'
        );

        $service->handle();
    }
}

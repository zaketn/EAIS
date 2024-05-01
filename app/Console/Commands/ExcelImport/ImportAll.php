<?php

namespace App\Console\Commands\ExcelImport;

use Illuminate\Console\Command;

class ImportAll extends Command
{
    protected $signature = 'import:all';

    protected $description = 'Импорт всех типов excel документов';

    public function handle() : void
    {
        $this->call('import:people-by-subjects');
        $this->info('Завершен импорт кол-ва получаетелей по регионам.');

        $this->call('import:people-by-forms');
        $this->info('Завершен импорт кол-ва получаетелей по формам поддержки.');

        $this->call('import:money-by-forms');
        $this->info('Завершен импорт выделенных средств по формам поддержки по регионам.');

        $this->info('Все импорты завершены.');
    }
}

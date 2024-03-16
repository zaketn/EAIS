<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DownloadFiles extends Command
{
    protected $signature = 'download:excel-files';

    protected $description = 'Command description';

    const link = 'https://rmsp-pp.nalog.ru/statistics-report-excel.xlsx';

    public function handle(): void
    {
        $currentDate = Carbon::now(); // текущая дата по календарю
        $startDate = Carbon::create(2021, 1, 15); // стартовая дата
        $types = [1 => 'people_by_subjects', 2 => 'people_by_forms', 3 => 'money_by_forms']; // типы файлов(для запроса) и наименования(для папок)

        foreach ($types as $type => $typeName) {
            $curDate = clone $startDate; // текущая дата в цикле

            while ($curDate <= $currentDate) {
                $r = Http::asForm()->post(self::link, [
                    'exceltype' => $type,
                    'excelstatdate' => $curDate->format('d.m.Y')
                ]);

                $xlsxContent = $r->body();

                $folder = "exports/{$typeName}/"; // папка для типа
                Storage::makeDirectory($folder); // создать папку еслди нет её

                $filename = $curDate->format('Y_m') . ".xlsx"; // название файла

                Storage::put($folder . $filename, $xlsxContent); // записать файл в формате "год_месяц"

                $curDate->addMonth();
            }
        }
    }
}

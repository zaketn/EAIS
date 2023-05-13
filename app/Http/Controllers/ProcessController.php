<?php

namespace App\Http\Controllers;

use App\Services\DocToExcel\ExcelHandlerService;
use App\Services\DocToExcel\ScanFilesService;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    const SOURCE_FILES_FOLDER = 'docs';

    /**
     * Сканирует на наличие файлов в указанной папке, проводит первичную очистку и отправляет таблицы на обработку в js
     *
     * @return string
     */
    public function index(): string
    {
        $oFilesService = new ScanFilesService(self::SOURCE_FILES_FOLDER);
        if (empty($oFilesService->filesToParse)) abort(400);

        $sTable = $oFilesService->getFilesContent();

        return view('processed-tables', compact('sTable'));
    }

    /**
     * Ajax обработчик.
     *
     * @param Request $request
     * @return void
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function process(Request $request)
    {
        $excelHandler = new ExcelHandlerService('2022', $request->number, $request->header, $request->table);
        $excelHandler->process();
    }
}

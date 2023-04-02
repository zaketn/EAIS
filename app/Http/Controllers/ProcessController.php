<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Html;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ProcessController extends Controller
{
    const SOURCE_FILES_FOLDER = 'docs/';

    public function index(): string
    {
        $aFilesToParse = scandir('docs', SCANDIR_SORT_DESCENDING);
        array_pop($aFilesToParse);
        array_pop($aFilesToParse);
        $aFilesToParse = array_reverse($aFilesToParse);

        if (empty($aFilesToParse)) abort(404);

        $sHtmlFile = '';
        foreach ($aFilesToParse as $sFile) {
            $sHtmlFile .= file_get_contents(self::SOURCE_FILES_FOLDER . $sFile);
        }

        $sTable = preg_replace('/\sstyle=".*?"/', '', $sHtmlFile);
        $sTable = preg_replace('/<p[^>]*>(?:\s|&nbsp;)*<\/p>/', '', $sTable);

        return view('processed-tables', compact('sTable'));
    }

    public function process(Request $request)
    {
        $sSpreadsheetName = '2003';
        $sSpreadsheetName .= '.xlsx';

        echo $request->number;
        if (file_exists($sSpreadsheetName)) {
            $currentDocument = IOFactory::load($sSpreadsheetName);

            $oReader = new Html();
            $oReader->setSheetIndex($currentDocument->getSheetCount());
            $oSpreadsheet = $oReader->loadFromString($request->tables, $currentDocument);
            $oSpreadsheet->getActiveSheet()->setTitle($request->number);

            $mapWorksheet = $currentDocument->setActiveSheetIndex(0);
            $row = $mapWorksheet->getHighestRow() + 1;
            $mapWorksheet->insertNewRowBefore($row);
            $mapWorksheet->setCellValue('A' . $row, $request->header);
            $mapWorksheet->setCellValue('B' . $row, 'Ссылка');
            $mapWorksheet->getCell('B' . $row)->getHyperlink()->setUrl("sheet://'" . $request->number . "'!A1");;

            $oWriter = IOFactory::createWriter($oSpreadsheet, 'Xlsx');
            $oWriter->save($sSpreadsheetName);
        } else {
            $spreadsheet = new Spreadsheet();
            $mapWorksheet = $spreadsheet->getActiveSheet();
            $mapWorksheet->setTitle('Оглавление');

            $activeWorksheet = $spreadsheet->createSheet();
            $activeWorksheet->setTitle($request->number);

            $oReader = new Html();
            $oReader->setSheetIndex(1);
            $oSpreadsheet = $oReader->loadFromString($request->tables, $spreadsheet);

            $mapWorksheet = $spreadsheet->setActiveSheetIndexByName('Оглавление');
            $mapWorksheet->insertNewRowBefore(1);
            $mapWorksheet->setCellValue('A1', $request->header);
            $mapWorksheet->setCellValue('B1', 'Ссылка');
            $mapWorksheet->getCell('B1')->getHyperlink()->setUrl("sheet://'" . $request->number . "'!A1");;

            $oWriter = IOFactory::createWriter($oSpreadsheet, 'Xlsx');
            $oWriter->save($sSpreadsheetName);


        };
    }
}

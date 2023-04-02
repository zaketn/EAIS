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

        $sTable = preg_replace('/style=".*?"/', '', $sHtmlFile);
        $sTable = preg_replace('/<p>\s+<\/p>/', '', $sTable);
        $sTable = preg_replace('/<p[^>]*>(?:\s|&nbsp;)*<\/p>/', '', $sTable);

        return view('processed-tables', compact('sTable'));
    }

    public function process(Request $request)
    {
        $sSpreadsheetName = '2003';
        $sSpreadsheetName .= '.xlsx';

        echo $request->tables;
        if (file_exists($sSpreadsheetName)) {
            $currentDocument = IOFactory::load($sSpreadsheetName);

            $oReader = new Html();
            $oReader->setSheetIndex($currentDocument->getSheetCount());
            $oSpreadsheet = $oReader->loadFromString($request->tables, $currentDocument);
            $oSpreadsheet->getActiveSheet()->setTitle($request->header);

            $oWriter = IOFactory::createWriter($oSpreadsheet, 'Xlsx');
            $oWriter->save($sSpreadsheetName);
        } else {
            var_dump($request->tables);

            $spreadsheet = new Spreadsheet();
            $activeWorksheet = $spreadsheet->getActiveSheet();
            $activeWorksheet->setTitle($request->header);

            $oReader = new Html();
            $oSpreadsheet = $oReader->loadFromString($request->tables, $activeWorksheet->getParent());
            $oWriter = IOFactory::createWriter($oSpreadsheet, 'Xlsx');
            $oWriter->save($sSpreadsheetName);
        };
    }
}

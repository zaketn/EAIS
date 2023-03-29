<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Html;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ProcessController extends Controller
{
    public function index(): string
    {
        $sHtmlFile = file_get_contents('R-1.html');
        $sTable = preg_replace('/style=".*?"/', '', $sHtmlFile);
        $sTable = preg_replace('/<p>\s*<\/p>/', '', $sTable);

        return view('processed-tables', compact('sTable'));
    }

    public function process(Request $request)
    {
        var_dump($request->tables);
        if (file_exists('test.xlsx')) {
            $currentDocument = IOFactory::load("test.xlsx");

            $oReader = new Html();
            $oReader->setSheetIndex($currentDocument->getSheetCount());
            $oSpreadsheet = $oReader->loadFromString($request->tables, $currentDocument);
            $oSpreadsheet->getActiveSheet()->setTitle('w' . $currentDocument->getSheetCount());

            $oWriter = IOFactory::createWriter($oSpreadsheet, 'Xlsx');
            $oWriter->save('test.xlsx');
        } else {
            preg_match('/\d\.\d/', $request->header, $sNumber);
            var_dump($request->tables);

            $spreadsheet = new Spreadsheet();
            $activeWorksheet = $spreadsheet->getActiveSheet();
            $activeWorksheet->setTitle($sNumber[0]);

            $oReader = new Html();
            $oSpreadsheet = $oReader->loadFromString($request->tables, $activeWorksheet->getParent());
            $oWriter = IOFactory::createWriter($oSpreadsheet, 'Xlsx');
            $oWriter->save('test.xlsx');
        };
    }
}

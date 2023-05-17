<?php

namespace App\Http\Controllers;

use App\Services\BinaryTree\BinaryTree;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportController extends Controller
{
    public function import()
    {
        $inputFileName = '123.xlsx';
        $inputFileType = 'Xlsx';

        $reader = IOFactory::createReader($inputFileType);
        $spreadsheet = $reader->load($inputFileName);
        $spreadsheet->setActiveSheetIndex(1);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();
        $columns = array_slice($rows, 0, 3);

        $oBinaryTree = new BinaryTree($columns);
        $oBinaryTree->create();
        die();

        $sizes = [];
        foreach ($columns as $rowNumber => $row) {
            array_shift($row);
            array_pop($row);
            dd($row);
            $counter = 1;
            $cellSizes = [];
            foreach($row as $i => $value){
                if($value === null){
                    ++$counter;
                    if($i === count($row) - 1) {
                        $cellSizes[] = [count($row), $counter];
                        array_shift($cellSizes);
                        dump('add add');
                        break;
                    }
                }
                else{
                    $cellSizes[] = [count($row), $counter];
                    $counter = 1;
                }
            }
            $sizes[] = array_reverse($cellSizes);
        }
        dump($sizes);

//        foreach ($rows as $key => $value) {
//            // key is the row count(starts from 0)
//            foreach ($value as $iter => $column_value) {
//                //$column_value the value of row
//            };
//        };

//        $sheetCount = $spreadsheet->getSheetCount();
//        for ($i = 0; $i < $sheetCount; $i++) {
//            $sheet = $spreadsheet->getSheet($i);
//            $sheetData = $sheet->toArray(null, true, true, true);
//        }
    }
}

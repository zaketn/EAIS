<?php

namespace App\Http\Controllers;

use App\Models\Tables\Table;
use App\Services\BinaryTree\BinaryTree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportController extends Controller
{
    private function import()
    {
        $inputFileName = 'storage/main.xlsx';
        $inputFileType = 'Xlsx';

        $reader = IOFactory::createReader($inputFileType);
        $spreadsheet = $reader->load($inputFileName);
        $spreadsheet->setActiveSheetIndex(19);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        Table::query()
            ->create([
                'year' => 2021,
                'name' => 'ОСНОВНЫЕ ФИНАНСОВЫЕ ПОКАЗАТЕЛИ ПО ВИДАМ ЭКОНОМИЧЕСКОЙ ДЕЯТЕЛЬНОСТИ',
                'data' => json_encode($rows)
        ]);
    }
}

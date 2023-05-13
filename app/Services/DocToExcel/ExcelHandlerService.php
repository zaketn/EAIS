<?php

namespace App\Services\DocToExcel;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Html;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ExcelHandlerService
{
    private string $fileName;
    private Spreadsheet $spreadsheet;
    private string $tableNumber;
    private string $tableTitle;
    private string $tableContent;
    private bool $isNewFile;

    public function __construct(string $fileName, string $tableNumber, string $tableTitle, string $tableContent)
    {
        $this->fileName = $fileName . '.xlsx';
        $this->tableNumber = $tableNumber;
        $this->tableContent = $tableContent;
        $this->tableTitle = $tableTitle;

        $this->isNewFile = !file_exists($this->fileName);
        $this->spreadsheet = $this->isNewFile ? new Spreadsheet() : IOFactory::load($this->fileName);
    }

    /**
     * Управление обработкой входящих данных
     *
     * @return void
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function process() : void
    {
        if ($this->isNewFile) $this->createMapSheet();
        $this->createSheetWithContent();
        $this->addNewSheetToMap();
        $this->saveFile();
    }

    /**
     * Создает страницу "Оглавление"
     *
     * @return void
     */
    private function createMapSheet() : void
    {
        $mapWorksheet = $this->spreadsheet->getActiveSheet();
        $mapWorksheet->setTitle('Оглавление');
    }


    /**
     * Создает новый лист и заполняет его данными
     *
     * @return void
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    private function createSheetWithContent() : void
    {
        $oReader = new Html();
        $oReader->setSheetIndex($this->spreadsheet->getSheetCount());
        $oSpreadsheet = $oReader->loadFromString($this->tableContent, $this->spreadsheet);
        $oSpreadsheet->getActiveSheet()->setTitle($this->tableNumber);
    }


    /**
     * Добавляет новый лист в оглавление
     *
     * @return void
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    private function addNewSheetToMap() : void
    {
        $mapWorksheet = $this->spreadsheet->setActiveSheetIndex(0);
        $newRowIndex = $mapWorksheet->getHighestRow() + 1;
        $mapWorksheet->insertNewRowBefore($newRowIndex);

        $mapWorksheet->setCellValue('A' . $newRowIndex, $this->tableTitle);
        $mapWorksheet->setCellValue('B' . $newRowIndex, 'Ссылка');
        $mapWorksheet->getCell('B' . $newRowIndex)
            ->getHyperlink()
            ->setUrl("sheet://'" . $this->tableNumber . "'!A1");
    }

    /**
     * Сохраняет файл
     *
     * @return void
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    private function saveFile() : void
    {
        $oWriter = IOFactory::createWriter($this->spreadsheet, 'Xlsx');
        $oWriter->save($this->fileName);
    }
}

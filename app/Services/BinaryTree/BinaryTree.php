<?php

namespace App\Services\BinaryTree;

class BinaryTree
{
    private int $treeSize;
    private array $rows;
    private array $binaryTree;

    public function __construct(array $rows)
    {
        $this->rows = $this->validateRows($rows);
        $this->treeSize = count($rows);
    }

    public function create()
    {
        foreach($this->rows as $row){
            dump($row);
            dump($this->getCellsSize($row));
        }
    }

    /**
     * Вырезает первый и последний элемент в строке.
     *
     * @param array $rows
     * @return array
     */
    private function validateRows(array $rows) : array
    {
        foreach($rows as $i => $row){
            array_shift($row);
            array_pop($row);

            $rows[$i] = $row;
        }

        return $rows;
    }

    /**
     * Получает кол-во занимаемых значением ячеек
     *
     * @param array $row
     * @return array
     */
    private function getCellsSize(array $row) : array
    {
        $aCellsSizes = [];
        $counter = 0;
        foreach($row as $i => $rowValue){
            if($i === 0 && $row[$i + 1] !== null){
                $aCellsSizes[] = ++$counter;
                $counter = 0;
            }
            else if($rowValue === null || $i === 0){
                $counter++;
                if($i === count($row) - 1) $aCellsSizes[] = ++$counter;
            } else{
                if($counter === 0) $counter = 1;
                $aCellsSizes[] = $counter;
                $counter = 0;
            }
        }

        return $aCellsSizes;
    }

    private function createRoot(int $maxIndex)
    {

    }

    private function appendChild()
    {

    }
}

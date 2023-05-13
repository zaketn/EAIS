<?php

namespace App\Services\DocToExcel;

class ScanFilesService
{
    public readonly array $filesToParse;
    private string $sourceFolder;

    public function __construct(string $sourceFolder)
    {
        $this->sourceFolder = $sourceFolder;
        $this->filesToParse = $this->getFilesToParse();
    }

    /**
     * Получает список файлов для парсинга
     *
     * @return array
     */
    private function getFilesToParse() : array
    {
        $aFilesToParse = scandir($this->sourceFolder, SCANDIR_SORT_DESCENDING);
        array_pop($aFilesToParse);
        array_pop($aFilesToParse);

        return array_reverse($aFilesToParse);
    }

    /**
     * Получает содержимое файлов которые будут парситься
     *
     * @param array $filesToParse
     * @return string
     */
    public function getFilesContent() : string
    {
        $sHtmlFile = '';
        foreach ($this->filesToParse as $sFile) {
            $sHtmlFile .= file_get_contents($this->sourceFolder .'/' . $sFile);
        }
        $sTable = preg_replace('/\sstyle=".*?"/', '', $sHtmlFile);

        return preg_replace('/<p[^>]*>(?:\s|&nbsp;)*<\/p>/', '', $sTable);
    }
}

<?php
namespace App\Generator;

use App\Document;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\PolyFill\PhpSpreadSheetHtmlStringReaderPolyFill as HtmlReader;
use DOMDocument;
use Exception;

class ExcelDocumentGenerator extends DefaultDocumentGenerator
{

    public function generate($template, $options = [])
    {
        $spreadSheet = (new HtmlReader())->loadFromString($template);
        $doc = $this->bunldeDocument();
        IOFactory::createWriter($spreadSheet, ucfirst($this->format))->save($doc->getFile());
        return $doc;
    }
}

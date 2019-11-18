<?php
namespace App\Generator;

use App\Document;
use mikehaertl\wkhtmlto\Pdf;



/**
 * @author Mattia Bonzi (mattiabonzi.it)
 *
 */
class DebugDocumentGenerator extends DefaultDocumentGenerator
{
    public function generate($template, $options = [])
    {
        $doc = $this->bunldeDocument("application/html");
        $handle = fopen($doc->getFile(), "w");
        fwrite($handle, $template);
        fclose($handle);
        return $doc;
    }

}

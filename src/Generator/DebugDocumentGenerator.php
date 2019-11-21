<?php
/*
 * This file is part of the openworks-srl/documentor package.
 *
 * (c) Openworks srl <www.openworks.it>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Generator;

use App\Utils;

/**
 * Generatore utilizzato per eseguire il debug durante la generazione
 *
 * @author Mattia Bonzi (mattiabonzi.it)
 *        
 */
class DebugDocumentGenerator extends DefaultDocumentGenerator
{

    public function generate($input, $options = [])
    {
        $doc = $this->bunldeDocument("application/html");
        $handle = fopen($doc->getFile(), "w");
        if (Utils::isHtml($input)) {
            fwrite($handle, $input);
        } else {
            ob_start();
            echo "<H1>Input</H1>";
            var_dump($input);
            echo "<br/><H1>options</H1>";
            var_dump($options);
            echo "<br/><H1>StackTrace</H1>";
            var_dump(debug_print_backtrace());
        }
        fclose($handle);
        return $doc;
    }
}


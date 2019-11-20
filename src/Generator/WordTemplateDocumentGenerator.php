<?php
/*
 * This file is part of the openworks-srl/documentor package.
 *
 * (c) Openworks srl <www.openworks.it>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Generator;

use App\Utils;
use PhpOffice\PhpWord\TemplateProcessor;

class WordTemplateDocumentGenerator extends DefaultDocumentGenerator
{

    public function generate($input, $options = [])
    {
        $templateProcessor = new TemplateProcessor(Utils::findFile($input["template"]));
        $templateProcessor->setValues($input["data"]);
        $doc = $this->bunldeDocument();
        $templateProcessor->saveAs($doc->getFile());
        return $doc;
    }

    public function mapInput($input)
    {
        $this->validateInput($input, 2);
        return Utils::mapArray($input, [
            "template" => 0,
            "data" => 1
        ]);
    }
}

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


abstract class DefaultDocumentGenerator extends AbstractDocumentGenerator
{

    public abstract function generate($input, $options = []);

    public function validateInput($input, $number)
    {
        if (count($input) < $number) {
            throw new \Exception("L'input fornito non � valido");
        }
        return true;
    }

    public function mapInput($input)
    {
        return $input;
    }
}


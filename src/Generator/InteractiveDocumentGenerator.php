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

abstract class InteractiveDocumentGenerator extends AbstractDocumentGenerator
{

    public abstract function getEditableObject(...$params);

    public abstract function save($object, ...$params);
}


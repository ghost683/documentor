<?php
/*
 * Copyright 2019 Openworks srl
 *
 * This file is part of the openworks-srl/documentor package.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * A copy of the License is distributed with the software,
 * if you can't find it, you may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 */
namespace Openworks\Documentor;

use Exception;

class GeneratorFactory
{

    const classPostfix = "DocumentGenerator";

    const classNameSpace = __NAMESPACE__ . "\Generator\\";

    public static function getGenerator($format, $modifier = null)
    {
        $class = null;
        switch (strtolower($format)) {
            case "doc":
            case "docx":
            case "odt":
                $class = "word";
                break;

            case "csv":
            case "ods":
            case "xls":
            case "xlsx":
                $class = "excel";
                break;

            case "pdf":
                $class = "pdf";
                break;

            case "debug":
                $class = "debug";
                break;

            default:
                throw new \InvalidArgumentException("La tipologia di documento speicifcata non puo essere generata");
                break;
        }
        $modifier = $modifier != null ? substr($modifier, 0, 1) == "_" ? ucfirst(substr($modifier, 1)) : ucfirst($modifier) : "";
        $class = self::classNameSpace . ucfirst($class) . $modifier . self::classPostfix;
        try {
            return new $class($format);
        } catch (Exception $e) {
            throw new \InvalidArgumentException("La tipologia di documento speicifcata non puo essere generata");
        }
    }
}


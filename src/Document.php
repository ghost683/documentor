<?php
/*
 * This file is part of the openworks-srl/documentor package.
 *
 * (c) Openworks srl <www.openworks.it>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App;

use function App\Document\cleanUp;

class Document
{

    private $file;

    private $name;

    private $format;

    private $contentType;

    private $lenght;

    public function saveAs($path, $name = null, $override = false)
    {
        if ($name == null) {
            $name = $this->name;
        }
        if (! file_exists($path)) {
            throw new \Exception("Impossibile trovare il percorso di destinazione specificato");
        }
        $completePath = $path . $name . '.' . $this->format;
        if ($this->file != null && file_exists($this->file)) {
            if (($override && file_exists($completePath)) || ! file_exists($completePath)) {
                copy($this->file, $completePath);
                $this->cleanUp();
                return $path;
            } else {
                throw new \Exception("Il file specificato $path esiste gia'");
            }
        } else {
            throw new \Exception("E' possibile salvare il file una sola volta");
        }
    }

    public function send()
    {
        if ($this->file != null && file_exists($this->file)) {
            header("Content-Type: " . $this->contentType);
            header('Content-disposition: filename="' . $this->name . $this->format . '"');
            header('Content-Length', $this->lenght);
            readfile($this->file);
            cleanUp();
        } else {
            throw new \Exception("E' possibile inviare il file una sola volta");
        }
    }

    private function cleanUp()
    {
        unlink($this->file);
        unset($this->file);
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }

    public function getContentType()
    {
        return $this->contentType;
    }

    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        return $this;
    }

    public function getLenght()
    {
        return $this->lenght;
    }

    public function setLenght($lenght)
    {
        $this->lenght = $lenght;
        return $this;
    }

    public function getFullName()
    {
        return $this->name . "." . $this->format;
    }
}


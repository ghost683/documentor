<?php
namespace App\Generator;

use App\Document;
use App\Config\Settings;

/**
 * Classe "generatore" base, viene estesa da tutti i generatori
 * contiene alcune utils comuni
 *
 * @author Mattia Bonzi (mattiabonzi.it)
 *        
 */
abstract class AbstractDocumentGenerator
{

    protected $format;

    /**
     *
     * @internal
     *
     * @param
     *            String <code>$format</code> Il formato del documento da generare (l'estensione desiderata del file di output)
     */
    public function __construct($format)
    {
        $this->format = $format;
    }

    /**
     *
     * @internal Restituisce un nome temporaneo random per un documento, basata sulla funzione builtin <code>uniqid()</code>
     * @return string Nome univoco
     */
    protected function getTmpName()
    {
        return "doc_" . uniqid();
    }

    /**
     *
     * @internal Istanzia un oggetto di tipo <code>\App\Document</code> con i valori di default e assegna un nome temporaneo univoco
     * @param string $contentType
     *            Stringa di MIME per trasmisssione su HTTP, se non viene fornita indicazione e' usato <code>application/octet-stream</code>
     * @param int $lenght
     *            Dimensione (in byte) del documento
     * @return \App\Document Classe wrapper per un documento da generare
     */
    protected function bunldeDocument($contentType = "application/octet-stream", $lenght = null)
    {
        $name = $this->getTmpName();
        return (new Document())->setName($name)
            ->setFile(Settings::get("TMP_DIR") . "/" . $name . ".$this->format")
            ->setContentType($contentType)
            ->setFormat($this->format)
            ->setLenght($lenght);
    }
}


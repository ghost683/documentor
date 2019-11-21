<?php
/*
 * This file is part of the openworks-srl/documentor package.
 *
 * (c) Openworks srl <www.openworks.it>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Documentor;

final class PdfTest extends BaseTestCase
{

    public function testGenerateSimpleDocument()
    {
        $foo = [
            [
                'name' => 'Alice'
            ],
            [
                'name' => 'Bob'
            ],
            [
                'name' => 'Eve'
            ]
        ];
        $doc = $this->documentor->generate([
            "test.pdf.twig",
            [
                "foo" => $foo
            ]
        ], "pdf", [
            'global' => [
                'margin-top' => 0,
                'margin-right' => 0,
                'margin-bottom' => 0,
                'margin-left' => 0
            ]
        ]);

        $this->assertFileExists($doc->saveAs($this->TEST_OUT, "Pdf_" . "testGenerateSimpleDocument_" . $doc->getName()));
    }

    public function testGenerateFromDocTemplate()
    {
        $data = [
            "firstname" => "mario",
            "lastname" => "rossi",
            "adress" => "Via garofalo 31"
        ];
        $doc = $this->documentor->generate([
            "cv.docx",
            $data
        ], "pdf", [
            "mod" => "wordTemplate"
        ]);

        $this->assertFileExists($doc->saveAs($this->TEST_OUT, "Pdf_" . "testGenerateFromDocTemplate_" . $doc->getName()));
    }

    public function testGenerateFromPrintWord()
    {
        $doc = $this->documentor->generate([
            "file-sample_500kB.docx"
        ], "pdf", [
            "mod" => "print"
        ]);

        $this->assertFileExists($doc->saveAs($this->TEST_OUT, "Pdf_" . "testGenerateFromPrintWord_" . $doc->getName()));
    }

    public function testGenerateFromPrintExcel()
    {
        $doc = $this->documentor->generate([
            "Financial_Sample.xlsx"
        ], "pdf", [
            "mod" => "print"
        ]);

        $this->assertFileExists($doc->saveAs($this->TEST_OUT, "Pdf_" . "testGenerateFromPrintExcel_" . $doc->getName()));
    }
}
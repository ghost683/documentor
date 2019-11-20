<?php
namespace Test\test;

use App\Documentor;
use PHPUnit\Framework\TestCase;

final class ExcelTest extends TestCase
{
    
    private $documentor;
    
    public function __construct() {
        $this->documentor = new Documentor(__DIR__."/TestConfig.php");
    }
    
    public function testGenerateDocument() {
        $foo = [
            [
                'name' => 'Alice',
                'surname' => 'In The Wontherland'
            ],
            [
                'name' => 'Bob',
                'surname' => 'Marley'
            ],
            [
                'name' => 'Steve',
                'surname' => 'Jobs'
                
            ]
        ];
        $doc =  $this->documentor->generate(["test.excel.twig", [
            "foo" => $foo
        ]], "ods");
        $this->assertFileExists($doc->getFile());
    }
    
    
    
    public function testGenerateManualBuildedDocument() {
        $generator =  $this->documentor->getInteractiveGenerator("xlsx");
        $obj = $generator->getEditableObject();
        $sheet = $obj->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
        $doc = $generator->save($obj);
        $this->assertFileExists($doc->getFile());
    }
    
    
    public function testgenerateFromArrayWithColoumn() {
        $data = [
            "column" => ["Nome", "Cognome", "Et�"],
            "data" => [
                ["Mattia", "Bonzi", "21"],
                ["Davide", "manoli", 21],
                ["Alessandro", "Cibelli", "35"]
            ]
        ];
        $doc =  $this->documentor->generate($data, "xlsx", ["mod" => "array"]);
        $this->assertFileExists($doc->getFile());
    }
    
    
    public function testgenerateFromArrayWithoutColoumn() {
        $data = [[
                ["Nome" => "Mattia", "Cognome" => "Bonzi","Et�" => "21"],
                ["Nome" => "Davide", "Cognome" => "manoli","Et�" => 21],
                ["Nome" => "Alessandro", "Cognome" => "Cibelli","Et�" => "35"]
        ]];
        $doc =  $this->documentor->generate($data, "xlsx", ["mod" => "array"]);
        $this->assertFileExists($doc->getFile());
    }
    
    
    
    
    public function testgenerateFromArrayWithColoumnWithOffset() {
        $options = ["mod" => "array", "doc" => ["headerStartColumn" => "B", "headerStartRow" => 3, "dataStartColumn" => "B"]];
        $data = [
            "column" => ["Nome", "Cognome", "Et�"],
            "data" => [
                ["Mattia", "Bonzi", "21"],
                ["Davide", "manoli", 21],
                ["Alessandro", "Cibelli", "35"]
            ]
        ];
        $doc =  $this->documentor->generate($data, "xlsx", $options);
        $this->assertFileExists($doc->getFile());
    }
    
    
    public function testgenerateFromArrayWithoutColoumnWithOffset() {
        $options = ["mod" => "array", "doc" => ["headerStartColumn" => "B", "headerStartRow" => 3, "dataStartColumn" => "B"]];
        $data = [[
            ["Nome" => "Mattia", "Cognome" => "Bonzi","Et�" => "21"],
            ["Nome" => "Davide", "Cognome" => "manoli","Et�" => 21],
            ["Nome" => "Alessandro", "Cognome" => "Cibelli","Et�" => "35"]
        ]];
        $doc =  $this->documentor->generate($data, "xlsx", $options);
        $this->assertFileExists($doc->getFile());
    }
    
    
    
    public function testgenerateFromArrayWithColoumnWithTemplate() {
        $options = ["mod" => "array", "doc" => ["template" => __DIR__ . "/../tmp/tmpl/templateTest.xlsx"]];
        $data = [
            "column" => ["Nome", "Cognome", "Et�"],
            "data" => [
                ["Mattia", "Bonzi", "21"],
                ["Davide", "manoli", 21],
                ["Alessandro", "Cibelli", "35"]
            ]
        ];
        $doc =  $this->documentor->generate($data, "xlsx", $options);
        $this->assertFileExists($doc->getFile());
    }
}
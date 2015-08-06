<?php

namespace leberknecht\PhpParserBundle\Tests\Service;

use leberknecht\PhpParserBundle\Service\PhpParserService;

class PhpParserServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testParserCreation()
    {
        $phpParserService = new PhpParserService();
        $filename = __DIR__ . '/../Fixtures/SomeClass.php';
        $phpParserService->parseFile($filename);
    }

    public function testParseReturnsObject()
    {
        $phpParserService = new PhpParserService();
        $filename = __DIR__ . '/../Fixtures/SomeClass.php';
        $result = $phpParserService->parseFile($filename);
        $this->assertTrue(is_object($result));
    }

    public function testReadFileFileDoesExistsNotPhp()
    {
        $phpParserService = new PhpParserService();
        $file = __DIR__ . '/../Fixtures/textfile.txt';
        $this->setExpectedException('\Exception', 'contains no php-code: ' . $file);
        $phpParserService->parseFile($file);
    }

    public function testReadFileFileDoesExistsIsPhp()
    {
        $phpParserService = new PhpParserService();
        $result = $phpParserService->parseFile(__DIR__ . '/../Fixtures/SomeClass.php');
        $this->assertTrue(is_object($result));
    }

    public function testParserResultIsNodeArray()
    {
        $phpParserService = new PhpParserService();
        $filename = __DIR__ . '/../Fixtures/SomeClass.php';
        $result = $phpParserService->parseFile($filename);
        $this->assertInstanceOf('leberknecht\PhpParserBundle\Entity\ParserReport', $result);
    }

    public function testParserResultEntries()
    {
        $phpParserService = new PhpParserService();
        $filename = __DIR__ . '/../Fixtures/SomeClass.php';
        $result = $phpParserService->parseFile($filename);
        $this->assertTrue(count($result->getObjects()) == 1);
    }

    public function testParserResultObjectName()
    {
        $phpParserService = new PhpParserService();
        $filename = __DIR__ . '/../Fixtures/SomeClass.php';
        $result = $phpParserService->parseFile($filename)->getObjects();
        $this->assertEquals('SomeClass', $result[0]->getName());
    }

    public function testParserResultMethodName()
    {
        $phpParserService = new PhpParserService();
        $filename = __DIR__ . '/../Fixtures/SomeClass.php';
        $result = $phpParserService->parseFile($filename)->getObjects();
        $method = $result[0]->getMethods();
        $this->assertEquals('privateFunction', $method[0]->getName());
    }

    public function testParserResultPropertyName()
    {
        $phpParserService = new PhpParserService();
        $filename = __DIR__ . '/../Fixtures/SomeClass.php';
        $result = $phpParserService->parseFile($filename)->getObjects();
        $property = $result[0]->getProperties();
        $this->assertEquals('privateMember', $property[0]->getName());
    }
}
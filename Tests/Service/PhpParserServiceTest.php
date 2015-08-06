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

    public function testParseReturnsParser()
    {
        $phpParserService = new PhpParserService();
        $filename = __DIR__ . '/../Fixtures/SomeClass.php';
        $result = $phpParserService->parseFile($filename);
        $this->assertTrue(is_array($result));
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
        $this->assertTrue(is_array($result));
    }

    public function testParserResultIsNodeArray()
    {
        $phpParserService = new PhpParserService();
        $filename = __DIR__ . '/../Fixtures/SomeClass.php';
        $result = $phpParserService->parseFile($filename);
        $this->assertInstanceOf('\PhpParser\Node', $result[0]);
    }

    public function testParserResultEntries()
    {
        $phpParserService = new PhpParserService();
        $filename = __DIR__ . '/../Fixtures/SomeClass.php';
        $result = $phpParserService->parseFile($filename);
        $this->assertInstanceOf('\PhpParser\Node', $result[0]);
    }
}
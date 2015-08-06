<?php
namespace leberknecht\PhpParserBundle\Tests\DependencyInjection;

use leberknecht\PhpParserBundle\DependencyInjection\PhpParserExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class PhpParserExtensionTest extends \PHPUnit_Framework_TestCase {

    public function testContainerLoadsFineWithDefaultConfig() {
        $containerBuilder = new ContainerBuilder();
        $dndFileUploadExtension = new PhpParserExtension();
        $dndFileUploadExtension->load(array(array()), $containerBuilder);
        $this->assertTrue($containerBuilder instanceof ContainerBuilder);
    }

    public function testContainerHasDefinition() {
        $containerBuilder = new ContainerBuilder();
        $dndFileUploadExtension = new PhpParserExtension();
        $dndFileUploadExtension->load(array(array()), $containerBuilder);
        $this->assertTrue($containerBuilder->hasDefinition('php_parser'));
    }

} 
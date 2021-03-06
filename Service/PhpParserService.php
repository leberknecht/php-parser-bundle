<?php

namespace leberknecht\PhpParserBundle\Service;

use leberknecht\PhpParserBundle\Entity\ParserReport;
use leberknecht\PhpParserBundle\Entity\ClassMethod;
use leberknecht\PhpParserBundle\Entity\ClassObject;
use leberknecht\PhpParserBundle\Entity\ClassProperty;
use PhpParser\Node\Stmt;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

class PhpParserService
{
    const NODE_TYPE_CLASS = 'Stmt_Class';
    const NODE_TYPE_METHOD = 'Stmt_ClassMethod';
    const NODE_TYPE_PROPERTY = 'Stmt_Property';

    /**
     * @var ParserReport | null
     */
    private $currentParserReport = null;

    /**
     * @var ClassObject | null
     */
    private $currentObject = null;

    /**
     * @param $filename
     * @return null|ParserReport
     * @throws \Exception
     */
    public function parseFile($filename)
    {
        if (!file_exists($filename)) {
            throw new FileNotFoundException();
        }

        $source = file_get_contents($filename);
        $tokens = token_get_all($source);

        if (empty($tokens)) {
            throw new \Exception('contains no php-code: ' . $filename);
        }

        return $this->createReport($filename);
    }

    /**
     * @param \PhpParser\Node | Stmt $node
     */
    private function parseNodeRecursive($node)
    {
        switch($node->getType()) {
            case self::NODE_TYPE_CLASS:
                $classObject = new ClassObject();
                $classObject->setName($node->name);
                $this->currentObject = $classObject;
                $this->currentParserReport->addObject($classObject);
                break;

            case self::NODE_TYPE_METHOD:
                $classProperty = new ClassMethod();
                $classProperty->setName($node->name);
                $this->currentObject->addMethod($classProperty);
                break;

            case self::NODE_TYPE_PROPERTY:
                $classProperty = new ClassProperty();
                $classProperty->setName($node->props[0]->name);
                $this->currentObject->addProperty($classProperty);
                break;
        }

        if (!empty($node->stmts)) {
            foreach($node->stmts as $stmt) {
                $this->parseNodeRecursive($stmt);
            }
        }
    }

    /**
     * @param string $filename
     * @return ParserReport|null
     */
    protected function createReport($filename)
    {
        $parser = new \PhpParser\Parser(new \PhpParser\Lexer);
        $source = file_get_contents($filename);
        $this->currentParserReport = new ParserReport();
        $this->currentParserReport->setSourceFile($filename);
        $this->currentParserReport->setSourceFileSize(filesize($filename));

        $nodes = $parser->parse($source);
        foreach ($nodes as $nodeEntries) {
            $this->parseNodeRecursive($nodeEntries);
        }
        return $this->currentParserReport;
    }
}
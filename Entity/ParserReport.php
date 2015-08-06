<?php

namespace leberknecht\PhpParserBundle\Entity;


class ParserReport
{
    /**
     * @var
     */
    private $sourceFile;

    /**
     * @var
     */
    private $sourceFileSize;

    /**
     * @var array
     */
    private $objects = [];

    /**
     * @return string
     */
    public function getSourceFile()
    {
        return $this->sourceFile;
    }

    /**
     * @param string $sourceFile
     */
    public function setSourceFile($sourceFile)
    {
        $this->sourceFile = $sourceFile;
    }

    /**
     * @return int
     */
    public function getSourceFileSize()
    {
        return (int)$this->sourceFileSize;
    }

    /**
     * @param string $sourceFileSize
     */
    public function setSourceFileSize($sourceFileSize)
    {
        $this->sourceFileSize = $sourceFileSize;
    }

    /**
     * @return ClassObject[]
     */
    public function getObjects()
    {
        return $this->objects;
    }

    /**
     * @param ClassObject[] $objects
     */
    public function setObjects(array $objects)
    {
        $this->objects = $objects;
    }

    /**
     * @param ClassObject $object
     */
    public function addObject(ClassObject $object)
    {
        $this->objects[] = $object;
    }
}
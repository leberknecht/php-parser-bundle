<?php

namespace leberknecht\PhpParserBundle\Entity;

class ClassObject
{
    /**
     * @var ClassMethod[]
     */
    private $methods = [];

    /**
     * @var ClassProperty[]
     */
    private $properties = [];

    /**
     * @var string
     */
    private $name;

    /**
     * @return ClassMethod[]
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * @param array $methods
     */
    public function setMethods(array $methods)
    {
        $this->methods = $methods;
    }

    /**
     * @param ClassMethod $methods
     */
    public function addMethod(ClassMethod $methods)
    {
        $this->methods[] = $methods;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return ClassProperty[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param ClassProperty[] $properties
     */
    public function setProperties($properties)
    {
        $this->properties = $properties;
    }

    public function addProperty(ClassProperty $property)
    {
        $this->properties[] = $property;
    }
}
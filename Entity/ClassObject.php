<?php

namespace leberknecht\PhpParserBundle\Entity;


class ClassObject
{
    /**
     * @var ClassMethod[]
     */
    private $methods = [];

    /**
     * @var string
     */
    private $name;

    /**
     * @return array
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
}
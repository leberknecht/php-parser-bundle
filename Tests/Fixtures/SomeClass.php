<?php

namespace PhpParserBundle\Tests\Fixtures;

class SomeClass
{
    private $privateMember;
    public $someMember;
    const IAM_CONSTANT = 0;
    private static $privateStatic = true;
    public static $publicStatic = true;

    private function privateFunction()
    {
        $hasSomeCode = false;
        if ($hasSomeCode)
            return true;
        return self::$privateStatic;
    }

    public function publicFunction()
    {
        $callsPrivateFunction = $this->privateMember = $this->privateFunction();
    }
}
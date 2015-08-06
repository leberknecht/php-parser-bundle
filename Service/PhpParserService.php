<?php

namespace leberknecht\PhpParserBundle\Service;

use Symfony\Component\Filesystem\Exception\FileNotFoundException;

class PhpParserService
{
    /**
     * @param $filename
     * @return null|\PhpParser\Node[]
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
        $parser = new \PhpParser\Parser(new \PhpParser\Lexer);

        return $parser->parse($filename);
    }
}
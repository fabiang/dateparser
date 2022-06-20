<?php

declare(strict_types=1);

namespace Fabiang\Dateparser;

use Hoa\File\Read as HoaFileReader;
use Hoa\Compiler\Llk\Llk;
use Hoa\Compiler\Llk\TreeNode;
use Fabiang\Dateparser\Exception\LoadDefinitionException;

abstract class Parser implements ParserInterface
{
    public const DEFAULT_PATH = __DIR__ . '/../resources/pp';

    protected string $path;

    public function __construct(string $path = self::DEFAULT_PATH)
    {
        $this->path = $path;
    }

    protected function baseParse(string $name, string $content): TreeNode
    {
        $compiler = Llk::load($this->loadPP($name));
        return $compiler->parse($content);
    }

    protected function loadPP(string $name): HoaFileReader
    {
        $file = $this->path . '/' . $name . '.pp';
        if (!file_exists($file)) {
            throw new LoadDefinitionException(sprintf(
                "Unable to load definition file '%s'",
                $file
            ));
        }

        if (!is_readable($file)) {
            throw new LoadDefinitionException(sprintf(
                "Definition file '%s' is not readable",
                $file
            ));
        }

        return new HoaFileReader($file);
    }
}

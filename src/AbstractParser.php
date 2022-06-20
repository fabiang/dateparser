<?php

declare(strict_types=1);

namespace Fabiang\Dateparser;

use Fabiang\Dateparser\Exception\LoadDefinitionException;
use Phplrt\Compiler\Compiler;

use function file_exists;
use function file_get_contents;
use function is_readable;
use function sprintf;

abstract class AbstractParser implements ParserInterface
{
    public const DEFAULT_PATH = __DIR__ . '/../resources/pp';

    protected string $path;

    public function __construct(string $path = self::DEFAULT_PATH)
    {
        $this->path = $path;
    }

    protected function baseParse(string $name, string $content): iterable
    {
        $compiler = new Compiler();
        $compiler->load($this->loadPP($name));
        return $compiler->parse($content);
    }

    protected function loadPP(string $name): string
    {
        $file = $this->path . '/' . $name . '.pp';

        if (! file_exists($file)) {
            throw new LoadDefinitionException(sprintf(
                "Unable to load definition file '%s'",
                $file
            ));
        }

        if (! is_readable($file)) {
            throw new LoadDefinitionException(sprintf(
                "Definition file '%s' is not readable",
                $file
            ));
        }

        return file_get_contents($file);
    }
}

<?php

declare(strict_types=1);

namespace Fabiang\Dateparser;

use Fabiang\Dateparser\Exception\LoadDefinitionException;
use Override;
use Phplrt\Lexer\Lexer;
use Phplrt\Lexer\Multistate;
use Phplrt\Parser\BuilderInterface;
use Phplrt\Parser\ContextInterface;
use Phplrt\Parser\Parser;

use function file_exists;
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
        $definition = $this->load($name);

        // Create Lexer from compiled data
        $lexer = new Multistate(
            [
                'default'            => new Lexer($definition['tokens']['default'], $definition['skip']),
                'month'              => new Lexer($definition['tokens']['month'], $definition['skip']),
                'day'                => new Lexer($definition['tokens']['day'], $definition['skip']),
                'sep'                => new Lexer($definition['tokens']['sep'], $definition['skip']),
                'hour'               => new Lexer($definition['tokens']['hour'], $definition['skip']),
                'minute'             => new Lexer($definition['tokens']['minute'], $definition['skip']),
                'second'             => new Lexer($definition['tokens']['second'], $definition['skip']),
                'timezone'           => new Lexer($definition['tokens']['timezone'], $definition['skip']),
                'timezone_seperated' => new Lexer($definition['tokens']['timezone_seperated'], $definition['skip']),
                'microsecond'        => new Lexer($definition['tokens']['microsecond'], $definition['skip']),
            ],
            $definition['transitions']
        );

        // Create Parser from compiled data
        $parser = new Parser(
            $lexer,
            $definition['grammar'],
            [
                // Recognition will start from the specified rule
                Parser::CONFIG_INITIAL_RULE => $definition['initial'],
                // Rules for the abstract syntax tree builder.
                // In this case, we use the data found in the compiled grammar.
                Parser::CONFIG_AST_BUILDER => new class ($definition['reducers']) implements BuilderInterface {
                    private array $reducers;

                    public function __construct(array $reducers)
                    {
                        $this->reducers = $reducers;
                    }

                    /**
                     * {@inheritDoc}
                     */
                    #[Override]
                    public function build(ContextInterface $context, $result)
                    {
                        $state = $context->getState();

                        return isset($this->reducers[$state]) ? $this->reducers[$state]($context, $result) : $result;
                    }
                },
            ]
        );

        return $parser->parse($content);
    }

    protected function load(string $name): array
    {
        $file = $this->path . '/' . $name . '.php';

        if (! file_exists($file)) {
            throw new LoadDefinitionException(
                sprintf(
                    "Unable to load definition file '%s'",
                    $file
                )
            );
        }

        if (! is_readable($file)) {
            throw new LoadDefinitionException(
                sprintf(
                    "Definition file '%s' is not readable",
                    $file
                )
            );
        }

        return require $file;
    }
}

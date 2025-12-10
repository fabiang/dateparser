<?php

declare(strict_types=1);

namespace Fabiang\Dateparser;

use DateTime;
use Fabiang\Dateparser\Exception\LoadDefinitionException;
use org\bovigo\vfs\vfsStream;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

use function chmod;
use function file_put_contents;

#[CoversClass(AbstractParser::class)]
final class AbstractParserTest extends TestCase
{
    public function testLoadFileMissing()
    {
        $this->expectException(LoadDefinitionException::class);
        $this->expectExceptionMessageMatches('/^Unable to load definition file/');

        $underTest = new class extends AbstractParser {
            #[Override]
            public function parse(string $string): DateTime
            {
                $this->load('UNKNOWN');
            }
        };
        $underTest->parse('unrelevant');
    }

    public function testLoadNotReadable()
    {
        $this->expectException(LoadDefinitionException::class);
        $this->expectExceptionMessageMatches('/^Definition file \'.*NOT_READABLE.php\' is not readable/');

        $underTest = new class extends AbstractParser {
            public function __construct()
            {
                $path = vfsStream::setup();
                $file = $path->url() . '/NOT_READABLE.php';
                file_put_contents($file, '<?php return [];');
                chmod($file, 0000);
                parent::__construct($path->url());
            }

            #[Override]
            public function parse(string $string): DateTime
            {
                $this->load('NOT_READABLE');
            }
        };
        $underTest->parse('unrelevant');
    }
}

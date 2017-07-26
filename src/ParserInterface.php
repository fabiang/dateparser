<?php

declare(strict_types=1);

namespace Fabiang\Dateparser;

use DateTime;

interface ParserInterface
{
    public function parse(string $string): DateTime;
}

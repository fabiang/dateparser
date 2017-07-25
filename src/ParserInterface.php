<?php

namespace Fabiang\Dateparser;

use DateTime;

interface ParserInterface
{
    public function parse(string $string): DateTime;
}

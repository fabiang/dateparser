<?php

require_once 'vendor/autoload.php';

use Phplrt\Source\File;
use Phplrt\Compiler\Compiler;

$compiler = new Compiler();
$compiler->load(File::fromPathname('resources/pp/RFC3339.pp'));

file_put_contents('resources/pp/RFC3339.php', $compiler->build());

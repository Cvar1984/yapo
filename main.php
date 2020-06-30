<?php

require __DIR__ . '/vendor/autoload.php';

use Cvar1984\Yapo\Yapo;

$path = getcwd() . DIRECTORY_SEPARATOR;

try {
    for ($x = 1; $x < $argc; $x++) {
        var_dump(
            Yapo::make(
                $path . $argv[$x],
                gzdeflate::class,
                Yapo::STUB_LUA
            )
        );
    }
} catch (\TypeError | \Exception | \RuntimeException $e) {
    fprintf(STDERR, '%s%s', $e->getMessage(), PHP_EOL);
}

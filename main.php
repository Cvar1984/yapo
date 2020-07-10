<?php

require __DIR__ . '/vendor/autoload.php';

use Cvar1984\Yapo\Yapo;
use Cvar1984\App\Exception\ {
    Exception, NotFoundException, BadPermissionException
};

$path = getcwd() . DIRECTORY_SEPARATOR;

try {
    if ($argc < 2) throw new Exception('Input a file');
    for ($x = 1; $x < $argc; $x++) {
        var_dump(
            Yapo::make(
                $path . $argv[$x],
                gzdeflate::class,
                Yapo::STUB_JPEG
            )
        );
    }
} catch (\TypeError | Exception | BadPermissionException | NotFoundException $e) {
    fprintf(STDERR, '%s%s', $e->getMessage(), PHP_EOL);
}

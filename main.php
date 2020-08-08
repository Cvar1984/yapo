<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Cvar1984\Yapo\Command\MakeCommand;

$app = new Application();
$app->add(new MakeCommand());
$app->run();

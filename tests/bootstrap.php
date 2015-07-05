<?php

$autoloadFile = dirname(__DIR__) . '/vendor/autoload.php';
if (! is_readable($autoloadFile)) {
	echo <<<EOT
You must run `composer.phar install` to install the dependencies
before running the test suite.

EOT;
	exit(1);
}

// Include the Composer generated autoloader
require_once $autoloadFile;

spl_autoload_register(function ($class)
{
    if (preg_match('/^PhpLibMind\\\\Tests\\\\(.*)$/', $class, $parts)) {
        $classFile = str_replace('\\', '/', $parts[1]) . '.php';
        require __DIR__ . '/PhpLibMind/' . $classFile;
    }
});

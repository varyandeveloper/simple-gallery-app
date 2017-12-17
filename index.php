<?php

error_reporting(E_ALL);

require_once "config.php";

try {
    \VS\Gallery\App::getInstance()->run();
} catch (\Exception $exception) {
    exit($exception->getMessage());
}
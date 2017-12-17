#!/usr/bin/env bash

# generate autoloader
composer dump-autoload

# seed temporary data
php seeder.php
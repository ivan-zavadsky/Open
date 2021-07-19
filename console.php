#!/usr/bin/php
<?php
require_once 'vendor/autoload.php';

use Ivan\Console\Library;
use Ivan\Console\Storage;
use Ivan\Console\Parser;

$lib = new Library(new Storage, new Parser);
$lib->execute();
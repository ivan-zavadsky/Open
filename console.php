#!/usr/bin/php
<?php
require_once 'Library/Command.php';
require_once 'Library/Library.php';
require_once 'Application/Command_Name.php';
require_once 'Library/Parser.php';

$lib = new Library(new Parser);
$lib->process();
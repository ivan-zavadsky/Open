#!/usr/bin/php
<?php
require_once 'Library/Storage.php';
require_once 'Library/Command.php';
require_once 'Library/Setdescription.php';
require_once 'Library/Help.php';
require_once 'Library/Library.php';
require_once 'Application/Command_Name.php';
require_once 'Library/Parser.php';
require_once 'Library/Setname.php';

$lib = new Library(new Storage, new Parser);
$lib->execute();
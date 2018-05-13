<?php

require_once 'DB.php';
require_once 'Git.php';

$git = new Git();

$start = empty($argv[1]) ? 0 : $argv[1];
$end = empty($argv[2]) ? 100 : $argv[2];

if ($git->usersToDb($start, $end)) {

    echo 'OK' . PHP_EOL;

} else {

    echo 'Err....' . PHP_EOL;

}




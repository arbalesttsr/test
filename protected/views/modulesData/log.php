<?php
/**
 * Created by PhpStorm.
 * User: urechean
 * Date: 05.08.2015
 * Time: 11:26
 */

$this->breadcrumbs = [
    'Manage Modules' => ["modulesData/admin"],
    'Manage Modules',
];
$myfile = fopen(__DIR__ . "/../../data/log.log", "r") or die("Unable to open file!");
// Output one line until end-of-file
$arr = [];
while (!feof($myfile)) {
    echo fgets($myfile) . "<br>";
}
fclose($myfile);
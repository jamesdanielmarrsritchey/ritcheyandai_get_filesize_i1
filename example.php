<?php
$location = realpath(dirname(__FILE__));
require_once $location . '/function.php';
$filePath = $location . '/About.txt';
$return = getFileSize($filePath, FALSE);
var_dump($return);
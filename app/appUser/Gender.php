<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';

enum Gender: string
{
    case MALE = 'm';
    CASE FEMALE = 'f';
}
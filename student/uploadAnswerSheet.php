<?php
session_start();

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/file/File.php';
require_once $ROOT . '/app/file/ImageDirectory.php';

$file = $_FILES['fileToUpload'];
$targetDir = $ROOT . '/uploads/images/';

var_dump($_FILES['fileToUpload']);
echo "<br>";

$fileO = new File($file['name'], $file['type'], $file['full_path'], $file['tmp_name'], $file['error'], $file['size'], $targetDir);
echo $fileO->getTargetFile() . '<br>';
$fileDirectory = new ImageDirectory();
$fileDirectory->uploadFile($fileO);
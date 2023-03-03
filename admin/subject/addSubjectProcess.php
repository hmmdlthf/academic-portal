<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/subject/SubjectService.php';

session_start();

$subjectService = new SubjectService();

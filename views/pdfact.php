<?php
chdir(dirname(__DIR__));
$_REQUEST['fidcen'] = isset($_GET['fidcen']) ? $_GET['fidcen'] : NULL;
$_REQUEST['fidjor'] = isset($_GET['fidjor']) ? $_GET['fidjor'] : NULL;
$_GET['pdf'] = 'ok';
require_once "controllers/votract.php";
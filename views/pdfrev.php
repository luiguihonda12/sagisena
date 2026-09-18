<?php
chdir(dirname(__DIR__));
$_REQUEST['fidfic'] = isset($_GET['idfic']) ? $_GET['idfic'] : NULL;
$_GET['pdf'] = 'ok';
require_once "controllers/votractvoc.php";
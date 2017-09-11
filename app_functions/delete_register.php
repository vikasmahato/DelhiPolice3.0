<?php

require ('../secure/config.php');
require ('../secure/db_connect.php');

if(DEBUG) { error_reporting(E_ALL); ini_set('display_errors', 1); }

$id = $_POST['id'];
$table = $_POST['table'];


?>

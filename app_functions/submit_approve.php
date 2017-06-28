<?php
require ('../secure/db_connect.php');
require ('../secure/config.php');
require ('../includes/dbcon.php');
include '../app_functions/logger.php';
include '../secure/functions.php';

if(DEBUG) error_reporting(E_ALL); ini_set('display_errors', 1);
session_start();
if (isset($_POST['approve_btn'])){
        $comment =  $_POST['inputComment'];
    $choice = $_SESSION['role'];
    $id = $_POST['appId'];
    $insetComment='';
    $updateStatus='';
    
switch ($choice) {
    case "hag":
        $insetComment="INSERT INTO `comments`(`user_id`, `app_id`, `comment`) VALUES ('hag', ?,?)";
        $updateStatus="UPDATE form SET status='I_ADMIN' WHERE app_id = $id";
        break;
    case "iadmin":
        $insetComment="INSERT INTO `comments`(`user_id`, `app_id`, `comment`) VALUES ('iadmin', ?,?)";
        $updateStatus="UPDATE form SET status='ACP' WHERE app_id = $id";
        break;
    case "acp":
        $insetComment="INSERT INTO `comments`(`user_id`, `app_id`, `comment`) VALUES ('acp', ?,?)";
        $updateStatus="UPDATE form SET status='DCP' WHERE app_id = $id";
        break;
    case "admin":
        $insetComment="INSERT INTO `comments`(`user_id`, `app_id`, `comment`) VALUES ('admin', ?,?)";
        $updateStatus="UPDATE form SET status='APPROVED' WHERE app_id = $id";
        break;
    default:
        
}
    if($stmt = $mysqli->prepare($insetComment)){
	$stmt->bind_param( 'ss', $id, $comment );
}/*else if(DEBUG) echo $mysqli->error();*/
//9 //17//25//30
//echo $sql; 
if($stmt->execute()){

logger($choice, 'Approval of claim', $diaryNo );
        mysqli_query($con, $updateStatus);
        header('location: dashboard.php');
    }else {
         header('location: some_error.php');
    }
    
    }

?>
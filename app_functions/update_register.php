<?php
require '../secure/config.php';

if(DEBUG) {error_reporting(E_ALL); ini_set('display_errors', 1); }
include("includes/dbcon.php");

    $admis_amt = $_POST['admis_amt'];
    $date = $_POST['date'];
    $sanction_no = $_POST['sanction_no'];
    $sanction_date = $_POST['sanction_date'];
    $id = $_POST['id'];
    $amt_claimed = $_POST['amt_claimed'];
    $phq_number = $_POST['phq_number'];
    $diaryType = $_POST['diaryType'];

    $table = '';
    $sql = '';

    if($diaryType=='Individual'){  
        $sql = "UPDATE register SET admis_amt= ?, amt_claimed= ?, `number`= ?, `date`= ?, sanction_no= ?, sanction_date= ? WHERE s_no = ";

    }elseif($diaryType=='Hospital'){ 
        $sql = "UPDATE register_hospital SET admis_amt= ?, amt_claimed= ?, `number`= ?, `date`= ?, sanction_no= ?, sanction_date= ? WHERE s_no = ";
    }



if($admis_amt==""){
    $admis_amt = null;
}
if($date==""){
    $date = null;
}
if($sanction_no==""){
    $sanction_no = null;
}
if($amt_claimed==""){
    $amt_claimed = null;
}
if($phq_number==""){
    $phq_number = null;
}

if($sanction_date==""){
    $sanction_date = null;
}

if($stmt1 = $mysqli->prepare($sql)){
    $stmt1->bind_param('sssssss', $admis_amt, $amt_claimed, $phq_number, $date, $sanction_no, $sanction_date, $id );
        
    }else if(DEBUG) echo $mysqli->error();


if($stmt1->execute()){
header('location: ../register.php');
}else {
    if(DEBUG) echo $stmt1->error;
    else header('location: ../some_error.php');
}

?>
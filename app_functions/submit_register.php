<?php
require ('../secure/db_connect.php');
require ('../secure/config.php');
require ('logger.php');

if(DEBUG) error_reporting(E_ALL); ini_set('display_errors', 1);

	$diaryNo 		= $_POST['diaryNo'];
    $diaryType 		= $_POST['diaryType'];
    $diaryDate 		= $_POST['diaryDate'];
    $rank 			= $_POST['rank'];
    $applicantName 	= $_POST['applicantName'];
    $idNo 			= $_POST['idNo'];
    $pis 			= $_POST['pis'];
    $treatment_by 	= $_POST['treatment_by'];
    $hospitalName 	= $_POST['hospitalName'];
    $type 			= $_POST['type'];
    $amt_claimed 	= $_POST['amt_claimed'];
    $admis_amt 		= $_POST['admis_amt'];
    $number 		= $_POST['number'];
    $date 			= $_POST['date'];
    $sanction_no 	= $_POST['sanction_no'];
    $sanction_date 	= $_POST['sanction_date'];

    $sql			= '';

if($diaryType==='Individual'){
 $sql = "INSERT INTO register ( diaryNo, diaryType, diaryDate, rank, applicantName, idNo, pis, treatment_by, hospitalName, type, amt_claimed, admis_amt,  `number`, `date`, sanction_no, sanction_date) VALUES ( ?, ?, ?, ?, ?, ?, ? , ?, ?, ?, ?, ?, ?, ?, ?, ?)";  
}elseif($diaryType==='Hospital'){ 
 $sql = "INSERT INTO register_hospital ( diaryNo, diaryType, diaryDate, rank, applicantName, idNo, pis, treatment_by, hospitalName, type, amt_claimed, admis_amt, `number`, `date`, sanction_no, sanction_date) VALUES ( ?, ?, ?, ?, ?, ?, ? , ?, ?, ?, ?, ?, ?, ?, ?, ?)"; 
}

if($stmt = $mysqli->prepare($sql)){
	$stmt->bind_param( 'ssssssssssssssss', $diaryNo, $diaryType, $diaryDate, $rank, $applicantName, $idNo, $pis, $treatment_by, $hospitalName, $type, $amt_claimed, $admis_amt, $number, $date, $sanction_no, $sanction_date  );
}else if(DEBUG) echo $mysqli->error;

logger('dealinghand', 'New Claim Entry', $diaryNo );
//echo $sql; 
if($stmt->execute()){
    $last_id =  $stmt->insert_id;
    header('location: ../viewregister.php?id='.$last_id.'&type='.$diaryType);
}else{
	if(DEBUG) echo $stmt->error;
  	else header('location:../some_error.php ');
}

?>
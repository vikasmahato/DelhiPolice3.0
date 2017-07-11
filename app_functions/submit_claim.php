<?php
require '../secure/config.php';
include 'logger.php';
if(DEBUG) {error_reporting(E_ALL); ini_set('display_errors', 1);}

include("../secure/db_connect.php");

function default_value($var) {
    return isset($var) ? $var : null;
}


$appName 			= $_POST['applicantName'];
$pis 				= $_POST['pis'];
$rank 				= $_POST['rank'];

$relation 			= $_POST['relation'];
$relativeName 		= $_POST['relativeName'];
$diaryDate 			= $_POST['diaryDate'];
$pincode 			= 000000;
$claimType			= $_POST['claim_type'];
$policestationNo	= $_POST['idNo'];
$status 			= 'HAG';


$diaryNo 			= $_POST['diaryNo'];

$refHospitalName	= default_value( $_POST['refHospitalName'] );
$startDate 			= default_value( $_POST['startDate']	   );
$endDate 			= default_value( $_POST['endDate']		   );
$hospitalName 		= default_value( $_POST['hospitalName']    );
$hospitalAddress	= default_value( $_POST['hospitalAddress'] ); 
$appCGHSno 			= default_value( $_POST['appCGHSno']	   );
$appCGHSexp 		= default_value( $_POST['appCGHSexp']	   );
$refCGHSno 			= default_value( $_POST['refCGHSno']       );
$refCGHSexp 		= default_value( $_POST['refCGHSexp']      );
$appCGHScategory 	= default_value( $_POST['appCGHScategory'] );
$disease 			= default_value( $_POST['disease']         );
$amtAsked 			= default_value( $_POST['amtAsked']        ); 
$amtGranted			= default_value( $_POST['amtGranted']      );
$amtAvailable		= default_value( $_POST['amtAvailable']    );
$period				= default_value( $_POST['period']          );
$hospType			= default_value( $_POST['hospType']        );
$amtDue 			= default_value( $_POST['amtDue']          );
$siNo 				= default_value( $_POST['siNo'] 		   );

$sql = "INSERT INTO form ( application_date, applicant_name, pis, rank, relation, relative_name, pincode, startdate, enddate, hospital_name, hospital_address, police_station_no, si_no, diary_no, ref_hospital_name, a_cghs_no, a_cghs_exp, r_cghs_no, r_cghs_exp, a_cghs_category, disease, diary_date, amt_asked, amt_granted, amt_available, status, period, claim_type, hospType, amt_due) VALUES  (CURDATE(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ? , ?, ?, ?, ?, ?, ?, ?, ?, ?, ? , ?, ?, ?, ?, ?, ?, ?, ?, ?)";

if(DEBUG)  echo "<br>INSERT INTO form ( application_date, applicant_name, pis, rank, relation, relative_name, pincode, startdate, enddate, hospital_name, hospital_address, police_station_no, si_no, diary_no, ref_hospital_name, a_cghs_no, a_cghs_exp, r_cghs_no, r_cghs_exp, a_cghs_category, disease, diary_date, amt_asked, amt_granted, amt_available, status, period, claim_type, hospType, amt_due) VALUES  (CURDATE(), '$appName', '$pis', '$rank', '$relation', '$relativeName', '$pincode', '$startDate', '$endDate', '$hospitalName', '$hospitalAddress', '$policestationNo', '$siNo', '$diaryNo', '$refHospitalName', $appCGHSno, '$appCGHSexp', $refCGHSno, '$refCGHSexp', '$appCGHScategory', '$disease',  '$diaryDate', $amtAsked, $amtGranted, '$amtAvailable', '$status', '$period',  '$claimType', '$hospType',  '$amtDue')";

if($stmt = $mysqli->prepare($sql)){
	$stmt->bind_param( 'sssssssssssssssssssssssssssss', $appName, $pis, $rank, $relation, $relativeName, $pincode, $startDate, $endDate, $hospitalName, $hospitalAddress, $policestationNo, $siNo, $diaryNo, $refHospitalName, $appCGHSno, $appCGHSexp, $refCGHSno, $refCGHSexp, $appCGHScategory, $disease,  $diaryDate, $amtAsked, $amtGranted, $amtAvailable, $status, $period,  $claimType, $hospType,  $amtDue  );
}else if(DEBUG) echo $mysqli->error();
//echo $sql; 
if($stmt->execute()){

logger('dealinghand', 'New Claim Entry', $diaryNo );
   // $last_id =  $stmt->last_id;
  if(!DEBUG) header('location: ../viewclaim.php?id='.$last_id);
} else{
	if(DEBUG) echo $stmt->error;
  	else header('location:some_error.php ');
}

?>
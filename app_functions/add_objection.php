<?php
require ('../secure/config.php');
require ('../secure/db_connect.php');

if(DEBUG) { error_reporting(E_ALL); ini_set('display_errors', 1); }

if(isset($_POST)){
  
	$id = $_POST['id'];

	$objection = $_POST['objection'];

	$diaryType = $_POST['diaryType'];
    

	if($diaryType=='Individual'){  

	 	$sql = "UPDATE register SET objection= ? WHERE s_no = ?";

	}elseif($diaryType=='Hospital'){  

	 	$sql = "UPDATE register_hospital SET objection= ? WHERE s_no = ?";
	
	}


	if($stmt = $mysqli->prepare($sql)){
		$stmt->bind_param( 'ss', $objection, $id  );
	}else if(DEBUG) echo $mysqli->error;



	if($stmt->execute()){
         if(isset($_POST['month']))
            header("location: ../show_query.php?month=$_POST[month]&diaryType=$_POST[table]&submit=");
        else
	       header('location: ../dashboard.php');
	    
	}else{
		if(DEBUG) echo $stmt->error;
	  	else header('location:../some_error.php ');
	}

}
?>
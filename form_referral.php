<?php include("includes/header.php"); ?>
  <!-- Content Wrapper. Contains page content -->
<?php
if(isset($_POST['edit_claim'])){
   $id = $_POST['id'];


          $sql1 = '';
           $sql1 = "SELECT applicant_name, pis, rank, relation, relative_name, pincode, startdate, enddate, hospital_name, hospital_address, police_station_no, si_no, diary_no, ref_hospital_name, a_cghs_no, a_cghs_exp, r_cghs_no, r_cghs_exp, a_cghs_category, disease, application_date, diary_date, status, period, claim_type, hospType FROM form WHERE app_id = ?";



          if($stmt1 = $mysqli->prepare($sql1)){
            $stmt1->bind_param('s', $id );
            $stmt1->execute();
            $stmt1->store_result();
            $stmt1->bind_result( $applicantName, $pis, $rank, $relation, $relative_name, $pincode, $startdate, $enddate, $hospitalName, $hospital_address, $idNo, $si_no, $diaryNo, $ref_hospital_name, $a_cghs_no, $a_cghs_exp, $r_cghs_no, $r_cghs_exp, $a_cghs_category, $disease, $application_date, $diaryDate, $status, $period, $claim_type, $hospType );
           $stmt1->fetch();
            }else if(DEBUG) echo $mysqli->error();


}

else {

   if(isset($_GET)){
          $id = $_GET['id'];
          $table = $_GET['table'];

          $sql1 = '';

          if($table==='register')
            $sql1 = "SELECT s_no, diaryNo, diaryType, diaryDate, rank, applicantName, idNo, pis, treatment_by, type, hospitalName FROM register WHERE s_no = ?";
          else if($table==='register_hospital')
             $sql1 = "SELECT s_no, diaryNo, diaryType, diaryDate, rank, applicantName, idNo, pis, treatment_by, type, hospitalName FROM register_hospital WHERE s_no = ?";



          if($stmt1 = $mysqli->prepare($sql1)){
            $stmt1->bind_param('s', $id );
            $stmt1->execute();
            $stmt1->store_result();
            $stmt1->bind_result( $s_no, $diaryNo, $diaryType, $diaryDate, $rank, $applicantName, $idNo, $pis, $treatment_by, $type, $hospitalName );
           $stmt1->fetch();
            }else if(DEBUG) echo $mysqli->error();
                  }


}



?>



  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       New Referral/Govt. Claim


      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Referral/Govt. Claim</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
	      <form role="form" method="post" action="app_functions/submit_claim.php" enctype="multipart/form-data">
        <input type="hidden" name="claim_type" value="OP_REFERRAL">
              <div class="box-body">
                  <div class="form-group">
                    <label for="rank">Rank</label>
                 <input type="text" class="form-control" id="basic-url" name="rank" placeholder="Rank" value="<?php echo  $rank; ?>" required >
                </div>

              	<div class="form-group">
                  <label for="applicantName">Applicant Name</label>
                 <input type="text" class="form-control" id="basic-url" name="applicantName" placeholder="Applicant Name" value="<?php echo $applicantName; ?>" required >
                </div>
                <div class="form-group">
                  <label for="idNo">Belt No</label>
                  <input type="text" class="form-control" id="basic-url" name="idNo" placeholder="Belt No" value="<?php echo $idNo; ?>" required >
                </div>
                <div class="form-group">
                  <label for="pis">PIS No</label>
                  <input type="text" class="form-control" id="basic-url" name="pis" placeholder="PIS No" value="<?php echo $pis; ?>" required >
                </div>

                <div class="form-group">
                  <label for="claimCheck">Treatment of Self or Relative:</label>
                  <div id="radioOptions">
              <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="claimCheck" id="radioCheck" value="self" onclick="hide()">
                    SELF
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="claimCheck" id="radioCheck" value="relative" onclick="show()">
                    RELATIVE
                </label>
              </div>
           </div>
                </div>

                   <div class="form-group" id="dependent1">
                  <label for="relation">Enter relation with the CGHS holder</label>
                 <input type="text" class="form-control" id="basic-url" name="relation" placeholder="Relation" value="self" >
                </div>

                  <div class="form-group" id="dependent5">
                  <label for="relation">Enter relative name</label>
                 <input type="text" class="form-control" id="basic-url" name="relativeName" placeholder="Relative Name" value="no name" >
                </div>

                   <div class="form-group">
                  <label for="startDate endDate">Period of Treatment</label>
                       <span class="input-group-addon" id="periodTo">From</span>
                  <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="startDate" class="form-control pull-right" id="fromDate">
                </div>
                       <span class="input-group-addon" id="periodTo">To</span>
                     <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="endDate" class="form-control pull-right" id="toDate">
                </div>
                </div>


                      <div class="form-group">
                  <label for="refhospitalName">Enter Referring Hospital Name</label>
                 <input type="text" class="form-control" id="basic-url" name="refHospitalName" placeholder="Referring Hospital Name" <?php if(isset($ref_hospital_name)) echo "value='$ref_hospital_name'";  ?> required >
                </div>

                      <div class="form-group">
                  <label for="hospitalName">Enter Hospital Name</label>
                 <input type="text" class="form-control" id="basic-url" name="hospitalName" placeholder="Hospital Name" value="<?php echo $hospitalName; ?>" required >
                </div>



                      <div class="form-group">
                  <span class="input-group-addon" id="basic-addon3">Enter Diary No:</span>
            <input type="text" class="form-control" id="diary" name="diaryNo" placeholder="Diary No" value = "<?php echo $diaryNo; ?>" required >
            <span class="input-group-addon" id="dated">/Genl. Branch/SED dated</span>
            <input type="text" class="form-control" id="datepicker" name="diaryDate" value="<?php echo $diaryDate; ?>" required >
                </div>

                      <div class="form-group">
                  <label for="appCGHSno">Enter the CGHS card/ID No. of Applicant</label>
               <input type="number" class="form-control" id="basic-url" name="appCGHSno" placeholder="Applicant CGHS Number" <?php if(isset($a_cghs_no)) echo "value='$a_cghs_no'";?> required >
                </div>



                   <div class="form-group">
                  <label for="appCGHSexp">Enter the expiry date of CGHS card of Applicant</label>
                  <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="appCGHSexp" class="form-control pull-right" id="appCGHSdate" <?php if(isset($a_cghs_exp)) echo "value='$a_cghs_exp'";?> required>
                </div>
                </div>

                      <div class="form-group" id="dependent2">
                  <label for="hospitalAddress">Enter the CGHS No of Dependent</label>
               <input type="text" class="form-control" id="basic-url" name="refCGHSno" placeholder="CGHS of dependennt" <?php if(isset($r_cghs_no)) echo "value='$r_cghs_no'"; else echo "value='0000'"; ?> >
                </div>

                    <div class="form-group" id="dependent3">
                  <label for="refCGHSexp">Enter the expiry date of CGHS card of Dependent</label>
                  <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="refCGHSexp" class="form-control pull-right" id="depCGHSdate" <?php if(isset($r_cghs_exp)) echo "value='$r_cghs_exp'"; else echo "value='00-00-0000'"; ?> >
                </div>
                </div>


                      <div class="form-group" id="dependent4">
                 <span class="input-group-addon" id="basic-addon3">Dependent Certificate:</span>
            <div id="radioOptions">
              <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="dependentCertificate">
                    Attached
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="dependentCertificate">
                    Not Required
                </label>
              </div>
           </div>
                </div>

                      <div class="form-group">
                  <label for="hospitalAddress">Enter the category of CGHS Applicant</label>
               <select class="custom-select form-control" name="appCGHScategory" required >
                <option value="" selected disabled>Please select</option>
                <option value="General">General</option>
                <option value="Private">Private</option>
                <option value="Semi-Private">Semi-Private</option>
            </select>
                </div>

               <input type="hidden" name="disease" value="none">

        <input type="hidden" name="pincode" value=0>
        <input type="hidden" name="amtAsked" value=0>
        <?php
if(isset($_POST['edit_claim'])){?>
<input type="hidden" name="id" value="<?php echo $id; ?>">

<?php } ?>
              </div>


	      </div>
	      <!-- /.box-body -->

	      <div class="box-footer">
	        <button type="submit" class="btn btn-primary">Submit</button>
	      </div>
	    </form>
	    </div>
	   </div>
	  </div>
	 </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include("includes/footer.php"); ?>

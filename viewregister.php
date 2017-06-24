<?php include("includes/header.php"); ?>
<?php 
$id=$_GET['id'];
$type=$_GET['type'];

$sql = '';
$table = '';
if($type=='Individual'){
 $sql = 'SELECT diaryNo, diaryType, diaryDate, objection, rank, applicantName, pis, idNo, treatment_by, type, hospitalName, amt_claimed, admis_amt, `number` , `date`,   sanction_no, sanction_date, s_no  FROM register WHERE s_no = ?'; 
 $table =   'register';
}elseif($type=='Hospital'){
 $sql='SELECT diaryNo, diaryType, diaryDate, objection, rank, applicantName, pis, idNo, treatment_by, type, hospitalName, amt_claimed, admis_amt, `number` , `date`,   sanction_no, sanction_date, s_no  FROM register_hospital WHERE s_no = ?';  
 $table = 'register_hospital'; 
}

if($stmt1 = $mysqli->prepare($sql)){
    $stmt1->bind_param('s', $id);
    $stmt1->execute();
    $stmt1->store_result();
    $stmt1->bind_result( $diaryNo, $diaryType, $diaryDate, $objection, $rank, $applicantName, $pis, $idNo, $treatment_by, $type, $hospitalName, $amt_claimed, $admis_amt, $number , $date,   $sanction_no, $sanction_date, $s_no);
   $stmt1->fetch();
}else if(DEBUG) echo $mysqli->error();

?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View Application
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Applications</a></li>
        <li class="active">View</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- title row -->
      <div class="row">
        <form class="form-horizontal" role="form" method="post" action="update_register.php">
        <div class="col-md-6">
          <div class="box box-default">
            <div class="box-header with-border">
	          <h3 class="box-title">
	            Diary Number <?php echo $diaryNo."/".$diaryType." /Genl. Branch/SED dated/".$diaryDate; ?>
	          </h3>
        	</div>
        <!-- /.col -->
            <div class="box-body">
                <?php if($objection==1){ ?>
	          <blockquote>
	          <strong>Under Objection </strong>
	          </blockquote>
                <?php } ?>
	          <blockquote>
	          <strong>Rank and Name: </strong>
	           <?php echo $rank." ".$applicantName; ?>
	          </blockquote>
	          
	          <blockquote>
	          <strong>PIS:
	            </strong><?php echo $pis; ?>
	          </blockquote>
	          
	          <blockquote>
	          <strong>Belt No:
	            </strong><?php echo $idNo; ?>
	          </blockquote>
	   
              <blockquote>
	          <strong>Treatment Taken By:
	            </strong><?php echo $treatment_by; ?>
	          </blockquote>
                
                <blockquote>
	          <strong>Case Type:
	            </strong><?php echo $type; ?>
	          </blockquote>
                
                <blockquote>
	          <strong>Hospital Name:
	            </strong><?php echo $hospitalName; ?>
	          </blockquote>
                
                <blockquote>
	          <strong>Amount Claimed:
	            </strong><?php echo $amt_claimed; ?>
	          </blockquote>
	
        	</div>
		    </div>
		  </div>

        <div class="col-md-6">
          <div class="box box-default">
        
        <!-- /.col -->
            <div class="box-body">
                 <blockquote>
	          <strong>Amount Claimed: </strong>
	           <input type="number" class="form-control" id="basic-url" name="amt_claimed" value="<?php echo $amt_claimed; ?>">
	          </blockquote>
	            <blockquote>
	          <strong>Amount Admissible: </strong>
	           <input type="number" class="form-control" id="basic-url" name="admis_amt" value="<?php echo $admis_amt; ?>">
	          </blockquote>
                
	           <blockquote>
	          <strong>Send to PHQ: </strong>
	           <input type="number" class="form-control" id="basic-url" name="phq_number" value="<?php echo $number; ?>">
	          </blockquote>
                
                

                <blockquote>
	          <strong>Date: </strong>
                <input type="text" class="form-control" id="datepicker" name="date" value="<?php echo $date; ?>">
	           </blockquote>
	          
                <blockquote>
	          <strong>Sanction No: </strong>
                <input type="number" class="form-control" id="basic-url" name="sanction_no" value="<?php echo $sanction_no; ?>">
	           </blockquote>    
                  <blockquote>
                 <label for="date">Sanction Date</label>
               <input type="text" class="form-control" id="datepicker" name="sanction_date" placeholder="Date" value="<?php echo $sanction_date; ?>">
                </blockquote>
                    
        	</div>
		    </div>
		  </div>
              <input type="hidden"  value="<?php echo $s_no; ?>" name="id" />
    <input type="hidden"  value="<?php echo $diaryType; ?>" name="diaryType" />
        <div class="row">
        <div class="col-md-6">
        
          <?php if ($_SESSION['sess_userrole']=="dealinghand"){ ?>
    <button type="submit" class="btn btn-success btn-lg btn-block col-md-6">Update</button>
           
    <?php
      }
    ?>
      

		</div>
          </form>
          
          <div class="col-md-6">
              
           <?php if ($_SESSION['sess_userrole']=="dealinghand"){ ?>
          <form action="app_functions/add_objection.php" method="post">
              <?php if($objection==0){ ?>
                <input type="hidden" value="1" name="objection">
                 <input type="hidden"  value="<?php echo $s_no; ?>" name="id" />
               <input type="hidden"  value="<?php echo $diaryType; ?>" name="diaryType" />
                <button type="submit" class="btn btn-danger btn-lg btn-block col-md-6" >Objection</button>
              <?php } else { ?> 
               <input type="hidden" value="0" name="objection">
                 <input type="hidden"  value="<?php echo $s_no; ?>" name="id" />
              <input type="hidden"  value="<?php echo $diaryType; ?>" name="diaryType" />
                <button type="submit" class="btn btn-danger btn-lg btn-block col-md-6" >Remove Objection</button>
              <?php } ?>
                </form>
           <?php
      }
    ?>
          </div>
            </div>
        </div>
    </section>

    <!-- /.content -->

    <div class="clearfix"></div>
</div>

<?php include("includes/footer.php"); ?>
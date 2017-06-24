<?php include("includes/header.php"); ?>
<?php 
$id = $_GET['id'];
$sql = "SELECT diary_no, diary_date, rank, applicant_name, pis, police_station_no, application_date, a_cghs_no, a_cghs_category, status, claim_type  FROM form WHERE app_id = ?";

if($stmt1 = $mysqli->prepare($sql)){
    $stmt1->bind_param('s', $id);
    $stmt1->execute();
    $stmt1->store_result();
    $stmt1->bind_result(  $diary_no, $diary_date, $rank, $applicant_name, $pis, $police_station_no, $application_date, $a_cghs_no, $a_cghs_category, $status, $claim_type);
    $stmt1->fetch();
}else echo $mysqli->error();


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
        <div class="col-md-6">
          <div class="box box-default">
            <div class="box-header with-border">
	          <h3 class="box-title">
	            Diary Number <?php echo $diary_no." /Genl. Branch/SED dated ".$diary_date; ?>
	          </h3>
        	</div>
        <!-- /.col -->
            <div class="box-body">
	          
	          <blockquote>
	          <strong>Rank and Name: </strong>
	           <?php echo $rank." ".$applicant_name; ?>
	          </blockquote>
	          
	          <blockquote>
	          <strong>PIS:
	            </strong><?php echo $pis; ?>
	          </blockquote>
	          
	          <blockquote>
	          <strong>Belt No:
	            </strong><?php echo $police_station_no; ?>
	          </blockquote>
	   
        	</div>
		    </div>
		  </div>

        <div class="col-md-6">
          <div class="box box-default">
        <!-- /.col -->
            <div class="box-body">
	            <blockquote>
	          <strong>Application Date: </strong>
	           <?php echo $application_date; ?>
	          </blockquote>
	          
                
                 <blockquote>
	          <strong>Applicant CGHS No: </strong>
	           <?php echo $a_cghs_no; ?>
	          </blockquote>
                
                 <blockquote>
	          <strong>Category: </strong>
	           <?php echo $a_cghs_category; ?>
	          </blockquote>
	          
        	</div>
		    </div>
		  </div>
            <div class="col-md-6">
          <form action="createpdf.php" method="post">
              <input type="hidden"  value="<?php echo $id; ?>" name="id" />
          <?php switch($claim_type){
            //permission treatment
            case 'PERMISSION': ?>
               <button type='submit' class='btn btn-info  btn-lg btn-block col-md-6' name='form12_btn'>Notesheet</button>
      <button type='submit' class='btn btn-info  btn-lg btn-block col-md-6'name='form13_btn'>Permission</button>
          <?php 
            break; //permision credit
            case 'CREDIT': ?>
              <button type='submit' class='btn btn-info  btn-lg btn-block col-md-6' name='form10_btn'>Notesheet</button>
       <button type='submit' class='btn btn-info  btn-lg btn-block col-md-6'name='form22_btn'>Permission</button>
          <?php
            break;
            case 'OP_EMERGENCY': ?>
            <button type='submit' class='btn btn-info  btn-lg btn-block col-md-6' name='form7_btn'>Forwarding Letter</button>
       <button type='submit' class='btn btn-info  btn-lg btn-block col-md-6' name='form4_btn'>Calculation Sheet</button>
               <?php if ($_SESSION['role']=="dealinghand"){ ?>
               <a href="editCalcSheet.php?id=<?php echo $id; ?>" class='btn btn-danger  btn-lg btn-block col-md-6' name='edit'>Edit Calculation Sheet</a>
               <?php } ?>
          <?php
            break; 
            case 'OP_REFERRAL': ?>
               <button type='submit' class='btn btn-info  btn-lg btn-block col-md-6' name='form2_btn'>Notesheet</button>
     <button type='submit' class='btn btn-info  btn-lg btn-block col-md-6'name='form4_btn'>Calculation Sheet</button>
        <button type='submit' class='btn btn-info  btn-lg btn-block col-md-6'name='form15_btn'>Order</button>
        <?php if ($_SESSION['role']=="dealinghand"){ ?>
              <a href="editCalcSheet.php?id=<?php echo $id; ?>" class='btn btn-danger  btn-lg btn-block col-md-6' name='edit'>Edit Calculation Sheet</a>
     <?php } ?>
          <?php
            break;
            case 'IP_EMERGENCY': ?>
         <button type='submit' class='btn btn-info' name='form3_btn'>Forwarding Letter</button>
      <button type='submit' class='btn btn-info'name='form4_btn'>Calculation Sheet</button>
                <?php if ($_SESSION['role']=="dealinghand"){ ?>
       <a href="editCalcSheet.php?id=<?php echo $id; ?>" class='btn btn-danger' name='edit'>Edit Calculation Sheet</a>
                <?php } ?>
          <?php
            break;
            }
          ?>
          </form>
        
      
        
          <?php if ($_SESSION['role']!="dealinghand"){ ?>
    <button type="button" class="btn btn-success btn-lg btn-block col-md-6" data-toggle="modal" data-target="#approveModal">Approve</button>
        <!-- Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="approveModalLabel">
                    Confirmation Details
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                
                <form class="form-horizontal" role="form" method="post" action="update.php">
                  <div class="form-group">
                    <label  class="col-sm-2 control-label"
                              for="orderNo">Comments:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" 
                        id="inputComment" name="inputComment" placeholder="Comment."/>
                    </div>
                  </div>
                <input name="appId" type="text" value="<?php echo $id; ?>" class="hidden" />
                <input type="submit" name="approve_btn" id="submit-form"  />
                </form>   
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Cancel
                </button>
            </div>
        </div>
    </div>
</div>
    <button type="button" class="btn btn-warning btn-lg btn-block " data-toggle="modal" data-target="#denyModal">Re-Eval</button>
      <!-- Modal -->
<div class="modal fade" id="denyModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="denyModalLabel">
                    Are you sure to Send for Re evaluation.
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                
                <form class="form-horizontal" role="form" method="post" action="update.php">
                  <div class="form-group">
                    <label  class="col-sm-2 control-label"
                              for="reason">Reason</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" 
                        id="inputComment" name="reason" placeholder="Reason"/>
                    </div>
                  </div>
                <input name="appId" type="number" value="<?php echo $id; ?>" class="hidden" />
                <input type="submit" id="submit-form" name="deny_btn" />
                </form>   
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Cancel
                </button>
            </div>
        </div>
    </div>
</div>
    <?php 
      } else if(($_SESSION['role']=="dealinghand")&&(($status =="REEVAL_HAG")||($status =="REEVAL_IADMIN")||($status =="REEVAL_ACP")||($status =="REEVAL_DCP"))){ 
    ?>
    <form class="form-horizontal" role="form" method="post" action="update.php">
        <input name="appId" type="text" value="<?php echo $id; ?>" class="hidden" />
        <input name="revStatus" type="text" value="<?php echo $status; ?>" class="hidden" />
        <button type="submit" class="btn btn-success btn-lg btn-block col-md-6" name="reeval_approve">Approve</button>
     </form> 
    <?php
      }
    ?>
      
		</div>

        </div>
      
    </section>

    <!-- /.content -->

    <div class="clearfix"></div>
</div>

<?php include("includes/footer.php"); ?>

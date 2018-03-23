<?php include ("includes/header.php");?>
<?php 
$month = $_GET['month'];
$diaryType = $_GET['diaryType'];

if($diaryType==='Individual'){
    $query = "SELECT s_no, diaryNo, diaryType, diaryDate, rank, applicantName, idNo, treatment_by, type 
        FROM register
        WHERE 
        Month(timestamp) = ?
        AND diaryType = 'Individual' ORDER BY timestamp DESC";
} elseif($diaryType==='Hospital'){
    $query = "SELECT s_no, diaryNo, diaryType, diaryDate, rank, applicantName, idNo, treatment_by, type 
        FROM register_hospital
        WHERE
         Month(timestamp) = ?
        AND diaryType = 'Hospital' ORDER BY timestamp DESC";
}


if($stmt1 = $mysqli->prepare($query)){
  $stmt1->bind_param('s', $month);
    $stmt1->execute();
    $stmt1->store_result();
    $stmt1->bind_result( $s_no, $diaryNo, $diaryType, $diaryDate, $rank, $applicantName, $idNo, $treatment_by, $type);
    $num = $stmt1->num_rows;
}else if(DEBUG) echo $mysqli->error();
    
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
 <br>
          <form method="post" action="print_register.php" >
              <input type="hidden" name="month" value="<?php echo $month; ?>">
              <input type="hidden" name="diaryType" value="<?php echo $diaryType; ?>">
           <button type="submit" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
          </form>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div>
          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Results</h3>
            </div>
            <!-- /.box-header -->
              <div class="box-body">
                    <table id="godown" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>S No</th>
                  <th>Diary No</th>
                  <th>Rank/Name/No</th>
                  <th>Treatment Taken By</th>
                    <th>Type</th>
                  <th>Details</th>
                </tr>
                </thead>
                <tbody>
                <?php
               
                while($stmt1->fetch())
                {
		$table = "register";
		if($diaryType=='Hospital') $table='register_hospital';
                ?>
                <tr><td><?php echo $num; ?></td>
                       <td>
                      <?php echo $diaryNo."/".$diaryType."/Gen Br./SED/Dated/".$diaryDate; ?>    
                    </td>  
                    
                    
                  <td><?php echo $rank." ".$applicantName." No.".$idNo; ?></td>
                     <td><?php echo $treatment_by; ?></td>
                    <td><?php echo $type ?></td>
                <td><a class="btn btn-block btn-default" href="viewregister.php?id=<?php echo $s_no; ?>&type=<?php echo $diaryType; ?>&month=<?php echo $month; ?>&table=<?php echo $diaryType; ?>"><i class="fa fa-eye"></i> View</a></td>
                    <td>
                    <?php 
                  
                    
                    if($s=$mysqli->prepare("select app_id FROM form WHERE diary_no = ? AND diary_date = ?")){
                        $s->bind_param('ss',$diaryNo, $diaryDate );
                        $s->execute();
                        $s->store_result();
                        $s->bind_result($app_id);
                        $s->fetch();
                    }else if(DEBUG) echo $mysqli->error();
                    
                    if($app_id=='')
                    { ?>
                 <div class="input-group-btn">
                  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Make Claim
                    <span class="fa fa-caret-down"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="form_referral.php?id=<?php echo $s_no; ?>&table=<?php echo $table; ?>">Referral/Govt</a></li>
                    <li><a href="form_emg_individual.php?id=<?php echo $s_no; ?>&table=<?php echo $table; ?>">Emergency Claim</a></li>
                    <li><a href="form_emg_credit.php?id=<?php echo $s_no; ?>&table=<?php echo $table; ?>">Emergency Credit</a></li>
                  </ul>
                </div>
                         
                    <?php }
                    elseif(is_numeric($app_id)) {
                    ?>
                        
                    <a class="btn btn-block btn-primary" href="viewclaim.php?id=<?php echo $app_id; ?>"><i class="fa fa-eye"></i> View</a>
                    <?php
                    }
                    $s->close();
                        
                        ?>
                    
                    </td>
                </tr>
                <?php 
                    $num--;
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>S No</th>
                    <th>Diary No</th>
                  <th>Rank/Name/No</th>
                  <th>Treatment Taken By</th>
                    <th>Type</th>
                  <th>Details</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
     
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include ("includes/footer.php"); ?>

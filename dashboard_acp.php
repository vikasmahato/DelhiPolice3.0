
<?php include ("includes/header.php");?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
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
              <h3 class="box-title">Latest Applications</h3>
            </div>
            <!-- /.box-header -->
              <div class="box-body">
              <table id="godown" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Status</th>
                  <th>Name</th>
                  <th>Date</th>
                  <th>Details</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT rank, applicant_name, application_date, app_id  FROM form WHERE status = 'ACP'";

                if($stmt1 = $mysqli->prepare($sql)){
                    $stmt1->execute();
                    $stmt1->store_result();
                    $stmt1->bind_result( $rank, $applicant_name, $application_date, $app_id );
                   $stmt1->fetch();
                }else if(DEBUG) echo $mysqli->error();

                while($stmt1->fetch())
                {
                ?>
                <tr>
                       <td>
                          
                           <span class="label label-default">ACP</span>
                           
                    </td>  
                    
                    
                  <td><?php echo $rank." ".$applicant_name; ?></td>
                     <td><?php echo $application_date; ?></td>
                <td><a class="btn btn-block btn-default" href="viewclaim.php?id=<?php echo $app_id; ?>"><i class="fa fa-eye"></i> View</a></td>
                </tr>
                <?php 
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Status</th>
                  <th>Name</th>
                  <th>Date</th>
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
<?php 

require('secure/db_connect.php');
require('secure/config.php');

$month = $_POST['month'];
$diaryType = $_POST['diaryType'];

if($diaryType=='Individual'){
    $query = "SELECT diaryNo, diaryType, diaryDate, rank, applicantName, idNo, treatment_by, type, sanction_no, sanction_date, `date`, `number` 
        FROM register
        WHERE Year(timestamp) = Year(CURRENT_TIMESTAMP) 
        AND Month(timestamp) = $month
        AND diaryType = 'Individual'";
} elseif($diaryType=='Hospital'){
    $query = "SELECT diaryNo, diaryType, diaryDate, rank, applicantName, idNo, treatment_by, type, sanction_no, sanction_date, `date`, `number` 
        FROM register_hospital
        WHERE Year(timestamp) = Year(CURRENT_TIMESTAMP) 
        AND Month(timestamp) = $month
        AND diaryType = 'Hospital'";
}

if($stmt1 = $mysqli->prepare($query)){
    $stmt1->bind_param('s', $month);
    $stmt1->execute();
    $stmt1->store_result();
    $stmt1->bind_result( $diaryNo, $diaryType, $diaryDate, $rank, $applicantName, $idNo, $treatment_by, $type, $sanction_no, $sanction_date, $date, $number);
}else if(DEBUG) echo $mysqli->error();
    
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Register</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
      <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
                <tr>
                  <th>Diary No</th>
                  <th>Rank/Name/No</th>
                  <th>Treatment Taken By</th>
                    <th>Type</th>
                  <th>Sancion No</th>
                    <th>PHQ No</th>
                </tr>
                </thead>
          <tbody>
                <?php
               
                while( $stmt1->fetch())
                {
                ?>
                <tr>
                       <td>
                      <?php echo $diaryNo."/".$diaryType."/Gen Br./SED/Dated/".$diaryDate; ?>    
                    </td>  
                    
                    
                  <td><?php echo $rank." ".$applicantName." No.".$idNo; ?></td>
                     <td><?php echo $treatment_by; ?></td>
                    <td><?php echo $type; ?></td>
                <td><?php echo $sanction_no; ?><br><?php echo $sanction_date; ?></td>
                    <td><?php echo $number; ?><br><?php echo $date; ?></td>
                </tr>
                <?php 
                }
                ?>
                </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

   
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>


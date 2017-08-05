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
                                    <th>Type</th>
                                    <th>Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $query = "SELECT `status`, rank, application_date, applicant_name, claim_type, app_id FROM form WHERE status LIKE '%REEVAL%' ";

                                if($stmt1 = $mysqli->prepare($query)){

                                    $stmt1->execute();
                                    $stmt1->store_result();
                                    $stmt1->bind_result( $status, $rank, $application_date, $applicant_name, $claim_type, $app_id );
                                }else if(DEBUG) echo $mysqli->error();


                                while($stmt1->fetch())
                                {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php if($status == 'HAG') { ?>
                                                <span class="label label-default">HAG</span>
                                            <?php } elseif($status == 'I_ADMIN') { ?>
                                                <span class="label label-warning">Ins. Admin</span>
                                            <?php } elseif($status == 'ACP') {?>
                                                <span class="label label-info">ACP</span>
                                            <?php } elseif($status == 'DCP') {?>
                                                <span class="label label-primary">DCP</span>
                                            <?php } elseif($status == 'REEVAL_HAG') {?>
                                                <span class="label label-default">Re. HAG</span>
                                            <?php } elseif($status == 'REEVAL_ACP') {?>
                                                <span class="label label-info">Re. ACP</span>
                                            <?php } elseif($status == 'REEVAL_IADMIN') {?>
                                                <span class="label label-warning">Re. Ins. Admin</span>
                                            <?php } elseif($status == 'D_HAND') {?>
                                                <span class="label label-default">D. Hand</span>
                                            <?php } elseif($status == 'PHQ') {?>
                                                <span class="label label-default">PHQ</span>
                                            <?php } elseif($status == 'APPROVED') {?>
                                                <span class="label label-success">Approved</span>
                                            <?php } elseif($status == 'FAILED') {?>
                                                <span class="label label-danger">Rejected</span>
                                            <?php } ?>
                                        </td>


                                        <td><?php echo $rank." ".$applicant_name; ?></td>
                                        <td><?php echo $application_date; ?></td>
                                        <td><?php echo $claim_type; ?></td>
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
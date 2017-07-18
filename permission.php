<?php include("includes/header.php"); ?>
<?php
$sql1 = "SELECT app_id, diary_no, diary_date, rank, applicant_name, relation, status, claim_type
        FROM form 
        WHERE claim_type = 'PERMISSION' OR claim_type='CREDIT'";


if ($stmt1 = $mysqli->prepare($sql1)) {
    $stmt1->execute();
    $stmt1->store_result();
    $stmt1->bind_result($s_no, $diaryNo, $diaryDate, $rank, $applicantName, $treatment_by, $status, $claim_type);
    $num_ind = $stmt1->num_rows;
} else if (DEBUG) echo $mysqli->error();


?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Permmission
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Permission</li>
        </ol>
    </section>
    <!-- Main content -->

    <section class="content">
        <!-- Info boxes -->


        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="ion ion-ios-plus"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Add New <br>Treatment</span>
                        <a href="form_permission_treatment.php" class="btn btn-sm btn-danger btn-flat pull-left">ADD</a>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="ion ion-ios-plus"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Add New <br>Credit</span>
                        <a href="form_permission_credit.php" class="btn btn-sm btn-danger btn-flat pull-left">ADD</a>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>


        </div>
        <!-- /.row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-md-12">
                <!-- TABLE: LATEST -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Latest Applications</h3>
                    </div>
                    <!-- /.box-header -->


                    <div class="box-body">
                        <table id="individual" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>S No</th>
                                <th>Status</th>
                                <th>Diary No</th>
                                <th>Rank/Name</th>
                                <th>Treatment Taken By</th>
                                <th>Notesheet</th>

                                <th>Permission</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            while ($stmt1->fetch()) {

                                ?>
                                <tr>
                                    <td><?php echo $num_ind; ?></td>
                                    <td>

                                        <span class="label label-default"><?php echo $status; ?></span>

                                    </td>
                                    <td>
                                        <?php echo $diaryNo . "/Gen Br./SED/Dated/" . $diaryDate; ?>
                                    </td>


                                    <td><?php echo $rank . " " . $applicantName; ?></td>
                                    <td><?php echo $treatment_by; ?></td>
                                    <form action="createpdf.php" method="post">
                                        <input type="hidden" value="<?php echo $s_no; ?>" name="id"/>
                                        <td>
                                            <?php if ($claim_type == 'PERMISSION') { ?>
                                                <button type='submit' class='btn btn-info  btn-lg btn-block col-md-6'
                                                        name='form12_btn'>Notesheet
                                                </button>
                                            <?php } else if ($claim_type == 'CREDIT') { ?>
                                                <button type='submit' class='btn btn-info  btn-lg btn-block col-md-6'
                                                        name='form10_btn'>Notesheet
                                                </button>
                                            <?php } ?>

                                        </td>
                                        <td>
                                            <?php if ($claim_type == 'PERMISSION') { ?>
                                                <button type='submit' class='btn btn-info  btn-lg btn-block col-md-6'
                                                        name='form13_btn'>Permission
                                                </button>
                                            <?php } else if ($claim_type == 'CREDIT') { ?>
                                                <button type='submit' class='btn btn-info  btn-lg btn-block col-md-6'
                                                        name='form22_btn'>Permission
                                                </button>
                                            <?php } ?>
                                        </td>
                                    </form>
                                </tr>
                                <?php
                                $num_ind--;
                            }
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>S No</th>
                                <th>Diary No</th>
                                <th>Rank/Name/No</th>
                                <th>Treatment Taken By</th>
                                <th>Notesheet</th>

                                <th>Permission</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>


                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->

            <!-- /.col -->
        </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include("includes/footer.php"); ?>

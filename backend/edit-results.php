<?php
// tao 1 phien ban ms hc tiep tuc_tra ve true neu oke
session_start();
//chi dinh loi bao cao
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    $stid = intval($_GET['stid']);
    if (isset($_POST['submit'])) {
        $stid = intval($_GET['stid']);
        if (isset($_POST['submit'])) {

            $rowid = $_POST['id'];
            $marks = $_POST['marks'];

            foreach ($_POST['id'] as $count => $id) {
                $mrks = $marks[$count];
                $iid = $rowid[$count];
                for ($i = 0; $i <= $count; $i++) {

                    $sql = "update tblresult  set marks=:marks where id=:iid ";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':marks', $mrks, PDO::PARAM_STR);
                    $query->bindParam(':iid', $iid, PDO::PARAM_STR);
                    $query->execute();

                    $msg = "Result info updated successfully";
                }
            }
        }
    }
?>




    <!DOCTYPE html>
    <html lang="en">



    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Edit Results</title>
        <base href="http://localhost:7882/StudentManagement/backend/">
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../frontend/plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="../frontend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="../frontend/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- JQVMap -->
        <link rel="stylesheet" href="../frontend/plugins/jqvmap/jqvmap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../frontend/dist/css/adminlte.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="../frontend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="../frontend/plugins/daterangepicker/daterangepicker.css">
        <!-- summernote -->
        <link rel="stylesheet" href="../frontend/plugins/summernote/summernote-bs4.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <style>
            body {
                font-family: 'Roboto', serif !important;
            }
        </style>
    </head>



    <style>
        .toggle {
            float: right;
            margin-left: -25px;
            margin-top: -35px;
            position: relative;
            z-index: 2;
        }
    </style>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <!-- Navbar -->
            <?php include('includes/topbar.php') ?>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <?php include('includes/leftbar.php') ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <emailid class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6 text-right">
                                <h1>Edit Result</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
                                    <li class="breadcrumb-item active">Edit Result</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </emailid>

                <!-- Main content -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">
                                <!-- jquery validation -->
                                <div class="card card-primary">
                                    <!-- /.card-header -->

                                    <?php if ($msg) { ?>
                                        <div class="alert alert-success left-icon-alert" role="alert">
                                            <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                                        </div><?php } else if ($error) { ?>
                                        <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                    <?php } ?>

                                    <!-- form start -->
                                    <form class="form-horizontal" method="post">

                                        <?php

                                        $ret = "SELECT tblstudents.StudentName,tblclasses.ClassName,tblclasses.Section from tblresult join tblstudents on tblresult.StudentId=tblresult.StudentId join tblsubjects on tblsubjects.id=tblresult.SubjectId join tblclasses on tblclasses.id=tblstudents.ClassId where tblstudents.StudentId=:stid limit 1";
                                        $stmt = $dbh->prepare($ret);
                                        $stmt->bindParam(':stid', $stid, PDO::PARAM_STR);
                                        $stmt->execute();
                                        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($stmt->rowCount() > 0) {
                                            foreach ($result as $row) {  ?>


                                                <div class="form-group">
                                                    <label for="default" class="col-sm-2 control-label">Class:</label>
                                                    <div class="col-sm-10">
                                                        <?php echo htmlentities($row->ClassName) ?>(<?php echo htmlentities($row->Section) ?>)
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="default" class="col-sm-2 control-label">Full Name:</label>
                                                    <div class="col-sm-10">
                                                        <?php echo htmlentities($row->StudentName); ?>
                                                    </div>
                                                </div>
                                        <?php }
                                        } ?>



                                        <?php
                                        $sql = "SELECT distinct tblstudents.StudentName,tblstudents.StudentId,tblclasses.ClassName,tblclasses.Section,tblsubjects.SubjectName,tblresult.marks,tblresult.id as resultid from tblresult join tblstudents on tblstudents.StudentId=tblresult.StudentId join tblsubjects on tblsubjects.id=tblresult.SubjectId join tblclasses on tblclasses.id=tblstudents.ClassId where tblstudents.StudentId=:stid ";
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':stid', $stid, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {  ?>



                                                <div class="form-group">
                                                    <label for="default" class="col-sm-2 control-label"><?php echo htmlentities($result->SubjectName) ?>:</label>
                                                    <div class="col-sm-10">
                                                        <input type="hidden" name="id[]" value="<?php echo htmlentities($result->resultid) ?>">
                                                        <input type="text" name="marks[]" class="form-control" id="marks" value="<?php echo htmlentities($result->marks) ?>" maxlength="5" required="required" autocomplete="off">
                                                    </div>
                                                </div>




                                        <?php }
                                        } ?>


                                        <div class="form-group text-center">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>

                        <!-- right column -->
                        <div class="col-md-6">

                        </div>

                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="../../../frontend/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../../../frontend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- jquery-validation -->
        <script src="../../../frontend/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="../../../frontend/plugins/jquery-validation/additional-methods.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../../../frontend/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../../../frontend/dist/js/demo.js"></script>
        <!-- Page specific script -->

    </body>

    </html>


    <!-- jQuery -->
    <script src="../frontend/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../frontend/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../frontend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../frontend/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../frontend/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="../frontend/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../frontend/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../frontend/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../frontend/plugins/moment/moment.min.js"></script>
    <script src="../frontend/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../frontend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="../frontend/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../frontend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../frontend/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../frontend/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../frontend/dist/js/pages/dashboard.js"></script>

<?php  } ?>
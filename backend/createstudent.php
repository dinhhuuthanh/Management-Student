<?php
// tao 1 phien ban ms hc tiep tuc_tra ve true neu oke
session_start();
//chi dinh loi bao cao
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['submit'])) {
        $studentname = $_POST['studentname'];
        $studentid = $_POST['studentid'];
        $emailid = $_POST['emailid'];
        $gender = $_POST['radio1'];
        $classid = $_POST['class'];
        $dob = $_POST['dob'];
        $status = 1;


        $sql = "INSERT INTO  tblstudents(StudentName,RollId,StudentEmail,Gender,ClassId,DOB,Status) VALUES(:studentname,:roolid,:studentemail,:gender,:classid,:dob,:status)";
        //chuan bi
        $query = $dbh->prepare($sql);

        //gan bien
        $query->bindParam(':studentname', $studentname, PDO::PARAM_STR);
        $query->bindParam(':roolid', $roolid, PDO::PARAM_STR);
        $query->bindParam(':studentemail', $studentemail, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':classid', $classid, PDO::PARAM_STR);
        $query->bindParam(':dob', $dob, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute(); //thuc thi cau lenh
        //tra ve id cua hang hoac chuoi dc chen cuoi
        $lastInsertId = $dbh->lastInsertId();

        if ($lastInsertId) {
            //Danh gia bieu thuc la true
            $msg = "Student info added successfully";
        } else {
            $error = "Something went wrong. Please try again";
        }
    }
?>




    <!DOCTYPE html>
    <html lang="en">



    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Create Student</title>

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
                                <h1>Create Student</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
                                    <li class="breadcrumb-item active">Create Student</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </emailid>

                <!-- Main content -->
                <emailid class="content">
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
                                    <form id="quickForm" method="post">
                                        <div class="card-body">

                                            <div class="form-group">
                                                <label for="success"> Current studentname:</label>
                                                <input type="text" name="studentname" class="form-control" id="studentname" placeholder="studentname">

                                            </div>
                                            <div class="form-group">
                                                <label for="success">New studentname:</label>
                                                <input type="number" name="studentid" class="form-control" id="studentid" placeholder="studentid">

                                            </div>
                                            <div class="form-group">
                                                <label for="success">Confirm studentname:</label>
                                                <input type="text" name="emailid" class="form-control" id="emailid" placeholder="emailid">

                                            </div>

                                            <div class="form-group" style="display: block;">
                                                <div class="row">
                                                    <label for="exampleSelectBorder"> Select Gender:</label>
                                                </div>
                                                <div style="display: flex;">
                                                    <div class="form-check" style="padding-left: 50px;">
                                                        <input class="form-check-input" value="Male" type="radio" name="radio1" checked>
                                                        <label class="form-check-label">Male</label>
                                                    </div>
                                                    <div class="form-check" style="padding-left: 50px;">
                                                        <input class="form-check-input" value="Female" type="radio" name="radio1" checked>
                                                        <label class="form-check-label">Female</label>
                                                    </div>
                                                    <div class="form-check" style="padding-left: 50px;">
                                                        <input class="form-check-input" value="Other" type="radio" name="radio1" checked>
                                                        <label class="form-check-label">Other</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleSelectBorder">Select Class:</label>
                                                <select name="class" class="custom-select form-control-border" id="exampleSelectBorder">
                                                    <option value="">Select Class</option>
                                                    <?php
                                                    $sql = "SELECT * FROM tblclasses";

                                                    $query = $dbh->prepare($sql);
                                                    //thuc thi
                                                    $query->execute();
                                                    //tra lai 1 mang chua ket qua
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    //neu so hang bi anh huong >0 thuc thi
                                                    if ($query->rowCount() > 0) {
                                                        foreach ($results as $i) { ?>
                                                            <option value="<?php echo htmlentities($i->id) ?>"><?php echo htmlentities($i->ClassNameNumeric); ?><?php echo htmlentities($i->Section); ?> </option>



                                                    <?php }
                                                    } ?>




                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="success">DBO:</label>
                                                <input type="date" name="dob" class="form-control" id="dob" placeholder="dob">

                                            </div>


                                        </div>
                                        <!-- /.card-body -->
                                        <div class="col text-center">
                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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
            </emailid>
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
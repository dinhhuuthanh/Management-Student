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
        $marks = array();
        $class = $_POST['class'];
        $studentid = $_POST['studentid'];
        $mark = $_POST['marks'];

        $stmt = $dbh->prepare("SELECT tblsubjects.SubjectName,tblsubjects.id FROM tblsubjectcombination join  tblsubjects on  tblsubjects.id=tblsubjectcombination.SubjectId WHERE tblsubjectcombination.ClassId=:cid order by tblsubjects.SubjectName");
        $stmt->execute(array(':cid' => $class));
        $sid1 = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            array_push($sid1, $row['id']);
        }

        for ($i = 0; $i < count($mark); $i++) {
            $mar = $mark[$i];
            $sid = $sid1[$i];
            $sql = "INSERT INTO  tblresult(StudentId,ClassId,SubjectId,marks) VALUES(:studentid,:class,:sid,:marks)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':studentid', $studentid, PDO::PARAM_STR);
            $query->bindParam(':class', $class, PDO::PARAM_STR);
            $query->bindParam(':sid', $sid, PDO::PARAM_STR);
            $query->bindParam(':marks', $mar, PDO::PARAM_STR);
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
    }
?>




    <!DOCTYPE html>
    <html lang="en">



    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Create Result</title>

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
    <script>
        function getStudent(val) {
            $.ajax({
                type: "POST", //GET or POST
                url: "getStudent.php", //the file to call
                data: 'classid=' + val, //get from data
                success: function(data) { //on success

                    $("#studentid").html(data);

                }
            });
            $.ajax({
                type: "POST",
                url: "getStudent.php",
                data: 'classid1=' + val,
                success: function(data) {
                    $("#subject").html(data);

                }
            });
        }
    </script>
    <script>
        function getresult(val, clid) {

            var clid = $(".clid").val();
            var val = $(".stid").val();;
            var abh = clid + '$' + val;
            //alert(abh);
            $.ajax({
                type: "POST",
                url: "getStudent.php",
                data: 'studclass=' + abh,
                success: function(data) {
                    $("#reslt").html(data);

                }
            });
        }
    </script>

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
                                <h1>Create Result</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
                                    <li class="breadcrumb-item active">Create Result</li>
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
                                    <form class="form-horizontal" method="post">

                                        <div class="form-group">
                                            <label for="default" class="col-sm-2 control-label">Class:</label>
                                            <div class="col-sm-10">
                                                <select name="class" class="form-control clid" id="classid" onChange="getStudent(this.value);" required="required">
                                                    <option value="">Select Class</option>
                                                    <?php $sql = "SELECT * from tblclasses";
                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    if ($query->rowCount() > 0) {
                                                        foreach ($results as $result) {   ?>
                                                            <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->ClassNameNumeric); ?><?php echo htmlentities($result->Section); ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="date" class="col-sm-2 control-label ">Student Name:</label>
                                            <div class="col-sm-10">
                                                <select name="studentid" class="form-control stid" id="studentid" required="required" onChange="getresult(this.value);">
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <div class="col-sm-10">
                                                <div id="reslt">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="date" class="col-sm-2 control-label">Subjects:</label>
                                            <div class="col-sm-10">
                                                <div id="subject">
                                                </div>
                                            </div>
                                        </div>



                                        <div class="form-group text-center">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" name="submit" id="submit" class="btn btn-primary">Declare Result</button>
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
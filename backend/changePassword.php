<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: login.php");
} else {
    if (isset($_POST['submit'])) {
        $password = md5($_POST['currentpassword']);
        $newpassword = md5($_POST['newpassword']);
        $username = $_SESSION['alogin'];
        $sql = "SELECT PassWord FROM admin WHERE UserName=:username and PassWord=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute(); //Thuc Thi cac cau lenh
        $results = $query->fetchAll(PDO::FETCH_OBJ); //tra ve 1 mang
        if ($query->rowCount() > 0/*tra ve so hang bi anh huong*/) {
            //neu lay duoc pass update
            $con = "update admin set PassWord=:newpassword where UserName=:username";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1->bindParam(':username', $username, PDO::PARAM_STR);
            $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();
            $msg = "Your Password succesfully changed";
        } else {
            $error = "Your current password is wrong";
        }
    }
?>

    <!DOCTYPE html>
    <html lang="en">



    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Change Password </title>

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
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6 text-right">
                                <h1>Change Password</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
                                    <li class="breadcrumb-item active">Change Password</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
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
                                    <form id="quickForm" method="POST" action="" \onsubmit="return checkpass();">
                                        <div class="card-body">

                                            <div class="form-group">
                                                <label for="exampleInputPassword1"> Current Password:</label>
                                                <input type="password" name="currentpassword" class="form-control" id="currentpassword" placeholder="currentpassword">
                                                <button type="button" onclick="checkpasscur()" class="toggle"><i id="eyeIcon" class="fa fa-eye"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">New Password:</label>
                                                <input type="password" name="newpassword" class="form-control" pattern="^(?=.*[A-Z]).{8,20}$" id="newpassword" title="at least one uppercase letter" placeholder="newpassword" require>
                                                <button type="button" onclick="checkpassnew()" class="toggle"><i id="eyeIcon" class="fa fa-eye"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Confirm Password:</label>
                                                <input type="password" name="confirmpassword" class="form-control" id="confirmpassword" placeholder="confirmpassword">
                                                <button type="button" onclick="checkpassconfim()" class="toggle"><i id="eyeIcon" class="fa fa-eye"></i></button>
                                            </div>
                                            <div class="form-group mb-0">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                                                    <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer text-center">
                                            <button type="submit" name="submit" onclick="checkpass();" class="btn btn-primary">Submit</button>
                                        </div>


                                    </form>
                                </div>
                                <!-- /.card -->
                            </div>
                            <!--/.col (left) -->
                            <!-- right column -->
                            <div class="col-md-6">

                            </div>
                            <!--/.col (right) -->
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </section>
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
        <script>
            $(function() {
                $.validator.setDefaults({
                    submitHandler: function() {
                        alert("Form successful submitted!");
                    }
                });
                $('#quickForm').validate({
                    rules: {
                        email: {
                            required: true,
                            email: true,
                        },
                        password: {
                            required: true,
                            minlength: 5
                        },
                        terms: {
                            required: true
                        },
                    },
                    messages: {
                        email: {
                            required: "Please enter a email address",
                            email: "Please enter a vaild email address"
                        },
                        password: {
                            required: "Please provide a password",
                            minlength: "Your password must be at least 5 characters long"
                        },
                        terms: "Please accept our terms"
                    },
                    errorElement: 'span',
                    errorPlacement: function(error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight: function(element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    }
                });
            });
        </script>

        <script>
            function checkpassnew() {
                x = document.getElementById('newpassword');
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }

            }

            function checkpasscur() {
                x = document.getElementById('currentpassword');
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }

            }

            function checkpassconfim() {
                x = document.getElementById('confirmpassword');
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }



            function checkpass() {
                x = document.getElementById('newpassword').value;

                y = document.getElementById('confirmpassword').value;
                if (x != y) {
                    alert("New Password and Confirm Password Field do not match  !!");
                }


            }
        </script>
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
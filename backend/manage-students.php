<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Management Student</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../frontend/plugins/fontawesome-free/css/all.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="../frontend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="../frontend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="../frontend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../frontend/dist/css/adminlte.min.css">
    </head>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <!-- Navbar -->
            <?php include('includes/topbar.php'); ?>
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
                                <h1>Manage Students</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
                                    <li class="breadcrumb-item active">Manage Students</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">



                                <div class="card">

                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Roll ID</th>
                                                    <th>Student Name</th>
                                                    <th>Gender</th>
                                                    <th>Class</th>
                                                    <th>Reg Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT tblstudents.StudentName,tblstudents.Gender,tblstudents.RollId,tblstudents.RegDate,tblstudents.StudentId,tblstudents.Status,tblclasses.ClassName,tblclasses.Section from tblstudents join tblclasses on tblclasses.id=tblstudents.ClassId";
                                                $query = $dbh->prepare($sql);
                                                $query->execute(); //thu hien
                                                //sinh mang tra kq
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                foreach ($results as $i) { ?>
                                                    <tr>
                                                        <td><?php echo htmlentities($cnt); ?></td>
                                                        <td><?php echo htmlentities($i->RollId); ?></td>
                                                        <td><?php echo htmlentities($i->StudentName); ?></td>
                                                        <td><?php echo htmlentities($i->Gender); ?></td>
                                                        <td><?php echo htmlentities($i->ClassName); ?></td>
                                                        <td><?php echo htmlentities($i->RegDate); ?></td>
                                                        <td><?php if ($i->Status == 1) {
                                                                echo htmlentities('Active');
                                                            } else {
                                                                echo htmlentities('Blocked');
                                                            }


                                                            ?></td>
                                                        <td>
                                                            <a href="students/<?php echo htmlentities($i->StudentId); ?>.html"><i class="fa fa-edit" title="Edit Record"></i> </a>

                                                        </td>

                                                    </tr>
                                                <?php $cnt = $cnt + 1;
                                                } ?>













                                            </tbody>

                                            <tfoot>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Roll ID</th>
                                                    <th>Student Name</th>
                                                    <th>Gender</th>
                                                    <th>Class</th>
                                                    <th>Reg Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
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
        <script src="../frontend/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../frontend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="../frontend/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../frontend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="../frontend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../frontend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="../frontend/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="../frontend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="../frontend/plugins/jszip/jszip.min.js"></script>
        <script src="../frontend/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="../frontend/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="../frontend/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="../frontend/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="../frontend/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../frontend/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../frontend/dist/js/demo.js"></script>
        <!-- Page specific script -->
        <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": true,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });
        </script>
    </body>

    </html>
<?php } ?>
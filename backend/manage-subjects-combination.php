<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    // for activate Subject   	
    if (isset($_GET['acid'])) {
        $acid = intval($_GET['acid']);
        $status = 1;
        $sql = "update tblsubjectcombination set status=:status where id=:acid ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':acid', $acid, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $msg = "Subject Activate successfully";
    }

    // for Deactivate Subject
    if (isset($_GET['did'])) {
        $did = intval($_GET['did']);
        $status = 0;
        $sql = "update tblsubjectcombination set status=:status where id=:did ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':did', $did, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $msg = "Subject Deactivate successfully";
    }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>

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
                                <h1>Manage Subject Combination</h1>
                            </div>

                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
                                    <li class="breadcrumb-item active">Manage Subject Combinatio</li>
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
                                    <?php if ($msg) { ?>
                                        <div class="alert alert-success left-icon-alert" role="alert">
                                            <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                                        </div><?php } else if ($error) { ?>
                                        <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                    <?php } ?>

                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Class</th>
                                                    <th>Subject</th>

                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $sql = " SELECT tblclasses.ClassNameNumeric,tblclasses.Section,tblsubjects.SubjectName,tblsubjectcombination.id as scid,tblsubjectcombination.status from tblsubjectcombination join tblclasses on tblclasses.id=tblsubjectcombination.ClassId  join tblsubjects on tblsubjects.id=tblsubjectcombination.SubjectId";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) {   ?>
                                                        <tr>
                                                            <td><?php echo htmlentities($cnt); ?></td>
                                                            <td><?php echo htmlentities($result->ClassNameNumeric); ?> &nbsp; Section-<?php echo htmlentities($result->Section); ?></td>
                                                            <td><?php echo htmlentities($result->SubjectName); ?></td>
                                                            <td><?php $stts = $result->status;
                                                                if ($stts == '0') {
                                                                    echo htmlentities('Inactive');
                                                                } else {
                                                                    echo htmlentities('Active');
                                                                }
                                                                ?></td>

                                                            <td>
                                                                <?php if ($stts == '0') { ?>
                                                                    <a href="manage-subjects-combination.php?acid=<?php echo htmlentities($result->scid); ?>" onclick="confirm('do you really want to ativate this subject');"><i class="fa fa-times" title="Acticvate Record"></i> </a><?php } else { ?>

                                                                    <a href="manage-subjects-combination.php?did=<?php echo htmlentities($result->scid); ?>" onclick="confirm('do you really want to deativate this subject');"><i class="fa fa-check" title="Deactivate Record"></i> </a>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                <?php $cnt = $cnt + 1;
                                                    }
                                                } ?>


                                            </tbody>

                                            <tfoot>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Class</th>
                                                    <th>Subject</th>

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
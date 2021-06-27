<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Result</title>

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




        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="margin-left: 0px;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1> </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active">Result</li>
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


                            <div class="panel" id="exampl">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h3 align="center">Student Result Details</h3>
                                        <hr />
                                        <?php
                                        // code Student Data
                                        $rollid = $_POST['rollid'];

                                        $_SESSION['rollid'] = $rollid;

                                        $qery = "SELECT   tblstudents.StudentName,tblstudents.RollId,tblstudents.RegDate,tblstudents.StudentId,tblstudents.Status, tblclasses.id,tblclasses.ClassName,tblclasses.Section from tblstudents join tblclasses on tblclasses.id=tblstudents.ClassId where tblstudents.RollId=:rollid";
                                        $stmt = $dbh->prepare($qery);
                                        $stmt->bindParam(':rollid', $rollid, PDO::PARAM_STR);

                                        $stmt->execute();
                                        $resultss = $stmt->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($stmt->rowCount() > 0) {
                                            $classid = null;
                                            foreach ($resultss as $row) {   ?>
                                                <p><b>Student Name :</b> <?php echo htmlentities($row->StudentName); ?></p>
                                                <p><b>Student Roll Id :</b> <?php echo htmlentities($row->RollId); ?>
                                                <p><b>Student Class:</b> <?php echo htmlentities($row->ClassName); ?>(<?php echo htmlentities($row->Section); ?>)
                                                <?php
                                                $classid = $row->id;
                                            }

                                                ?>
                                    </div>
                                    <div class="panel-body p-20">







                                        <table class="table table-hover table-bordered" border="1" width="100%">
                                            <thead>
                                                <tr style="text-align: center">
                                                    <th style="text-align: center">#</th>
                                                    <th style="text-align: center"> Subject</th>
                                                    <th style="text-align: center">Marks</th>
                                                </tr>
                                            </thead>




                                            <tbody>
                                                <?php
                                                // Code for result

                                                $query = "select t.StudentName,t.RollId,t.ClassId,t.marks,SubjectId,tblsubjects.SubjectName from (select sts.StudentName,sts.RollId,sts.ClassId,tr.marks,SubjectId from tblstudents as sts join  tblresult as tr on tr.StudentId=sts.StudentId) as t join tblsubjects on tblsubjects.id=t.SubjectId where (t.RollId=:rollid and t.ClassId=:classid)";
                                                $query = $dbh->prepare($query);
                                                $query->bindParam(':rollid', $rollid, PDO::PARAM_STR);
                                                $query->bindParam(':classid', $classid, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($countrow = $query->rowCount() > 0) {
                                                    foreach ($results as $result) {

                                                ?>

                                                        <tr>
                                                            <th scope="row" style="text-align: center"><?php echo htmlentities($cnt); ?></th>
                                                            <td style="text-align: center"><?php echo htmlentities($result->SubjectName); ?></td>
                                                            <td style="text-align: center"><?php echo htmlentities($totalmarks = $result->marks); ?></td>
                                                        </tr>
                                                    <?php
                                                        $totlcount += $totalmarks;
                                                        $cnt++;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <th scope="row" colspan="2" style="text-align: center">GPA</th>
                                                        <td style="text-align: center"><b><?php echo htmlentities($totlcount / ($cnt - 1)); ?></b> </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" colspan="2" style="text-align: center">Classification</th>

                                                        <td style="text-align: center"><b> <?php $dtb = $totlcount / ($cnt - 1);
                                                                                            if ($dtb < 4) {
                                                                                                echo  htmlentities("YẾU");
                                                                                            } else if ($dtb < 6.5) {
                                                                                                echo  htmlentities("TRUNG BÌNH");
                                                                                            } else if ($dtb < 8.0) {
                                                                                                echo  htmlentities("KHÁ");
                                                                                            } else {
                                                                                                echo  htmlentities("GIỎI");
                                                                                            }

                                                                                            ?></b></td>
                                                    </tr>

                                                    <tr>

                                                        <td colspan="3" align="center"><i class="fa fa-print fa-2x" aria-hidden="true" style="cursor:pointer" OnClick="CallPrint(this.value)"></i></td>
                                                    </tr>

                                                <?php } else { ?>
                                                    <div class="alert alert-warning left-icon-alert" role="alert">
                                                        <strong>Notice!</strong> Your result not declare yet
                                                    <?php }
                                                    ?>
                                                    </div>
                                                <?php
                                            } else { ?>

                                                    <div class="alert alert-danger left-icon-alert" role="alert">
                                                        strong>Oh snap!</strong>
                                                    <?php
                                                    echo htmlentities("Invalid Roll Id");
                                                }
                                                    ?>
                                                    </div>



                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <!-- /.panel -->
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>



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
    <script>
        $(function($) {

        });


        function CallPrint(strid) {
            var prtContent = document.getElementById("exampl");
            var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
            WinPrint.document.write(prtContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
        }
    </script>
</body>

</html>
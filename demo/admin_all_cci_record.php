<?php include('includes/connect.php');
include('includes/secure.php');
error_reporting(0);

session_start();
$aid = $_SESSION['aid'];


?>

<?php include "admin_header.php"; ?>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_settings-panel.html -->


    <!-- partial -->
    <!-- partial:partials/_sidebar.html -->
    <?php include "admin_menu.php" ?>
    <!-- partial -->


    <div class="main-panel">
        <div class="content-wrapper">

            <div class="row">


                <div class="card">
                    <a href="admin_dashboard.php?aid=<?php echo $aid ?>">
                        <button class="btn btn-outline-primary" style="float: right;">Back</button>
                    </a>
                    <div class="card-body">
                        <h4 class="card-title">All CCI's Record</h4>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="order-listing" class="table">
                                        <thead>
                                        <tr>
                                            <th>CCI ID</th>
                                            <th>CCI Name</th>
                                            <th>Email ID</th>
                                            <th>Total Child</th>
                                            <th>Action</th>
                                            <th>Weekly</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        //session_start();


                                        $sql = "select * from tbl_user ";

                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            $i = 0;
                                            while ($row = mysqli_fetch_array($result)) {
                                                ?>


                                                <tr>
                                                    <td><?php echo $row['cciid']; ?></td>
                                                    <td><?php echo $row['cciname']; ?></td>
                                                    <td><?php echo $row['uname']; ?></td>
                                                    <td><?php echo $ccdata['cctotal']; ?></td>
                                                    <td>
                                                        <a href="admin_cci_record.php?cciid=<?php echo $row['cciid']; ?>">
                                                            <button class="btn btn-outline-success">Record</button>
                                                        </a></td>
                                                    <td>
                                                        <a href="child_weekly_record.php?cciid=<?php echo $row['cciid']; ?>">
                                                            <button class="btn btn-outline-success">Assessment</button>
                                                        </a></td>

                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <!-- content-wrapper ends -->
                        <!-- partial:partials/_footer.html -->

                        <!-- partial -->
                    </div>
                    <!-- main-panel ends -->
                </div>
                <!-- page-body-wrapper ends -->
            </div>
            <!-- container-scroller -->

            <!-- plugins:js -->
            <script src="../vendors/js/vendor.bundle.base.js"></script>
            <!-- endinject -->
            <!-- Plugin js for this page -->
            <script src="../vendors/chart.js/Chart.min.js"></script>
            <script src="../vendors/datatables.net/jquery.dataTables.js"></script>
            <script src="../vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
            <script src="../js/dataTables.select.min.js"></script>
            <!-- End plugin js for this page -->
            <!-- inject:js -->

            <!-- endinject -->
            <!-- Custom js for this page-->
            <script src="../js/jquery.cookie.js" type="text/javascript"></script>
            <script src="../js/dashboard.js"></script>
            <script src="../js/Chart.roundedBarCharts.js"></script>
            <!-- End custom js for this page-->
            </body>


            </html>


<?php include('includes/connect.php');
include('includes/secure.php');
error_reporting(0);

session_start();
$cciid = $_GET['cciid'];


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
                    <div class="card-body">
                        <h4 class="card-title">Child's Record</h4>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="order-listing" class="table">
                                        <thead>
                                        <tr>

                                            <th>Child ID</th>
                                            <th>Name</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Hindi</th>
                                            <th>Maths</th>
                                            <th>Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        session_start();


                                        $sql = "select * from tbl_child where cciid=$cciid ";

                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            $i = 0;
                                            while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                                <tr>

                                                    <td><?php echo $row['cid']; ?></td>
                                                    <td>
                                                        <a href="district_child_record.php?cciid=<?php echo $cciid ?>&&cid=<?php echo $row['cid'] ?>"><?php echo $row['cname']; ?></a>
                                                    </td>

                                                    <td><?php echo $row['cage']; ?></td>
                                                    <td><?php echo $row['cgender']; ?></td>
                                                    <td>
                                                        <?php $querycheck = "SELECT * FROM tbl_child_score_h WHERE cid ='" . $row['cid'] . "' ";

                                                        $resultch = mysqli_query($conn, $querycheck);
                                                        $cuser = mysqli_fetch_assoc($resultch);


                                                        if (mysqli_num_rows($resultch)) {
                                                            ?>

                                                            <b><?php echo $cuser['bq2'];
                                                                ?>
                                                            </b>


                                                            <?php
                                                        } else {
                                                            ?>
                                                            No Assessment
                                                            <?php
                                                        }
                                                        ?>          </td>

                                                    <td>
                                                        <?php $querycheck = "SELECT * FROM tbl_child_score_h WHERE cid ='" . $row['cid'] . "'";

                                                        $resultch = mysqli_query($conn, $querycheck);
                                                        $cuser = mysqli_fetch_assoc($resultch);


                                                        if (mysqli_num_rows($resultch)) {
                                                            ?>

                                                            <b><?php echo $cuser['mq2'];
                                                                ?>
                                                            </b>


                                                            <?php
                                                        } else {
                                                            ?>
                                                            No Assessment
                                                            <?php
                                                        }
                                                        ?>


                                                    </td>
                                                    <td>
                                                        <a href="admin_child_delete.php?cciid=<?php echo $cciid ?>&&cid=<?php echo $row['cid'] ?>">Delete</a>
                                                    </td>


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


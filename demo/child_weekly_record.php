<?php include('includes/connect.php');
include('includes/secure.php');
error_reporting(0);

session_start();

$aid = $_SESSION['aid'];
$cciid = $_GET['cciid'];
//$cmonth= $_GET['cmonth']


?>

<?php include "admin_header.php"; ?>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_settings-panel.html -->


    <!-- partial -->
    <!-- partial:partials/_sidebar.html -->
    <?php include "menu.php" ?>
    <!-- partial -->


    <div class="main-panel">

        <div class="content-wrapper">


            <div class="card">
                <div class="card-body">
                    <a href="admin_dashboard.php?aid=<?php echo $aid ?>">
                        <button class="btn btn-outline-primary" style="float: right;color: #FFF;">Back</button>
                    </a>
                    <h4 class="card-title"
                        style="font-size: 1.525rem; background: cadetblue; padding: 10px; text-align: center; color: white;">
                        Month Wise Record</h4>
                    <div class="card-body">


                        <div class="card">
                            <div class="card-body">


                                <?php
                                session_start();


                                $msql = "select cmonth from tbl_child_week where cciid=$cciid group by cmonth ";

                                $mresult = mysqli_query($conn, $msql);
                                if (mysqli_num_rows($mresult) > 0)
                                {
                                $i = 0;
                                while ($mrow = mysqli_fetch_array($mresult))
                                {
                                ?>


                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="order-listing" class="table">
                                                <thead>
                                                <br>
                                                <h4 class="card-title"> Month:
                                                    <button class="btn btn-outline-success"><?php echo $mrow['cmonth']; ?></button>
                                                </h4>

                                                <tr>

                                                    <!--<th>Month</th> -->
                                                    <th>Child Name</th>
                                                    <th>Age</th>
                                                    <th> Gender</th>
                                                    <th>Child ID</th>

                                                    <th>Baseline in Hindi</th>
                                                    <th>Baseline in Maths</th>
                                                    <th> Hindi W1</th>
                                                    <th> Maths W1</th>
                                                    <th> Hindi W2</th>
                                                    <th> Maths W2</th>
                                                    <th> Hindi W3</th>
                                                    <th> Maths W3</th>
                                                    <th> Hindi W4</th>
                                                    <th> Maths W4</th>

                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php

                                                session_start();
                                                $sql = "select * from tbl_child_week where cmonth='" . $mrow['cmonth'] . "' group by cid ";

                                                $result = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($result) > 0) {
                                                    $i = 0;
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        ?>

                                                        <tr>
                                                            <?php
                                                            // $sqll="select * from tbl_child where cciid='".$row['cciid']."' and cid='".$row['cid']."'";
                                                            $sqll = "SELECT tbl_child.cname,tbl_child.cage, tbl_child.cgender,tbl_child_score_m.bqm2,tbl_child_score_h.bq2 FROM tbl_child INNER JOIN tbl_child_score_m ON tbl_child.cid = tbl_child_score_m.cid INNER JOIN tbl_child_score_h ON tbl_child.cid = tbl_child_score_h.cid WHERE tbl_child_score_m.clid='Basic' AND tbl_child_score_m.clid='Basic' AND tbl_child.cciid='" . $row['cciid'] . "' AND tbl_child.cid='" . $row['cid'] . "'";

                                                            //SELECT tbl_child.cname,tbl_child.cage, tbl_child.cgender,tbl_child_score_h.bq2 FROM tbl_child INNER JOIN tbl_child_score_h ON tbl_child.cid = tbl_child_score_h.cid group by tbl_child_score_h.bq2
                                                            $resultl = mysqli_query($conn, $sqll);
                                                            if (mysqli_num_rows($result) > 0) {
                                                                $i = 0;
                                                                while ($rowm = mysqli_fetch_array($resultl)) {
                                                                    ?>


                                                                    <?php
                                                                    /*   $sqlb="select * from tbl_child_score_h where cciid='".$row['cciid']."' and cid='".$row['cid']."'";

                                                                               $resultb= mysqli_query($conn,$sqlb);
                                                                               if (mysqli_num_rows($resultb)>0)
                                                                               {
                                                                                   $i=0;
                                                                                   while($rowb=mysqli_fetch_array($resultb))
                                                                                   { */
                                                                    ?>


                                                                    <td><?php echo $rowm ['cname']; ?></</td>
                                                                    <td><?php echo $rowm['cage']; ?></</td>
                                                                    <td><?php echo $rowm['cgender']; ?></</td>
                                                                    <td><?php echo $row['cid']; ?></</td>

                                                                    <td><?php echo $rowm['bq2']; ?></td>
                                                                    <td><?php echo $rowm['bqm2']; ?></td>


                                                                    <?php
                                                                    $sqls = "select * from tbl_child_week where cid='" . $row['cid'] . "'and cmonth='" . $row['cmonth'] . "' ";

                                                                    $results = mysqli_query($conn, $sqls);
                                                                    $cuser = mysqli_fetch_assoc($results);

                                                                    ?>


                                                                    <!--   <td><?php //echo $row['cweek'];
                                                                    ?></td>-->
                                                                    <td><?php echo $cuser['chindi']; ?></td>
                                                                    <td><?php echo $cuser['cmaths']; ?></td>
                                                                    <td><?php echo $cuser['chindi1']; ?></td>
                                                                    <td><?php echo $cuser['cmaths1']; ?></td>
                                                                    <td><?php echo $cuser['chindi2']; ?></td>
                                                                    <td><?php echo $cuser['cmaths2']; ?></td>
                                                                    <td><?php echo $cuser['chindi3']; ?></td>
                                                                    <td><?php echo $cuser['cmaths3']; ?></td>


                                                                    <?php


                                                                }
                                                            }
                                                            ?>

                                                        </tr>

                                                        <?php

                                                    }
                                                }
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
            <script src="../js/off-canvas.js"></script>
            <script src="../js/hoverable-collapse.js"></script>
            <script src="../js/template.js"></script>
            <script src="../js/settings.js"></script>
            <script src="../js/todolist.js"></script>
            <!-- endinject -->
            <!-- Custom js for this page-->
            <script src="../js/jquery.cookie.js" type="text/javascript"></script>
            <script src="../js/dashboard.js"></script>
            <script src="../js/Chart.roundedBarCharts.js"></script>
            <!-- End custom js for this page-->
            </body>


            </html>
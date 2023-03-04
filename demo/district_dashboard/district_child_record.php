<?php include('../includes/connect.php');
// include('includes/secure.php');
error_reporting(0);

session_start();
$cciid = $_GET['cciid'];
$cid = $_GET['cid'];


?>

<?php include "district_header.php"; ?>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_settings-panel.html -->


    <!-- partial -->
    <!-- partial:partials/_sidebar.html -->
    <?php include "district_menu.php" ?>
    <!-- partial -->


    <div class="main-panel">

        <div class="content-wrapper">
            <a href="district_cci_record.php?cciid=<?php echo $cciid ?>">
                <button class="btn btn-outline-primary" style="float: right;color: #FFF;">Back</button>
            </a>
            <?php
            session_start();


            $sql = "select * from tbl_child where cciid=$cciid and cid=$cid";

            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0)
            {
            $i = 0;
            while ($row = mysqli_fetch_array($result))
            {
            ?>
            <h3 class="title" style="font-size: 1.525rem; background: cadetblue; padding: 10px; text-align: center;
    color: white;"> CCI Name : <?php echo $row ['cciname']; ?> </h3>
            <div class="container">
                <div class="col-md-12 grid-margin">
                    <div class="row">

                        <div class
                        "col-md-6 grid-margin stretch-card" style="width:50%;padding-bottom: 10px;border-block-end: 1px
                        blue dotted;">
                        Child ID : <?php echo $row ['cid']; ?>
                    </div>
                    <div class
                    "col-md-6 grid-margin stretch-card" style="width:50%;padding-bottom: 10px;border-block-end: 1px blue
                    dotted;">
                    Name : <?php echo $row ['cname']; ?>
                </div>
                <div class
                "col-md-6 grid-margin stretch-card" style="width:50%;padding-bottom: 10px;border-block-end: 1px blue
                dotted;">
                Age : <?php echo $row ['cage']; ?>
            </div>
            <div class
            "col-md-6 grid-margin stretch-card" style="width:50%;padding-bottom: 10px;border-block-end: 1px blue
            dotted;">
            Gender : <?php echo $row ['cgender']; ?>
        </div>
        <div class
        "col-md-6 grid-margin stretch-card" style="width:50%;padding-bottom: 10px;border-block-end: 1px blue dotted;">
        School Name : <?php echo $row ['cschool']; ?>
    </div>
</div>
    </div>
    </div>

<?php
}
}
?>

<div class="card">
    <div class="card-body">
        <h4 class="card-title"
            style="font-size: 1.525rem; background: cadetblue; padding: 10px; text-align: center; color: white;">
            Learning Level in Baseline</h4>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="order-listing" class="table">
                        <thead>
                        <tr>

                            <th>Hindi Tool</th>
                            <th>Hindi Level</th>
                            <th>Maths Tool</th>
                            <th>Maths Level</th>
                            <th>Assessment Taken</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        session_start();


                        $sql = "select * from tbl_child_score_h where cciid=$cciid and cid=$cid";

                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            $i = 0;
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr>

                                    <td><?php echo $row['bq1']; ?></td>
                                    <td><?php echo $row['bq2']; ?></td>
                                    <td><?php echo $row['mq1']; ?></td>
                                    <td><?php echo $row['mq2']; ?></td>
                                    <td><?php echo $row['ctime']; ?></td>

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

    <div class="card-body">
        <h4 class="card-title"
            style="font-size: 1.525rem; background: cadetblue; padding: 10px; text-align: center; color: white;">Weekly
            Learning Level</h4>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="order-listing" class="table">
                        <thead>
                        <tr>

                            <th>Month</th>
                            <th>Week</th>
                            <th>Hindi</th>
                            <th>Maths</th>

                            <th>Assessment Taken</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        session_start();


                        $sql = "select * from tbl_child_week where cciid=$cciid and cid=$cid";

                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            $i = 0;
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr>

                                    <td><?php echo $row['cmonth']; ?></td>
                                    <td><?php echo $row['cweek']; ?></td>
                                    <td><?php echo $row['chindi']; ?></td>
                                    <td><?php echo $row['cmaths']; ?></td>
                                    <td><?php echo $row['ctime']; ?></td>
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


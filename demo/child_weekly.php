<?php include('includes/connect.php');
include('includes/secure.php');
error_reporting(0);
$cciid = $_SESSION['cciid'];
$cid = $_GET['cid'];


?>

<?php include "header.php"; ?>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_settings-panel.html -->


    <!-- partial -->
    <!-- partial:partials/_sidebar.html -->
    <?php include "menu.php" ?>
    <!-- partial -->


    <div class="main-panel">

        <div class="content-wrapper">
            <a href="dashboard.php?cciid=<?php echo $cciid ?>">
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
    color: white;"> CCI Name : <?php echo $row ['cciname']; ?> Child wise Assessment Record </h3>
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
                CCI Name : <?php echo $row ['cciname']; ?>
            </div>
            <div class
            "col-md-6 grid-margin stretch-card" style="width:50%;padding-bottom: 10px;border-block-end: 1px blue
            dotted;">
            CCI ID : <?php echo $row ['cciid']; ?>
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
            style="font-size: 1.525rem; background: cadetblue; padding: 10px; text-align: center; color: white;">Weekly
            Assessment</h4>

        <form class="form-sample" method="post" action="child_weekly_action.php">

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">Please Select Month</label>
                        <div class="col-sm-5">
                            <select class=" js-example-basic-single w-100" name="cmonth" required>
                                <option value="" selected>Select Month</option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">Please Select Week* </label>
                        <div class="col-sm-5">
                            <select class=" js-example-basic-single w-100" name="cweek" required>
                                <option value="Week 1">Week 1: To be uploaded by every 15th of the month</option>
                                <option value="Week 2">Week 2: To be uploaded by every 30th of the month</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">Please Select Level for Hindi* </label>
                        <div class="col-sm-5">
                            <select class=" js-example-basic-single w-100" name="chindi" required>
                                <option value="Beginner">Beginner: Child Can not identify letters</option>
                                <option value="Letter">Child Can Identify Letter</option>
                                <option value="Words">Child can read words</option>
                                <option value="Paragraphs">Child can read paragraphs</option>
                                <option value="Story">Child can read story</option>
                                <option value="Advanced">Child can read advanced story</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">Please Select Level for Maths *</label>
                        <div class="col-sm-5">
                            <select class=" js-example-basic-single w-100" name="cmaths" required>
                                <option value="Beginner">Beginner: Can not identify numbers</option>
                                <option value="Level L1">Level L1: Can identify numbers from 1 to 9</option>
                                <option value="Level L2">Level L2: Can identify numbers from 10 to 99</option>
                                <option value="Subtraction">Child can do Subtraction</option>
                                <option value="Division">Child can do Division</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">How Many days the child has used the tablet ?*</label>
                        <div class="col-sm-5">
                            <select class=" js-example-basic-single w-100" name="tablet_use" >
                                <option value="0" selected>select Number of Days</option>
                                <option value="1">Days 1</option>
                                <option value="2">Days 2</option>
                                <option value="3">Days 3</option>
                                <option value="4">Days 4</option>
                                <option value="5">Days 5</option>
                                <option value="6">Days 6</option>
                                <option value="7">Days 7</option>
                                <option value="8">Days 8</option>
                                <option value="9">Days 9</option>
                                <option value="10">Days 10</option>
                                <option value="11">Days 11</option>
                                <option value="12">Days 12</option>
                                <option value="13">Days 13</option>
                                <option value="14">Days 14</option>
                                <option value="15">Days 15</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">What is the PraDigi Score ?*</label>
                        <div class="col-sm-5">
                            <input type="number" name="praigi_score" >
                        </div>
                    </div>
                    <input type="hidden" name="cciid" value="<?php echo $cciid ?>"/>
                    <input type="hidden" name="cid" value="<?php echo $cid ?>"/>
                    <div class="wrapper">
                        <input type="submit" class="btn btn-outline-primary btn-block" name="submit" onclick="return confirm('Are you sure you want submit the form data?')">
                    </div>


                </div>
            </div>
        </form>
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


<?php include('includes/connect.php');
include('includes/secure.php');
error_reporting(0);

session_start();
$cciid = $_SESSION['cciid'];
$cid = $_GET['cid'];


?>

<?php include "header.php" ?>

<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_settings-panel.html -->


    <!-- partial -->
    <!-- partial:partials/_sidebar.html -->
    <?php include "menu.php" ?>

    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <a href="dashboard.php?cciid=<?php echo $cciid ?>">
                    <button class="btn btn-outline-primary" style="float: right;">Back</button>
                </a>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="container text-center pt-5">
                                <h1 class="mb-3 mt-5">Learning Level of Child </h1>

                                <div class="row pricing-table">
                                    <div class="col-md-6 col-xl-6 grid-margin stretch-card pricing-card">
                                        <div class="card border-primary border pricing-card-body">
                                            <div class="text-center pricing-card-head">
                                                <h3>Hindi Basic Level</h3>

                                            </div>
                                            <!--   <ul class="list-unstyled plan-features">
                                                 <li>Email preview on air</li>
                                               </ul>-->
                                            <div class="wrapper">
                                                <a href="b_level_r_h.php?cciid=<?php echo $cciid ?>&&cid=<?php echo $cid ?>"
                                                   class="btn btn-outline-primary btn-block">Click Here</a>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-6 grid-margin stretch-card pricing-card">
                                        <div class="card border border-success pricing-card-body">
                                            <div class="text-center pricing-card-head">
                                                <h3 class="text-success">Maths Basic Level</h3>

                                            </div>

                                            <div class="wrapper">
                                                <a href="b_level_r_m.php?cciid=<?php echo $cciid ?>&&cid=<?php echo $cid ?>"
                                                   class="btn btn-success btn-block">Click Here</a>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->

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
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="../js/off-canvas.js"></script>
<script src="../js/hoverable-collapse.js"></script>
<script src="../js/template.js"></script>
<script src="../js/settings.js"></script>
<script src="../js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<!-- End custom js for this page-->
</body>


</html>

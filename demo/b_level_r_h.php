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


                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Basic Level Hindi</h4>
                            <form class="form-sample" method="Post" action="clevelbh_action.php">
                                <p class="card-description">

                                </p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Please select the testing tool that
                                                was used to conduct the baseline assessment of students: </label>
                                            <div class="col-sm-5">
                                                <select class=" js-example-basic-single w-100" name="bq1">
                                                    <option value="Sample Tool 1">Sample Tool 1</option>
                                                    <option value="Sample Tool 2">Sample Tool 2</option>
                                                    <option value="Sample Tool 3">Sample Tool 3</option>
                                                    <option value="Sample Tool 4">Sample Tool 4</option>
                                                    <option value="Sample Tool 5">Sample Tool 5</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Select level of child under
                                                basic:</label>

                                            <div class="col-sm-5">
                                                <select class=" js-example-basic-single w-100" name="bq2">
                                                    <option value="Beginner">Beginner: Child Can not identify letters
                                                    </option>
                                                    <option value="Letter">Child Can Identify Letter</option>
                                                    <option value="Words">Child can read words</option>
                                                    <option value="Paragraphs">Child can read paragraphs</option>
                                                    <option value="Story">Child can read story</option>
                                                    <option value="Advanced">Child can read advanced story</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                </div>


                        </div>


                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Basic Level Maths</h4>
                                    <p class="card-description">

                                    </p>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-sm-6 col-form-label">Please select the testing tool
                                                    that was used to conduct the baseline assessment of
                                                    students. </label>
                                                <div class="col-sm-5">
                                                    <select class=" js-example-basic-single w-100" name="mq1">
                                                        <option value="Sample Tool 1">Sample Tool 1</option>
                                                        <option value="Sample Tool 2">Sample Tool 2</option>
                                                        <option value="Sample Tool 3">Sample Tool 3</option>
                                                        <option value="Sample Tool 4">Sample Tool 4</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-sm-6 col-form-label">What is the level in
                                                    Maths</label>

                                                <div class="col-sm-5">
                                                    <select class=" js-example-basic-single w-100" name="mq2">
                                                        <option value="Beginner">Beginner: Can not identify numbers
                                                        </option>
                                                        <option value="Level L1">Level L1: Can identify numbers from 1
                                                            to 9
                                                        </option>
                                                        <option value="Level L2">Level L2: Can identify numbers from 10
                                                            to 99
                                                        </option>
                                                        <option value="Subtraction">Child can do Subtraction</option>
                                                        <option value="Division">Child can do Division</option>

                                                    </select>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row">

                                            <!-- <div class="col-md-12">
                                              <div class="form-group row">
                                           <label class="col-sm-6 col-form-label">What is the level in mathematical operations?</label>
                                           <div class="col-sm-5">
                                                  <select class=" js-example-basic-single w-100" name="bq3" >
                                                    <option value="child can't identify">Child can't identify/solve  mathematical operations</option>
                                                    <option value="Subtraction">Subtraction</option>
                                                    <option value="Division">Division</option>
                                                  </select>
                                              </div>
                                            </div>
                                          </div> -->
                                            <input type="hidden" name="cciid" value="<?php echo $cciid ?>"/>
                                            <input type="hidden" name="cid" value="<?php echo $cid ?>"/>


                                            <div class="wrapper">
                                                <input type="submit" class="btn btn-outline-primary btn-block"
                                                       name="submit">
                                            </div>
                                        </div>
                                        </form>


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
<script src="../vendors/typeahead.js/typeahead.bundle.min.js"></script>
<script src="../vendors/select2/select2.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->

<!-- endinject -->
<!-- Custom js for this page-->
<script src="../js/file-upload.js"></script>
<script src="../js/typeahead.js"></script>
<script src="../js/select2.js"></script>
<!-- End custom js for this page-->
</body>

</html>

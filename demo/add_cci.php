<?php include('includes/connect.php');
include('includes/secure.php');
error_reporting(0);

session_start();
$aid = $_SESSION['aid'];
?>
<?php include "admin_header.php" ?>

<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_settings-panel.html -->


    <!-- partial -->
    <!-- partial:partials/_sidebar.html -->
    <?php include "admin_menu.php" ?>
    <!-- partial -->


    <div class="main-panel">
        <div class="content-wrapper">


            <div class="container-scroller">
                <div class="container-fluid page-body-wrapper full-page-wrapper">
                    <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
                        <div class="row flex-grow">
                            <div class="col-lg-12 d-flex align-items-center justify-content-center">
                                <div class="auth-form-transparent text-left p-3">

                                    <h3>Add New child </h3>

                                    <form class="pt-3" action="add_cci_action.php" method="POST">

                                        <div class="form-group">
                                            <label>Name of the CCI*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-user text-primary"></i>
                      </span>
                                                </div>
                                                <input type="text" class="form-control form-control-lg border-left-0"
                                                       placeholder="CCI Name" required name="cciname">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Name of the Incharge*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-user text-primary"></i>
                      </span>
                                                </div>
                                                <input type="text" class="form-control form-control-lg border-left-0"
                                                       name="cuname" placeholder="Incharge Name" required>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label>Email Id*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-user text-primary"></i>
                      </span>
                                                </div>
                                                <input type="email" class="form-control form-control-lg border-left-0"
                                                       placeholder="Email ID" name="uname" required>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Password*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-user text-primary"></i>
                      </span>
                                                </div>
                                                <input type="text" class="form-control form-control-lg border-left-0"
                                                       placeholder="password" required name="password">
                                            </div>
                                        </div>

                                        <input type="hidden" name="aid" value="<?php echo $aid ?>"/>


                                        <div class="mt-3">
                                            <button class="btn btn-outline-primary " name="addchild">
                                                Add CCI
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- content-wrapper ends -->
                </div>
                <!-- page-body-wrapper ends -->
            </div>
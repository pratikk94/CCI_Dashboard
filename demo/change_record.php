<?php include('includes/connect.php');
include('includes/secure.php');
error_reporting(0);

session_start();
$cciid = $_SESSION['cciid'];
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


            <div class="container-scroller">
                <div class="container-fluid page-body-wrapper full-page-wrapper">
                    <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
                        <div class="row flex-grow">
                            <div class="col-lg-12 d-flex align-items-center justify-content-center">
                                <div class="auth-form-transparent text-left p-3">

                                    <h3>CCI Record </h3>

                                    <form class="pt-3" action="change_record_action.php" method="post">
                                        <?php
                                        session_start();
                                        $sql = "select * from tbl_user where cciid=$cciid";

                                        $result = mysqli_query($conn, $sql);
                                        $data = mysqli_fetch_assoc($result);

                                        ?>
                                        <div class="form-group">
                                            <label>CCI Name</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-user text-primary"></i>
                      </span>
                                                </div>
                                                <input type="text" class="form-control form-control-lg border-left-0"
                                                       value="<?php echo $data['cciname']; ?>" readonly>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label>Username</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-user text-primary"></i>
                      </span>
                                                </div>
                                                <input type="text" class="form-control form-control-lg border-left-0"
                                                       value="<?php echo $data['uname']; ?>" readonly>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Password</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-user text-primary"></i>
                      </span>
                                                </div>
                                                <input type="text" class="form-control form-control-lg border-left-0"
                                                       name="password" value="<?php echo $data['password']; ?>">
                                            </div>
                                        </div>


                                        <input type="hidden" name="cciid" value="<?php echo $cciid ?>"/>

                                        <input type="hidden" name="cciname" value="<?php echo $data['cciname']; ?>"/>

                                        <div class="mt-3">
                                            <button class="btn btn-outline-primary " name="cpassword">
                                                Change Password
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
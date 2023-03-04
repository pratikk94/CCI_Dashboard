<?php include('includes/connect.php');
include('includes/secure.php');
error_reporting(0);

session_start();
$cciid = $_SESSION['cciid'];
$cid = $_GET['cid'];


?>

<?php include "header.php"; ?>
<div class="container-fluid page-body-wrapper">
<?php include "menu.php" ?>
<!-- partial -->
<br>  <br>  <br>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">All Children's Record</h4>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <!-- <form action="cstatus.php" method="POST">-->
                    <table id="order-listing" class="table">
                        <thead>
                        <tr>
                            <th>Child ID</th>
                            <th>Name</th>
                            <th>What is the Status of Child</th>
                            <th>Update Weekly Assessment</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = "select * from tbl_child where cciid='" . $cciid . "' and status='Active'  ";

                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            $i = 0;
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['cid']; ?></td>
                                    <td><?php echo $row['cname']; ?></td>
                                    <td><?php $querycheck = "SELECT * FROM tbl_child WHERE cid ='" . $row['cid'] . "' and status='Active'";

                                        $resultch = mysqli_query($conn, $querycheck);
                                        $cuser = mysqli_fetch_assoc($resultch);


                                        if (mysqli_num_rows($resultch)) {
                                            ?>

                                                <?php echo $cid ?>
                                                <?php echo $data['cciname']; ?>
                                                <a href="cstatus.php?cciid=<?php echo $cciid ?>&cid=<?php echo $row['cid'] ?>&status_type=Restore" onclick="return confirm('Are you sure you want to restore this Child?')">
                                                    <button class="btn btn-outline-primary " name="updates">
                                                        Mark Child </br> as Restored
                                                    </button>
                                                </a>
                                            <?php
                                        } else {
                                            ?>
                                            <button class="btn btn-outline-success">Transfer</button>
                                            <?php
                                        }
                                        ?>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="cstatus.php?cciid=<?php echo $cciid ?>&cid=<?php echo $row['cid'] ?>&status_type=Transfer" onclick="return confirm('Are you sure you want to mark this Child as transferred to other CCI?')">
                                            <button class="btn btn-outline-success " name="updates">
                                                Mark Child as </br>Transferred to other CCI
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="child_weekly.php?cciid=<?php echo $cciid ?>&&cid=<?php echo $row['cid'] ?>">
                                            <button class="btn btn-outline-info" name="updates">
                                                Click to Submit </br> Weekly Assessment
                                            </button>
                                        </a>

                                    </td>



                                <?php
                            }
                        }
                        ?>
                                </tr>
                        </tbody>
                    </table>
                    <!--</form>-->

                </div>
            </div>
        </div>


        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="../vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <script src="../vendors/datatables.net/jquery.dataTables.js"></script>
        <script src="../vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="../js/off-canvas.js"></script>
        <script src="../js/hoverable-collapse.js"></script>
        <script src="../js/template.js"></script>
        <script src="../js/settings.js"></script>
        <script src="../js/todolist.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="../js/data-table.js"></script>
        <!-- End custom js for this page-->


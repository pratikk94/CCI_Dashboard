<?php
include('includes/connect.php');
include('includes/secure.php');
error_reporting(0);

session_start();
$aid = $_SESSION['aid'];

include "admin_header.php" ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

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
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Welcome Admin Panel </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                        <div class="card-body">
                            <p class="mb-4">Total CCI's</p>
                            <p class="fs-30 mb-2">
                                <?php
                                $sql = "select COUNT(DISTINCT cciid) as ctotal from tbl_child";

                                $result = mysqli_query($conn, $sql);
                                $data = mysqli_fetch_assoc($result);
                                ?>
                                <a href="admin_all_cci_record.php?aid=<?php echo $aid; ?>" style="color:#fff;">
                                    <?php echo $data['ctotal']; ?></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                        <div class="card-body">
                            <p class="mb-4">Total Child's</p>
                            <p class="fs-30 mb-2">
                                <?php
                                $sql = "select COUNT(DISTINCT cid) as cctotal from tbl_child ";

                                $cchild = mysqli_query($conn, $sql);
                                $ccdata = mysqli_fetch_assoc($cchild);
                                ?>

                                <a href="admin_all_child_record.php?aid=<?php echo $aid; ?>"
                                   style="color:#fff;"> <?php echo $ccdata['cctotal']; ?></a>
                            </p>


                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 mb-lg-0 stretch-card transparent">
                    <div class="card card-light-blue">
                        <div class="card-body">
                            <p class="mb-4">Total Assessment</p>
                            <p class="fs-30 mb-2">
                                <?php
                                $sql = "select COUNT(DISTINCT cid) as cexam from tbl_child_score_h ";

                                $ccexam = mysqli_query($conn, $sql);
                                $cedata = mysqli_fetch_assoc($ccexam);
                                ?>

                                <a href="admin_all_child_examrecord.php?aid=<?php echo $aid; ?>"
                                   style="color:#fff;">  <?php echo $cedata['cexam']; ?></a>
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 mb-lg-0 stretch-card transparent">
                    <div class="card card-light-blue">
                        <div class="card-body">
                            <p class="mb-4">Total Children Restored</p>
                            <p class="fs-30 mb-2">
                                <?php
                                $sql = "SELECT count(*) as transfer FROM `tbl_child` where status='Transfer'";

                                $ccexam = mysqli_query($conn, $sql);
                                $cedata = mysqli_fetch_assoc($ccexam);
                                ?>

                                <a href="admin_all_child_restored.php?aid=<?php echo $aid; ?>"
                                   style="color:#fff;">  <?php echo $cedata['transfer']; ?></a>
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 mb-lg-0 stretch-card transparent">
                    <div class="card card-light-blue">
                        <div class="card-body">
                            <p class="mb-4">Total Children Currently in CCI</p>
                            <p class="fs-30 mb-2">
                                <?php
                                $sql = "SELECT count(*) as active FROM `tbl_child` where status='Active'";

                                $ccexam = mysqli_query($conn, $sql);
                                $cedata = mysqli_fetch_assoc($ccexam);
                                ?>

                                <a href="admin_all_child_in_cci.php?aid=<?php echo $aid; ?>"
                                   style="color:#fff;">  <?php echo $cedata['active']; ?></a>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card tale-bg d-flex align-items-end">
                        <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card tale-bg d-flex align-items-end">
                        <canvas id="myChart1" style="width:100%;max-width:600px"></canvas>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">CCI's Record <a href="excel.php">
                                <button class="btn btn-outline-primary">Download Data</button>
                            </a>
                            <a href="weekly_excel.php">
                                <button class="btn btn-outline-primary">Weekly Data</button>
                            </a>
                        </h4>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="order-listing" class="table">
                                        <thead>
                                        <tr>
                                            <th>CCI ID</th>
                                            <th>CCI Name</th>
                                            <th>Total Child</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $sql = "select * from tbl_user ";

                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            $i = 0;
                                            while ($row = mysqli_fetch_array($result)) {
                                                ?>


                                                <tr>
                                                    <td><?php echo $row['cciid']; ?></td>
                                                    <td><?php echo $row['cciname']; ?></td>
                                                    <td> <?php
                                                        $sqlc = "select COUNT(cciid) as ccitotal from tbl_child where cciid='" . $row['cciid'] . "'";
                                                        $ccihild = mysqli_query($conn, $sqlc);
                                                        $ccidata = mysqli_fetch_assoc($ccihild);

                                                        echo $ccidata['ccitotal']; ?></td>
                                                    <td>
                                                        <a href="admin_cci_record.php?cciid=<?php echo $row['cciid']; ?>">
                                                            <button class="btn btn-outline-success">Record</button>
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
                    </div>
                </div>
            </div>
            <!-- main-panel ends -->
        </div>
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<?php
$sql = "select COUNT(chindi)as begg from tbl_child_week where chindi='Beginner'";
$rbegg = mysqli_query($conn, $sql);
$dbegg = mysqli_fetch_assoc($rbegg);
$be = $dbegg['begg'];

$sql = "select COUNT(chindi)as lett from tbl_child_week where chindi='Letter'";
$rlett = mysqli_query($conn, $sql);
$dlett = mysqli_fetch_assoc($rlett);
$le = $dlett['lett'];


$sql = "select COUNT(chindi)as word from tbl_child_week where chindi='Words'";
$rword = mysqli_query($conn, $sql);
$dword = mysqli_fetch_assoc($rword);
$wo = $dword['word'];

$sql = "select COUNT(chindi)as para from tbl_child_week where chindi='Paragraphs'";
$rpara = mysqli_query($conn, $sql);
$dpara = mysqli_fetch_assoc($rpara);
$pa = $dpara['para'];

$sql = "select COUNT(chindi)as story from tbl_child_week where chindi='Story'";
$rstory = mysqli_query($conn, $sql);
$dstory = mysqli_fetch_assoc($rstory);
$st = $dstory['story'];

$sql = "select COUNT(chindi)as adva from tbl_child_week where chindi='Advanced'";
$radva = mysqli_query($conn, $sql);
$dadva = mysqli_fetch_assoc($radva);
$ad = $dadva['adva'];
?>

<?php $be ?> <?php $le ?> <?php $wo ?> <?php $pa ?> <?php $st ?> <?php $ad ?>

<script>
    var xValues = ["Beginner", "Letter", "Words", "Paragraphs", "Story", "Advance"];
    var yValues = [<?php echo $be?>,<?php echo $le?>, <?php echo $wo?>, <?php echo $pa?>,<?php echo $st?>,<?php echo $ad?>];

    var barColors = [
        "#b91d47",
        "#00aba9",
        "#2b5797",
        "#e8c3b9",
        "#FF5733",
        "#1e7235"
    ];

    new Chart("myChart", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            title: {
                display: true,
                text: "Hindi Learning Level"
            }
        }
    });
</script>

<!--- Maths -->

<?php

$sql = "select COUNT(cmaths)as mbegg from tbl_child_week where cmaths='Beginner'";

$rmbegg = mysqli_query($conn, $sql);
$dmbegg = mysqli_fetch_assoc($rmbegg);

$mbe = $dmbegg['mbegg'];


$sql = "select COUNT(cmaths)as ll1 from tbl_child_week where cmaths='Level L1'";

$rll = mysqli_query($conn, $sql);
$dll = mysqli_fetch_assoc($rll);

$l1 = $dll['ll1'];


$sql = "select COUNT(cmaths)as ll2 from tbl_child_week where cmaths='Level L2'";

$rll2 = mysqli_query($conn, $sql);
$dll2 = mysqli_fetch_assoc($rll2);

$l2 = $dll2['ll2'];

$sql = "select COUNT(cmaths)as subt from tbl_child_week where cmaths='Subtraction'";

$rsubt = mysqli_query($conn, $sql);
$dsubt = mysqli_fetch_assoc($rsubt);

$su = $dsubt['subt'];


$sql = "select COUNT(cmaths)as divi from tbl_child_week where cmaths='Division'";

$rdivi = mysqli_query($conn, $sql);
$ddivi = mysqli_fetch_assoc($rdivi);

$div = $ddivi['divi'];

?>



<?php $mbe ?> <?php $l1 ?> <?php $l2 ?> <?php $su ?> <?php $div ?>


<script>
    var xValues = ["Beginner", "Level L1", "Level L2", "Subtraction", "Division"];
    var yValues = [<?php echo $mbe?>,<?php echo $l1?>, <?php echo $l2?>, <?php echo $su?>,<?php echo $div?>];

    var barColors = [
        "#b91d47",
        "#00aba9",
        "#2b5797",
        "#e8c3b9",
        "#1e7235"

    ];

    new Chart("myChart1", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            title: {
                display: true,
                text: "Maths Learning Level"
            }
        }
    });
</script>


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


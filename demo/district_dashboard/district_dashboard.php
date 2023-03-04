<?php
include('../includes/connect.php');
include('../includes/secure.php');
error_reporting(0);

session_start();
 $did = $_SESSION['did'];

include "district_header.php" ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_settings-panel.html -->
    <!-- partial -->
    <!-- partial:partials/_sidebar.html -->
    <?php include "district_menu.php" ?>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Welcome District Panel </h3>
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
                                $sql = "select COUNT(DISTINCT cciid) as ctotal from tbl_user where did='$did' ";

                                $result = mysqli_query($conn, $sql);
                                $data = mysqli_fetch_assoc($result);
                                ?>
                                <a href="district_all_cci_record.php?did=<?php echo $did; ?>" style="color:#fff;">
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
                                /*$sql = "select COUNT(DISTINCT cid) as cctotal from tbl_child INNER JOIN tbl_user ON tbl_child.cid = tbl_user.cid ";*/
                               $sqls = "select sum(stdcount) total_students from (SELECT count(a.cciname) as stdcount, b.cciid FROM `tbl_child` as a join tbl_user as b on a.cciid =b.cciid WHERE b.did ='$did' GROUP BY b.cciid ) as total";
                                

                                $cchild = mysqli_query($conn, $sqls);
                                $ccdata = mysqli_fetch_assoc($cchild);
                                ?>

                                <a href="district_all_child_record.php?did=<?php echo $did; ?>"
                                   style="color:#fff;"> <?php echo $ccdata['total_students']; ?></a>
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
                                $sqll = "select sum(stddcount) totall_students from (SELECT count(a.cid) as stddcount, b.cciid FROM `tbl_child_score_h` as a join tbl_user as b on a.cciid =b.cciid WHERE b.did ='$did' GROUP BY b.cciid ) as total;";

                                $cachild = mysqli_query($conn, $sqll);
                                $cacdata = mysqli_fetch_assoc($cachild);
                                ?>

                                <a href="district_all_child_record.php?did=<?php echo $did; ?>"
                                   style="color:#fff;"> <?php echo $cacdata['totall_students']; ?></a>
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
                                $sql = "select sum(stdcount) total_tstudents from (SELECT count(a.cciname) as stdcount, b.cciid FROM `tbl_child` as a join tbl_user as b on a.cciid =b.cciid WHERE b.did ='$did' AND a.status='Transfer' GROUP BY b.cciid ) as total";

                                $ccexam = mysqli_query($conn, $sql);
                                $cedata = mysqli_fetch_assoc($ccexam);
                                ?>

                                <a href="district_all_child_restored.php?did=<?php echo $did; ?>"
                                   style="color:#fff;">  <?php echo $cedata['total_tstudents']; ?></a>
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
                                $sql = "select sum(stdcount) total_acstudents from (SELECT count(a.cciname) as stdcount, b.cciid FROM `tbl_child` as a join tbl_user as b on a.cciid =b.cciid WHERE b.did ='$did' AND a.status='Active' GROUP BY b.cciid ) as total";


                                $ccexam = mysqli_query($conn, $sql);
                                $cedata = mysqli_fetch_assoc($ccexam);
                                ?>

                                <a href="district_all_child_in_cci.php?did=<?php echo $did; ?>"
                                   style="color:#fff;">  <?php echo $cedata['total_acstudents']; ?></a>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
			</br>
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
                       <!-- Excel -->
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
                                        $sql = "SELECT count(a.cciname) as stdcount, b.cciid,b.cciname FROM `tbl_child` as a join tbl_user as b on a.cciid =b.cciid WHERE b.did ='$did' GROUP BY b.cciid,b.cciname";

                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            $i = 0;
                                            while ($row = mysqli_fetch_array($result)) {
                                                ?>


                                                <tr>
                                                    <td><?php echo $row['cciid']; ?></td>
                                                    <td><?php echo $row['cciname']; ?></td>
                                                    <td><?php echo $row['stdcount']; ?></td>
                                                    <td>
                                                        <a href="district_cci_record.php?cciid=<?php echo $row['cciid']; ?>">
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
$sql = "select sum(chindi) begg from (SELECT count(a.cid) as chindi, b.cciid FROM tbl_child_week as a join tbl_user as b on a.cciid =b.cciid WHERE b.did ='$did' AND a.chindi='Beginner' GROUP BY b.cciid ) as total;";
$rbegg = mysqli_query($conn, $sql);
$dbegg = mysqli_fetch_assoc($rbegg);
$be = $dbegg['begg'];

$sql = "select sum(chindi) lett from (SELECT count(a.cid) as chindi, b.cciid FROM tbl_child_week as a join tbl_user as b on a.cciid =b.cciid WHERE b.did ='$did' AND a.chindi='Letter' GROUP BY b.cciid ) as total;";
$rlett = mysqli_query($conn, $sql);
$dlett = mysqli_fetch_assoc($rlett);
$le = $dlett['lett'];


$sql = "select sum(chindi) word from (SELECT count(a.cid) as chindi, b.cciid FROM tbl_child_week as a join tbl_user as b on a.cciid =b.cciid WHERE b.did ='$did' AND a.chindi='Words' GROUP BY b.cciid ) as total;";
$rword = mysqli_query($conn, $sql);
$dword = mysqli_fetch_assoc($rword);
$wo = $dword['word'];

$sql = "select sum(chindi) para from (SELECT count(a.cid) as chindi, b.cciid FROM tbl_child_week as a join tbl_user as b on a.cciid =b.cciid WHERE b.did ='$did' AND a.chindi='Paragraphs' GROUP BY b.cciid ) as total;";
$rpara = mysqli_query($conn, $sql);
$dpara = mysqli_fetch_assoc($rpara);
$pa = $dpara['para'];

$sql = "select sum(chindi) story from (SELECT count(a.cid) as chindi, b.cciid FROM tbl_child_week as a join tbl_user as b on a.cciid =b.cciid WHERE b.did ='$did' AND a.chindi='Story' GROUP BY b.cciid ) as total;";
$rstory = mysqli_query($conn, $sql);
$dstory = mysqli_fetch_assoc($rstory);
$st = $dstory['story'];

$sql = "select sum(chindi) adva from (SELECT count(a.cid) as chindi, b.cciid FROM tbl_child_week as a join tbl_user as b on a.cciid =b.cciid WHERE b.did ='$did' AND a.chindi='Advanced' GROUP BY b.cciid ) as total;";
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

$sql = "select sum(cmaths) mbegg from (SELECT count(a.cid) as cmaths, b.cciid FROM tbl_child_week as a join tbl_user as b on a.cciid =b.cciid WHERE b.did ='$did' AND a.cmaths='Beginner' GROUP BY b.cciid ) as total;";

$rmbegg = mysqli_query($conn, $sql);
$dmbegg = mysqli_fetch_assoc($rmbegg);

$mbe = $dmbegg['mbegg'];


$sql = "select sum(cmaths) ll1 from (SELECT count(a.cid) as cmaths, b.cciid FROM tbl_child_week as a join tbl_user as b on a.cciid =b.cciid WHERE b.did ='$did' AND a.cmaths='Level L1' GROUP BY b.cciid ) as total;";

$rll = mysqli_query($conn, $sql);
$dll = mysqli_fetch_assoc($rll);

$l1 = $dll['ll1'];


$sql = "select sum(cmaths) ll2 from (SELECT count(a.cid) as cmaths, b.cciid FROM tbl_child_week as a join tbl_user as b on a.cciid =b.cciid WHERE b.did ='$did' AND a.cmaths='Level L2' GROUP BY b.cciid ) as total;";

$rll2 = mysqli_query($conn, $sql);
$dll2 = mysqli_fetch_assoc($rll2);

$l2 = $dll2['ll2'];

$sql = "select sum(cmaths) subt from (SELECT count(a.cid) as cmaths, b.cciid FROM tbl_child_week as a join tbl_user as b on a.cciid =b.cciid WHERE b.did ='$did' AND a.cmaths='Subtraction' GROUP BY b.cciid ) as total;";

$rsubt = mysqli_query($conn, $sql);
$dsubt = mysqli_fetch_assoc($rsubt);

$su = $dsubt['subt'];


$sql = "select sum(cmaths) divi from (SELECT count(a.cid) as cmaths, b.cciid FROM tbl_child_week as a join tbl_user as b on a.cciid =b.cciid WHERE b.did ='$did' AND a.cmaths='Division' GROUP BY b.cciid ) as total;";

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
<script src="../../vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="../../vendors/chart.js/Chart.min.js"></script>
<script src="../../vendors/datatables.net/jquery.dataTables.js"></script>
<script src="../../vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="../../js/dataTables.select.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="../../js/off-canvas.js"></script>
<script src="../../js/hoverable-collapse.js"></script>
<script src="../../js/template.js"></script>
<script src="../../js/settings.js"></script>
<script src="../../js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="../../js/jquery.cookie.js" type="text/javascript"></script>
<script src="../../js/dashboard.js"></script>
<script src="../../js/Chart.roundedBarCharts.js"></script>
<!-- End custom js for this page-->
</body>
</html>


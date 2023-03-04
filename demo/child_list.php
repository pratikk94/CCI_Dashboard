<?php include('includes/connect.php');
include('includes/secure.php');
error_reporting(0);
$cciid = $_SESSION['cciid'];
?>
<?php include "header.php"; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

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
                <div class="card">
                    <div class="card-body">
                        <h4 class="">Child's having incomplete record is highlighted in <i style='color: red;'>red</i></h4>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="order-listing" class="table">
                                        <thead>
                                        <tr>

                                            <th>Child ID</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                         $sql = "select * from tbl_child where cciid=$cciid and status='Active' ORDER BY cname asc ";

                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            $i = 0;
                                            while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                                <tr <?=$gender=($row['cage']==""||$row['admission_date']==""||$row['cenroll']==""||$row['cschool']==""||$row['has_tablet']||$row['cwsn']==""||$row['birth_certificate']==""||$row['cgender']==""||$row['cage']=="")?"style='color: red;'":"style='color: Green;'" ?>>

                                                <td><?php echo $row['cid'];?></td>
                                                <td>
                                                    <a href="child_record.php?cciid=<?php echo $cciid ?>&&cid=<?php echo $row['cid'] ?>"><?php echo $row['cname']; ?></a>
                                                </td>
                                                <td>
                                                    <a href="update_child_record.php?cciid=<?php echo $cciid ?>&&cid=<?php echo $row['cid'] ?>">
                                                        <button class="btn btn-outline-primary">Edit Child Details</button>
                                                    </a>
                                                </td>
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


                        <?php


                        $sql = "select COUNT(chindi)as begg from tbl_child_week where cciid=$cciid and chindi='Beginner'";

                        $rbegg = mysqli_query($conn, $sql);
                        $dbegg = mysqli_fetch_assoc($rbegg);

                        $be = $dbegg['begg'];


                        $sql = "select COUNT(chindi)as lett from tbl_child_week where cciid=$cciid and chindi='Letter'";

                        $rlett = mysqli_query($conn, $sql);
                        $dlett = mysqli_fetch_assoc($rlett);

                        $le = $dlett['lett'];


                        $sql = "select COUNT(chindi)as word from tbl_child_week where cciid=$cciid and chindi='Words'";

                        $rword = mysqli_query($conn, $sql);
                        $dword = mysqli_fetch_assoc($rword);

                        $wo = $dword['word'];

                        $sql = "select COUNT(chindi)as para from tbl_child_week where cciid=$cciid and chindi='Paragraphs'";

                        $rpara = mysqli_query($conn, $sql);
                        $dpara = mysqli_fetch_assoc($rpara);

                        $pa = $dpara['para'];


                        $sql = "select COUNT(chindi)as story from tbl_child_week where cciid=$cciid and chindi='Story'";

                        $rstory = mysqli_query($conn, $sql);
                        $dstory = mysqli_fetch_assoc($rstory);

                        $st = $dstory['story'];


                        $sql = "select COUNT(chindi)as adva from tbl_child_week where cciid=$cciid and chindi='Advanced'";

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

                        $sql = "select COUNT(cmaths)as mbegg from tbl_child_week where cciid=$cciid and cmaths='Beginner'";

                        $rmbegg = mysqli_query($conn, $sql);
                        $dmbegg = mysqli_fetch_assoc($rmbegg);

                        $mbe = $dmbegg['mbegg'];


                        $sql = "select COUNT(cmaths)as ll1 from tbl_child_week where cciid=$cciid and cmaths='Level L1'";

                        $rll = mysqli_query($conn, $sql);
                        $dll = mysqli_fetch_assoc($rll);

                        $l1 = $dll['ll1'];


                        $sql = "select COUNT(cmaths)as ll2 from tbl_child_week where cciid=$cciid and cmaths='Level L2'";

                        $rll2 = mysqli_query($conn, $sql);
                        $dll2 = mysqli_fetch_assoc($rll2);

                        $l2 = $dll2['ll2'];

                        $sql = "select COUNT(cmaths)as subt from tbl_child_week where cciid=$cciid and cmaths='Subtraction'";

                        $rsubt = mysqli_query($conn, $sql);
                        $dsubt = mysqli_fetch_assoc($rsubt);

                        $su = $dsubt['subt'];


                        $sql = "select COUNT(cmaths)as divi from tbl_child_week where cciid=$cciid and cmaths='Division'";

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


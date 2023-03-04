<?php
error_reporting(0);
if (isset($_POST['submit'])) {
    include('includes/connect.php');
    include('includes/secure.php');
    $bq1 = $_POST['bq1'];
    $bqm2 = $_POST['bqm2'];
    session_start();
    $cciid = $_SESSION['cciid'];
    $cid = $_POST['cid'];
    $clid = $_POST['clid'];
    $ctid = $_POST['ctid'];

    $query1 = ("INSERT tbl_child_score_m set cid='" . $cid . "', cciid='" . $cciid . "',clid='" . $clid . "',ctid='" . $ctid . "',bq1='" . $bq1 . "',bqm2='" . $bqm2 . "',ctime=NOW()");

    mysqli_query($conn, $query1);

    echo "Records added successfully.";
    echo "<script>location.href='dashboard.php'</script>";
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

$conn->close();

?>
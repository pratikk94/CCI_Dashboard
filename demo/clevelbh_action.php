<?php
error_reporting(0);
if (isset($_POST['submit'])) {
    include('includes/connect.php');
    include('includes/secure.php');
    $bq1 = $_POST['bq1'];
    $bq2 = $_POST['bq2'];
    $mq1 = $_POST['mq1'];
    $mq2 = $_POST['mq2'];

    session_start();
    $cciid = $_SESSION['cciid'];
    $cid = $_POST['cid'];

    $query1 = ("INSERT tbl_child_score_h set cid='" . $cid . "', cciid='" . $cciid . "',clid='',ctid='',bq1='" . $bq1 . "',bq2='" . $bq2 . "',mq1='" . $mq1 . "',mq2='" . $mq2 . "',ctime=NOW()");

    mysqli_query($conn, $query1);

    echo "Records added successfully.";
    echo "<script>location.href='dashboard.php'</script>";
} else {
    echo "Records already exit.";
    echo "<script>location.href='dashboard.php'</script>";
}

$conn->close();

?>
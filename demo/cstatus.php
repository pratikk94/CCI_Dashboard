<?php
error_reporting(1);
include('includes/connect.php');
include('includes/secure.php');
$cid = $_GET['cid'];
$status_type = $_GET['status_type'];
$cciid = $_SESSION['cciid'];
$query = ("update tbl_child set `status`='".$status_type."', stime=NOW() where cciid='" . $cciid . "' and cid='" . $cid . "'");
mysqli_query($conn, $query);
echo "<script>location.href='children_table.php'</script>";
$conn->close();
?>
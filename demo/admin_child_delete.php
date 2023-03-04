<?php
error_reporting(0);

include('includes/connect.php');
include('includes/secure.php');


session_start();
echo $cciid = $_GET['cciid'];
echo $cid = $_GET['cid'];


$query1 = ("DELETE FROM tbl_child WHERE cciid='$cciid' and cid='$cid' ");

mysqli_query($conn, $query1);

echo "Records deleted successfully.";
echo "<script>location.href='admin_dashboard.php'</script>";


$conn->close();

?>
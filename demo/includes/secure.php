<?php
include('connect.php');
session_start();

$uname = $_SESSION['uname'];
$ses_sql = mysqli_query($conn, "select uname from tbl_user where uname = '$uname' ");
$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
$uname = $row['uname'];
if (!isset($_SESSION['uname'])) {
    header("location:logout.php");
    die();
}
?>
<?php
//error_reporting(0);
if (isset($_POST['addchild'])) {
    include('includes/connect.php');
    include('includes/secure.php');
    $cuname = $conn->real_escape_string($_POST['cuname']);
    $uname = $conn->real_escape_string($_POST['uname']);
    $password = $conn->real_escape_string($_POST['password']);
    $cciname = $conn->real_escape_string($_POST['cciname']);
    $aid = $conn->real_escape_string($_SESSION['aid']);
    $max_id_sql="select max(cciid) as cciid from tbl_user;";
    $res = mysqli_query($conn, $max_id_sql);
    $row = mysqli_fetch_assoc($res);
    $ccid= $row["cciid"]+1;
    $sql_query = "INSERT into tbl_user set aid='" . $aid . "',cciname='" . $cciname . "',cuname='" . $cuname . "',uname='" . $uname . "',password='" . $password . "',cciid=$ccid,ctime=NOW()";
    $res = mysqli_query($conn, $sql_query);
    if ($res) {
        header("Location: admin_dashboard.php");
    }
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
$conn->close();

?>
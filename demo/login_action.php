<?php
include('includes/connect.php');
error_reporting(0);
session_start();
if (isset($_POST['login'])) {
    $uname = mysqli_real_escape_string($conn, $_POST['uname']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM tbl_user WHERE uname = '$uname' and password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $cciid = $row['cciid'];
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        //session_register("uname");
        $_SESSION['uname'] = $uname;
        $_SESSION['cciid'] = $cciid;
        echo "<script>alert('Login successfully');</script>";
        echo "<script>location.href='dashboard.php?cciid=$cciid'</script>";
    } else {
        echo "<script>alert('Your Login Name or Password is invalid');</script>";
        echo "<script>location.href='index.php'</script>";
        //$error = "Your Login Name or Password is invalid";
    }


}

?>
      
<?php
include('includes/connect.php');
error_reporting(0);
session_start();
if (isset($_POST['login'])) {
    $uname = mysqli_real_escape_string($conn, $_POST['uname']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM tbl_admin_user WHERE uname = '$uname' and password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $aid = $row['aid'];
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        //session_register("uname");
        $_SESSION['uname'] = $uname;
        $_SESSION['aid'] = $aid;


        echo "<script>alert('Login successfully');</script>";
        echo "<script>location.href='admin_dashboard.php?aid=$aid'</script>";
    } else {
        echo "<script>alert('Your Login Name or Password is invalid');</script>";
        echo "<script>location.href='admin_index.php'</script>";
        //$error = "Your Login Name or Password is invalid";
    }


}

?>
      
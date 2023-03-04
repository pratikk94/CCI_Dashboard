<?php
include('../includes/connect.php');
//var_dump($_POST['uname']);
//die();
error_reporting(0);
    if (isset($_SESSION['uname'])) {
        echo "<script>location.href='district_index.php'</script>";
    } else {
        session_start();
        //echo "<script>alert('Session created');</script>";
        //echo "<script>alert(".$_POST['uname'].");</script>" ;

        if (isset($_POST['uname'])&&isset($_POST['password'])) {
            $uname = mysqli_real_escape_string($conn, $_POST['uname']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $type = $_POST["type"];
            if($type == "district"){
                $sql = "SELECT * FROM tbl_district_user WHERE uname = '$uname' and password = '$password'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $did = $row['did'];
                $count = mysqli_num_rows($result);

                if ($count == 1) {
                    //session_register("uname");
                    $_SESSION['uname'] = $uname;
                    $_SESSION['did'] = $did;


                    echo "<script>alert('Login successfully');</script>";
                    echo "<script>location.href='district_dashboard.php?did=$did'</script>";
                } else {
                    echo "<script>alert('Your Login Name or Password is invalid');</script>";
                    echo "<script>location.href='district_index.php'</script>";
                    //$error = "Your Login Name or Password is invalid";
                }
            }
            else if ($type == "admin"){
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
                    echo "<script>location.href='../admin_dashboard.php?aid=$aid'</script>";
                } else {
                    echo "<script>alert('Your Login Name or Password is invalid');</script>";
                    echo "<script>location.href='../admin_index.php'</script>";
                    //$error = "Your Login Name or Password is invalid";
                }

            }

}


}
?>
      
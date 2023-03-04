<?php
error_reporting(0);
if (isset($_POST['cpassword'])) {
    include('includes/connect.php');
    include('includes/secure.php');
    $password = $_POST['password'];

    session_start();
    $cciid = $_SESSION['cciid'];


    echo $query1 = ("update tbl_user set password='" . $password . "',ctime=NOW() where cciid=$cciid");

    mysqli_query($conn, $query1);

    echo "Change Password successfully.";
    echo "<script>location.href='dashboard.php'</script>";
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

$conn->close();

?>
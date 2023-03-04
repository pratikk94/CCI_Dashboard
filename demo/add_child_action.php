<?php
error_reporting(0);
if (isset($_POST['addchild'])) {
    include('includes/connect.php');
    include('includes/secure.php');
    $cname = $_POST['cname'];
    $cage = $_POST['cage'];
    $has_tablet = $_POST['has_tablet'];
    $admission_date = $_POST['admission_date'];
    $cbirthcertificate = $_POST['birth_certificate'];
    $cgender = $_POST['cgender'];
    $cwsn = $_POST['cwsn'];
    $cschool = $_POST['cschool'];
    $cenroll = $_POST['cenroll'];
    $cciid = $_SESSION['cciid'];
    $cciname = $_POST['cciname'];
    $query = sprintf("INSERT tbl_child set cciid='%s', cciname='%s', cname='%s', cage='%s', cgender='%s', cwsn='%s', 
        cschool='%s',cenroll='%s',has_tablet='%s',admission_date='%s',birth_certificate='%s', status='Active',ctime=NOW()",
        $cciid,
        mysqli_real_escape_string($conn, $cciname),
        mysqli_real_escape_string($conn, $cname),
        mysqli_real_escape_string($conn, $cage),
        mysqli_real_escape_string($conn, $cgender),
        mysqli_real_escape_string($conn, $cwsn),
        mysqli_real_escape_string($conn, $cschool),
        mysqli_real_escape_string($conn, $cenroll),
        mysqli_real_escape_string($conn, $has_tablet),
        mysqli_real_escape_string($conn, $admission_date),
        mysqli_real_escape_string($conn, $cbirthcertificate)
    );

    $res = mysqli_query($conn, $query);
    // Check connection
    if (!$res) {
        echo "ERROR: Could not able to execute $query . " . mysqli_error($conn);
        echo "<script>location . href = 'dashboard.php' </script>";
    } else {
        echo "Records added successfully.";
        echo "<script>location . href = 'dashboard.php' </script>";
    }

} else {
    echo "ERROR: some error happened";
}
$conn->close();

?>
<?php
error_reporting(0);
if (isset($_POST['submit'])) {
    include('includes/connect.php');
    include('includes/secure.php');
    $cmonth = mysqli_real_escape_string($conn, $_POST['cmonth']);
    $cweek = mysqli_real_escape_string($conn, $_POST['cweek']);
    $chindi = mysqli_real_escape_string($conn, $_POST['chindi']);
    $cmaths = mysqli_real_escape_string($conn, $_POST['cmaths']);
    $tablet_use = mysqli_real_escape_string($conn, $_POST['tablet_use']);
    $pradigi_score = mysqli_real_escape_string($conn, $_POST['pradigi_score']);
    $pradigi_score = ($pradigi_score == '') ? 0 : $pradigi_score;
    $cciid = $_SESSION['cciid'];
    $cid = mysqli_real_escape_string($conn, $_POST['cid']);
    $year = date("Y");
    $query = ("INSERT tbl_child_week set cciid='" . $cciid . "',cid='" . $cid . "',cmonth='" . $cmonth . "',cweek='" . $cweek . "',chindi='" . $chindi . "',cmaths='" . $cmaths . "',tablet_use='" . $tablet_use . "',pradigi_score='" . $pradigi_score . "',year='" . $year . "',ctime=NOW()");

    $res = mysqli_query($conn, $query);
    if ($res) {
        echo "Records added successfully.";
        header("Refresh:2;url= child_record.php?cciid=$cciid&cid=$cid, true, 303");
    } else {
        if (mysqli_errno($conn) == 1062) {
            print 'Duplicate Entry!';
        }
        echo "</br>Unable to update weekly assessment data</br>";
        echo"<a href='child_weekly.php?cciid=$cciid&cid=$cid'>Click Here to Go Back</a>";
    }
    $conn->close();
}
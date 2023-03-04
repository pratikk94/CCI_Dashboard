<?php
// Load the database configuration file 
include('includes/connect.php');
// Fetch records from database
$sql = "SELECT tbl_user.dname,tbl_user.did,tbl_child.cciid, tbl_child.cciname, tbl_child.birth_certificate,tbl_child.admission_date,tbl_child.cid, tbl_child.cname, tbl_child.cwsn, tbl_child.cage, tbl_child.cgender,IF(tbl_child.has_tablet=1, 'Yes', 'No') as has_tablet,tbl_child.status,tbl_child_week.year,
            tbl_child_week.cmonth, tbl_child_week.cweek, tbl_child_week.chindi, tbl_child_week.cmaths,tbl_child_week.tablet_use,tbl_child_week.pradigi_score,tbl_child.stime 
                from tbl_child INNER JOIN tbl_child_week ON tbl_child.cid = tbl_child_week.cid join tbl_user on tbl_user.cciid=tbl_child.cciid ORDER BY cciid ASC;";
$query = mysqli_query($conn, $sql);
$lineData="";

if ($query->num_rows > 0) {
    // Output each row of the data 
    while ($row = $query->fetch_assoc()) {
        $lineData .= $row['dname'].",".$row['did'].",".$row['cciid'].",".$row['cciname'].",".$row['cid'].",". $row['cname'].",".$row['birth_certificate'].",".$row['admission_date'].",".$row['cwsn'].",".$row['cage'].",".$row['cgender'].",".$row['has_tablet'].",".$row['status'].",".$row['year'].",".
            $row['cmonth'].",". $row['cweek'].",". $row['chindi'].",". $row['cmaths'].",".$row['tablet_use'].",".$row['pradigi_score'].",". $row['stime']."\r\n";
    }
} else {
    $excelData .= 'No records found...' . "\n";
}


?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php echo $lineData; ?>
</body>
</html>

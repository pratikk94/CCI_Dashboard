<?php
// Load the database configuration file 
include('includes/connect.php');

// Filter the excel data 
function filterData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

// Excel file name for download 
$fileName = "cci_weekly_" . date('Y-m-d') . ".xls";

// Column names 
$fields = array('District','District Id','CCI ID', 'CCI Name ', 'Child ID', 'Child Name','Birth Certificate','Date of Admission in CCI', 'Child is with special needs', 'Child Age', 'Child Gender','Is the child using a tablet','Status','Year',
    'Month', 'Week', 'Level Hindi', 'Level Maths','Tablet Usage','PraDigi Score', 'Updated_at');

// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n";

// Fetch records from database 
$sql = "SELECT tbl_user.dname,tbl_user.did,tbl_child.cciid, tbl_child.cciname, tbl_child.birth_certificate,tbl_child.admission_date,tbl_child.cid, tbl_child.cname, tbl_child.cwsn, tbl_child.cage, tbl_child.cgender,IF(tbl_child.has_tablet=1, 'Yes', 'No') as has_tablet,tbl_child.status,tbl_child_week.year,
            tbl_child_week.cmonth, tbl_child_week.cweek, tbl_child_week.chindi, tbl_child_week.cmaths,tbl_child_week.tablet_use,tbl_child_week.pradigi_score,tbl_child.stime 
                from tbl_child INNER JOIN tbl_child_week ON tbl_child.cid = tbl_child_week.cid join tbl_user on tbl_user.cciid=tbl_child.cciid ORDER BY cciid ASC;";
$query = mysqli_query($conn, $sql);


if ($query->num_rows > 0) {
    // Output each row of the data 
    while ($row = $query->fetch_assoc()) {
        $lineData = array($row['dname'],$row['did'],$row['cciid'], $row['cciname'],  $row['cid'], $row['cname'],$row['birth_certificate'], $row['admission_date'], $row['cwsn'], $row['cage'], $row['cgender'],$row['has_tablet'],$row['status'],$row['year'],
            $row['cmonth'], $row['cweek'], $row['chindi'], $row['cmaths'],$row['tablet_use'],$row['pradigi_score'], $row['stime']);
        array_walk($lineData, 'filterData');
        $excelData .= implode("\t", array_values($lineData)) . "\n";
    }
} else {
    $excelData .= 'No records found...' . "\n";
}

// Headers for download 
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$fileName\"");

// Render excel data 
echo $excelData;

exit;
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
$fileName = "cci_" . date('Y-m-d') . ".xls";

// Column names 
$fields = array('District','District Id','CCI ID', 'CCI Name ', 'Child ID', 'Child Name','Birth Certificate','Date of Admission in CCI ', 'Child is with special needs', 'Child Age', 'Child Gender', 'Is the child using a tablet', 'Status','Year',
    'Sample tool Hindi', 'Level Hindi', 'Sample tool Maths', 'Level Maths', 'Update_at');

// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n";

// Fetch records from database 
$sql = "SELECT tbl_user.dname,tbl_user.did,tbl_child.cciid, tbl_child.cciname,tbl_child.birth_certificate,tbl_child.admission_date, tbl_child.cid, tbl_child.cname, tbl_child.cwsn, tbl_child.cage, tbl_child.cgender, IF(tbl_child.has_tablet=1, 'Yes', 'No') as has_tablet,tbl_child.status,tbl_child_week.year,
            tbl_child_score_h.bq1, tbl_child_score_h.bq2, tbl_child_score_h.mq1, tbl_child_score_h.mq2, tbl_child.stime 
                from tbl_child INNER JOIN tbl_child_score_h ON tbl_child.cid = tbl_child_score_h.cid 
                join tbl_child_week on tbl_child_week.cid=tbl_child.cid join tbl_user on tbl_user.cciid=tbl_child.cciid ORDER BY cciid ASC; ";
$query = mysqli_query($conn, $sql);

if ($query->num_rows > 0) {
    // Output each row of the data 
    while ($row = $query->fetch_assoc()) {
        $lineData = array($row['dname'],$row['did'],$row['cciid'], $row['cciname'], $row['cid'], $row['cname'],$row['birth_certificate'],$row['admission_date'], $row['cwsn'], $row['cage'], $row['cgender'], $row['has_tablet'],$row['status'],$row['year'],
            $row['bq1'], $row['bq2'], $row['mq1'], $row['mq2'], $row['stime']);
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
<?php
include('../includes/connect.php');
include('../includes/secure.php');
error_reporting(0);
session_start();

/**
 *  Things to do.
 * 
 *      1.  Check if cwid exists. If it does, ignore entries. 
 *          Else add to DB
 * 
 * 
 */



$level_hindi = ["Beginner","Letter","Words","Paragraphs","Story","Advanced"];
$level_maths = ["Beginner","Level L1","Level L2","Subtraction","Division"];

fetchData();

function fetchData(){
    include('../includes/connect.php');
    include('../includes/secure.php');

    $response = [];
    $sqlQuery = "SELECT * FROM `tbl_child_week` INNER JOIN `tbl_child` ON `tbl_child_week`.`cid` = `tbl_child`.`cid` ORDER BY `tbl_child_week`.`ctime` ASC;";
    $resultch = mysqli_query($conn, $sqlQuery);
    
    foreach($resultch as $row){
        $response["cwid"] = $row["cwid"];
        $response["cci_id"] = $row["cciid"];
        $response["child_id"] = $row["cid"];
        $response["month"] = $row["cmonth"];
        $response["period"] = $row["cweek"];
        $response["progress_hindi"] = mapLevel($row["chindi"]);
        $response["progress_math"] = mapLevel($row["cmaths"]);
        $sqlQuery = "SELECT count(`child_id`) as count FROM `tbl_progress` where `child_id` = ".$row["cid"].";";
        $resultch = mysqli_query($conn, $sqlQuery);
        $cuser = mysqli_fetch_assoc($resultch);
        if($cuser["count"]==0){
            $isFirstTimeUser = true;
        }
        else{
            $isFirstTimeUser = false;
        }
        if($isFirstTimeUser){
            $response["baseline_hindi"] = mapLevel($row["chindi"]);
            $response["baseline_math"] =  mapLevel($row["cmaths"]);
            $response["hindi_progress_level"] = "First Assessment";
            $response["math_progress_level"] = "FirstAssessment"; 
            $isFirstTimeUser = false;       
        }
        else{
            $sql_child_exist_query= "SELECT * FROM `tbl_progress` WHERE `child_id` = ".$row["cid"]." ORDER BY `progress_id` DESC LIMIT 1";
            $resultch = mysqli_query($conn, $sql_child_exist_query);
            $cuser = mysqli_fetch_assoc($resultch);
            
            $response["baseline_hindi"] = $cuser["progress_hindi"];
            $response["baseline_math"] = $cuser["progress_math"];
            $response["hindi_progress_level"] = $response["progress_hindi"] - $response["baseline_hindi"];
            $response["math_progress_level"] = $response["progress_math"] - $response["baseline_math"];
            
        }
        $response["current_status"] = $row["status"];
        addToDatabase($response);
    
    }
    
    echo "DONE";

}


function addToDatabase($response){
    
    include('../includes/connect.php');
    include('../includes/secure.php');

    $query = sprintf("INSERT tbl_progress set`cwid`='%s', `child_id`='%s', `cci_id`='%s',`month`='%s', `period`='%s',`progress_hindi`='%s',`progress_math`='%s',`baseline_hindi`='%s',`baseline_math`='%s', `hindi_progress_level`='%s',`math_progress_level`='%s',`current_status`='%s',`created_at`=NOW()",
        mysqli_real_escape_string($conn, $response["cwid"]),
        $response["child_id"],
        mysqli_real_escape_string($conn, $response["cci_id"]),
        mysqli_real_escape_string($conn, $response["month"]),
        mysqli_real_escape_string($conn, $response["period"]),
        mysqli_real_escape_string($conn, $response["progress_hindi"]),
        mysqli_real_escape_string($conn, $response["progress_math"]),
        mysqli_real_escape_string($conn, $response["baseline_hindi"]),
        mysqli_real_escape_string($conn, $response["baseline_math"]),
        mysqli_real_escape_string($conn, $response["hindi_progress_level"]),
        mysqli_real_escape_string($conn, $response["math_progress_level"]),
        mysqli_real_escape_string($conn, $response["current_status"])
    );

    $res = mysqli_query($conn, $query);
    // Check connection
    if (!$res) {
        echo "ERROR: Could not able to execute $query . " . mysqli_error($conn);
    } else {
        //echo "Records added successfully.";
    }
}

function mapLevel($level){
    switch($level){
        case 'Beginner':
            return 1;
        case 'Letter':
        case 'Beginner L1':
            return 2;
        case 'Words':
        case 'Beginner L2':
            return 3;
        case 'Paragraphs':
        case 'Subtraction':
            return 4;
        case 'Story':
        case 'Division':
            return 5;
        case 'Advanced':
            return 6;
        default :
            return 0;
    }

}


?>

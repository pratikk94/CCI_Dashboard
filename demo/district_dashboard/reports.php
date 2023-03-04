<?php

error_reporting(0);
session_start();


/**
 * 
 * 
 * 1. Provide cumulative as well as district wise.
 * 2. If in advanced, don't show as no progress.        //done
 * 3.
 * 
*/





//getBaseline(270,"CWC I (West)");
//getData(30,"math","CWC I (West)");
getBaselineCumulative(30);



function masterQuery($duration,$subject,$progressLevel,$district_name,$getMaxLevel){
    include('../includes/connect.php');
    include('../includes/secure.php');
    if(!$getMaxLevel && $subject == "hindi")
        $query = "SELECT COUNT(*) as count from `tbl_child_week` INNER JOIN `tbl_user` ON `tbl_user`.`cciid` = `tbl_child_week`.`cciid` INNER JOIN `tbl_progress` ON `tbl_child_week`.`cwid` = `tbl_progress`.`cwid` where `tbl_child_week`.`ctime` > now() - INTERVAL ".$duration." day and `tbl_progress`.`".$subject."_progress_level` = ".$progressLevel." and `tbl_user`.`cuname` = '".$district_name."' and `tbl_child_week`.`chindi` != 'Advanced'";
    else if(!$getMaxLevel && $subject == "math")
        $query = "SELECT COUNT(*) as count from `tbl_child_week` INNER JOIN `tbl_user` ON `tbl_user`.`cciid` = `tbl_child_week`.`cciid` INNER JOIN `tbl_progress` ON `tbl_child_week`.`cwid` = `tbl_progress`.`cwid` where `tbl_child_week`.`ctime` > now() - INTERVAL ".$duration." day and `tbl_progress`.`".$subject."_progress_level` = ".$progressLevel." and `tbl_user`.`cuname` = '".$district_name."' and `tbl_child_week`.`cmaths` != 'division'";
    else if($getMaxLevel && $subject == "hindi")
        $query = "SELECT COUNT(*) as count from `tbl_child_week` INNER JOIN `tbl_user` ON `tbl_user`.`cciid` = `tbl_child_week`.`cciid` INNER JOIN `tbl_progress` ON `tbl_child_week`.`cwid` = `tbl_progress`.`cwid` where `tbl_child_week`.`ctime` > now() - INTERVAL ".$duration." day and `tbl_user`.`cuname` = '".$district_name."' and `tbl_child_week`.`chindi` = 'Advanced'";
    else if($getMaxLevel && $subject == "math")
        $query = "SELECT COUNT(*) as count from `tbl_child_week` INNER JOIN `tbl_user` ON `tbl_user`.`cciid` = `tbl_child_week`.`cciid` INNER JOIN `tbl_progress` ON `tbl_child_week`.`cwid` = `tbl_progress`.`cwid` where `tbl_child_week`.`ctime` > now() - INTERVAL ".$duration." day and `tbl_user`.`cuname` = '".$district_name."' and `tbl_child_week`.`cmaths` = 'division'";
    //echo $query."<br/>";
    $resultch = mysqli_query($conn, $query);
    $count = mysqli_fetch_assoc($resultch);
    return $count["count"];
}

function getData($duration,$subject,$district_name){
    $response = [];
    
    for($i=-7;$i<7;$i++){
        $level[$i] =masterQuery($duration,$subject,$i,$district_name,false);
        $response["Level ".$i] = $level[$i];
        
    }

    $response["maxLevelHindi"]= masterQuery($duration,'hindi',$i,$district_name,true);
    $response["maxLevelMath"]= masterQuery($duration,'math',$i,$district_name,true);

    echo json_encode($response);
}

function getBaselineCumulative($duration){
    include('../includes/connect.php');
    include('../includes/secure.php');
    $mainQ = "SELECT `cid` from `tbl_child_week` INNER JOIN `tbl_user` ON `tbl_user`.`cciid` = `tbl_child_week`.`cciid` INNER JOIN `tbl_progress` ON `tbl_child_week`.`cwid` = `tbl_progress`.`cwid` where `tbl_child_week`.`ctime` > now() - INTERVAL ".$duration." day;";
    //echo $mainQ;
    $resultch = mysqli_query($conn, $mainQ);
    
    for($i=0;$i<5;$i++){
        $repsonse_math_level[$i] = 0;
    }

    for($i=0;$i<6;$i++){
        $repsonse_hindi_level[$i] = 0;
    }
    
    foreach($resultch as $row){
        $subQ = "SELECT `chindi`,`cmaths` FROM `tbl_child_week` WHERE `cid` =".$row['cid']." ORDER BY `cwid` ASC LIMIT 1";
        $resultchQ = mysqli_query($conn, $subQ);
        foreach($resultchQ as $rowQ){
            //echo mapLevel($rowQ["cmaths"])."<br/> ";
            $response_baseline_hindi[mapLevel($rowQ["chindi"]) - 1] = $response_baseline_hindi[mapLevel($rowQ["chindi"])-1] + 1;
            $response_baseline_math[mapLevel($rowQ["cmaths"]) - 1] = $response_baseline_math[mapLevel($rowQ["cmaths"])-1] + 1;
        
        }
        
    }
    $response["baseline_hindi"] = $response_baseline_hindi;
    $response["baseline_maths"] = $response_baseline_math;
    foreach($resultch as $row){
        $subQ = "SELECT `chindi`,`cmaths` FROM `tbl_child_week` WHERE `cid` =".$row['cid']." ORDER BY `cwid` DESC LIMIT 1";
        $resultchQ = mysqli_query($conn, $subQ);
        foreach($resultchQ as $rowQ){
            //echo mapLevel($rowQ["cmaths"])."<br/> ";
            $response_current_hindi[mapLevel($rowQ["chindi"]) - 1] = $response_current_hindi[mapLevel($rowQ["chindi"])-1] + 1;
            $response_current_math[mapLevel($rowQ["cmaths"]) - 1] = $response_current_math[mapLevel($rowQ["cmaths"])-1] + 1;
        }
        
    }
    $response["current_hindi"] = $response_current_hindi;
    $response["current_maths"] = $response_current_math;
    
    echo json_encode($response);
}



function getBaselineByDistrict($duration,$district_name){
    include('../includes/connect.php');
    include('../includes/secure.php');
    $mainQ = "SELECT `cid` from `tbl_child_week` INNER JOIN `tbl_user` ON `tbl_user`.`cciid` = `tbl_child_week`.`cciid` INNER JOIN `tbl_progress` ON `tbl_child_week`.`cwid` = `tbl_progress`.`cwid` where `tbl_user`.`cuname` = '".$district_name."' and `tbl_child_week`.`ctime` > now() - INTERVAL ".$duration." day;";
    //echo $mainQ;
    $resultch = mysqli_query($conn, $mainQ);
    
    for($i=0;$i<5;$i++){
        $repsonse_math_level[$i] = 0;
    }

    for($i=0;$i<6;$i++){
        $repsonse_hindi_level[$i] = 0;
    }
    
    foreach($resultch as $row){
        $subQ = "SELECT `chindi`,`cmaths` FROM `tbl_child_week` WHERE `cid` =".$row['cid']." ORDER BY `cwid` ASC LIMIT 1";
        $resultchQ = mysqli_query($conn, $subQ);
        foreach($resultchQ as $rowQ){
            //echo mapLevel($rowQ["cmaths"])."<br/> ";
            $response_baseline_hindi[mapLevel($rowQ["chindi"]) - 1] = $response_baseline_hindi[mapLevel($rowQ["chindi"])-1] + 1;
            $response_baseline_math[mapLevel($rowQ["cmaths"]) - 1] = $response_baseline_math[mapLevel($rowQ["cmaths"])-1] + 1;
        
        }
        
    }
    $response["baseline_hindi"] = $response_baseline_hindi;
    $response["baseline_maths"] = $response_baseline_math;
    foreach($resultch as $row){
        $subQ = "SELECT `chindi`,`cmaths` FROM `tbl_child_week` WHERE `cid` =".$row['cid']." ORDER BY `cwid` DESC LIMIT 1";
        $resultchQ = mysqli_query($conn, $subQ);
        foreach($resultchQ as $rowQ){
            //echo mapLevel($rowQ["cmaths"])."<br/> ";
            $response_current_hindi[mapLevel($rowQ["chindi"]) - 1] = $response_current_hindi[mapLevel($rowQ["chindi"])-1] + 1;
            $response_current_math[mapLevel($rowQ["cmaths"]) - 1] = $response_current_math[mapLevel($rowQ["cmaths"])-1] + 1;
        }
        
    }
    $response["current_hindi"] = $response_current_hindi;
    $response["current_maths"] = $response_current_math;
    
    echo json_encode($response);
    
}

function mapLevel($level){
    switch($level){
        case 'Beginner':
            return 1;
        case 'Letter':
        case 'Beginner L1':
        case 'Level L1':
            return 2;
        case 'Words':
        case 'Beginner L2':
        case 'Level L2':
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


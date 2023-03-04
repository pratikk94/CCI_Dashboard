<?php
    include('../district_dashboard/report_functions.php');  
    $response["hindi"]["01_month"] = getData(30,"hindi",$_GET["district"]);
    $response["hindi"]["03_month"] = getData(90,"hindi",$_GET["district"]);
    $response["hindi"]["06_month"] = getData(180,"hindi",$_GET["district"]);
    $response["hindi"]["12_month"] = getData(360,"hindi",$_GET["district"]);
    $response["math"]["01_month"] = getData(30,"math",$_GET["district"]);
    $response["math"]["03_month"] = getData(90,"math",$_GET["district"]);
    $response["math"]["06_month"] = getData(180,"math",$_GET["district"]);
    $response["math"]["12_month"] = getData(360,"math",$_GET["district"]);
    
    echo json_encode($response);
?>
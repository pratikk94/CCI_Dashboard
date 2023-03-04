<?php
    include('../district_dashboard/report_functions.php');  
    if(isset($_GET["district"])){
        $district = $_GET["district"];
        $response["01_month"] = getBaselineByDistrict(30,$district);
        $response["03_month"] = getBaselineByDistrict(90,$district);
        $response["06_month"] = getBaselineByDistrict(180,$district);
        $response["12_month"] = getBaselineByDistrict(360,$district);
        echo json_encode($response);
    }
?>
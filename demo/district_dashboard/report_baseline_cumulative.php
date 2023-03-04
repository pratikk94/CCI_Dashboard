<?php
    include('../district_dashboard/report_functions.php');  
    $response["01_month"] = getBaselineCumulative(30);
    $response["03_month"] = getBaselineCumulative(90);
    $response["06_month"] = getBaselineCumulative(180);
    $response["12_month"] = getBaselineCumulative(360);
    echo json_encode($response);
?>
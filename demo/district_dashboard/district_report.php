<!DOCTYPE html>
<html>
<head>
<title>Creating Dynamic Data Graph using PHP and Chart.js</title>
<style type="text/css">
BODY {
    width: 550PX;
}

#chart-container {
    width: 100%;
    height: auto;
}
</style>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</head>
<body>
    <canvas id="graphCanvas"></canvas>
    

    <script>
        $(document).ready(function () {
            showGraph();
        });


        function showGraph()
        {
            {
                $.post("http://localhost:8888/CCI_Dashboard/demo/district_dashboard/report_baseline_district.php?district=CWC%20I%20(West)",
                function (data)
                {
                    var jsonData = JSON.parse(data);
                    console.log(jsonData["01_month"]);
                    const labelsHindi = ["Beginner","Letter","Words","Paragraphs","Story","Advanced"];
                    const labelMaths = ["Beginner","Level L1","Level L2","Subtraction","Division"];
                    var baseLineValue = [];
                    var currentValue = [];
                    var name = [];
                    var months = ["01_month"]
                    for (var i in [0,1,2,3,4,5]) {
                        name.push(labelsHindi[i]);
                        baseLineValue.push(jsonData["01_month"]["baseline_hindi"][i]);
                        currentValue.push(jsonData["01_month"]["current_hindi"][i])
                    }
                    console.log(name);
                    console.log(baseLineValue);
                    console.log(currentValue);

                    var speedCanvas = document.getElementById("graphCanvas");
                    
                    var speedData = {
                        labels: name,
                        datasets: [baseLineValue, currentValue]
                    };

                    var chartOptions = {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                            boxWidth: 80,
                            fontColor: 'black'
                            }
                        }
                    };

                    var lineChart = new Chart(speedCanvas, {
                        type: 'line',
                        data: speedData,
                        options: chartOptions
                    });


                });
            }
        }
        </script>

</body>
</html>
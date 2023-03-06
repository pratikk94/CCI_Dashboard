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
</head>
<body>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<canvas id="chartJSContainer" width="600" height="400"></canvas>
<canvas id="myChart" width="400" height="400"></canvas>
    

    <script>
        var speedCanvas = document.getElementById("graphCanvas");
                   
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

                    const xValues1 = [50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150];
                    const yValues1 = [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15];

                    const xValues2 = [54, 64, 74, 84, 94, 104, 114, 124, 134, 144, 154];
                    const yValues2 = [8, 9, 9, 10, 10, 10, 11, 12, 15, 15, 16];
                    const options = {
                        type: 'line',
                        data: {
                            datasets: [
                                {
                                    label: 'Initial level of students',
                                    data: baseLineValue,
                                    borderColor: 'pink'
                                },
                                {
                                    label: 'Current level of students',
                                    data: currentValue,
                                    borderColor: 'orange',
                                    xAxisID: 'x2' // Match dataset to other axis
                                }
                            ]
                        },
                        options: {
                            scales: {
                            xAxes: [{
                                    type: 'category',
                                    labels: labelsHindi,
                                    id: 'x',
                                    display: true // Set to false to hide the axis
                                },
                                {
                                    type: 'category',
                                    labels: labelsHindi,
                                    id: 'x2',
                                    display: false // Set to false to hide the axis
                                }
                            ]
                            }
                        }
                        }

                        const ctx = document.getElementById('chartJSContainer').getContext('2d');
                        new Chart(ctx, options);


                        var ctx2 = document.getElementById("myChart").getContext("2d");

                        var data = {
                        labels: labelsHindi,
                        datasets: [{
                            label: "Baseline",
                            backgroundColor: "red",
                            data: baseLineValue
                        },
                        {
                            label: "Current",
                            backgroundColor: "blue",
                            data: currentValue
                        }
                    ]
                        };
                        var myBarChart = new Chart(ctx2, {
                        type: 'bar',
                        data: data,
                        options: {
                            barValueSpacing: 20,
                            scales: {
                            yAxes: [{
                                ticks: {
                                min: 0,
                                }
                            }]
                            }
                        }
                        });





                });






            }
        }
        </script>

</body>
</html>
@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div> --}}

        {{-- <!DOCTYPE html>
        <html>

        <head>
         
            <style type="text/css">
                .box {
                    width: 800px;
                    margin: 0 auto;
                }
            </style>
        </head>

        <body>
            <div class="container" style="margin-top: 50px;">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                    </div>
                                    <div class="panel-body" align="center">
                                        <div id="pie_chart" style="width:750px; height:450px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="http://code.highcharts.com/highcharts.js"></script>
            <script src="http://code.highcharts.com/modules/exporting.js"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                    var lists = <?php echo json_encode($lists); ?>;
               
                    var options = {
                        chart: {
                            renderTo: 'pie_chart',
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false
                        },
                        title: {
                            text: 'ภาพรวมจำนวนพนักงานในองค์กร'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.y} คน</b>',
                            percentageDecimals: 1
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    color: '#000000',
                                    connectorColor: '#000000',
                                    formatter: function() {
                                        console.log(this.point);
                                        return '<b>' + this.point.name + '</b>: ' + this.percentage.toFixed(2) +
                                            ' %' + ' (' + this.point.y + ' คน)';
                                    }
                                }
                            }
                        },
                        series: [{
                            type: 'pie',
                            name: 'จำนวน'
                        }]
                    }
                    myarray = [];
                    $.each(lists, function(index, val) {
                        myarray[index] = [val.position_name, val.count];
                    });
                    options.series[0].data = myarray;
                    chart = new Highcharts.Chart(options);

                });
               
            </script>
        </body>

        </html> --}}

        <!DOCTYPE html>
        <html>

        <head>
            {{-- <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@200;300;400;500&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Kodchasan:ital,wght@0,300;1,200;1,300&family=Montserrat:ital,wght@0,200;0,300;0,800;1,200;1,300;1,400;1,500;1,600;1,700&family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Parisienne&family=Playball&family=Poppins:ital,wght@0,100;0,200;0,300;0,800;0,900;1,100;1,200;1,300&family=Roboto+Condensed:wght@300;400;700&family=Roboto+Mono:ital,wght@0,100;1,100&family=Roboto:ital,wght@0,100;0,300;1,100&family=Rubik+Beastly&family=Teko:wght@300;400;500;600;700&display=swap" rel="stylesheet"> --}}
            {{-- <title>How to Use Charts.JS in Laravel 9? - Mywebtuts.com</title> --}}
        </head>
        <style type="text/css">
            body {
                font-family: 'Roboto Mono', monospace;
            }

            h1 {
                text-align: center;
                font-size: 35px;
                font-weight: 900;
            }

            .card {
        margin: 0 auto; /* Added */
        float: none; /* Added */
        margin-bottom: 10px; /* Added */
}

            .width-size {
/* height: 200px; */
/* width: 1130px; */
width: 98%;
}
        </style>

        <body>
            <h1>จำนวนการลาในวันนี้ ({{Helper::DateThaiFull(Carbon::now())}})</h1>

            <div class="row mb-3 width-size">
                <div class="col-3">
                    <div class="card" style="width: 100%; height:100%;">
                        <div class="card-body">
                            <h6 class="card-title">ลาป่วย</h6>
                            <h6 class="card-title">{{ $sick_count }} คน</h6>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card" style="width: 100%; height:100%;">
                        <div class="card-body">
                            <h6 class="card-title">ลากิจ</h6>
                            <h6 class="card-title">{{ $personal_count }} คน</h6>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card" style="width: 100%; height:100%;">
                        <div class="card-body">
                            <h6 class="card-title">ลาพักร้อน</h6>
                            <h6 class="card-title">{{ $vacation_count }} คน</h6>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card" style="width: 100%; height:100%;">
                        <div class="card-body">
                            <h6 class="card-title">ลาคลอด</h6>
                            <h6 class="card-title">{{ $maternity_count }} คน</h6>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card" style="width: 100%; height:100%;">
                        <div class="card-body">
                            <h6 class="card-title">ลาฝึกอบรม</h6>
                            <h6 class="card-title">{{ $training_count }} คน</h6>
                        </div>
                    </div>
                </div>
            </div>


            {{-- <div class="card" style="width: 30%; height:40%;">
                <div class="card-body">
                   <p>ss</p>
                </div> --}}
    </div>
    {{-- <div class="row mb-3">
        <div class="col-12"> --}}
    <div class="card width-size" id="card-chart">
        <div class="card-body">
            <canvas id="myChart" style="width: 50%; height:100%;"></canvas>
        </div>
    {{-- </div>
    </div> --}}
</div>
    </body>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0/dist/chartjs-plugin-datalabels.min.js">
    </script>

    <script type="text/javascript">
        // var labels =  {{ Js::from($labels) }};
        // var users =  {{ Js::from($data) }};

        // const data = {
        //     labels: labels,
        //     datasets: [{
        //         label: 'My First dataset',
        //         backgroundColor: 'rgb(255, 99, 132)',
        //         borderColor: 'rgb(255, 99, 132)',
        //         data: users,
        //     }]
        // };

        // const config = {
        //     type: 'pie',
        //     data: data,
        //     options: {}
        // };

        // const myChart = new Chart(
        //     document.getElementById('myChart'),
        //     config
        // );
        Chart.register(ChartDataLabels);
        Chart.defaults.set('plugins.datalabels', {
            color: '#fff',
            labels: {
                title: {
                    font: {
                        weight: 'bold',
                        
                    }
                },


            },



        });
        let data = {{ Js::from($data) }}; // Some data
        let data_labels = {{ Js::from($labels) }}; // Some data labels
        let randomBackgroundColor = [];
        let usedColors = new Set();

        let dynamicColors = function() {
            let r = Math.floor(Math.random() * 255);
            console.log(Math.random());
            let g = Math.floor(Math.random() * 255);
            let b = Math.floor(Math.random() * 255);
            let color = "rgb(" + r + "," + g + "," + b + ")";

            if (!usedColors.has(color)) {
                usedColors.add(color);
                console.log('d');
                return color;

            } else {
                console.log('dd');
                return dynamicColors();
            }
        };

        for (let i in data) {

            randomBackgroundColor.push(dynamicColors());

        }

        let pie_config = {
            type: 'bar',
            data: {
                datasets: [{
                    data: data,
                    // backgroundColor: randomBackgroundColor,
                    backgroundColor: ["#757BC8", "#8187DC", "#8E94F2", "#9FA0FF", "#ADA7FF", "#BBADFF", '#CBB2FE', '#DAB6FC',
                        '#DDBDFC', '#DEC9E9', '#DAC3E8', '#D2B7E5','#C19EE0','#B185DB', '#A06CD5', '#9163CB'
                    ],
                    // backgroundColor: [
                    //     'rgba(255, 99, 132, 0.2)',
                    //     'rgba(255, 159, 64, 0.2)',
                    //     'rgba(255, 205, 86, 0.2)',
                    //     'rgba(75, 192, 192, 0.2)',
                    //     'rgba(54, 162, 235, 0.2)',
                    //     'rgba(153, 102, 255, 0.2)',
                    //     'rgba(201, 203, 207, 0.2)'
                    // ],
                    // borderColor: [
                    //     'rgb(255, 99, 132)',
                    //     'rgb(255, 159, 64)',
                    //     'rgb(255, 205, 86)',
                    //     'rgb(75, 192, 192)',
                    //     'rgb(54, 162, 235)',
                    //     'rgb(153, 102, 255)',
                    //     'rgb(201, 203, 207)'
                    // ],
                    borderWidth: 1,
                    label: 'จำนวนการลาใน 1 เดือน'
                }],
                labels: data_labels,
                // render: 'label',
                // arc: true,
                // position: 'border'
                // render: 'label'
            },
            options: {
                scales: {
      y: {
        beginAtZero: true,
        ticks: {
          // forces step size to be 50 units
          stepSize: 1
        }
      }
    },
                // responsive: true,
                plugins: {
                    datalabels: {
                        formatter: function(value, context) {
                            position_name = context.chart.data.labels[context.dataIndex]; // value + ' คน'
                            // return position_name + ' : ' + value + ' คน';
                            return value + ' คน';
                        }
                    }
                }
                

            }
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            pie_config
        );
    </script>

    </html>
    </div>
@endsection

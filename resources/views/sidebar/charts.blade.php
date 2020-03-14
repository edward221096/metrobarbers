@extends('layouts.sidebar')

<style>
    .container-fluid{
        max-width: 1000px;
    }
</style>

@section('charts')
    <div class="main_content">
        <div class="header">View Charts</div>
        <div class="info">
            <p></p>
            <div>Total Sales Per Service Name</div>
            <div class="container-fluid" >
                <canvas id="salesperservice"></canvas>
            </div>

            <div>Total Sales Per Employee</div>
            <div class="container-fluid" >
                <canvas id="salesperemployee"></canvas>
            </div>

            <div>Total Sales for Each Day</div>
            <div class="container-fluid" >
                <canvas id="salesperday"></canvas>
            </div>
        </div>
    </div>
    <script>
        //SALES PER DAY LINE CHART
        var ctx3 = $('#salesperemployee');

        var url3 = "{{url('/totalsalesperemployee')}}";
        var sales2 = new Array();
        var name2 = new Array()

        $(document).ready(function(){
            $.get(url3, function(response){
                response.forEach(function(data){
                    sales2.push(data.sales);
                    name2.push(data.name);
                });
                var ctx = document.getElementById("salesperemployee").getContext('2d');
                var myChart = new Chart(ctx3, {
                    type: 'bar',
                    data: {
                        labels: name2,
                        datasets: [{
                            label: 'Total Sales',
                            data: sales2,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            barThickness: 100,
                            borderWidth: 1

                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            });
        });

        //SALES PER EMPLOYEE BAR CHART
        var ctx2 = $('#salesperday');

        var url2 = "{{url('/totalsalesperday')}}";
        var sales3 = new Array();
        var date = new Array()

        $(document).ready(function(){
            $.get(url2, function(response){
                response.forEach(function(data){
                    sales3.push(data.sales);
                    date.push(data.date);
                });
                var ctx = document.getElementById("salesperday").getContext('2d');
                var myChart = new Chart(ctx2, {
                    type: 'line',
                    data: {
                        labels: date,
                        datasets: [{
                            label: 'Sales',
                            data: sales3,
                            backgroundColor: [
                                'transparent'
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',
                            ],

                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            });
        });

        //SALES PER SERVICE BAR CHART
        var ctx = $('#salesperservice');

        var url = "{{url('/totalsalesperservice')}}";
        var sales = new Array();
        var service_name = new Array()

        $(document).ready(function(){
            $.get(url, function(response){
                response.forEach(function(data){
                    sales.push(data.sales);
                    service_name.push(data.service_name);
                });
                var ctx = document.getElementById("salesperservice").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: service_name,
                        datasets: [{
                            label: 'Total Sales',
                            data: sales,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            barThickness: 100,
                            borderWidth: 1

                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            });
        });
    </script>
@endsection

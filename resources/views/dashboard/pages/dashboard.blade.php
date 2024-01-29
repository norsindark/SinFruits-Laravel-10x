@extends('dashboard.layouts.master')


@section('content')

    <body class="g-sidenav-show  bg-gray-100">
        <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Total revenue</p>
                                            <h5 class="font-weight-bolder mb-0">
                                                {{ number_format($incomeYear, 0, '.', '.') }} VNĐ
                                                {{-- <span class="text-success text-sm font-weight-bolder">+55%</span> --}}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Orders</p>
                                            <h5 class="font-weight-bolder mb-0">
                                                {{ $billOrders->count() }} billing
                                                {{-- <span class="text-success text-sm font-weight-bolder">+3%</span> --}}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                            <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Total revenue Month</p>
                                            <h5 class="font-weight-bolder mb-0">
                                                {{ number_format($incomeMonth, 0, '.', '.') }} VNĐ
                                                {{-- <span class="text-danger text-sm font-weight-bolder">-2%</span> --}}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                            <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-xl-3 col-sm-6">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Sales</p>
                                            <h5 class="font-weight-bolder mb-0">
                                                $103,430
                                                <span class="text-success text-sm font-weight-bolder">+5%</span>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                            <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>

                <div class="row mt-4">

                    {{-- year --}}
                    <div class="col-lg-6">
                        <div class="card z-index-2">
                            <div class="card-header pb-0">
                                <h6>Total Revenue In This Year</h6>
                                {{-- <p class="text-sm">
                                    <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                                    <span class="font-weight-bold">4% more</span> in 2021
                                </p> --}}
                            </div>
                            <div class="card-body p-3">
                                <div class="chart">
                                    <canvas id="chart-line" class="chart-canvas" height="375" width="832"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- month --}}
                    <div class="col-lg-6">
                        <div class="card z-index-2">
                            <div class="card-header pb-0">
                                <h6>Total Revenue In This Month</h6>
                                {{-- <p class="text-sm">
                                    <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                                    <span class="font-weight-bold">4% more</span> in 2021
                                </p> --}}
                            </div>
                            <div class="card-body p-3">
                                <div class="chart">
                                    <canvas id="chart-days" class="chart-canvas" height="375" width="832"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <footer class="footer pt-3  ">
                    <div class="container-fluid">
                        <div class="row align-items-center justify-content-lg-between">
                            <div class="col-lg-6 mb-lg-0 mb-4">
                                <div class="copyright text-center text-sm text-muted text-lg-start">
                                    ©
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script>,
                                    made with <i class="fa fa-heart"></i> by
                                    <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">SinD</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        {{-- chart year --}}
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var incomeYearData = {!! json_encode($incomeThisYear) !!};
                var months = Object.keys(incomeYearData).map(Number);

                createChart('chart-line', 'Income This Year(2024)', incomeYearData, months);

                function createChart(chartId, label, data, months) {
                    var ctx = document.getElementById(chartId).getContext('2d');

                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            datasets: [{
                                label: label,
                                data: data,
                                borderColor: 'rgb(75, 192, 192)',
                                borderWidth: 2,
                                fill: false
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }

                //     function monthToLabel(month) {
                //         var monthNames = [
                //             'January', 'February', 'March', 'April', 'May', 'June',
                //             'July', 'August', 'September', 'October', 'November', 'December'
                //         ];
                //         return monthNames[month - 1];
                //     }
            });
        </script>



        {{-- chart month --}}
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var incomeMonthData = {!! json_encode($incomeThisMonth) !!};
                var days = Object.keys(incomeMonthData).map(Number);

                createChart('chart-days', 'Income This Month(February)', incomeMonthData, days);

                function createChart(chartId, label, data, days) {
                    var ctx = document.getElementById(chartId).getContext('2d');

                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            datasets: [{
                                label: label,
                                data: data,
                                borderColor: 'rgb(75, 52, 172)',
                                borderWidth: 2,
                                fill: false
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            });
        </script>;


    </body>
@endsection

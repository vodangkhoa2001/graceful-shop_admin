{{-- {{ dd(Date('Y')) }} --}}
@extends('layouts.master')
@section('head')
    @parent
@endsection
@section('title','Trang chủ')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Doanh thu (Hôm nay)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format( $saleNowDay, 0, '', '.')." VNĐ" }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Doanh thu tháng này</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($saleNowMonth, 0, '', '.')." VNĐ"; }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Số đơn hoàn thành
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $num_invocie }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Người dùng</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countUser }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-xl-between">
                    <form action="{{ route('post-SaleOfYear') }}" method="post" class="col-6 d-flex align-items-center">
                        @csrf
                        <i class="fas fa-chart-bar me-1"></i>
                        <span class="ml-1 col-4">Doanh thu năm</span>
                        
                        <button type="submit" class="btn btn-primary ml-4">Chọn</button>
                    </form>
                    <span>Tổng doanh thu: {{ number_format($saleNowYear, 0, '', '.')." VNĐ"; }}</span>
                </div>
                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
            </div>
        </div>

    </div>

@endsection

@section('script')

{{-- bieu do --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

<script type="text/javascript">
    var _ydata = JSON.parse('{!! json_encode($months) !!}');
    var _xdata = JSON.parse('{!! json_encode($monthSum) !!}');
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    // Bar Chart Example
    var ctx = document.getElementById("myBarChart");
    var myLineChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: _ydata,
        datasets: [{
        label: "Số lượng",
        backgroundColor: "rgba(2,117,216,1)",
        borderColor: "rgba(2,117,216,1)",
        data: _xdata,
        }],
    },
    options: {
        tooltips: {
            callbacks: {
                label: function(t, d) {
                var xLabel = d.datasets[t.datasetIndex].label;
                var yLabel = t.yLabel >= 1000 ? t.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " VNĐ" : t.yLabel + " VNĐ";
                return xLabel + ': ' + yLabel;
                }
            }
        },
        scales: {
        xAxes: [{
            time: {
            unit: 'month'
            },
            gridLines: {
            display: false
            },
            ticks: {
            maxTicksLimit: 12
            }
        }],
        yAxes: [{
                ticks: {
                callback: function(value, index, values) {
                    if (parseInt(value) >= 1000) {
                        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")+" VNĐ";
                    } else {
                        return  value+" VNĐ";
                    }
                }
                }
            }]
        },
        legend: {
        display: false
        }
    }
    });
</script>

@parent

@endsection


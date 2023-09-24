@extends('admin.main')

@section('content')
    <div style="height: 50px"></div>
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Doanh thu theo tháng</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($doanhthuthanghientai, '0', '', '.') }} VND</div>
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
                                Doanh thu theo quý: {{ $quy }}</div>

                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($doanhthutheoquyhientai, '0', '', '.') }} VND</div>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Chỉ tiêu
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ number_format($task, '0', '', '.') }}%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                             style="width: {{ $task }}%" aria-valuenow="50" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
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
                                Số khách hàng tháng này</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $customer }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Doanh thu các tháng</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <input type="hidden" id="jan" value="{{ $thang1 }}">
                        <input type="hidden" id="Feb" value="{{ $thang2 }}">
                        <input type="hidden" id="Mar" value="{{ $thang3 }}">
                        <input type="hidden" id="Apr" value="{{ $thang4 }}">
                        <input type="hidden" id="May" value="{{ $thang5 }}">
                        <input type="hidden" id="Jun" value="{{ $thang6 }}">
                        <input type="hidden" id="Jul" value="{{ $thang7 }}">
                        <input type="hidden" id="Aug" value="{{ $thang8 }}">
                        <input type="hidden" id="Sep" value="{{ $thang9 }}">
                        <input type="hidden" id="Oct" value="{{ $thang10 }}">
                        <input type="hidden" id="Nov" value="{{ $thang11 }}">
                        <input type="hidden" id="Dec" value="{{ $thang12 }}">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Doanh thu trong vòng 3 năm</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <input type="hidden" id="hainam" value="{{ $nam2 }}">
                        <input type="hidden" id="motnam" value="{{ $nam1 }}">
                        <input type="hidden" id="hientai" value="{{ $hientai }}">
                        <input type="hidden" id="sonam2" value="<?php echo getdate()["year"]-2 ?>">
                        <input type="hidden" id="sonam1" value="<?php echo getdate()["year"]-1 ?>">
                        <input type="hidden" id="sonamhientai" value="<?php echo getdate()["year"] ?>">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> <?php echo getdate()["year"]-2 ?>
                                        </span>
                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> <?php echo getdate()["year"]-1 ?>
                                        </span>
                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> <?php echo getdate()["year"] ?>
                                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

</div>

<script src="/template1/vendor/jquery/jquery.min.js"></script>
<script src="/template1/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


<!-- Custom scripts for all pages-->
<script src="/template1/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="/template1/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="/template1/js/demo/chart-area-demo.js"></script>
<script src="/template1/js/demo/chart-pie-demo.js"></script>

@endsection

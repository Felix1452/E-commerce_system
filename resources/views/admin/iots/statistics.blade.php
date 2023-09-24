@extends('admin.main')

@section('content')
    <div style="height: 50px"></div>
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 text-lg-center">
                <h2>Điều khiển thiết bị</h2>
            </div>
            <!-- Earnings (Monthly) Card Example -->
        </div>
        <div class="row justify-content-md-center">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3">
                <div class="card border-left-primary shadow h-60 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-0">
                                <div class="text-xs font-weight-bold text-uppercase  text-lg-center">
                                    <img onclick="changeLight()"  id="img_light" width="100px" src="/storage/img/led_off.png">
                                </div>

                                <div class="mt-4 text-xs font-weight-bold text-uppercase text-lg-center">
                                    <div class="container">
                                        <div class="jumbotron df-bg-primary">
                                            <div class="df-switch">
                                                <button type="button" class="btn btn-lg btn-toggle" data-toggle="button" aria-pressed="false" autocomplete="off">
                                                    <div class="inner-handle"></div>
                                                    <div class="handle"></div>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="jumbotron bg-white">
                                            <div class="df-switch">
                                                <button type="button" class="btn btn-lg btn-toggle" data-toggle="button" aria-pressed="false" autocomplete="off">
                                                    <div class="inner-handle"></div>
                                                    <div class="handle"></div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3">
                <div class="card border-left-primary shadow h-60 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-0">
                                <div class="text-xs font-weight-bold text-uppercase  text-lg-center">
                                    <img onclick="changeLight()"  id="img_light" width="100px" src="/storage/img/led_off.png">
                                </div>

                                <div class="mt-4 text-xs font-weight-bold text-uppercase text-lg-center">
                                    <h2>LIGHT AUTO</h2>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 text-lg-center">
                <h2>THÔNG TIN THIẾT BỊ</h2>
            </div>
            <!-- Earnings (Monthly) Card Example -->
        </div>
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Nhiệt độ</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">8ºC</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-temperature-high fa-2x text-red-900"></i>
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
                                    Độ ẩm</div>

                                <div class="h5 mb-0 font-weight-bold text-gray-800">8%</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-temperature-low fa-2x text-gray-300"></i>
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
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Mực nước
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                 style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-percent fa-2x text-gray-300"></i>
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
                                    Độ PH</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">50</div>
                            </div>
                            <div class="col-auto">
                                <h2 style="font-weight: bold">PH</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Chất rắn</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">8ºC</div>
                            </div>
                            <div class="col-auto">
                                <h2 style="font-weight: bold">TDS</h2>
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
                                    Độ trong</div>

                                <div class="h5 mb-0 font-weight-bold text-gray-800">8</div>
                            </div>
                            <div class="col-auto">
                                <h2 style="font-weight: bold">NDN</h2>
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
                                    Độ đục khuếch tán</div>

                                <div class="h5 mb-0 font-weight-bold text-gray-800">8</div>
                            </div>
                            <div class="col-auto">
                                <h2 style="font-weight: bold">NTU</h2>
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
                                    Nhiệt độ trung bình ngày</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">50ºC</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-temperature-high fa-2x text-gray-300"></i>
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
                        <h6 class="m-0 font-weight-bold text-primary">Độ PH trong năm</h6>

                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <input type="hidden" id="jan" value="1">
                            <input type="hidden" id="Feb" value="2">
                            <input type="hidden" id="Mar" value="1">
                            <input type="hidden" id="Apr" value="2">
                            <input type="hidden" id="May" value="1">
                            <input type="hidden" id="Jun" value="2">
                            <input type="hidden" id="Jul" value="1">
                            <input type="hidden" id="Aug" value="2">
                            <input type="hidden" id="Sep" value="1">
                            <input type="hidden" id="Oct" value="2">
                            <input type="hidden" id="Nov" value="1">
                            <input type="hidden" id="Dec" value="2">
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
                        <h6 class="m-0 font-weight-bold text-primary">Độ PH trong vòng 3 năm</h6>

                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <input type="hidden" id="hainam" value="1">
                            <input type="hidden" id="motnam" value="2">
                            <input type="hidden" id="hientai" value="3">
                            <input type="hidden" id="sonam2" value="2021">
                            <input type="hidden" id="sonam1" value="2022">
                            <input type="hidden" id="sonamhientai" value="2023">
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

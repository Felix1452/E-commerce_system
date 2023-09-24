<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{$title}}</title>


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="/template/admin/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="/template/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="/template/admin/dist/css/adminlte.min.css?v=3.2.0">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="/template1/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="/template1/css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="/template/css/main.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>

        .df-switch {
            text-align: center;
        }

        .btn-toggle {
            top: 50%;
            transform: translateY(-50%);
        }

        .btn-toggle {
            padding: 0;
            position: relative;
            border: none;
            height: 1.5rem;
            width: 5rem;
            border-radius: 1.5rem;
            color: #6b7381;
            background: #000000;
        }

        .btn-toggle:focus,
        .btn-toggle.focus,
        .btn-toggle:focus.active,
        .btn-toggle.focus.active {
            outline: none;
        }

        .btn-toggle:before,
        .btn-toggle:after {
            line-height: 1.5rem;
            width: 4rem;
            text-align: center;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: absolute;
            bottom: 0;
            transition: opacity 0.25s;
        }

        .btn-toggle:before {
            content: 'OFF';
            left: -4rem;
            color: #595959;
        }

        .btn-toggle:after {
            content: 'ON';
            right: -4rem;
            opacity: 0.4;
            color: #525252;
        }

        .btn-toggle>.inner-handle {
            border-radius: 13px;
            width: 65px;
            height: 13px;
            position: absolute;
            top: 6px;
            left: 8px;
            background-color: #363636;
            box-shadow: inset 1px 1px 2px -1px black;
        }

        .btn-toggle.active>.inner-handle {
            background-color: #BD4053;
        }

        .btn-toggle>.handle:before {
            content: "";
            position: absolute;
            height: 34px;
            width: 34px;
            top: 35%;
            left: 11px;
            background-image: radial-gradient(circle at center, #afafaf 5px, transparent 5px);
            background-size: 10px 10px;
            background-repeat: no-repeat;
        }

        .btn-toggle.active>.handle:before {
            background-image: radial-gradient(circle at center, #F47280 5px, transparent 5px);
        }

        .btn-toggle>.handle {
            position: absolute;
            top: -0.2875rem;
            left: 0.3875rem;
            width: 2.125rem;
            height: 2.125rem;
            border-radius: 1.125rem;
            background: #fff;
            transition: left 0.25s;
            border: 1px solid #ccc;
        }

        .btn-toggle.active {
            transition: background-color 0.25s;
        }

        .btn-toggle.active>.handle {
            left: 2.4175rem;
            transition: left 0.25s;
        }

        .btn-toggle.active:before {
            opacity: 0.5;
        }

        .btn-toggle.active:after {
            opacity: 1;
            color: #ff001c;
        }

        .btn-toggle.active {
            background-color: #fd001b;
        }
        .dot {
            height: 15px;
            width: 15px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="<?php echo route('client')?>" class="brand-link">
            <img src="/template/admin/dist/img/vlute.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">VLUTE</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar-dark">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <i style="color: white; margin-left: 20px" class="fa fa-user-friends"><a href="<?php echo route('profile') ?>" style="margin-left: 10px">{{session()->get('name') }}</a></i>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2" style="color: #0a0e14">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Smart Home
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo route('admin.iots.statistics') ?>" class="nav-link">
                                    <p>IOT</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-pager"></i>
                            <p>
                                Page
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo route('dangxuat')?>" class="nav-link">
                                    <p>Đăng xuất</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="card-body">
            @include('admin.alert')
            @yield('Sub_button')
        </div>


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">{{$title}}</h3>
                            </div>


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
                                            <div style="text-align:right; margin-right: 12px">
                                                <span id="dot_motor" class="dot"></span>
                                            </div>
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-0">
                                                        <div class="text-xs font-weight-bold text-uppercase  text-lg-center">
                                                            <img id="img_motor" width="100px" src="/storage/img/motor_off.png">
                                                        </div>

                                                        <div class="mt-5 text-xs font-weight-bold text-uppercase text-lg-center">
                                                            <div class="df-switch">
                                                                <button onclick="changeMotor({{ (string)session()->get('phone') }})"  type="button" class="btn btn-lg btn-toggle active" data-toggle="button" aria-pressed="false"
                                                                        autocomplete="off">
                                                                    <div class="inner-handle"></div>
                                                                    <div class="handle"></div>
                                                                </button>
                                                                <div class="mt-2 text-xs font-weight-bold text-uppercase text-lg-right">
                                                                    Motor
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
                                            <div style="text-align:right; margin-right: 12px">
                                                <span id="dot_auto_motor" class="dot"></span>
                                            </div>
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-0">
                                                        <div class="text-xs font-weight-bold text-uppercase  text-lg-center">
                                                            <img id="img_motor_auto" width="100px" src="/storage/img/motor_auto_off.png">
                                                        </div>

                                                        <div class="mt-5 text-xs font-weight-bold text-uppercase text-lg-right">
                                                            <div class="df-switch">
                                                                <button onclick="changeMotorAuto({{ (string)session()->get('phone') }})" type="button" class="btn btn-lg btn-toggle active" data-toggle="button" aria-pressed="false"
                                                                           autocomplete="off">
                                                                        <div class="inner-handle"></div>
                                                                        <div class="handle"></div>
                                                                    </button>
                                                                <div class="mt-2 text-xs font-weight-bold text-uppercase text-lg-right">
                                                                    Motor Auto
                                                                </div>
                                                            </div>
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
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $Aquariums->nd }}ºC</div>
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

                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $Aquariums->da }}%</div>
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
                                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $Aquariums->khoangcach / 30 * 100 }} %</div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="progress progress-sm mr-2">
                                                                    <div class="progress-bar bg-info" role="progressbar"
                                                                         style="width: {{ $Aquariums->khoangcach / 30 * 100 }}%" aria-valuenow="50" aria-valuemin="0"
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
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $Aquariums->ph }}</div>
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
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $Aquariums->tds }}</div>
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

                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $Aquariums->ndn }}</div>
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

                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $Aquariums->ntu }}</div>
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
                                                <h6 class="m-0 font-weight-bold text-primary">Độ PH trong ngày</h6>

                                            </div>
                                            <!-- Card Body -->
                                            <div class="card-body">
                                                <div class="chart-pie pt-4 pb-2">
                                                    <input type="hidden" id="hainam" value="1">
                                                    <input type="hidden" id="motnam" value="2">
                                                    <input type="hidden" id="hientai" value="3">
                                                    <input type="hidden" id="sonam2" value="morning">
                                                    <input type="hidden" id="sonam1" value="afternoon">
                                                    <input type="hidden" id="sonamhientai" value="everning">
                                                    <canvas id="myPieChart"></canvas>
                                                </div>
                                                <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> sáng
                                        </span>
                                                    <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> trưa
                                        </span>
                                                    <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> chiều
                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-8 col-lg-5">
                                        <div class="card shadow mb-4">
                                            <!-- Card Header - Dropdown -->
                                            <div
                                                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold text-primary">Độ PH theo các tuần trong năm</h6>

                                            </div>
                                            <!-- Card Body -->
                                            <div class="card-body">
                                                <canvas id="myChart" style="width:100%;max-width:800px"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-5">
                                        <div class="card shadow mb-4">
                                            <!-- Card Header - Dropdown -->
                                            <div
                                                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold text-primary">Nhiệt độ trung bình trong ngày</h6>

                                            </div>
                                            <!-- Card Body -->
                                            <div class="card-body">
                                                <canvas id="myChartBar" style="width:100%;max-width:600px;height: 370px"></canvas>
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

                        </div>

                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Copyrights</b> by
        </div>
        <strong>19004071 & 19004158</strong>
    </footer>

{{--    <input type="hidden" id="AquariumAll" value="<?php echo $AquariumAll ?>">--}}

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/template/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/template/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="/template/admin/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="/template/admin/plugins/jquery-validation/additional-methods.min.js"></script>

<script>

    function getMonday(d) {
        d = new Date(d);
        var day = d.getDay(),
            diff = d.getDate() - day + (day == 0 ? -6 : 1); // adjust when day is sunday
        return new Date(d.setDate(diff));
    }




    currentDate = new Date();
    var year = new Date(currentDate.getFullYear(), 0, 1);
    var days = Math.floor((currentDate - year) / (24 * 60 * 60 * 1000));
    var week = Math.ceil(( currentDate.getDay() + 1 + days) / 7);
    let dayBegin = getMonday(new Date()).getDate();
    let monthCurrent = getMonday(new Date()).getMonth();
    monthCurrent = monthCurrent + 1;
    let yearCurrent = getMonday(new Date()).getFullYear();

    // console.log(dayBegin);
    //
    // console.dir();

    var arrWeek = [];
    for(var i = (week - 9); i <= week; i++){
        arrWeek.push(i);
    }

    let arrAqua = <?php echo $AquariumAll ?>;


    let arrAvg = [];


    console.log(monthCurrent, yearCurrent);

    for(var j = 0 ; j < arrWeek.length ; j++){
        let sum = 0;
        let dem = 0;
        let SumAvg = 0;
        for (var i = 0 ; i < arrAqua.length ; i++){
            const dateT = new Date(arrAqua[0].thoigian);
            if((dateT.getMonth() + 1) == monthCurrent && dateT.getFullYear() == yearCurrent){
                sum += arrAqua[i].ph;
                dem++;
            }
            SumAvg = sum / dem;
        }
        arrAvg.push(SumAvg);
    }

    // console.dir(arrAvg);



    let xValuesL = ["PH/Tuần"];

    xValuesL = [...xValuesL, ...arrWeek];

    const dat = new Date();
    let month = dat.getMonth() + 1;
    // console.log(month);


    // const a = [1,2,3,4,5,6];
    //
    // [c, d, ...rest ] = a;
    //
    // console.log(rest);




    const yValuesL = [2,2,4,3,5,6,7,8,9,10,11,12,13];

    new Chart("myChart", {
        type: "line",
        data: {
            labels: xValuesL,
            datasets: [{
                fill: false,
                lineTension: 0,
                backgroundColor: "rgba(0,0,255,1.0)",
                borderColor: "rgba(0,0,255,0.1)",
                data: yValuesL
            }]
        },
        options: {
            legend: {display: false},
            scales: {
                yAxes: [{ticks: {min: 1, max:13}}],
            }
        }
    });
</script>

<script>
    var xValues = ["Sáng", "Trưa", "Chiều"];
    var yValues = [55, 49, 24];
    var barColors = ["red","blue","orange"];

    new Chart("myChartBar", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            legend: {display: false},
            title: {
                display: true,
                text: "Nhiệt Độ Trung Bình Trong Ngày"
            }
        }
    });
</script>
</body>

@include('admin.footer')

</html>

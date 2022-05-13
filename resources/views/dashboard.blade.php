@extends ('layouts.master')

@section('main')
    <section>
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-9 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class=" font-weight-bold text-primary text-uppercase mb-1 mt-2">
                                        Schedules</div>
                                    <div class="h4 mb-0 font-weight-bold text-gray-800">{{ \App\Schedule::count() }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar-check fa-2x text-gray-300" style="font-size:40px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-9 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2 ">
                                    <div class=" font-weight-bold text-success text-uppercase mb-1 mt-2">
                                        Data Office Boys</div>
                                    <div class="h4 mb-0 font-weight-bold text-gray-800">{{ \App\User::count() }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300" style="font-size:40px;"
                                        style="font-size:40px;"></i>
                                </div>
                            </div>
                        </div>
                        <!-- <a href="{{ route('users.index') }}" class="small-box-footer text-center">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-9 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class=" font-weight-bold text-info text-uppercase mb-1 mt-2">Pelaporan/Report
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h4 mb-0 font-weight-bold text-gray-800">{{ \App\User::count() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300" style="font-size:40px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Row -->
            </div>

            <div class="row">
                <div class="col-xl-7 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="myAreaChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-5 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Status Schedule ( {{ $day }} )</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            @foreach ($data as $da)
                                @if ($da->status == 'On Progress')
                                    <div class="row">
                                        <div class="col">
                                            <img src="{{ asset('assets/img/undraw_profile_3.svg') }}" width="50px;"
                                                alt="">
                                        </div>
                                        <div class="col-9">
                                            <h4 class="small font-weight-bold" title="username">{{ $da->user->name }}
                                                <span class="float-right">50%</span>
                                            </h4>
                                            <div class="progress mb-4" title="{{ $da->task_title }}">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 60%"
                                                    aria-valuenow="50%" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($da->status == 'Completed')
                                    <div class="row">
                                        <div class="col">
                                            <img src="{{ asset('assets/img/undraw_profile_3.svg') }}" width="50px;"
                                                alt="">
                                        </div>

                                        <div class="col-9">
                                            <h4 class="small font-weight-bold">{{ $da->user->name }}
                                                <span class="float-right">Complete!</span>
                                            </h4>
                                            <div class="progress mb-4" title="{{ $da->task_title }}">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                                    title="{{ $da->task_title }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($da->status == 'Incompleted')
                                    <div class="row">
                                        <div class="col">
                                            <img src="{{ asset('assets/img/undraw_profile_3.svg') }}" width="50px;"
                                                alt="">
                                        </div>
                                        <div class="col-9">

                                            <h4 class="small font-weight-bold">{{ $da->user->name }}
                                                <span class="float-right">0%</span>
                                            </h4>
                                            <div class="progress mb-4" title="{{ $da->task_title }}">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 5%"
                                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                                    title="{{ $da->task_title }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('sweetalert::alert')

        <!-- /.container-fluid -->

    </section>
@endsection

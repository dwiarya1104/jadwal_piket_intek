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
                        <i class="fas fa-users fa-2x text-gray-300" style="font-size:40px;" style="font-size:40px;"></i>
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
                            <div class="h4 mb-0 font-weight-bold text-gray-800">{{ \App\User::count() }}</div>
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
<!-- /.container-fluid -->

</section>
@endsection

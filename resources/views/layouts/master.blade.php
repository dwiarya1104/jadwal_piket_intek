<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Jadwal Piket</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">
    <div class="modal fade" id="modalEditProfile{{ \Auth::user()->id }}" tabindex="-1"
        aria-labelledby="modalUpdateBarang" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--FORM UPDATE BARANG-->
                    <form action="{{ route('users.editProfile', \Auth::user()->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-4">
                                @if (\Auth::user()->poto)
                                    <img class="img-profile rounded-circle "
                                        src="{{ asset('storage/pp/' . \Auth::user()->poto) }}" width=100%>
                                @else
                                    <img class="img-profile rounded-circle "
                                        src="{{ asset('assets/img/default.svg') }}" width=100%>
                                @endif
                            </div>
                            <div class="col-8">
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label for="#" class="font-weight-bold h6">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" id="email" placeholder="Name"
                                            value={{ \Auth::user()->name }}>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="#" class="font-weight-bold h6">Username</label>
                                        <input type="text" class="form-control" name="username" id="email"
                                            placeholder="Username" value={{ \Auth::user()->username }}>
                                    </div>
                                </div>
                                <label for="#" class="font-weight-bold h6 mt-3">Choose your profile picture</label>
                                <input type="hidden" name="oldImage" value={{ \Auth::user()->poto }}>
                                <div class="form-group">
                                    <input type="file" class="form-control" name="poto">
                                </div>
                            </div>
                        </div>
                        {{-- @if (\Auth::user()->img)
                            <img src="{{ asset('storage/bukti/' . \Auth::user()->img) }}" alt="" width="70%"
                                style="display:flex;margin-left: auto; margin-right:auto">
                        @else
                            <h4 class="text-center my-5">No Image Yet</h4>
                        @endif --}}
                        {{-- <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="#" class="font-weight-bold h6">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" id="email" placeholder="Name" value={{ \Auth::user()->name }}>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="#" class="font-weight-bold h6">Username</label>
                                <input type="text" class="form-control" name="username" id="email"
                                    placeholder="Username" value={{ \Auth::user()->username }}>
                            </div>
                        </div>
                        <label for="#" class="font-weight-bold h6 mt-3">Bukti</label>
                        <div class="form-group">
                            <input type="file" class="form-control" name="upload_bukti">
                        </div> --}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary bt-sm right">Save Change</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
                <img src="{{ asset('assets/img/sii_circle.svg') }}" width="20%" alt="">
                <div class="sidebar-brand-text mx-2">Jadwal Piket</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            @hasrole('admin')
                <li class="nav-item {{ request()->is('dashboard*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/dashboard') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>
            @endhasrole
            <!-- Divider -->
            <hr class="sidebar-divider">
            {{-- <li class="nav-item {{request()->is('users.index')? 'active': ''}}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Administrator</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{route('users.index')}}">Office Boys</a>
                        {{-- <a class="collapse-item" href="{{route('admin.index')}}">Admins</a> --}}
            {{-- </div> --}}
            {{-- </div> --}}
            {{-- </li> --}}

            <!-- Nav Item - Charts -->
            @hasrole('admin')
                <li class="nav-item {{ request()->is('users*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('users.index') }}">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Office Boys</span></a>
                </li>
            @endhasrole

            <li class="nav-item {{ request()->is('schedule*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('schedule.index') }}">
                    <i class="fas fa-fw fa-calendar-check"></i>
                    <span>Schedules</span></a>
            </li>
            @hasrole('admin')
                <li class="nav-item {{ request()->is('activity*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('activities.index') }}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Activities</span></a>
                </li>
            @endhasrole
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="row ml-3">
                        <div class="date mt-2 text-primary font-weight-bold">
                            <script type='text/javascript'>
                                var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
                                    'November', 'Desember'
                                ];
                                var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                var date = new Date();
                                var day = date.getDate();
                                var month = date.getMonth();
                                var thisDay = date.getDay(),
                                    thisDay = myDays[thisDay];
                                var yy = date.getYear();
                                var year = (yy < 1000) ? yy + 1900 : yy;
                                document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                            </script>
                        </div>
                        <div class="topbar-divider d-none d-sm-block primary"></div>

                        <div class="clock mt-2 text-primary">
                            {{-- <div class="badge badge-primary"> --}}
                            <h6 id="jam" style="padding-top:3px; font-weight:bold;"></h6>
                            {{-- </div> --}}
                        </div>
                    </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                            aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                        placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        </li>


                        <!-- <div class="topbar-divider d-none d-sm-block"></div> -->

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->username }}</span>
                                @if (\Auth::user()->poto)
                                    <img class="img-profile rounded-circle"
                                        src="{{ asset('storage/pp/' . \Auth::user()->poto) }}">
                                @else
                                    <img class="img-profile rounded-circle"
                                        src="{{ asset('assets/img/default.svg') }}">
                                @endif
                            </a>
                            <!-- Dropdown - User Information -->
                            <ul class="dropdown-menu dropdown-menu-right shadow animated--grow-in justify-content-center align-items-center"
                                aria-labelledby="userDropdown">
                                <!-- The user image in the menu -->
                                <li class="user-header align-items-center justify-content-center text-center">
                                    @if (\Auth::user()->poto)
                                        <img src="{{ asset('storage/pp/' . \Auth::user()->poto) }}"
                                            class="img-circle rounded-circle my-3 mx-3" style="width:50px;"
                                            alt="User Image">
                                    @else
                                        <img src="{{ asset('assets/img/default.svg') }}"
                                            class="img-circle rounded-circle my-3 mx-3" style="width:50px;"
                                            alt="User Image">
                                    @endif
                                    <h6 class="col">
                                        {{ \Auth::user()->name }}
                                        <br>
                                        <small>{{ \Auth::user()->email }}</small>
                                    </h6>
                                </li>
                                <div class="dropdown-divider mx-1"></div>
                                <a class="btn btn-transparent btn-sm" style="font-size" data-toggle="modal"
                                    data-target="#modalEditProfile{{ \Auth::user()->id }}">
                                    <i class="fas fa-cog"></i>&nbsp;
                                    {{ __('Edit Profile') }}
                                </a>
                                {{-- <input type="file" id="imgupload"> --}}
                                {{-- <a href="" onclick="$('#imgupload').trigger('click'); return false;" style="text-decoration: none; display:flex; justify-content:center">Change Profile</a> --}}
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    {{-- <div class="pull-left"> --}}
                                    {{-- <a href="#" class="btn btn-default btn-flat">Profile</a> --}}
                                    {{-- </div> --}}
                                    <div class="dropdown-divider mx-1"></div>
                                    <div class="pull-right">
                                        <a class="btn btn-default btn-flat float-left"
                                            style="font-size: 12px; color:#e74a3b" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt mr-1"></i>{{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>

                            {{-- <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </div>
                        </li>

                    </ul> --}}

                </nav>

                <!-- End of Topbar -->

                <!-- Begin Page Content -->

                <main id="main" class="main">
                    @yield('main')
                </main>

                <!-- /.container-fluid -->

                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container">
                        <div class="copyright text-center">
                            <span>Copyright &copy; 2021</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $("#OpenImgUpload").click(function() {
                $("#imgupload").click();
            });
        </script>

        <script type="text/javascript">
            window.onload = function() {
                jam();
            }

            function jam() {
                var e = document.getElementById('jam'),
                    d = new Date(),
                    h, m, s;
                h = d.getHours();
                m = set(d.getMinutes());
                s = set(d.getSeconds());

                e.innerHTML = h + ':' + m + ':' + s;

                setTimeout('jam()', 1000);
            }

            function set(e) {
                e = e < 10 ? '0' + e : e;
                return e;
            }
        </script>


        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

        <!-- Page level plugins -->
        <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('assets/js/demo/chart-pie-demo.js') }}"></script>
        <!-- Page level plugins -->
        <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>


        {{-- @include('sweetalert::alert') --}}

</body>

</html>

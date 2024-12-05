<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    @yield("title")

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('resources/assets/img/logo-sm.png') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/js/daterangepicker.css') }}" />

    <link rel="stylesheet" href="{{ asset('resources/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"/>



    <script src="{{ asset('resources/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/apexchart/chart-data.js') }}"></script>
    <script src="{{ asset('resources/assets/js/script.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/sweetalert/sweetalerts.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/tableToExcel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('resources/js/daterangepicker.min.js') }}"></script>


</head>



<body>
    <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div>

    <div class="main-wrapper">

        <div class="header">

            <div class="header-left active">
                <a href="{{route("dash.home")}}" class="logo">
                    <img src="{{ asset('resources/assets/img/logo.png') }}" alt="">
                </a>
                <a href="{{route("dash.home")}}" class="logo-small">
                    <img src="{{ asset('resources/assets/img/logo-sm.png') }}" alt="">
                </a>
                <a id="toggle_btn" href="javascript:void(0);">
                </a>
            </div>

            <a id="mobile_btn" class="mobile_btn" href="#sidebar">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>

            <ul class="nav user-menu">

                <li class="nav-item">
                    <div class="top-nav-search">
                        <a href="javascript:void(0);" class="responsive-search">
                            <i class="fa fa-search"></i>
                        </a>
                        <form action="#">
                            <div class="searchinputs">
                                <input type="text" placeholder="Search Here ...">
                                <div class="search-addon">
                                    <span><img src="{{ asset('resources/assets/img/icons/closes.svg') }}"
                                            alt="img"></span>
                                </div>
                            </div>
                            <a class="btn" id="searchdiv"><img
                                    src="{{ asset('resources/assets/img/icons/search.svg') }}" alt="img"></a>
                        </form>
                    </div>
                </li>



                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                        <span class="user-img"><img src="{{ asset(Auth::user()->images) }}" alt="">
                            <span class="status online"></span></span>
                    </a>
                    <div class="dropdown-menu menu-drop-user">
                        <div class="profilename">
                            <div class="profileset">
                                <span class="user-img"><img class="border" src="{{ asset(Auth::user()->images) }}"
                                        alt="">
                                    <span class="status online"></span></span>
                                <div class="profilesets">
                                    <h6>{{ Auth::user()->name }}</h6>

                                    <h5>{{ get_role_name(Auth::user()->user_role) }}</h5>
                                </div>
                            </div>
                            <hr class="m-0">
                            <a class="dropdown-item" href="{{ route('dash.profile') }}"> <i class="me-2"
                                    data-feather="user"></i>
                                My
                                Profile</a>
                            <a class="dropdown-item" href="{{ route('dash.setting') }}"><i class="me-2"
                                    data-feather="settings"></i>Settings</a>
                            <hr class="m-0">
                            <a class="dropdown-item logout pb-0" href="{{ route('logout') }}"><img
                                    src="{{ asset('resources/assets/img/icons/log-out.svg') }}" class="me-2"
                                    alt="img">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>


            <div class="dropdown mobile-user-menu">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('dash.profile') }}">My Profile</a>
                    <a class="dropdown-item" href="{{ route('dash.setting') }}">Settings</a>
                    <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>

        </div>


        {{-- Alert --}}

        @if (session()->has('message'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: '{{ empty(session()->get('type'))?"success":"error" }}',
                    title: '{{ session()->get('message') }}',
                    showConfirmButton: false,
                    timer: 2500
                })
            </script>
        @endif

        @if ($errors->any())
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ $errors->first() }}',
                })
            </script>
        @endif

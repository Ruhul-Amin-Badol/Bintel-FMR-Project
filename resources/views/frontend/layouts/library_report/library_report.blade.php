<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Library Visiting Report</title>

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

    <style>
        circle,
        .circle::before {
            content: " ";
            margin: 15px;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            margin: 0 auto;
            transition: all 0.3s;
            background-color: #00db00;
        }

        .circle::before {
            animation: mymove 2s infinite;
            position: absolute;
            background-color: #00db00;
        }

        @-webkit-keyframes mymove {
            50% {
                transform: scale(2);
                opacity: 0
            }

            100% {
                transform: scale(2);
                opacity: 0
            }
        }


        .logo span {
            font-weight: 600;
            color: #635858;
            font-size: 17px;
            font-family: sans-serif;
            margin-left: 14px;
            margin-top: 8px;
            display: block;
        }

        .animate_charcter {
            text-transform: uppercase;
            background-image: linear-gradient(-225deg, #231557 0%, #077abd 29%, #f8142d 67%, #ffee00 100%);
            background-size: auto auto;
            background-clip: border-box;
            background-size: 200% auto;
            color: #fff;
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: textclip 2s linear infinite;
            display: inline-block;
            font-size: 190px;
        }

        .animate_date {
            background-image: linear-gradient(-225deg, #231557 0%, #077abd 29%, #f8142d 67%, #ffee00 100%);
            background-size: 200% auto;
            color: #fff;
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: textclip 2s linear infinite;
            display: inline-block;
        }

        @keyframes textclip {
            to {
                background-position: 200% center;
            }
        }

        .logo h5 {
            text-shadow: 0 2px 3px #000;
            font-size: 30px;
            color: #e40808;
            margin-bottom: 0;
            margin-left: 8px;
        }

        @media (min-width: 1801px) {
            .logo span {
                font-size: 15px;
            }

        }

        @media (min-width: 1801px) {
            .logo h5 {
                font-size: 27px;
            }

        }

        @media only screen and (max-width: 1400px) and (min-width: 993px) {

            .logo span {
                font-size: 12px;
            }

            .logo h5 {
                font-size: 18px;
            }

            .logo {
                height: 70px;
            }


        }

        @media only screen and (max-width: 992px) and (min-width: 468px) {

            .logo span {
                font-size: 9px;
            }

            .logo h5 {
                font-size: 16px;
            }

            .logo {
                height: 50px;
            }


        }

        @media only screen and (max-width: 467px) and (min-width: 320px) {

            .logo span {
                display: none
            }

            .logo h5 {
                display: none
            }


            .logo {
                height: 40px;
            }


        }
    </style>

</head>

<body style="background: url(./resources/assets/img/White_Background-01.jpg); ">


    <header class="p-3 mb-3 border-bottom bg-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center  justify-content-between">
                <a href="https://the-royal-scientific-publications.com" class="logo d-flex"><img class="mr-1"
                        src="https://the-royal-scientific-publications.com/uploads/logos/2023/08/20/logo_1692527996.webp"
                        alt="The Royal Scientific Publications">
                    <div class="d-block mobile_hide">
                        <h5>The Royal Scientific Publications</h5>
                        <span class="animate_charcter">World Class Publications in Bangladesh</span>
                    </div>
                </a>

                <ul class="nav col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">


                </ul>

                @if (session()->has('officer'))
                    <div class="dropdown text-end">

                        <a href="#"
                            class="d-block d-flex align-items-center link-dark text-decoration-none dropdown-toggle text-center"
                            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false"
                            style="display: flex; align-items: center; justify-content: center;">
                            <img src="{{ asset('resources/assets/img/profile.png') }}" alt="mdo" width="40"
                                height="40" class="rounded-circle" style="margin-right: 10px;">
                            <span class="fw-bold">{{ session('officer')->name }}</span>
                        </a>

                        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1" style="">
                            <li><a class="dropdown-item" href="#"></a></li>
                            <li><a class="dropdown-item fw-bold text-danger" href="{{ route('officer.logout') }}">Log
                                    Out</a></li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </header>


    <div class="container mt-3">


        <div class="row d-flex justify-content-center">
            <div class="col-lg-10">
                <div class="library_title bg-white" style=" overflow:hidden;">
                    <hr>
                    <h3 class="text-center text-success fw-bold"> Library Visiting Report </h3>
                    <hr>
                </div>
                <div class="card">

                    <div class="card-body">

                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        @if (Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        <form action="{{ route('library.visit.new.front.action') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Library Type <span class="text-danger"
                                                style="font-size: 30px; font-weight:600;">*</span></label>
                                        <div class="">
                                            <select id="library-type" class="form-select" name="library_type">
                                                <option value="">-- Select --</option>
                                                <option value="Agent"
                                                    {{ old('library_type') == 'Agent' ? 'selected' : '' }}>Agent
                                                </option>
                                                <option value="Wholesaler"
                                                    {{ old('library_type') == 'Wholesaler' ? 'selected' : '' }}>
                                                    Wholesaler</option>
                                                <option value="Retailer"
                                                    {{ old('library_type') == 'Retailer' ? 'selected' : '' }}>Retailer
                                                </option>
                                            </select>
                                            @error('library_type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Employee Name Or ID <span class="text-danger"
                                                style="font-size: 30px; font-weight:600;">*</span></label>
                                        <select name="employee_id" class="form-select select2">
                                            <option disabled selected value="">Select</option>
                                            @foreach ($officers as $officer)
                                                <option value="{{ $officer->employee_id }}"
                                                    {{ old('employee_id') == $officer->employee_id ? 'selected' : '' }}>
                                                    {{ $officer->name }} ({{ $officer->employee_id }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('employee_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Library Name <span class="text-danger"
                                                style="font-size: 30px; font-weight:600;">*</span></label>
                                        <input type="text" class="form-control" name="library_name"
                                            value="{{ old('library_name') }}" placeholder="Enter Library Name">
                                        @error('library_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Library Owner Name <span class="text-danger"
                                                style="font-size: 30px; font-weight:600;">*</span></label>

                                        <input type="text" class="form-control" name="owner_name"
                                            value="{{ old('owner_name') }}" placeholder="Enter Owner Name">
                                        @error('owner_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Library Contact Number <span class="text-danger"
                                                style="font-size: 30px; font-weight:600;">*</span>
                                        </label>

                                        <input type="text" class="form-control" name="contact_number"
                                            value="{{ old('contact_number') }}"
                                            placeholder="Enter Library Contact Number">

                                        @error('contact_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="dateInput">Select a date <span
                                                class="text-danger"
                                                style="font-size: 30px; font-weight:600;">*</span></label>
                                        <input type="text" placeholder="Choose Date" class="form-control"
                                            name="date" value="{{ old('date') }}" id="daterangeSingle">
                                        @error('date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Detail Address <span class="text-danger"
                                        style="font-size: 30px; font-weight:600;">*</span></label>
                                <div class="col-md-10">
                                    <div class="form-group row">

                                        <div class="col-md-4">
                                            <label class="col-form-label col-md-3">Division</label>
                                            <div class="">
                                                <select class="form-select select2" id="division_id"
                                                    name="division_id">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($divisions as $division)
                                                        <option value="{{ $division->division_id }}"
                                                            {{ old('division_id') == $division->division_id ? 'selected' : '' }}>
                                                            {{ $division->division_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('division_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="col-form-label col-md-3">District</label>
                                            <div class="">
                                                <select class="form-select select2" id="district_id"
                                                    name="district_id">
                                                    <option value="">-- Select --</option>
                                                    <!-- Options for districts will be dynamically populated based on the selected division using JavaScript -->
                                                </select>
                                                @error('district_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="col-form-label col-md-3">Upazila</label>
                                            <div class="">
                                                <select class="form-select select2" id="upazila_id"
                                                    name="upazila_id">
                                                    <option value="">-- Select --</option>
                                                    <!-- Options for upazilas will be dynamically populated based on the selected district using JavaScript -->
                                                </select>
                                                @error('upazila_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 pt-0">Area <span class="text-danger"
                                        style="font-size: 30px; font-weight:600;">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="area"
                                        value="{{ old('area') }}" placeholder="Enter Area">
                                    @error('area')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-md-3 pt-0">Available Books(TRSP) <span class="text-danger" style="font-size: 30px; font-weight:600;">*</span></label>
                                <div class="col-md-9">
                                    <select class="form-select select2" name="available_books[]" multiple>
                                        <option value="V-VIII" {{ in_array('V-VIII', old('available_books', [])) ? 'selected' : '' }}>V-VIII</option>
                                        <option value="SSC" {{ in_array('SSC', old('available_books', [])) ? 'selected' : '' }}>SSC</option>
                                        <option value="HSC" {{ in_array('HSC', old('available_books', [])) ? 'selected' : '' }}>HSC</option>
                                        <option value="Admission" {{ in_array('Admission', old('available_books', [])) ? 'selected' : '' }}>Admission</option>
                                        <option value="BCS & Job" {{ in_array('BCS & Job', old('available_books', [])) ? 'selected' : '' }}>BCS & Job</option>
                                        <option value="Stationary" {{ in_array('Stationary', old('available_books', [])) ? 'selected' : '' }}>Stationary</option>
                                        <option value="Higher Education" {{ in_array('Higher Education', old('available_books', [])) ? 'selected' : '' }}>Higher Education</option>
                                        <option value="None" {{ in_array('None', old('available_books', [])) ? 'selected' : '' }}>None</option>
                                    </select>
                                    @error('available_books')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-md-3 pt-0">Books Collected From <span class="text-danger" style="font-size: 30px; font-weight:600;">*</span></label>
                                <div class="col-md-9">
                                    <select class="form-control select2" name="books_collected_from[]" multiple>
                                        <option value="Sales Center" {{ in_array('Sales Center', old('books_collected_from', [])) ? 'selected' : '' }}>Sales Center</option>
                                        <option value="Agent" {{ in_array('Agent', old('books_collected_from', [])) ? 'selected' : '' }}>Agent</option>
                                        <option value="Others" {{ in_array('Others', old('books_collected_from', [])) ? 'selected' : '' }}>Others</option>
                                    </select>
                                    @error('books_collected_from')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-form-label col-md-3">Sales Executive Comments </label>
                                <div class="col-md-9">
                                    <textarea rows="5" cols="5" class="form-control" name="sales_executive_comments"
                                        placeholder="Write comments Here"></textarea>
                                    @error('sales_executive_comments')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>



                            {{-- <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Feedback</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="col-form-label">➤ What category of TRSP books are not in the
                                            collection? Why?</label>
                                        <textarea rows="5" cols="5" class="form-control" name="what_category_comments"
                                            placeholder="Write comments Here"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">➤ Agent Library Coverage?</label>
                                        <textarea rows="5" cols="5" class="form-control" name="agent_library_comments"
                                            placeholder="Write comments Here"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">➤ Have you faced any problem while collecting
                                            books from sales center?</label>
                                        <textarea rows="5" cols="5" class="form-control" name="any_problem_comments"
                                            placeholder="Write comments Here"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">➤ Are you getting new books on time when they
                                            are
                                            published?</label>
                                        <textarea rows="5" cols="5" class="form-control" name="new_books_on_time_comments"
                                            placeholder="Write comments Here"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">➤ How often do MR contact you? Do they work
                                            according to your suggestion?</label>
                                        <textarea rows="5" cols="5" class="form-control" name="mr_contact_comments"
                                            placeholder="Write comments Here"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">➤ How can we improve our service for
                                            you?</label>
                                        <textarea rows="5" cols="5" class="form-control" name="improve_our_service_comments"
                                            placeholder="Write comments Here"></textarea>
                                    </div>
                                </div>

                            </div> --}}
                            <div class="col-lg-12">
                                <button class="btn btn-submit me-2" type="submit"> <i class="fa fa-edit"></i>
                                    Submit</button>
                                <a href="#" class="btn btn-cancel"> <i class="fa fa-arrow-left"></i>
                                    Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <style>
        .table tbody tr td {
            text-align: left !important;
        }

        .table-bordered {
            border: 1px solid #dee2e6 !important;
        }

        .table-bordered td {
            border: 1px solid #dee2e6 !important;
        }

        @media only screen and (max-width: 600px) {

            .library_title h3,
            h4 {

                font-size: 16px;
            }
        }
    </style>



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
    <script>
        $(function() {
            $('#daterangeSingle').daterangepicker({
                singleDatePicker: true,
                opens: 'right',
                showDropdowns: true,
                showWeekNumbers: true,
                alwaysShowCalendars: true
            }, function(start, end, label) {
                console.log("A new date was selected: " + start.format('YYYY-MM-DD'));
            });
        });
    </script>


    <script>
        $(document).ready(function() {

            $(".select2").select2();
        });
    </script>


    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2();

            // Add change event listener to the division select
            $('#division_id').change(function() {
                var divisionId = $(this).val(); // Get the selected division ID

                // Fetch data for Zilla select
                $.ajax({
                    url: "{{ route('get.districts') }}", // Change this to your backend route
                    type: 'GET',
                    data: {
                        division_id: divisionId
                    }, // Pass division ID to backend
                    success: function(data) {
                        var options = '<option value="">-- Select --</option>';
                        $.each(data, function(key, value) {
                            options += '<option value="' + value.district_id + '">' +
                                value
                                .district_name + '</option>';
                        });
                        $('#district_id').html(options);
                    },
                    error: function(xhr, status, error) {
                        console.error(error); // Log any errors to the console
                    }
                });
            });

            $('#district_id').change(function() {
                var districtId = $(this).val();
                $.ajax({
                    url: "{{ route('get.upazilas') }}",
                    type: 'GET',
                    data: {
                        district_id: districtId
                    }, // Pass district ID to backend
                    success: function(data) {
                        var options = '<option value="">-- Select --</option>';
                        $.each(data, function(key, value) {
                            options += '<option value="' + value.upazila_id + '">' +
                                value
                                .upazila_name + '</option>';
                        });
                        $('#upazila_id').html(options);
                    },
                    error: function(xhr, status, error) {
                        console.error(error); // Log any errors to the console
                    }
                });

            });


        });
    </script>




</body>

</html>

@extends('dashboard.master')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Institution Visiting Reports</h4>
                <h6>Institution Visit List</h6>
            </div>
        </div>

        <div class="card">
            <div class="card-body">

                <div class="table-top">
                    <div class="search-set">
                        <div class="search-path">
                            <a class="btn btn-filter" id="filter_search">
                                <img src="{{ asset('resources/assets/img/icons/filter.svg') }}" alt="img">
                                <span><img src="{{ asset('resources/assets/img/icons/closes.svg') }}" alt="img"></span>
                            </a>
                        </div>
                        <div class="search-input">
                            <a class="btn btn-searchset"><img
                                    src="{{ asset('resources/assets/img/icons/search-white.svg') }}" alt="img"></a>
                        </div>
                    </div>
                    <div class="wordset">
                        <ul>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="PDF">
                                    <img src="{{ asset('resources/assets/img/icons/pdf.svg') }}" alt="img">
                                </a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel">
                                    <img src="{{ asset('resources/assets/img/icons/excel.svg') }}" alt="img">
                                </a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Print">
                                    <img src="{{ asset('resources/assets/img/icons/printer.svg') }}" alt="img">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                    <!-- Filter start -->
                <div class="card " id="filter_inputs">
                    <div class="card-body pb-0">
                        <form method="GET" action="">
                            <div class="row">
                                <!-- Date Range Input -->
                                <div class="col-md-4">
                                    <div class="form-group required">
                                        <label class="fw-bold" for="daterange">Select a Date Range</label>
                                        <input type="text" class="form-control" name="range" id="daterange"
                                            value="{{ request('range') }}" placeholder="YYYY-MM-DD - YYYY-MM-DD">
                                    </div>
                                </div>

                                <!-- Employee ID Input select -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="fw-bold" for="employee_id">Employee Name / ID</label>
                                        <select name="employee_id" id="employee_id" class="form-control select234">
                                            <option selected value="">Select Employee Name/ID </option>
                                            @foreach ($officers as $officer)
                                                <option value="{{ $officer->employee_id }}">
                                                    {{ $officer->name }} ({{ $officer->employee_id }})
                                                </option>
                                            @endforeach
                                        </select>              
                                    </div>
                                </div>

                                <!-- Division -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="fw-bold" for="division_id">Division</label>
                                        <select class="form-control select234" name="division_id" id="division_id">
                                            <option value="">Select Division</option>
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->division_id }}">{{ $division->division_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- District -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="fw-bold" for="district_id">District</label>
                                        <select class="form-control select234" name="district_id" id="district_id">
                                            <option value="">Select District</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Upazila -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="fw-bold" for="upazila_id">Upazila</label>
                                        <select class="form-control select234" name="upazila_id" id="upazila_id">
                                            <option value="">Select Upazila</option>
                                        </select>
                                    </div>
                                </div>

                       
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary" id="applyFilters"><i class="fa-solid fa-filter"></i> Apply Filters</button>
                                    <button type="button" class="btn btn-secondary" id="resetFilters"><i class="fa-solid fa-rotate-right"></i> Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table  datanewAjax">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Employee ID</th>
                                <th>Date</th>
                                <th>Institution Name</th>
                                <th>Teachers Name</th>
                                <th>Designation</th>
                                <th>Contact Number</th>
                                <th>Details Address</th>
                                <th>Quantity</th>
                                <th>Comments</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('title')
    <title>Institution Visit List</title>
@endsection

@section('script')
    <style>
        .table tbody tr td {
            text-align: left !important;
        }
    </style>


    <script>
        var AJAX_URL = '{{ route('institution.visiting.ajax') }}';

        $(document).ready(function() {

// Date Range Picker
    $('#daterange').daterangepicker({
        opens: 'right',
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });

    $('#daterange').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
    });

    $('#daterange').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    // Apply Filters
    $("#applyFilters").on("click", function(e) {
        e.preventDefault();

        // Gather filters
        var filters = {
            date_range: $("#daterange").val(),
            employee_id: $("#employee_id").val(),
            division_id: $("#division_id").val(),
            district_id: $("#district_id").val(),
            upazila_id: $("#upazila_id").val(),
        };

        // Update DataTable with new filters
        var queryString = $.param(filters);
        var dataTable = $('.datanewAjax').DataTable();
        var url = AJAX_URL + "?" + queryString;
        dataTable.ajax.url(url).load();
    });

    // Reset Filters
    $("#resetFilters").on("click", function() {
        $("#daterange").val("");
        $("#employee_id").val("");
        $("#division_id").val("");
        $("#district_id").val("").change(); 
        $("#upazila_id").val("");

        // Reload DataTable without filters
        var dataTable = $('.datanewAjax').DataTable();
        dataTable.ajax.url(AJAX_URL).load();
    });

    // Dynamic District and Upazila Loading
    $('#division_id').on('change', function() {
        var divisionId = $(this).val();
        $.ajax({
            url: '{{ route('get.districts') }}', // Route to fetch districts
            method: 'GET',
            data: {
                division_id: divisionId
            },
            success: function(data) {
                $('#district_id').html('<option value="">Select District</option>');
                data.forEach(function(district) {
                    $('#district_id').append('<option value="' + district.district_id +
                        '">' + district.district_name + '</option>');
                });
            }
        });
    });

    $('#district_id').on('change', function() {
        var districtId = $(this).val();
        $.ajax({
            url: '{{ route('get.upazilas') }}', // Route to fetch upazilas
            method: 'GET',
            data: {
                district_id: districtId
            },
            success: function(data) {
                $('#upazila_id').html('<option value="">Select Upazila</option>');
                data.forEach(function(upazila) {
                    $('#upazila_id').append('<option value="' + upazila.upazila_id +
                        '">' + upazila.upazila_name + '</option>');
                });
            }
        });
    });

    $(".select234").select2();
});
    </script>
@endsection

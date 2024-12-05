@extends('dashboard.master')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Library Visiting Report</h4>
                <h6>Library Visit List</h6>
            </div>
            {{-- <div class="page-btn">
                <a href="#" class="btn btn-added"><img
                        src="{{ asset('resources/assets/img/icons/plus.svg') }}" alt="img">Add New</a>
            </div> --}}
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
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                        src="{{ asset('resources/assets/img/icons/pdf.svg') }}" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                        src="{{ asset('resources/assets/img/icons/excel.svg') }}" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                        src="{{ asset('resources/assets/img/icons/printer.svg') }}" alt="img"></a>
                            </li>
                        </ul>
                    </div>
                </div>




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

                                <!-- Employee ID Input -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="fw-bold" for="employee_id">Employee ID</label>
                                        <input type="text" class="form-control" name="employee_id" id="employee_id"
                                            value="{{ request('employee_id') }}" placeholder="Enter Employee ID">
                                    </div>
                                </div>

                                <!-- Filter Button -->
                                <div class="col-md-2 text-center filter">
                                    <button type="submit" class="btn btn-primary "><i class="fa-solid fa-filter"></i>
                                        Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="table-responsive">
                    <table class="table  datanewAjax">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee ID</th>
                                <th>Date</th>
                                <th>Library</th>
                                <th>Owner Name</th>
                                <th>Contact Number</th>
                                <th>Detail Address</th>
                                <th>All Comments</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- DataTable will populate here -->
                        </tbody>
                    </table>

                </div>


            </div>
        </div>


    </div>
  
@endsection
@section('title')
    <title>Library Visit List</title>

@endsection



@section('script')


<style>
  .table tbody tr td {
    text-align: left !important;
  }
</style>



    <script>
        var AJAX_URL = '{{ route('library.list-ajax') }}';

        // Apply Filters
        function applyFilters() {
            var filters = {
                date_range: $("#daterange").val(),
                employee_id: $("#employee_id").val()
            };
            updateDataTable(filters);
        }

        // Update DataTable with Filters
        function updateDataTable(filters) {
            var dataTable = $('.datanewAjax').DataTable();
            var queryString = $.param(filters);
            var url = AJAX_URL + "?" + queryString;
            dataTable.ajax.url(url).load();
        }

        // Reset Filters
        function resetFilters() {
            $("#daterange").val('');
            $("#employee_id").val('');
            applyFilters();
        }

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

            // Trigger filter on button click
            $(".filter button").on('click', function(e) {
                e.preventDefault();
                applyFilters();
            });
        });
    </script>
@endsection


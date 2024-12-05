@extends('dashboard.master')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Library Visit</h4>
                <h6>Library Visit List</h6>
            </div>
            <div class="page-btn">
                <a href="{{ route('library.visit') }}" class="btn btn-added"><img
                        src="{{ asset('resources/assets/img/icons/plus.svg') }}" alt="img">Add New</a>
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

                        <div class="row ">
                            <form method="GET" action="{{ route('library.list') }}">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <div class="form-group required">
                                            <label class="fw-bold" for="dateInput">Select a daterange</label>
                                            <input type="text" class="form-control" name="range" id="daterange">
                                        </div>
                                    </div>
                                    <div class="col-md-1 text-center filter">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>


        <div class="table-responsive">
            <table class="table datanew">
                <thead>
                    <tr>
                        <th>Serial No</th>
                        <th>Library Type</th>
                        <th>Employee ID</th>
                        <th>Library Name</th>
                        <th>Owner Name</th>
                        <th>Contact Number</th>
                        <th>Date</th>
                        <th>Address</th>
                        <th>Available Books</th>
                        <th>Books Collected From</th>
                        <th>Sales Executive Comments</th>
                        <th>What Category Comments</th>
                        <th>Agent Library Comments</th>
                        <th>Any Problem Comments</th>
                        <th>New Books On Time Comments</th>
                        <th>MR Contact Comments</th>
                        <th>Improve Our Service Comments</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($libraryReports as $key => $report)
                  
                        @php
                        
                         $div=DB::table('divisions')->where('division_id',$report->division_id)->first();
                         $dis=DB::table('districts')->where('district_id',$report->district_id)->first();
                         $upo=DB::table('upazilas')->where('upazila_id',$report->upazila_id)->first();
                  
                         
                  
                        @endphp
                      
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $report->library_type }}</td>
                            <td>{{ $report->employee_id }}</td>
                            <td>{{ $report->library_name }}</td>
                            <td>{{ $report->owner_name }}</td>
                            <td>{{ $report->contact_number }}</td>
                            <td>{{ $report->date }}</td>
                            <td>
                                {{ $report->area }},
                                {{ $upo->upazila_name}},
                                {{ $dis->district_name }},
                                {{  $div->division_name }}
                            </td>
                            <td>{{ $report->available_books }}</td>
                            <td>{{ $report->books_collected_from }}</td>
                            <td>{{ $report->sales_executive_comments }}</td>
                            <td>{{ $report->what_category_comments }}</td>
                            <td>{{ $report->agent_library_comments }}</td>
                            <td>{{ $report->any_problem_comments }}</td>
                            <td>{{ $report->new_books_on_time_comments }}</td>
                            <td>{{ $report->mr_contact_comments }}</td>
                            <td>{{ $report->improve_our_service_comments }}</td>

                            <td>
                                <a class="me-3" href="{{route("library.visit.edit",encrypt($report->id))}}">
                                    <img src="{{ asset('resources/assets/img/icons/edit.svg') }}" alt="img">
                                </a>
                                <a class="me-3 delete-btn" href="{{route("delete.library.visit",encrypt($report->id))}}">
                                    <img src="{{ asset('resources/assets/img/icons/delete.svg') }}" alt="img">
                                </a>
                            </td>
                        </tr>
                    @endforeach
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
    {{-- <script>
    var AJAX_URL='{{route("monthly.report.ajax")}}';


 </script> --}}
    <script>
        $(function() {
            $('#daterangeSingle').daterangepicker({
                singleDatePicker: true, // Set to true for single date picker
                opens: 'right',
                showDropdowns: true,
                showWeekNumbers: true,
                alwaysShowCalendars: true
            }, function(start, end, label) {
                console.log("A new date was selected: " + start.format('YYYY-MM-DD'));
            });
        });
    </script>
@endsection

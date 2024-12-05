@extends('dashboard.master')

@section('content')

    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Records Report</h4>
                <h6>Manage your Records</h6>
            </div>
            <div class="page-btn">
                <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#newModal">
                    <img src="{{ asset('resources/assets/img/icons/plus.svg') }}" alt="img">Add New
                </a>
            </div>

             <!-- Modal -->
             <div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="newModal" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Create</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="card bg-light">
                                    <form action="{{route('records.new.ajax')}}" id="record_form" method="POST" enctype="multipart/form-data">
                                     @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="fw-bold" for="dateInput">Select a daterange</label>
                                                        <input type="text" class="form-control" name="collection_date" id="daterangeSingle" placeholder="Choose Date" value="{{ old('collection_date') ? date('d-m-Y', strtotime(old('collection_date'))) : '' }}">

                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>Employee Name Or ID</label>


                                                        <select  name="employee_id" class="form-control select22">
                                                            <option disabled selected value="">Select </option>
                                                            @foreach($officers as $officer)
                                                                <option value="{{ $officer->employee_id }}">{{ $officer->name }}
                                                                ({{ $officer->employee_id }})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>

                                               <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>Location</label>
                                                        <input type="text" class="form-control" name="location" value="{{old("location")}}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>Cost</label>
                                                        <input type="number" class="form-control" name="cost" value="{{old('cost')}}">

                                                    </div>
                                                </div>



                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>School/College</label>
                                                        <input type="number" class="form-control" name="institute" value="{{old('institute')}}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>Coaching/Batch</label>
                                                        <input type="number" class="form-control" name="others_institute" value="{{old('others_institute')}}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>Library Visit</label>
                                                        <input type="number" class="form-control" name="library" value="{{old('library')}}">

                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>Teacher</label>
                                                        <input type="number" class="form-control" name="teacher" value="{{old('teacher')}}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>Student</label>
                                                        <input type="number" class="form-control" name="student" value="{{old('student')}}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>Books</label>
                                                        <input type="number" class="form-control" name="books_count" value="{{old('books_count')}}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>Quiz</label>
                                                        <input type="number" class="form-control" name="quiz" value="{{old('quiz')}}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>Leave A Comments</label>
                                                        <textarea name="comments" type="description" class="form-control" id="" cols="30" rows="10" value="{{old("comments")}}"></textarea>


                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <button class="btn btn-submit me-2" type="submit"> <i class="fa fa-edit"></i> Submit</button>
                                                    <a href="{{route('records.list')}}" class="btn btn-cancel"> <i class="fa fa-arrow-left"></i> Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                   </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

                <div class="card" id="filter_inputs">
                    <div class="card-body pb-0">
                        <div class="row">
                            <form method="GET" action="{{ route('records.list.by.date') }}">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label class="fw-bold" for="dateInput">Select a daterange</label>
                                        <input type="text" class="form-control" name="range" id="daterange">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="employee_name">Employee Name Or ID:</label>
                                        <select id="employee_name" name="employeeName" class="form-control select2">
                                            <option value="">All</option>
                                            @foreach($officers as $officer)
                                                <option value="{{ $officer->employee_id  }}">{{ $officer->name }}({{ $officer->employee_id }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 text-center filter">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>

                                <h3 class="py-3 text-center">Date Range: {{request()->input("range")}}</h3>
                                <h3 class="py-3 text-center">Employee ID: {{request()->input('employeeName') }}</h3>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table datanew">
                        <thead>
                            <tr>
                                <th class="text-dark" style="font-weight: 600; font-size:15px;min-width:120px!important">Date</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px;">Employee</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px;">Location</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px;">Cost</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px;">School/College</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px;">Coaching/Batch</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px;">Library</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px;">Teacher</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px;">student</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px;">Books</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px;">Quiz</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px;">Comments</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px;">Created On</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px;min-width:120px!important">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $totalCost = 0; // Initialize total cost variable to 0
                            $totalinstitute = 0;
                            $totalinstitutes = 0;
                            $totallibrary = 0;
                            $totalteacher = 0;
                            $totalstudent = 0;
                            $totalbooks = 0;
                            $totalquiz = 0;


                            @endphp

                            @foreach ($records as $record)
                                <tr>
                                    <td>{{ date('d-m-y', strtotime($record->collection_date)) }}</td>
                                    <td>{{ $record->employee->name }} ({{$record->employee_id}})</td>
                                    <td>{{ $record->location }}</td>
                                    <td>{{ $record->cost }}৳</td>
                                    <td>{{ $record->institute}}</td>
                                    <td>{{ $record->others_institute }}</td>
                                    <td>{{ $record->library }}</td>
                                    <td>{{ $record->teacher }}</td>
                                    <td>{{ $record->student }}</td>
                                    <td>{{ $record->books_count }}</td>
                                    <td>{{ $record->quiz }}</td>
                                    <td>{{ $record->comments }}</td>
                                    <td>{{ date('d/m/Y', strtotime($record->created_at)) }}</td>
                                    <td>
                                        <a class="me-3" href="{{route("records.edit",encrypt($record->id))}}">
                                            <img src="{{ asset('resources/assets/img/icons/edit.svg') }}" alt="img">
                                        </a>
                                        <a class="me-3 delete-btn" href="{{route("records.delete",encrypt($record->id))}}">
                                            <img src="{{ asset('resources/assets/img/icons/delete.svg') }}" alt="img">
                                        </a>
                                    </td>
                                </tr>
                                @php
                                    $totalCost += $record->cost;
                                    $totalinstitute += $record->institute;
                                    $totalinstitutes += $record->others_institute;
                                    $totallibrary += $record->library;
                                    $totalteacher += $record->teacher;
                                    $totalstudent += $record->student;
                                    $totalbooks += $record->books_count;
                                    $totalquiz += $record->quiz;

                                @endphp
                            @endforeach
                        </tbody>
                        <tfoot style="border:none !important;">

                            <tr>

                                <td class="text-dark" colspan='3' style="font-weight: 600; text-align:center; font-size:15px; width: 120px;">Total</td>

                                <td class="text-dark"   style="font-weight: 600; text-align:left; font-size:15px; width: 120px; ">{{ $totalCost }}৳</td>

                                <td class="text-dark" style="font-weight: 600; text-align:center; font-size:15px; width: 120px">{{ $totalinstitute }}</td>
                                <td class="text-dark" style="font-weight: 600; text-align:center; font-size:15px; width: 120px;">{{ $totalinstitutes }}</td>
                                <td class="text-dark" style="font-weight: 600; text-align:center; font-size:15px; width: 120px;">{{ $totallibrary }}</td>
                                <td class="text-dark" style="font-weight: 600; text-align:center; font-size:15px; width: 120px;">{{ $totalteacher }}</td>
                                <td class="text-dark" style="font-weight: 600; text-align:center; font-size:15px; width: 120px;">{{ $totalstudent }}</td>

                                <td class="text-dark" style="font-weight: 600; text-align:center; font-size:15px; width: 120px;">{{ $totalbooks }}</td>
                                <td class="text-dark" style="font-weight: 600; text-align:center; font-size:15px; width: 120px;">{{ $totalquiz }}</td>
                                <td class="text-dark" colspan='3'  style="font-weight: 600; text-align:left; font-size:15px; width: 120px;"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>

    </div>
@endsection
@section('title')
<title>Record Report</title>
@endsection
@section('script')

<script>
    var AJAX_URL='{{route("records.ajax")}}';
</script>

<script>
    $(document).ready(function () {
        $('#record_form').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission behavior
            var form_data = new FormData(this);

            $.ajax({
                type: 'POST',
                url: "{{ route('records.new.ajax') }}",
                data: form_data,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Handle the response from the server
                    if (response.message) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message
                        });
                    }
                    $('#newModal').modal('hide');
                    $('.datanewAjax').DataTable().ajax.reload();
                },
                error: function(xhr, status, error) {
                    // Handle the error response from the server
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = '';
                    $.each(errors, function (field, error) {
                        errorMessage += error[0] + '\n';
                    });
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage,
                    });
                }
            });
        });
    });
</script>
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
<script>
    $(document).ready(function() {

            $(".select22").select2(
                {
                    dropdownParent: $('#newModal') //modal id here
                }
            );

        });
</script>
@endsection


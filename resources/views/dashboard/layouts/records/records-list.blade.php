@extends('dashboard.master')

@section('content')

    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Records List</h4>
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


                                                        <select  name="employee_id" class="form-control select21">
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

                                <h3 class="py-3 text-center">Date Range: </h3>

                                {{-- <div class="form-group row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div> --}}

                            </form>
                        </div>
                    </div>
                </div>


                <div class="table-responsive">
                    <table class="table datanewAjax" style="table-layout: auto">
                        <thead>
                            <tr>
                                <th class="text-dark" style="font-weight: 600; font-size:15px; ">Date &nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px; ">Employee</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px; ">Location</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px; ">Cost</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px; ">School/College</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px; ">Coaching/Batch</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px; ">Library</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px; ">Teacher</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px; ">student</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px; ">Books</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px; ">Quiz</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px; ">Comments</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px; ">Created On</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px; ">Action &nbsp;&nbsp;&nbsp;&nbsp;</th>
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
<title>Records List</title>
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
                  
                    // Save the value of #daterangeSingle
                      var daterangeSingleValue = $('#daterangeSingle').val();

                      // Reset the form
                      $('#record_form')[0].reset();

                      // Set the value of #daterangeSingle back
                      $('#daterangeSingle').val(daterangeSingleValue);
                      $('.select21').val('').trigger('change');
                  
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

            $(".select21").select2(
                {
                    dropdownParent: $('#newModal') //modal id here
                }
            );
        });
</script>

@endsection



@extends('dashboard.master')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Expenses List</h4>
                <h6>Manage your Expenses</h6>
            </div>
            {{-- <div class="page-btn">
                <a href="{{route("expenses.new")}}" class="btn btn-added"><img src="{{ asset('resources/assets/img/icons/plus.svg') }}"
                        alt="img">Add New</a>
            </div> --}}
            <div class="page-btn">
                <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#newModal2">
                    <img src="{{ asset('resources/assets/img/icons/plus.svg') }}" alt="img">Add New
                </a>
            </div>


            <!-- Modal -->

            <div class="modal fade" id="newModal2" tabindex="-1" aria-labelledby="newModal" aria-hidden="true">
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
                                    <form action="{{ route('expenses.new.ajax') }}" id="exp_form" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="fw-bold" for="dateInput">Select a date</label>
                                                        <input type="text" placeholder="Choose Date" class="form-control"
                                                            name="expenses_date" value="{{ old('expenses_date') }}"
                                                            id="daterangeSingle">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>Employee Name Or ID</label>

                                                        <select name="employee_id" class="form-control select23">
                                                            <option disabled selected value="">Select </option>
                                                            @foreach ($officers as $officer)
                                                                <option value="{{ $officer->employee_id }}">
                                                                    {{ $officer->name }} ({{ $officer->employee_id }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>


                                                <div class="col-lg-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>TA</label>
                                                        <input type="number" class="form-control" name="TA">

                                                    </div>
                                                </div>


                                                <div class="col-lg-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>Comment TA</label>
                                                        <textarea name="commentTA" class="form-control" id="" cols="30" rows="2" style="height: 40px;"></textarea>
                                                    </div>
                                                </div>


                                                <div class="col-lg-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>DA</label>
                                                        <input type="number" class="form-control" name="DA">

                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>Comment DA</label>
                                                        <textarea name="commentDA" class="form-control" id="" cols="30" rows="2" style="height: 40px;"></textarea>
                                                    </div>
                                                </div>


                                                <div class="col-lg-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>Convenience</label>
                                                        <input type="number" class="form-control" name="Convenience">

                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>Comment Convenience</label>
                                                        <textarea name="commentConvenience" class="form-control" id="" cols="30" rows="2"
                                                            style="height: 40px;"></textarea>
                                                    </div>
                                                </div>



                                                <div class="col-lg-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>Rent</label>
                                                        <input type="number" class="form-control" name="Rent">

                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>Comment Rent</label>
                                                        <textarea name="commentRent" class="form-control" id="" cols="30" rows="2" style="height: 40px;"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>Others</label>
                                                        <input type="number" class="form-control" name="Others">

                                                    </div>
                                                </div>



                                                <div class="col-lg-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>Comment Other</label>
                                                        <textarea name="commentOthers" type="description" class="form-control" id="" cols="30" rows="2"
                                                            style="height: 40px;"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <button class="btn btn-submit me-2" type="submit"> <i
                                                            class="fa fa-edit"></i> Submit</button>
                                                    <a href="{{ route('expenses.list') }}" class="btn btn-cancel"> <i
                                                            class="fa fa-arrow-left"></i> Cancel</a>
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
                                <span><img src="{{ asset('resources/assets/img/icons/closes.svg') }}"
                                        alt="img"></span>
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
                            <form method="GET" action="{{ route('expenses.list.by.date') }}">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <div class="form-group required">
                                            <label class="fw-bold" for="dateInput">Select a daterange</label>
                                            <input type="text" class="form-control" name="range" id="daterange">
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <label for="employee_name">Employee Name Or ID :</label>
                                        <select id="employee_name" name="employeeName" class="form-control select2">
                                            
                                            @foreach ($officers as $officer)
                                                <option value="{{ $officer->employee_id }}">
                                                    {{ $officer->name }}({{ $officer->employee_id }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 text-center filter">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                                <h3 class="py-3 text-center">Date Range: </h3>

                            </form>

                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table  datanewAjax">
                        <thead>
                            <tr>


                                <th class="text-dark" style="font-weight: 600; font-size:15px; width: 130px;">Date</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px; width: 160px;">Employee ID
                                </th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px; width: 100px;">Type</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px; width: 100px;">Total Cost
                                </th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px; width: 300px;">Comments
                                </th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px; width: 150px;">Created On
                                </th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px; width: 100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            {{-- @foreach ($expenses as $expense)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $expense->expenses_date }}</td>
                                    <td>{{ $expense->employee->name }} ({{$expense->employee_id}})</td>
                                    <td>{{ $expense->type}}</td>
                                    <td>{{ $expense->total_cost}}৳</td>
                                    <td>{{ $expense->comments }}</td>


                                    <td>{{ date('d/m/Y', strtotime($expense->created_at)) }}</td>

                                    <td>
                                        <a class="me-3" href="{{route("expenses.edit",encrypt($expense->id))}}">
                                            <img src="{{ asset('resources/assets/img/icons/edit.svg') }}" alt="img">
                                        </a>
                                        <a class="me-3 delete-btn" href="{{route("expenses.delete",encrypt($expense->id))}}">
                                            <img src="{{ asset('resources/assets/img/icons/delete.svg') }}" alt="img">
                                        </a>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('title')
    <title>Expenses List</title>
@endsection


@section('script')

    <script>
        var AJAX_URL = '{{ route('expenses.ajax') }}';

    </script>
<script>
    $(document).ready(function () {
        $('#exp_form').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission behavior
            var form_data = new FormData(this);

            $.ajax({
                type: 'POST',
                url: "{{ route('expenses.new.ajax') }}",
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
                      
                       // Save the value of #daterangeSingle
                      var daterangeSingleValue = $('#daterangeSingle').val();

                      // Reset the form
                      $('#exp_form')[0].reset();

                      // Set the value of #daterangeSingle back
                      $('#daterangeSingle').val(daterangeSingleValue);
                      $('.select23').val('').trigger('change');
                      
                    }
                    $('#newModal2').modal('hide');
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

            $(".select23").select2(
                {
                    dropdownParent: $('#newModal2') //modal id here
                }
            );

        });

</script>

@endsection

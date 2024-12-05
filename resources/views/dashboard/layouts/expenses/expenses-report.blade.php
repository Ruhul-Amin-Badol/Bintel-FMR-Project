@extends('dashboard.master')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Expenses Report</h4>
                <h6>filtered Expenses</h6>
            </div>
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

                                                        <select name="employee_id" class="form-control select22">
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
                                                        <textarea name="commentOther" type="description" class="form-control" id="" cols="30" rows="2"
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
                                        <label class="fw-bold" for="dateInput">Select a daterange</label>
                                        <input type="text" class="form-control" name="range" id="daterange">

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

                                <h3 class="py-3 text-center">Date Range: {{request()->input("range")}}</h3>
                                <h3 class="py-3 text-center">Employee ID: {{request()->input('employeeName') }}</h3>


                            </form>

                        </div>
                    </div>
                </div>
              
             

                <div class="table-responsive">
                    <table class="table ">

                        <thead>
                            <tr class="d-none" style="text-align: center">
                                <td colspan="10"> <h1 class=" text-center text-danger">The Royal Scientific Publications</h1></td>
                            </tr>
                            <tr class="d-none" style="text-align: center">
                                <td colspan="10">  <h2 class=" text-center">Employee Monthly Reports</h2></td>
                            </tr>

                            <tr>

                                <th class="text-dark text-center" style="font-weight: 600; font-size:15px; width: 130px;">SL</th>
                                <th class="text-dark text-center" style="font-weight: 600; font-size:15px; width: 130px;">Date</th>
                                <th class="text-dark text-center" style="font-weight: 600; font-size:15px; width: 160px;">Employee name</th>
                                <th class="text-dark text-center" style="font-weight: 600; font-size:15px; width: 200px;">Working Area</th>
                                <th class="text-dark text-center" style="font-weight: 600; font-size:15px; width: 100px;">T.A</th>
                                <th class="text-dark text-center" style="font-weight: 600; font-size:15px; width: 100px;">D.A</th>
                                <th class="text-dark text-center" style="font-weight: 600; font-size:15px; width: 150px;">H.R</th>
                                <th class="text-dark text-center" style="font-weight: 600; font-size:15px; width: 100px;">M.A</th>
                                <th class="text-dark text-center" style="font-weight: 600; font-size:15px; width: 100px;">O.Exp</th>
                                <th class="text-dark text-center" style="font-weight: 600; font-size:15px; width: 100px;">Total</th>
                                <th class="text-dark text-center" style="font-weight: 600; font-size:15px; width: 100px;">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                          
                          @php
                           $c=0;
                            $ta=$da=$hr=$ma=$oa=0;
                          @endphp
                            @foreach ($data as $key => $officer)
                             @if($officer['total_cost']>0)
                             <tr>
                                <td>{{ ++$c}}</td>
                                <td>{{ $key}}</td>
                                <td>{{ $employee->name }} ({{ $employee->employee_id }})</td>
                                <td>{{ $employee->area }}</td>
                                <td>{{ $officer['ta'] }}</td>
                                <td>{{ $officer['da'] }}</td>
                                <td>{{ $officer['rent'] }}</td>
                                <td>{{ $officer['con'] }}</td>
                                <td>{{ $officer['ot'] }}</td>
                                <td>{{ $officer['total_cost'] }}</td>
                                <td> <a class="me-3" href="{{route("expenses.report.edit",$employee->employee_id)}}?date={{$key}}">
                                        <img src="{{ asset('resources/assets/img/icons/edit.svg') }}" alt="img">
                                    </a>
                                    <a class="me-3 delete-btn"href="{{route("expenses.report.delete",$employee->employee_id)}}?date={{$key}}">
                                        <img src="{{ asset('resources/assets/img/icons/delete.svg') }}" alt="Delete">
                                    </a></td>
                             </tr>
                             @php 
                               $ta += $officer['ta'];
                               $da += $officer['da'];
                               $hr += $officer['rent'];
                               $ma += $officer['con'];
                               $oa += $officer['ot']
                          
                             @endphp
                            @endif
                          @endforeach

                        </tbody>
                        <tfoot style="border:none !important;">

                            <tr>

                                <td class="text-dark" style="font-weight: 600; text-align:center; font-size:15px; width: 120px;"></td>

                                <td class="text-dark" style="font-weight: 600; text-align:left; font-size:15px; width: 120px; "></td>
								<td class="text-dark" style="font-weight: 600; text-align:center; font-size:15px; width: 120px"></td>
                                <td class="text-dark" style="font-weight: 600; text-align:center; font-size:15px; width: 120px"></td>
                                <td class="text-dark" style="font-weight: 600; text-align:center; font-size:15px; width: 120px;">T.A: {{taka($ta)}}</td>
                                <td class="text-dark" style="font-weight: 600; text-align:center; font-size:15px; width: 120px;">D.A: {{taka($da)}}</td>
                                <td class="text-dark" style="font-weight: 600; text-align:center; font-size:15px; width: 120px;">H.R: {{taka($hr)}}</td>
                                <td class="text-dark" style="font-weight: 600; text-align:center; font-size:15px; width: 120px;">M.A: {{taka($ma)}}</td>

                                <td class="text-dark" style="font-weight: 600; text-align:center; font-size:15px; width: 120px;">O.Exp:{{taka($oa)}}</td>
                                <td class="text-dark" colspan="2" style="font-weight: 600; text-align:center; font-size:15px; width: 120px;">Total:{{ taka($grandTotal) }}</td>
                               
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('title')
    <title>Expenses Report</title>
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

            $(".select22").select2(
                {
                    dropdownParent: $('#newModal2') //modal id here
                }
            );

        });
</script>
@endsection

@extends('dashboard.master')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Edit Expenses</h4>
                <h6>Customize Your Expenses</h6>
            </div>
        </div>

        <div class="card">
            <form action="{{ route('expenses_profile.update.profile.action', encrypt($expense->id)) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="fw-bold" for="dateInput">Select a date</label>
                                <input type="text" placeholder="Choose Date" class="form-control"
                                    name="expenses_date" value="{{ $formattedExpensesDate ?? $expense->expenses_date }}"
                                    id="daterangeSingle">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Employee Name</label>

                                {{-- <select name="employee_id" class="form-control select23">
                                <option disabled selected value="">Select </option>
                                @foreach ($officers as $officer)
                                    <option value="{{ $officer->employee_id }}">
                                        {{ $officer->name }} ({{ $officer->employee_id }})
                                    </option>
                                @endforeach
                            </select> --}}



                                <select name="employee_id" class="form-control select2">
                                    @foreach ($emp as $officer)
                                        <option value="{{ $officer->employee_id }}"
                                            @if ($officer->employee_id == $expense->employee_id) selected @endif>{{ $officer->name }} ({{ $officer->employee_id }})</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">


                                <label for="type">Expenses Type</label>
                                <select name="type" class="form-control" id="type" value="{{ $expense->type }}">
                                    <option value="TA">Travel Allowance</option>
                                    <option value="DA">Daily Allowance</option>
                                    <option value="Convenience">Mobile Allowance</option>
                                    <option value="Rent">Rent</option>
                                    <option value="Others">Others Expenses</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Total Cost</label>
                                <input type="number" class="form-control" name="total_cost"
                                    value="{{ $expense->total_cost }}">
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Leave A Comments</label>
                                <textarea name="comments" type="description" class="form-control" id="" cols="30" rows="10"
                                    >{{ $expense->comments }}</textarea>

                            </div>
                        </div>



                        <div class="col-lg-12">
                            <button class="btn btn-submit me-2" type="submit"> <i class="fa fa-edit"></i> Submit</button>
                            <a href="{{ route('expenses.list') }}" class="btn btn-cancel"> <i class="fa fa-arrow-left"></i>
                                Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
@section('title')
<title>Edit Expenses</title>
@endsection

@section('script')
<script>
    $(function() {
        $('#daterangeSingle').daterangepicker({
            singleDatePicker: true, // Set to true for single date picker
            opens: 'right',
            showDropdowns: true,
            showWeekNumbers: true,
            alwaysShowCalendars: true,
            startDate: '{{ $formattedExpensesDate ?? $expense->expenses_date }}',
            locale: {
                format: 'YYYY-MM-DD' // Set the desired date format
            }
        }, function(start, end, label) {
            console.log("A new date was selected: " + start.format('YYYY-MM-DD'));
        });
    });
</script>
@endsection

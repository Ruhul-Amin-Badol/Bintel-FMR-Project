@extends('dashboard.master')

@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Records Management</h4>
            <h6>Update Records</h6>
        </div>
    </div>

    <div class="card">
        <form action="{{route('records_profile.update.profile.action',encrypt($record->id))}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">

                    <div class="col-lg-2 col-sm-6 col-12">
                        <div class="form-group">
                            <div class="form-group">
                                <label class="fw-bold" for="dateInput">Select a date</label>
                                <input type="text" placeholder="Choose Date" class="form-control"
                                    name="collection_date" value="{{ $formattedRecordsDate ?? $record->collection_date }}"
                                    id="daterangeSingle">
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-5 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Employee Name</label>

                            <select  name="employee_id" class="form-control select2x">
                                @foreach($emp as $officer)
                                    <option value="{{ $officer->employee_id }}" @if($officer->employee_id==$record->employee_id) selected @endif>{{ $officer->name }} ({{ $officer->employee_id }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-5 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" class="form-control" name="location" value="{{$record->location}}">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Total Cost</label>
                            <input type="number" class="form-control" name="cost" value="{{$record->cost}}">

                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Number Of School/College</label>
                            <input type="number" class="form-control" name="institute" value="{{$record->institute}}">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Number Of Coaching Batch</label>
                            <input type="number" class="form-control" name="others_institute" value="{{$record->others_institute}}">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Library</label>
                            <input type="number" class="form-control" name="library" value="{{$record->library}}">

                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Number Of Visit Teacher</label>
                            <input type="number" class="form-control" name="teacher" value="{{$record->teacher}}">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Number Of Student</label>
                            <input type="number" class="form-control" name="student" value="{{$record->student}}">
                        </div>
                    </div>


                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Number Of Books</label>
                            <input type="number" class="form-control" name="books_count" value="{{$record->books_count}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Quiz</label>
                            <input type="number" class="form-control" name="quiz" value="{{$record->quiz}}">

                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Leave A Comments</label>
                            <textarea name="comments" type="description" class="form-control" id="" cols="30" rows="10">{{$record->comments}}</textarea>

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
@endsection

@section("title")
<title>Edit Record</title>
@endsection

@section("script")
<script>
  $(document).ready(function() {
    $('.select2x').select2();
});
</script>
<script>
    $(function() {
        $('#daterangeSingle').daterangepicker({
            singleDatePicker: true, // Set to true for single date picker
            opens: 'right',
            showDropdowns: true,
            showWeekNumbers: true,
            alwaysShowCalendars: true,
            startDate: '{{ $formattedRecordsDate ?? $record->collection_date }}',
            locale: {
                format: 'YYYY-MM-DD' // Set the desired date format
            }
        }, function(start, end, label) {
            console.log("A new date was selected: " + start.format('YYYY-MM-DD'));
        });
    });
</script>

@endsection

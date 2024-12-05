@extends('dashboard.master')

@section('content')
    <div class=" cardhead">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Edit Your Library Visiting Report</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Edit Your Library Visiting Report</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title text-center">Edit Visiting Report</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('library.visit.edit.action', encrypt($report->id)) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Library Type <span
                                                    class="text-danger">*</span></label>
                                            <div class="">
                                                <select id="library-type" class="form-select" name="library_type">

                                                    <option value="Agent" {{$report->library_type == 'Agent'??'selected'}}>Agent</option>
                                                    <option value="Wholesaler" {{$report->library_type == 'Wholesaler'??'selected'}}>Wholesaler</option>
                                                    <option value="Retailer" {{$report->library_type == 'Retailer'??'selected'}}>Retailer</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Employee Name Or ID</label>
                                            <select name="employee_id" class="form-select select2">
                                                <option disabled value="">Select</option>
                                                @foreach($officers as $officer)
                                                    <option value="{{ $officer->employee_id }}" {{ $officer->employee_id == $report->employee_id ? 'selected' : '' }}>
                                                        {{ $officer->name }} ({{ $officer->employee_id }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Library Name</label>
                                            <input type="text" class="form-control" name="library_name"
                                                value="{{$report->library_name}}" placeholder="Enter Library Name">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Library Owner Name</label>

                                            <input type="text" class="form-control" name="owner_name"
                                                value="{{$report->owner_name}}" placeholder="Enter Owner Name">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Library Contact Number
                                            </label>

                                            <input type="text" class="form-control" name="contact_number"
                                                value=" {{$report->contact_number}}"
                                                placeholder="Enter Library Contact Number">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="dateInput">Select a date</label>

                                            <input type="text" placeholder="Choose Date" class="form-control"
                                                name="date" value="{{$report->date}}"  id="daterangeSingle">

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Detail Address</label>
                                    <div class="col-md-10">
                                        <div class="form-group row">

                                            <div class="col-md-4">
                                                <label class="col-form-label col-md-3">Division</label>
                                                <div class="">
                                                    <select class="form-select select2" id="division_id" name="division_id" >
                                                        <option value="" disabled>-- Select --</option>
                                                        @foreach ($divisions as $division)
                                                            <option value="{{ $division->division_id }}" {{ $division->division_id == $report->division_id? 'selected':'' }}>
                                                                {{ $division->division_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="col-form-label col-md-3">District</label>
                                                <div class="">
                                                    <select class="form-select select2" id="district_id" name="district_id" >
                                                        <option value="{{$report->district_id}}">{{ $report->district->district_name }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="col-form-label col-md-3">Upazila</label>
                                                <div class="">
                                                    <select class="form-select select2" id="upazila_id"
                                                        name="upazila_id">
                                                        <option value="{{$report->upazila_id}}">{{ $report->upazila->upazila_name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2 pt-0">Area</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="area"
                                        value="{{$report->area}}" placeholder="Enter Area">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-2 pt-0">Available Books(TRSP)</label>
                                    <div class="col-md-10">
                                        <select class="form-select select2" name="available_books[]" multiple>
                                            @php
                                                $availableBooks = explode(',', $report->available_books);
                                            @endphp
                                            @foreach (['V-VIII', 'SSC', 'HSC', 'Admission', 'BCS & Job', 'Stationary', 'Higher Education'] as $option)
                                                <option value="{{ $option }}" {{ in_array($option, $availableBooks) ? 'selected' : '' }}>
                                                    {{ $option }}
                                                </option>
                                            @endforeach
                                        </select>


                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-form-label col-md-2 pt-0">Books Collected From</label>
                                    <div class="col-md-10">
                                        <select class="form-control select2" name="books_collected_from[]" multiple>
                                            @php
                                                $booksCollectedFrom = explode(',', $report->books_collected_from);
                                            @endphp
                                            @foreach (['Sales Center', 'Agent', 'Others'] as $option)
                                                <option value="{{ $option }}" {{ in_array($option, $booksCollectedFrom) ? 'selected' : '' }}>
                                                    {{ $option }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Sales Executive Comments</label>
                                    <div class="col-md-10">
                                        <textarea rows="5" cols="5" class="form-control" name="sales_executive_comments"
                                            placeholder="Write comments Here">{{$report->sales_executive_comments}}</textarea>
                                    </div>
                                </div>



                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Feedback</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="col-form-label">➤ What category of TRSP books are not in the
                                                collection? Why?</label>
                                            <textarea rows="5" cols="5" class="form-control" name="what_category_comments"
                                                placeholder="Write comments Here">{{$report->what_category_comments}}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-form-label">➤ Agent Library Coverage?</label>
                                            <textarea rows="5" cols="5" class="form-control" name="agent_library_comments"
                                                placeholder="Write comments Here">{{$report->agent_library_comments}}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-form-label">➤ Have you faced any problem while collecting
                                                books from sales center?</label>
                                            <textarea rows="5" cols="5" class="form-control" name="any_problem_comments"
                                                placeholder="Write comments Here">{{$report->any_problem_comments}}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-form-label">➤ Are you getting new books on time when they are
                                                published?</label>
                                            <textarea rows="5" cols="5" class="form-control" name="new_books_on_time_comments"
                                                placeholder="Write comments Here">{{$report->new_books_on_time_comments}}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-form-label">➤ How often do MR contact you? Do they work
                                                according to your suggestion?</label>
                                            <textarea rows="5" cols="5" class="form-control" name="mr_contact_comments" placeholder="Write comments Here">{{$report->mr_contact_comments}}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-form-label">➤ How can we improve our service for you?</label>
                                            <textarea rows="5" cols="5" class="form-control" name="improve_our_service_comments"
                                                placeholder="Write comments Here">{{$report->improve_our_service_comments}}</textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-12">
                                    <button class="btn btn-submit me-2" type="submit"> <i class="fa fa-edit"></i>
                                        Submit</button>
                                    <a href="{{route('library.list')}}" class="btn btn-cancel"> <i class="fa fa-arrow-left"></i> Cancel</a>
                                </div>
                            </form>
                        </div>
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
    </style>
@endsection
@section('title')
    <title>Update Library Visit</title>
@endsection

@section('script')
<script>
    $(function() {
        var dateValue = "{{ date('Y-m-d', strtotime($report->date)) }}";

        $('#daterangeSingle').daterangepicker({
            singleDatePicker: true,
            opens: 'right',
            showDropdowns: true,
            showWeekNumbers: true,
            alwaysShowCalendars: true,
            locale: {
             format: 'Y-M-D'
         }
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
                    url: "{{ route('get.districts') }}",
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
@endsection

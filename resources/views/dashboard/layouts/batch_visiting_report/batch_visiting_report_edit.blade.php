@extends('dashboard.master')

@section('content')
<div class="cardhead">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Edit Batch Visiting Report</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Edit Batch Visiting Report</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <h5 class="card-title text-center">Edit Visiting Report</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('batch.visiting.update', encrypt($batch->id)) }}">
                            @csrf

                            <div class="row">
                                <!-- Batch Name -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="batch_name">Batch Name</label>
                                        <input type="text" name="batch_name" class="form-control" value="{{ $batch->batch_name }}" required>
                                    </div>
                                </div>

                                <!-- Owner Name -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="owner_name">Owner Name</label>
                                        <input type="text" name="owner_name" class="form-control" value="{{ $batch->owner_name }}" required>
                                    </div>
                                </div>

                                <!-- date  Number -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="contact_number">Date</label>
                                        <input type="date" name="date" class="form-control" value="{{ $batch->date }}" required>
                                    </div>
                                </div>
                                <!-- Contact Number -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contact_number">Contact Number</label>
                                        <input type="text" name="contact_number" class="form-control" value="{{ $batch->contact_number }}" required>
                                    </div>
                                </div>

                                <!-- Detail Address -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="detail_address">Detail Address</label>
                                        <textarea name="detail_address" class="form-control" required>{{ $batch->detail_address }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Division, District, Upazila -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="division">Division</label>
                                        <select name="division" id="division" class="form-control select213" required>
                                            <option value="">Select Division</option>
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->division_id }}"
                                                    {{ $batch->division == $division->division_id ? 'selected' : '' }}>
                                                    {{ $division->division_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="zilla">District</label>
                                        <select name="zilla" id="zilla" class="form-control select213" required>
                                            <option value="">Select District</option>
                                            @foreach ($districts as $district)
                                                <option value="{{ $district->district_id }}"
                                                    {{ $batch->zilla == $district->district_id ? 'selected' : '' }}>
                                                    {{ $district->district_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="upazilla">Upazila</label>
                                        <select name="upazilla" id="upazilla" class="form-control select213" required>
                                            <option value="">Select Upazila</option>
                                            @foreach ($upazilas as $upazila)
                                                <option value="{{ $upazila->upazila_id }}"
                                                    {{ $batch->upazilla == $upazila->upazila_id ? 'selected' : '' }}>
                                                    {{ $upazila->upazila_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                             <!-- Union ,area Name -->
                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="union_name">Union Name</label>
                                        <input type="text" name="union_name" class="form-control"
                                            value="{{ $batch->union_name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="union_name">Area Name</label>
                                        <input type="text" name="area_name" class="form-control"
                                            value="{{ $batch->area_name }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Categories -->
                            <div class="form-group">
                                <label for="categories">Categories</label>
                                @php
                                    $categories = ['Collaborator', 'Dedicated', 'Non-Cooperative', 'Normal','N/A'];
                                @endphp
                                @foreach ($categories as $category)
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input" name="categories[]" 
                                            id="category-{{ $category }}" value="{{ $category }}" 
                                            {{ in_array($category, $batch->categories->pluck('category')->toArray()) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="category-{{ $category }}">{{ $category }}</label>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Courses -->
                            <div class="form-group">
                                <label for="courses">Courses</label>
                                @php
                                    $courses = ['VII', 'SSC', 'HSC','Admission','Job','N/A'];
                                @endphp
                                @foreach ($courses as $course)
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input" name="courses[]" 
                                            id="course-{{ $course }}" value="{{ $course }}" 
                                            {{ in_array($course, $batch->courses->pluck('course')->toArray()) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="course-{{ $course }}">{{ $course }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <!-- Teacher,student  -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="union_name">Teachers Quantity</label>
                                        <input type="text" name="teachers_quantity" class="form-control"
                                            value="{{ $batch->teachers_quantity }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="union_name">Student Quantity</label>
                                        <input type="text" name="student_quantity" class="form-control"
                                            value="{{ $batch->student_quantity }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Comments -->
                            <div class="form-group">
                                <label for="comments">Teacher's Comments</label>
                                <textarea name="teachers_comment" class="form-control">{{ $batch->teachers_comment }}</textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="comments">Senior Sales Executive
                                    Comments</label>
                                <textarea name="senior_sales_executive_comments" class="form-control">{{ $batch->senior_sales_executive_comments }}</textarea>
                            </div>

                            <div class="text-end">
                                <button type="button" class="btn btn-secondary" onclick="window.history.back();"><i class="fa-solid fa-arrow-left-long"></i> Cancel</button>
                                <button type="submit" class="btn btn-primary">Update Batch</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    /* Increase checkbox size */
    .form-check-input {
        width: 20px; 
        height: 20px; 
    }

    /* Optionally adjust label spacing for alignment */
    .form-check-label {
        margin-top: 5px;
        margin-left: 8px; 
        font-size: 16px; /
    }
</style>
@section('script')
<script>
    $('#division').change(function() {
        var divisionId = $(this).val();
        $('#zilla').html('<option value="">Select District</option>');
        $('#upazilla').html('<option value="">Select Upazila</option>');
        console.log(divisionId);
        if (divisionId) {
            $.ajax({
                url: '{{ url('dashboard/get-districts') }}/' + divisionId,
                type: 'GET',
                success: function(data) {
                    $.each(data, function(index, district) {
                        $('#zilla').append(
                            `<option value="${district.district_id}">${district.district_name}</option>`
                        );
                    });
                }
            });
        }
    });

    $('#zilla').change(function() {
        var districtId = $(this).val();
        $('#upazilla').html('<option value="">Select Upazila</option>');

        if (districtId) {
            $.ajax({
                url: '{{ url('dashboard/get-upazilas') }}/' + districtId,
                type: 'GET',
                success: function(data) {
                    $.each(data, function(index, upazila) {
                        $('#upazilla').append(
                            `<option value="${upazila.upazila_id}">${upazila.upazila_name}</option>`
                        );
                    });
                }
            });
        }
    });

    $(document).ready(function() {

        $(".select213").select2();
    });
</script>
@endsection
@endsection

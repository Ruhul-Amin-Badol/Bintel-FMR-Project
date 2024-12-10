@extends('dashboard.master')

@section('content')
    <div class="cardhead">
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
                    <div class="card shadow-lg">
                        <div class="card-header">
                            <h5 class="card-title text-center">Edit Visiting Report</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('library.visiting-list.update',encrypt($library->id)) }}">
                                @csrf
                                @method('POST')

                                <div class="row">
                                    <!-- Library Name -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="library_Name">Library Name</label>
                                            <input type="text" name="library_Name" class="form-control"
                                                value="{{ $library->library_Name }}" required>
                                        </div>
                                    </div>

                                    <!-- Owner Name -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="owner_name">Owner Name</label>
                                            <input type="text" name="owner_name" class="form-control"
                                                value="{{ $library->owner_name }}" required>
                                        </div>
                                    </div>
                                      <!-- date  Number -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="date">date</label>
                                        <input type="date" name="date" class="form-control" value="{{ $library->date }}" required>
                                    </div>
                                </div>

                                    <!-- Contact Number -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="contact_number">Contact Number</label>
                                            <input type="text" name="contact_number" class="form-control"
                                                value="{{ $library->contact_number }}" required>
                                        </div>
                                    </div>

                                    <!-- Detail Address -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="detail_address">Detail Address</label>
                                            <textarea name="detail_address" class="form-control" required>{{ $library->detail_address }}</textarea>
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
                                                        {{ $library->division == $division->division_id ? 'selected' : '' }}>
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
                                                        {{ $library->zilla == $district->district_id ? 'selected' : '' }}>
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
                                                        {{ $library->upazilla == $upazila->upazila_id ? 'selected' : '' }}>
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
                                                value="{{ $library->union_name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="union_name">Area Name</label>
                                            <input type="text" name="area_name" class="form-control"
                                                value="{{ $library->area_name }}">
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <!-- Categories -->
                                <div class="form-group">
                                    <label for="categories" class="fw-bold">Categories</label><br>
                                    @php
                                        $categories = ['Collaborator', 'Dedicated', 'Non-Cooperative', 'Normal'];
                                    @endphp
                                    @foreach ($categories as $category)
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="categories[]" id="category-{{ $category }}"
                                                value="{{ $category }}" 
                                                {{ in_array($category, $library->categories->pluck('category')->toArray()) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="category-{{ $category }}">{{ $category }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                    <!-- Type -->
                                <div class="form-group">
                                    <label for="types" class="fw-bold">Library Types</label><br>
                                    @php
                                        $types = ['Agent', 'Wholesale', 'Retail', 'Local'];
                                    @endphp
                                    @foreach ($types as $type)
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="types[]" id="type-{{ $type }}" 
                                                value="{{ $type }}" 
                                                {{ in_array($type, $library->types->pluck('library_type')->toArray()) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="type-{{ $type }}">{{ $type }}</label>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Comments -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="librarian_comments">Librarian Comments</label>
                                            <textarea name="librarian_comments" class="form-control">{{ $library->librarian_comments }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="senior_sales_executive_comments">Senior Sales Executive
                                                Comments</label>
                                            <textarea name="senior_sales_executive_comments" class="form-control">{{ $library->senior_sales_executive_comments }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="button" class="btn btn-secondary" onclick="window.history.back();"><i class="fa-solid fa-arrow-left-long"></i> Cancel</button>
                                    <button type="submit" class="btn btn-primary">Update Library</button>
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
@endsection

@section('title')
    <title>Update Library Visit</title>
@endsection

@section('title')
    <title>Update Library Visit</title>
@endsection
@section('script')
    <script>
        $('#division').change(function() {
            var divisionId = $(this).val();
            console.log('Selected Division ID:', divisionId); // Debugging

            // Reset district and upazila dropdowns
            $('#zilla').html('<option value="">Select District</option>');
            $('#upazilla').html('<option value="">Select Upazila</option>');

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
        // Handle district change
        $('#zilla').change(function() {
            var districtId = $(this).val();
            console.log('Selected districtId ID:', districtId); // Debugging
            // Reset upazila dropdown
            $('#upazilla').html('<option value="">Select Upazila</option>');

            if (districtId) {
                $.ajax({
                    url: '{{ url('dashboard/get-upazilas/') }}/' + districtId,
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

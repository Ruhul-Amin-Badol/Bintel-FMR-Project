@extends('dashboard.master')

@section('content')
    <div class="cardhead">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Edit Institution Visiting Report</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Edit Institution Visiting Report</li>
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
                            <form method="POST"
                                action="{{ route('institution.visiting.update', encrypt($institution->id)) }}">
                                @csrf


                                <!-- Basic Info -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="institution_name">Institution Name</label>
                                            <input type="text" name="institution_name" class="form-control"
                                                value="{{ $institution->institution_name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="teachers_name">Teacher's Name</label>
                                            <input type="text" name="teachers_name" class="form-control"
                                                value="{{ $institution->teachers_name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="teachers_name">Designation</label>
                                            <input type="text" name="designation" class="form-control"
                                                value="{{ $institution->designation}}" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Details -->
                                <div class="row">
                                    <!-- date  Number -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="contact_number">Date</label>
                                            <input type="date" name="date" class="form-control"
                                                value="{{ $institution->date }}" required>
                                        </div>
                                    </div>
                                     <!-- contact  Number -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="contact_number">Contact Number</label>
                                            <input type="text" name="contact_number" class="form-control"
                                                value="{{ $institution->contact_number }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="detail_address">Address</label>
                                            <textarea name="detail_address" class="form-control" rows="2" required>{{ $institution->detail_address }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Dynamic Dropdowns -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="division">Division</label>
                                            <select name="division" id="division" class="form-control" required>
                                                <option value="">Select Division</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->division_id }}"
                                                        {{ $institution->division == $division->division_id ? 'selected' : '' }}>
                                                        {{ $division->division_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="zilla">District</label>
                                            <select name="zilla" id="zilla" class="form-control" required>
                                                <option value="">Select District</option>
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->district_id }}"
                                                        {{ $institution->zilla == $district->district_id ? 'selected' : '' }}>
                                                        {{ $district->district_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="upazilla">Upazila</label>
                                            <select name="upazilla" id="upazilla" class="form-control" required>
                                                <option value="">Select Upazila</option>
                                                @foreach ($upazilas as $upazila)
                                                    <option value="{{ $upazila->upazila_id }}"
                                                        {{ $institution->upazilla == $upazila->upazila_id ? 'selected' : '' }}>
                                                        {{ $upazila->upazila_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- Union ,area Name -->
                                <div class="row">
                                 <div class="col-md-4">
                                     <div class="form-group">
                                         <label for="union_name">Area Name</label>
                                         <input type="text" name="area_name" class="form-control"
                                             value="{{ $institution->area_name }}">
                                     </div>
                                 </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="union_name">Union Name</label>
                                        <input type="text" name="union_name" class="form-control"
                                            value="{{ $institution->union_name }}">
                                    </div>
                                </div>
                            </div>

                                <!-- Class -->
                                <div class="form-group">
                                    <label for="class">Class</label>
                                    @foreach (['K.G' => 'K.G (কে.জি স্কুল)', 'VI-VIII' => 'VI-VIII (নিম্ন মাধ্যমিক)', 'VI-X' => 'VI-X (মাধ্যমিক)', 'VI-XII' => 'VI-XII (স্কুল এন্ড কলেজ)', 'XI-XII' => 'XI-XII (কলেজ)'] as $classValue => $classLabel)
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" name="classes[]" class="form-check-input"
                                                value="{{ $classValue }}"
                                                {{ in_array($classValue, $institution->classes->pluck('class')->toArray()) ? 'checked' : '' }}>
                                            <label class="form-check-label">{{ $classLabel }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- group -->
                                <div class="form-group">
                                    <label for="categories">Group</label>
                                    @foreach (['Science', 'Arts', 'Commerce'] as $group)
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" name="groups[]" class="form-check-input"
                                                value="{{ $group }}"
                                                {{ in_array($group, $institution->groups->pluck('group_name')->toArray()) ? 'checked' : '' }}>
                                            <label class="form-check-label">{{ $group }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Categories -->
                                <div class="form-group">
                                    <label for="categories">Category</label>
                                    @foreach (['Famouse', 'Average', 'Normal'] as $category)
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" name="categories[]" class="form-check-input"
                                                value="{{ $category }}"
                                                {{ in_array($category, $institution->categories->pluck('category')->toArray()) ? 'checked' : '' }}>
                                            <label class="form-check-label">{{ $category }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Teacher,student  -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="union_name">Teachers Quantity</label>
                                            <input type="text" name="teachers_quantity" class="form-control"
                                                value="{{ $institution->teachers_quantity }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="union_name">Student Quantity</label>
                                            <input type="text" name="student_quantity" class="form-control"
                                                value="{{ $institution->student_quantity }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Comments -->
                                <div class="form-group">
                                    <label for="comments">Teacher's Comments</label>
                                    <textarea name="teachers_comment" class="form-control">{{ $institution->teachers_comment }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="comments">Senior Sales Executive
                                        Comments</label>
                                    <textarea name="senior_sales_executive_comments" class="form-control">{{ $institution->senior_sales_executive_comments }}</textarea>
                                </div>

                                <!-- Submit Button -->
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Update Report</button>
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
    </script>
@endsection
@endsection

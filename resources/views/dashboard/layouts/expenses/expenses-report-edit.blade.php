@extends('dashboard.master')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Expenses Report</h4>
                <h6>Update Your Report</h6>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card allform">
                    @foreach ($expense as $expen)
                        <form method="POST" enctype="multipart/form-data" class="expense-form">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="id" value="{{ $expen->id }}">
                                    <h4 class="text-center text-info">{{ $expen->type }}</h4>
                                    <hr>
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="text" class="form-control" value="{{ $expen->expenses_date }}"
                                                name="expenses_date">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>Total</label>
                                            <input type="text" class="form-control" value="{{ $expen->total_cost }}"
                                                name="total_cost">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>Comment</label>
                                            <textarea name="comment" class="form-control" id="" cols="30" rows="" style="height: 60px;">{{ $expen->comments }}</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </form>
                    @endforeach

                    <div class="col-lg-12 text-center py-3">
                        <button class="btn btn-submit me-2 update-expense" type="button">
                            <i class="fa fa-edit"></i> Update
                        </button>

                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
@section('title')
    <title>Edit Officer</title>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $('.update-expense').click(function() {

                // Select all forms using the $("form") selector
                // Select all forms using the $("form") selector
                var allForms = $(".allform form");

                // Loop through the selected forms
                allForms.each(function(index, form) {
                    // Serialize each form and log the result
                    var formData = $(form).serialize();
                    var formDataObject = new FormData(form);



                    $.ajax({
                        type: 'POST',
                        url: '{{ route('expenses.report.update.action') }}',
                        data: formDataObject,
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
                                if (response.redirect) {
                                    window.location.href = response.redirect;
                                }
                            }


                        },
                        error: function(xhr, status, error) {
                            // Handle the error response from the server
                            var errors = xhr.responseJSON.errors;
                            var errorMessage = '';
                            $.each(errors, function(field, error) {
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
                return;



            });
        });
    </script>
@endsection

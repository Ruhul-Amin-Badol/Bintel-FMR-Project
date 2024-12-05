@extends('dashboard.master')
@section('content')


<div class="content ">



    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header border">
                    <h5 class="card-title">Site option <a class="btn btn-primary float-sm-end m-l-10" data-bs-toggle="modal" data-bs-target="#create" > New Option</a></h5>
                </div>
                <div class="card-body">

                    <div class="row">
                        @foreach($option as $key => $value)

                        <div class="col-md-4">
                            <div class="card flex-fill">

                                <div class="card-body">
                                    <form id="option_{{$value->id}}">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label fw-bold">{{$value->name}} <span data-bs-toggle="tooltip" data-bs-placement="top" title="Leave blank to delete"><i class="text-danger fa fa-question-circle "></i></span></label>
                                            <div class="col-lg-9">
                                                <input type="hidden" name="name" value="{{$value->name}}" class="form-control">
                                                <textarea name="value" class="form-control" cols="30" rows="4">{{$value->value}}</textarea>

                                            </div>
                                        </div>

                                    </form>
                                    <div class="text-end">
                                        <a onclick="save_this('#option_{{$value->id}}')" class="btn btn-danger btn-sm">Save</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach



                    </div>

                </div>
            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="create" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Option</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                    <form action="{{route('dash.setting.new')}}" method="post">
                        @csrf
                       
                           
                               
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Value </label>
                                            <textarea name="value" class="form-control" required></textarea>
                                        </div>
                                    </div>

                                
                               
                           
                            <div class="col-lg-12 m-2">
                                <button class="btn btn-submit me-2 btn-sm" type="submit">Save</button>
                                {{-- <a class="btn btn-cancel btn-sm" data-bs-dismiss="modal">Cancel</a> --}}
                            </div>
                       
                    </form>
        

            </div>
        </div>
    </div>
</div>


@endsection

@section('title')
<title>Setting</title>
@endsection

@section('script')

<script>
    function save_this(id) {

        $.ajax({
            url: "{{ route('dash.setting.store') }}"
            , data: $(id).serialize()
            , type: 'POST'
            , dataType: 'json'
            , success: function(result) {

                if (result["status"] == "1") {
                    Swal.fire({
                        position: 'top-end'
                        , icon: 'success'
                        , title: result["message"]
                        , showConfirmButton: false
                        , timer: 1500
                    }).then((result) => {
                        //location.reload();
                    });
                }
                else{
                    Swal.fire({
                        position: 'top-end'
                        , icon: 'success'
                        , title: result["message"]
                        , showConfirmButton: false
                        , timer: 1500
                    }).then((result) => {
                        location.reload();
                    });
                }
            }

        });

    }

</script>


@endsection

@extends('dashboard.master')
@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Update {{$role->name}}</h4>
                
            </div>
        </div>



        <div class="card">
            <div class="card-body">

                <form action="{{ route('roles.update.store',encrypt($role->id)) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Role Name</label>
                                        <input type="text" name="name" value="{{$role->name}}">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="productdetails product-respon">
                                        @php
                                            $myArray=explode(",",$role->permissions);
                                        @endphp
                                        <ul>
                                            @foreach($permission as $key => $value)
                                            <li>
                                                <h4>
                                                    <label class="inputcheck"> {{$value->name}}
                                                        <input type="checkbox" name="permission[]" value="{{$value->id}}" @if(in_array($value->id, $myArray)) checked @endif>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </h4>

                                                <div class="input-checkset">
                                                    <ul>
                                                        @php
                                                        $urls=explode(",",$value->slug);
                                                        foreach ($urls as $key => $slug) {

                                                        echo "<li style='margin: 2px'><label class='bg-success rounded text-white px-1'>$slug</label></li>";
                                                        }
                                                        @endphp
                                                        


                                                    </ul>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 m-2">
                            <button class="btn btn-submit me-2 btn-sm" type="submit">Save</button>
                            <a class="btn btn-cancel btn-sm" data-bs-dismiss="modal">Cancel</a>
                        </div>
                    </div>

                   
                </form>
            </div>
        </div>

    </div>

   
@endsection

@section("title")
<title>Role Management</title>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        try {
            var selectSimple = $('.select2Ajax');

            selectSimple.select2({

                minimumInputLength: 3
                , tags: []
                , ajax: {
                    url: '{{route("permission.routes")}}'
                    , dataType: 'json'
                    , type: "GET"
                    , quietMillis: 50
                    , data: function(term) {
                        return {
                            q: term.term
                        }
                    }
                    , processResults: function(data) {
                        return {
                            results: data
                        };
                    }
                }


            });



        } catch (err) {
            console.log(err);
        }

    });

</script>
@endsection


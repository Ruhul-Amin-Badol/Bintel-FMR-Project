@extends('dashboard.master')
@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Update {{$permission->name}}</h4>
                
            </div>
        </div>



        <div class="card">
            <div class="card-body">

                <form action="{{ route('permission.update.store',encrypt($permission->id)) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Name*</label>
                                <input type="text" name="name" value="{{ $permission->name }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                              
                                <label>Routes *</label>
                                <select class="select2Ajax" name="slug[]" multiple>
                                    @foreach ( explode(',',$permission->slug) as  $single)

                                     <option value="{{$single}}" selected>{{$single}}</option>
                                        
                                    @endforeach
                                                                   
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <button class="btn btn-submit me-2" type="submit"> <i class="fa fa-plus"></i>Save</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

   
@endsection

@section("title")
<title>Update Permission</title>
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


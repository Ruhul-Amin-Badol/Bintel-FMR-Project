@extends('dashboard.master')

@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>User Management</h4>
            <h6>Update Admin</h6>
        </div>
    </div>

    <div class="card">
        <form action="{{route('dash.profile.update.profile.action',encrypt($admin->id))}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" value="{{$admin->name}}">
                        </div>

                        <div class="form-group">
                            <label>User Name</label>
                            <input type="text" name="user_name" value="{{$admin->user_name}}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" value="{{$admin->email}}">
                        </div>

                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" name="user_mobile" value="{{$admin->user_mobile}}">
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" name="user_role">
                                @foreach ( get_role_list() as $role)

                                 <option value="{{$role->id}}" @if($admin->user_role==$role->id) selected @endif>{{$role->name}}</option>

                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Password Password</label>
                            <div class="pass-group">
                                <input type="password" class=" pass-inputs" name="password" autocomplete="new-password">
                                <span class="fas toggle-passworda fa-eye-slash"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label> Profile Picture</label>
                            <div class="image-upload image-upload-new">
                                <input type="file" name="images" id="imgInp">
                                <div class="image-uploads">
                                    <img src="{{asset("$admin->images")}}" alt="img" id="blah" style="height:120px" class="border">
                                    <h4>Drag and drop a file to upload</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button class="btn btn-submit me-2" type="submit"> <i class="fa fa-edit"></i> Submit</button>
                        <a href="{{route('dash.admin.list')}}" class="btn btn-cancel"> <i class="fa fa-arrow-left"></i> Cancel</a>
                    </div>
                </div>
            </div>
       </form>
    </div>

</div>
@endsection
@section('title')
<title>Edit Admin</title>
@endsection

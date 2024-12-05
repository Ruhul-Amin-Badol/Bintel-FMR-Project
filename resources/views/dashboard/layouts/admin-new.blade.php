@extends('dashboard.master')

@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>User Management</h4>
            <h6>New Admin</h6>
        </div>
    </div>

    <div class="card">
        <form action="{{route('dash.admin.new.action')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" value="{{old("name")}}">
                        </div>

                        <div class="form-group">
                            <label>User Name</label>
                            <input type="text" name="user_name" value="{{old("user_name")}}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" value="{{old("email")}}">
                        </div>

                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" name="user_mobile" value="{{old("user_mobile")}}">
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select class="select2" name="user_role">
                                @foreach ( get_role_list() as $role)

                                 <option value="{{$role->id}}">{{$role->name}}</option>

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
                                    <img src="{{asset("resources/assets/img/icons/upload.svg")}}" alt="img" id="blah" style="height:120px" >
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
<title>Add New Admin</title>
@endsection

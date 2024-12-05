@extends('dashboard.master')

@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Officers Customization</h4>
            <h6>Update Your Officers</h6>
        </div>
    </div>

    <div class="card">
        <form action="{{route('officers_profile.update.profile.action',encrypt($officer->id))}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">

                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Employee ID</label>
                            <input type="text" name="employee_id" value="{{$officer->employee_id}}">
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" value="{{$officer->name}}">
                        </div>
                        <div class="form-group">
                            <label>Designation</label>
                            <input type="text" name="designation" value="{{$officer->designation}}">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" value="{{$officer->phone}}">
                        </div>
                        <div class="form-group">
                            <label>Area</label>
                            <input type="text" name="area" value="{{$officer->area}}">

                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Enter new password if you wish to change it">
                            <small class="text-muted"> Leave blank to keep the current password.</small>

                        </div>
                    </div>

                    <div class="col-lg-12">
                        <button class="btn btn-submit me-2" type="submit"> <i class="fa fa-edit"></i> Submit</button>
                        <a href="{{route('officers.list')}}" class="btn btn-cancel"> <i class="fa fa-arrow-left"></i> Cancel</a>
                    </div>
                </div>
            </div>
       </form>
    </div>

</div>
@endsection
@section('title')
<title>Edit Officer</title>
@endsection

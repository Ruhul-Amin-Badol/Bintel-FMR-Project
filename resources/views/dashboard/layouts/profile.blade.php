@extends('dashboard.master')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Profile</h4>
                <h6>User Profile</h6>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="profile-set">
                    <div class="profile-head">
                    </div>
                    <div class="profile-top">
                        
                            <div class="profile-content">
                                <div class="profile-contentimg">
                                    <img src="{{ asset(Auth::user()->images) }}" alt="img" id="blah"  >
                                    <div class="profileupload">
                                        <form action="{{route("dash.profile.update.image")}}" method="POST" id="UpdateImage" enctype="multipart/form-data">
                                            @csrf
                                        <input type="file" id="imgInp" name="images">
                                       </form>
                                        <a href="javascript:void(0);"><img
                                                src="{{ asset('resources/assets/img/icons/edit-set.svg') }}"
                                                alt="img"></a>
                                    </div>
                                </div>
                                <div class="profile-contentname">
                                    <h2>{{ Auth::user()->name }}</h2>
                                    <h4>Updates Your Photo and Personal Details.</h4>
                                </div>
                            </div>
                            <div class="ms-auto">
                                <a  onclick="$('#UpdateImage').submit()" class="btn btn-submit me-2">Save</a>
                                <a href="{{ route('dash.profile') }}" class="btn btn-cancel">Cancel</a>
                            </div>
                        
                    </div>
                </div>
                <form action="{{route("dash.profile.update.profile")}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="name" value="{{ Auth::user()->name }}" required> 
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="user_name" value="{{ Auth::user()->user_name }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" value="{{ Auth::user()->email }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Mobile Number</label>
                                <input type="text" name="user_mobile" value="{{ Auth::user()->user_mobile }}" required>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Role</label>
                                <select class="select" name="user_role">

                                @foreach ( get_role_list() as $role )
                                   
                                    <option value="{{encrypt($role->id)}}"  @if($role->id==Auth::user()->user_role) selected @endif>{{$role->name}}</option>
                                    
                                @endforeach

                                </select>
                            </div>
                        </div>

                       
                       
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input type="password" class="pass-input" autocomplete="new-password" name="password">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-submit me-2"> <i class="fa fa-edit"></i> Update Profile</a>
                            
                        </div>
                    </div>
               </form>
            </div>
        </div>

        

    </div>
    
@endsection

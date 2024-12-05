@extends('dashboard.master')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Admin List</h4>
                <h6>Manage your Admin</h6>
            </div>
            <div class="page-btn">
                <a href="{{route("dash.admin.new")}}" class="btn btn-added"><img src="{{ asset('resources/assets/img/icons/plus.svg') }}"
                        alt="img">Add New</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-path  d-none">
                            <a class="btn btn-filter" id="filter_search">
                                <img src="{{ asset('resources/assets/img/icons/filter.svg') }}" alt="img">
                                <span><img src="{{ asset('resources/assets/img/icons/closes.svg') }}" alt="img"></span>
                            </a>
                        </div>
                        <div class="search-input">
                            <a class="btn btn-searchset"><img
                                    src="{{ asset('resources/assets/img/icons/search-white.svg') }}" alt="img"></a>
                        </div>
                    </div>
                    <div class="wordset">
                        <ul>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                        src="{{ asset('resources/assets/img/icons/pdf.svg') }}" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                        src="{{ asset('resources/assets/img/icons/excel.svg') }}" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                        src="{{ asset('resources/assets/img/icons/printer.svg') }}" alt="img"></a>
                            </li>
                        </ul>
                    </div>
                </div>



                <div class="table-responsive">
                    <table class="table  datanew">
                        <thead>
                            <tr>
                                {{-- <th>
                                <label class="checkboxs">
                                    <input type="checkbox">
                                    <span class="checkmarks"></span>
                                </label>
                            </th> --}}
                                <th>Images </th>
                                <th>Name </th>
                                <th>Username </th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created On</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($admins as $admin)
                                <tr>
                                    <td class="productimgname">
                                        <a href="javascript:void(0);" class="product-img">
                                            <img src="{{asset($admin->images)}}" alt="product">
                                        </a>
                                    </td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->user_name }}</td>
                                    <td>{{ $admin->user_mobile }}</td>
                                    <td>{{ $admin->email }}</a>
                                    </td>
                                    <td><span class="badge bg-danger">{{ get_role_name($admin->user_role) }}</span></td>
                                    <td>{{ date('d/m/Y', strtotime($admin->created_at)) }}</td>

                                    <td>
                                        <div class="status-toggle d-flex justify-content-between align-items-center ">
                                            <input type="checkbox" id="user{{ $admin->id }}" class="check admin_status"
                                                data-value="{{ encrypt($admin->id) }}"
                                                @if ($admin->status == 1) checked @endif>
                                            <label for="user{{ $admin->id }}" class="checktoggle ">checkbox</label>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="me-3" href="{{route("dash.admin.edit",encrypt($admin->id))}}">
                                            <img src="{{ asset('resources/assets/img/icons/edit.svg') }}" alt="img">
                                        </a>
                                        <a class="me-3 delete-btn" href="{{route("dash.admin.delete",encrypt($admin->id))}}">
                                            <img src="{{ asset('resources/assets/img/icons/delete.svg') }}" alt="img">
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('title')
<title>Admin List</title>
@endsection

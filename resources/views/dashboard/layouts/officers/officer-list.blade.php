@extends('dashboard.master')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Officers List</h4>
                <h6>Manage your Officers</h6>
            </div>
            <div class="page-btn">
                <a href="{{route("officers.new")}}" class="btn btn-added"><img src="{{ asset('resources/assets/img/icons/plus.svg') }}"
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
                    <table class="table datanewAjax">
                        <thead>
                            <tr>

                                <th class="text-dark" style="font-weight: 600; font-size:15px; width: 160px;">Employee ID</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px; width: 130px;">Name </th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px; width: 130px;">Designation </th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px; width: 160px;">Phone</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px; width: 130px;">Area</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px; width: 160px;">Created On</th>
                                <th class="text-dark" style="font-weight: 600; font-size:15px; width: 130px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            {{-- @foreach ($officers as $officer)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $officer->employee_id }}</td>
                                    <td>{{ $officer->name }}</td>
                                    <td>{{ $officer->phone }}</td>
                                    <td>{{ $officer->area }}</td>

                                    <td>{{ date('d/m/Y', strtotime($officer->created_at)) }}</td>


                                    <td>
                                        <a class="me-3" href="{{route("officers.edit",encrypt($officer->id))}}">
                                            <img src="{{ asset('resources/assets/img/icons/edit.svg') }}" alt="img">
                                        </a>
                                        <a class="me-3 delete-btn" href="{{route("officers.delete",encrypt($officer->id))}}">
                                            <img src="{{ asset('resources/assets/img/icons/delete.svg') }}" alt="img">
                                        </a>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')

 <script>
    var AJAX_URL='{{route("officers.ajax")}}';


 </script>

@endsection
@section('title')
<title>Officer List</title>
@endsection

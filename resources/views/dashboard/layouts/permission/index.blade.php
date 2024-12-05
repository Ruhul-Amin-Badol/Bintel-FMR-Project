@extends('dashboard.master')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>ALL Permissions</h4>
            <h6>ALL Permissions</h6>
        </div>
        <div class="page-btn">
            <a data-bs-toggle="modal" data-bs-target="#create" class="btn btn-added">
                <img src="{{ asset('resources/assets/img/icons/plus.svg') }}" class="me-1" alt="img">Add New
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">
                    <div class="search-path">

                    </div>
                    <div class="search-input">
                        <a class="btn btn-searchset"><img src="{{ asset('resources/assets/img/icons/search-white.svg') }}" alt="img"></a>
                    </div>
                </div>
                <div class="wordset">
                    <ul>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Selected" class="delete-btn-group" href="{{route("permission.destroy.all")}}"><img src="{{ asset('resources/assets/img/icons/delete.svg') }}" alt="img"></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="{{ asset('resources/assets/img/icons/excel.svg') }}" alt="img"></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="{{ asset('resources/assets/img/icons/printer.svg') }}" alt="img"></a>
                        </li>
                    </ul>
                </div>
            </div>



            <div class="table-responsive">
                <table class="table datanew">
                    <thead>
                        <tr>
                            <th width="10px">
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all" data-value="0">
                                    <span class="checkmarks"></span>
                                </label>
                            </th>
                            <th>Name</th>
                            <th>Route</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($permission as $single)
                        <tr>
                            <td>
                                <label class="checkboxs">
                                    <input type="checkbox" data-value="{{$single->id}}">
                                    <span class="checkmarks"></span>
                                </label>
                            </td>
                            <td>
                                {{$single->name}}
                            </td>
                            <td>
                                @php
                                $urls=explode(",",$single->slug);
                                foreach ($urls as $key => $value) {

                                echo "<span class='btn btn-sm btn-outline-danger m-1'>$value</span>";
                                }
                                @endphp

                            </td>
                            <td class="text-center">
                                <a class="me-3" href="{{route("permission.update",encrypt($single->id))}}">
                                    <img src="{{asset("resources/assets/img/icons/edit.svg")}}" alt="img">
                                </a>
                                <a class="me-3 delete-btn" href="{{route("permission.destroy",encrypt($single->id))}}">
                                    <img src="{{asset("resources/assets/img/icons/delete.svg")}}" alt="img">
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




<div class="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="create" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Permission</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('permission.store')}}" method="post">
                    @csrf
                <div class="row">

                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label>Permission Name</label>
                            <input type="text" name="name">
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label>Routes</label>
                            <select class="select2Ajax" name="routes[]" multiple>
                                <option value="1">Royal</option>
                            </select>
                        </div>
                    </div>


                </div>
                <div class="col-lg-12">
                    <button class="btn btn-submit me-2" type="submit">Create</button>
                    <a class="btn btn-cancel" data-bs-dismiss="modal">Cancel</a>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>


@endsection
@section("title")
<title>ALL Permission</title>
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

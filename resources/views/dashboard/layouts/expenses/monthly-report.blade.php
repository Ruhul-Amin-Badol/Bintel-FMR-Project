@extends('dashboard.master')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Monthly Report</h4>
                <h6>Employee Monthly Report</h6>
            </div>
            {{-- <div class="page-btn">
                <a href="{{route("expenses.new")}}" class="btn btn-added"><img src="{{ asset('resources/assets/img/icons/plus.svg') }}"
                        alt="img">Add New</a>
            </div> --}}
        </div>


        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-path">
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

                <div class="card " id="filter_inputs">
                    <div class="card-body pb-0">

                        <div class="row ">
                            <form method="GET" action="{{ route('monthly.report.ajax') }}">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <div class="form-group required">
                                            <label class="fw-bold" for="dateInput">Select a daterange</label>
                                            <input type="text" class="form-control" name="range" id="daterange">
                                        </div>
                                    </div>
                                    <div class="col-md-1 text-center filter">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>


                <style>
                    .title_print {
                        text-align: center;
                        display: none;
                    }


                    @media print {
                        .title_print {
                            display: table-row;

                        }


                        body {
                            margin: 0;

                            padding: 0;

                        }

                        .table {
                            page-break-inside: avoid;
                            font-size: 6px !important;
                        }

                    }
                </style>


                <div class="table-responsive">
                    <h1 class=" text-center text-danger">The Royal Scientific Publications</h1>
                    <h2 class=" text-center">Employee Monthly Reports</h2>
                    <h3 class="py-3 text-center">Date Range: <span
                            class="text-danger">{{ request()->input('range') }}</span></h3>
                    <table class=" table" id="example">

                        <thead>
                            <tr class="title_print" style="text-align: center">
                                <td colspan="10">
                                    <h1 class=" text-center text-danger">The Royal Scientific Publications</h1>
                                </td>
                            </tr>
                            <tr class="title_print" style="text-align: center">
                                <td colspan="10">
                                    <h2 class=" text-center">Employee Monthly Reports {{ request()->input('range') }}</h2>
                                </td>
                            </tr>

                            <tr>
                                <th class="text-dark"
                                    style="font-weight: 600; text-align: left !important; font-size:15px; width: 130px;">SL
                                </th>
                                <th class="text-dark"
                                    style="font-weight: 600; text-align: left !important; font-size:15px; width: 200px;">
                                    Employee name</th>
                                <th class="text-dark"
                                    style="font-weight: 600; text-align: left !important; font-size:15px; width: 160px;">
                                    Designation</th>
                                
                                <th class="text-dark"
                                    style="font-weight: 600; text-align: right !important; font-size:15px; width: 100px;">
                                    D.A</th>
                                <th class="text-dark"
                                    style="font-weight: 600; text-align: right !important; font-size:15px; width: 150px;">
                                    H.R</th>
                              
                                <th class="text-dark"
                                    style="font-weight: 600; text-align: right !important; font-size:15px; width: 100px;">
                                    Total D.A</th>
                              
                                <th class="text-dark"
                                    style="font-weight: 600; text-align: right !important; font-size:15px; width: 100px;">
                                    T.A</th>
                              
                              
                                <th class="text-dark"
                                    style="font-weight: 600; text-align: right !important; font-size:15px; width: 100px;">
                                    M.A</th>
                                <th class="text-dark "
                                    style="font-weight: 600; text-align: right !important; font-size:15px; width: 100px;">
                                    O.Exp</th>
                                <th class="text-dark"
                                    style="font-weight: 600; text-align: right !important; font-size:15px; width: 150px;">
                                    Total</th>
                                <th class="text-dark"
                                    style="font-weight: 600; text-align: center !important; font-size:15px; width: 100px;">
                                    Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $c = 0;
                                $ta=$da=$hr=$ma=$oa=0;
                            @endphp
                            @foreach ($data as $key => $officer)
                                @if ($officer['total_cost'] != 0)
                                    @php
                                      $tda=$officer['da']+$officer['rent'];
                                    @endphp
                                    <tr>
                                        <td style="text-align: left !important;">{{ ++$c }}</td>
                                        <td style="text-align: left !important;">{{ $officer['name'] }} ({{ $officer['employee_id'] }})</td>
                                        <td style="text-align: left !important;">{{ $officer['designation'] }}</td>
                                       
                                        <td style="text-align: right !important;">{{ $officer['da'] }}</td>
                                        <td style="text-align: right !important;">{{ $officer['rent'] }}</td>
                                         <td style="text-align: right !important;">{{  $tda }}</td>
                                        <td style="text-align: right !important;">{{ $officer['ta'] }}</td>
                                        <td style="text-align: right !important;">{{ $officer['con'] }}</td>
                                        <td style="text-align: right !important;">{{ $officer['ot'] }}</td>
                                        <td style="text-align: right  !important;">{{ $officer['total_cost'] }}</td>
                                        <td style="text-align: center !important;"></td>
                                    </tr>
                                     @php 
                                       $ta += $officer['ta'];
                                       $da += $officer['da'];
                                       $hr += $officer['rent'];
                                       $ma += $officer['con'];
                                       $oa += $officer['ot']

                                     @endphp
                                @endif
                            @endforeach
                        </tbody>
                        <tfoot style="border:none !important;">

                            <tr>

                                <td class="text-dark"
                                    style="font-weight: 600; text-align:left; font-size:15px; width: 120px;"></td>

                                <td class="text-dark"
                                    style="font-weight: 600; text-align:left; font-size:15px; width: 120px; "></td>

                                <td class="text-dark"
                                    style="font-weight: 600; text-align:left;  font-size:15px; width: 120px"></td>
                              <td class="text-dark"
                                    style="font-weight: 600; text-align:left;  font-size:15px; width: 120px"></td>
                                
                                <td class="text-dark"
                                    style="font-weight: 600; text-align: right !important; font-size:15px; width: 120px;">
                                </td>
                                <td class="text-dark"
                                    style="font-weight: 600; text-align: right !important; font-size:15px; width: 120px;">Total DA {{$hr+$da}}
                                  
                                </td>
                              
                               <td class="text-dark"
                                    style="font-weight: 600;  text-align: right !important; font-size:15px; width: 120px;">T.A: {{$ta}}
                                </td>
                              
                                <td class="text-dark"
                                    style="font-weight: 600; text-align: right !important; font-size:15px; width: 120px;">M.A: {{$ma}}
                                </td>

                                <td class="text-dark"
                                    style="font-weight: 600; text-align: right !important; font-size:15px; width: 120px;">O.Exp:{{$oa}}</td>
                                <td class="text-dark"
                                    style="font-weight: 600; border-top: 1px solid #red; text-align: right !important;  font-size:15px; width: 120px;">Total:
                                    {{ $grandTotal }}</td>
                                <td class="text-dark" style="font-weight: 600;  font-size:15px; width: 120px;"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>


                {{--
                <div class="table-responsive">
                    <ul class="list-group">
                        @foreach ($expenses as $key => $expense)
                            <li class="list-group-item">
                                <strong>SL: {{ $key + 1 }}</strong><br>
                                <strong>Employee name:</strong> {{ isset($expense->employee) ? $expense->employee->name . "($expense->employee_id)" : "" }}<br>
                                <strong>Working Area:</strong> {{ isset($expense->employee) ? $expense->employee->area : "" }}<br>

                                <strong>Total Expenses:</strong><br>
                                @php
                                    $totalExpenses = 0;
                                @endphp
                                @foreach ($expenseTypes as $type)
                                    @php
                                        $typeTotal = $expense
                                            ->where('type', $type)
                                            ->where('employee_id', $expense->employee_id)
                                            ->sum('total_cost');
                                        $totalExpenses += $typeTotal;
                                    @endphp
                                    <span>{{ $type }}: {{ $typeTotal }}৳</span><br>
                                @endforeach
                                <span><strong>Total All Expenses:</strong> {{ $totalExpenses }}৳</span>
                            </li>
                        @endforeach
                    </ul>
                </div> --}}
            </div>
        </div>

    </div>
@endsection
@section('title')
    <title>Monthly Report Expenses</title>
@endsection


@section('script')
    {{-- <script>
    var AJAX_URL='{{route("monthly.report.ajax")}}';


 </script> --}}
    <script>
        $(function() {
            $('#daterangeSingle').daterangepicker({
                singleDatePicker: true, // Set to true for single date picker
                opens: 'right',
                showDropdowns: true,
                showWeekNumbers: true,
                alwaysShowCalendars: true
            }, function(start, end, label) {
                console.log("A new date was selected: " + start.format('YYYY-MM-DD'));
            });
        });
    </script>



@endsection

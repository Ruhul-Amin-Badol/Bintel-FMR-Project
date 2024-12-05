@extends('dashboard.master')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget" style="  box-shadow: 0 0 15px #6C757D;">
                <div class="dash-widgetimg">
                    <span><img src="{{ asset('resources/assets/img/icons/dash1.svg')}}" alt="img"></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5><span class="counters" data-count="{{record_count_today()}}">{{record_count_today()}}</span></h5>
                    <h6>Todays Records</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget dash1" style="  box-shadow: 0 0 15px #6C757D;">
                <div class="dash-widgetimg">
                    <span><img src="{{ asset('resources/assets/img/icons/purchase1.svg')}}" alt="img"></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5><span class="counters" data-count="{{record_count_week()}}">{{record_count_week()}}</span></h5>
                    <h6>Weekly Records</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget dash2" style="  box-shadow: 0 0 15px #6C757D;">
                <div class="dash-widgetimg">
                    <span><img src="{{ asset('resources/assets/img/icons/e.svg')}}" alt="img"></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5><span class="counters" data-count="{{record_count_month()}}">{{record_count_month()}}</span></h5>
                    <h6>Monthly Records</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12" >
            <div class="dash-widget dash3" style="  box-shadow: 0 0 15px #6C757D;">
                <div class="dash-widgetimg">
                    <span><img src="{{ asset('resources/assets/img/icons/dash2.svg')}}" alt="img"></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5><span class="counters" data-count="{{total_expenses()}}">{{total_expenses()}}</span></h5>
                    <h6>Todays Expenses</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-4 col-sm-6 col-12 d-flex">
            <div class="dash-count">
                <div class="dash-counts">
                    <h4><span class="counters" data-count="{{admin()}}">{{admin()}}</span></h4>
                    <h5>Super Admin</h5>
                </div>
                <div class="dash-imgs">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12 d-flex">
            <div class="dash-count das1">
                <div class="dash-counts">
                    <h4><span class="counters" data-count="{{officer()}}">{{officer()}}</span></h4>
                    <h5>Officers</h5>
                </div>
                <div class="dash-imgs">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12 d-flex">
            <div class="dash-count das2">
                <div class="dash-counts">
                    <h4><span class="counters" data-count="{{total_cost()}}">{{total_cost()}}</span></h4>
                    <h5>Total Cost</h5>
                </div>
                <div class="dash-imgs">
                    <svg fill="#ffffff" viewBox="0 0 24 24" id="taka" data-name="Flat Color" xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="icon flat-color" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path id="primary" d="M18.67,12.16a3.9,3.9,0,0,0-2.32-2.11,1,1,0,0,0-.63,1.9,1.87,1.87,0,0,1,1.12,2.53l-1.75,3.94A2.66,2.66,0,0,1,10,17.34V12h2a1,1,0,0,0,0-2H10V6A4,4,0,0,0,6,2,1,1,0,0,0,6,4,2,2,0,0,1,8,6v4H6a1,1,0,0,0,0,2H8v5.34a4.66,4.66,0,0,0,8.92,1.89l1.75-3.93A3.9,3.9,0,0,0,18.67,12.16Z" style="fill: #ffffff;"></path></g></svg>
                </div>
            </div>
        </div>

    </div>
</div>


</div>
@endsection


@section("title")

<title>Home | {{get_option("title")}}</title>

@endsection













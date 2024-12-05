<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="shoaeb_link @if (Route::currentRouteName() == 'dash.home') active @endif">
                    <a href="{{ route('dash.home') }}"><img src="{{ asset('resources/assets/img/icons/dashboard.svg') }}"
                            alt="img"><span>
                            Dashboard</span> </a>
                </li>


                @if (can_view(route('dash.admin.list')))

                    <li class="shoaeb_link submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('resources/assets/img/icons/users1.svg') }}"
                                alt="img"><span>
                                Admin</span> <span class="menu-arrow"></span></a>
                        <ul>
                            @if (can_view(route('dash.admin.new')))
                                <li class='shoaeb_link'><a class="@if (Route::currentRouteName() == 'dash.admin.new') activex @endif"
                                        href="{{ route('dash.admin.new') }}"> Add New</a></li>
                            @endif
                            @if (can_view(route('dash.admin.list')))
                                <li class='shoaeb_link'><a class="@if (Route::currentRouteName() == 'dash.admin.list') activex @endif"
                                        href="{{ route('dash.admin.list') }}">Admin List</a></li>
                            @endif
                        </ul>
                    </li>

                @endif

                {{-- Tanvir  --}}


                {{-- Officers  --}}

                @if (can_view(route('officers.list')))

                    <li class="shoaeb_link submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('resources/assets/img/icons/users2.svg') }}"
                                alt="img"><span>
                                Officers</span> <span class="menu-arrow"></span></a>
                        <ul>
                            @if (can_view(route('officers.new')))
                                <li class='shoaeb_link'><a class="@if (Route::currentRouteName() == 'officers.new') activex @endif"
                                        href="{{ route('officers.new') }}"> Add New</a></li>
                            @endif
                            @if (can_view(route('officers.list')))
                                <li class='shoaeb_link'><a class="@if (Route::currentRouteName() == 'officers.list') activex @endif"
                                        href="{{ route('officers.list') }}">Officers List</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                {{-- Daily Records  --}}

                @if (can_view(route('records.list')))

                    <li class="shoaeb_link submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('resources/assets/img/icons/r.svg') }}"
                                alt="img"><span>
                                Daily Records</span> <span class="menu-arrow"></span></a>
                        <ul>
                            {{-- @if (can_view(route('records.new')))
                             <li class='shoaeb_link' ><a class="@if (Route::currentRouteName() == 'records.new') activex @endif" href="{{ route('records.new') }}"> Add New</a></li>
                            @endif --}}
                            @if (can_view(route('records.list')))
                                <li class='shoaeb_link'><a class="@if (Route::currentRouteName() == 'records.list') activex @endif"
                                        href="{{ route('records.list') }}">Records List</a></li>
                            @endif
                        </ul>
                    </li>
                @endif


                {{-- Daily Expenses  --}}

                @if (can_view(route('expenses.list')))

                    <li class="shoaeb_link submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('resources/assets/img/icons/e.svg') }}"
                                alt="img"><span>
                                Daily Expenses</span> <span class="menu-arrow"></span></a>
                        <ul>

                            @if (can_view(route('expenses.list')))
                                <li class='shoaeb_link'><a class="@if (Route::currentRouteName() == 'expenses.list') activex @endif"
                                        href="{{ route('expenses.list') }}">Expenses List</a></li>
                            @endif
                            @if (can_view(route('monthly.report.ajax')))
                                <li class='shoaeb_link'><a class="@if (Route::currentRouteName() == 'monthly.report.ajax') activex @endif"
                                        href="{{ route('monthly.report.ajax') }}">Monthly Report</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                {{-- library report --}}

                @if (can_view(route('library.visit')))

                    <li class="shoaeb_link submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('resources/assets/img/icons/e.svg') }}"
                                alt="img"><span>
                                Library Visit Report</span> <span class="menu-arrow"></span></a>
                        <ul>

                            @if (can_view(route('library.visit')))
                                <li class='shoaeb_link'><a class="@if (Route::currentRouteName() == 'library.visit') activex @endif"
                                        href="{{ route('library.visit') }}">Add Library Report</a></li>
                            @endif
                            {{-- @if (can_view(route('library.list')))
                                <li class='shoaeb_link'><a class="@if (Route::currentRouteName() == 'library.list') activex @endif"
                                        href="{{ route('library.list') }}">Library Report List</a></li>
                            @endif --}}
                        </ul>
                    </li>
                @endif

                    {{-- visiting report --}}

                    @if (can_view(route('library.visit')))

                    <li class="shoaeb_link submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('resources/assets/img/icons/e.svg') }}"
                                alt="img"><span>
                             Visiting Report</span> <span class="menu-arrow"></span></a>
                        <ul>

                            @if (can_view(route('library.show-list')))
                            <li class='shoaeb_link'>
                                <a class="@if (Route::currentRouteName() == 'library.show-list') activex @endif"
                                    href="{{ route('library.show-list') }}">Library Visiting Report</a>
                            </li>
                        @endif
                            @if (can_view(route('batch.visiting.index')))
                                <li class='shoaeb_link'><a class="@if (Route::currentRouteName() == 'batch.visiting.index') activex @endif"
                                        href="{{ route('batch.visiting.index') }}">Batch Visiting Report</a></li>
                            @endif
                            @if (can_view(route('institution.visiting.index')))
                                <li class='shoaeb_link'><a class="@if (Route::currentRouteName() == 'institution.visiting.index') activex @endif"
                                        href="{{ route('institution.visiting.index') }}">Institution Visiting Report</a></li>
                            @endif
                        </ul> 
                    </li>
                @endif



                @if (can_view(route('permission.index')))
                    <li class="shoaeb_link submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('resources/assets/img/icons/settings.svg') }}"
                                alt="img"><span>
                                Permission</span> <span class="menu-arrow"></span></a>
                        <ul>
                            @if (can_view(route('permission.index')))
                                <li class='shoaeb_link'><a class="@if (Route::currentRouteName() == 'permission.index') activex @endif"
                                        href="{{ route('permission.index') }}">Permission Management</a></li>
                            @endif
                            @if (can_view(route('roles.index')))
                                <li class='shoaeb_link'><a class="@if (Route::currentRouteName() == 'roles.index') activex @endif"
                                        href="{{ route('roles.index') }}">Role Management</a></li>
                            @endif
                        </ul>
                    </li>
                @endif


            </ul>
        </div>
    </div>
</div>


<style>
    .activex {
        background: #1b2850d9;
        color: #fff !important;
        border-radius: 5px;
    }

    .sidebar .sidebar-menu>ul>li>a img {
        width: 20px;
        height: 20px;
    }
</style>

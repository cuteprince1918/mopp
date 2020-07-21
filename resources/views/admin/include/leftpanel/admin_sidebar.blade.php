@php
$currRoute = Route::current()->getName();
$items = Session::get('logindata');
@endphp
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">Username</div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>
    <form role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
    </form>
    <ul class="nav menu">
        <li class="{{ ($currRoute == 'admin-dashboard')  ? 'active' : '' }}"><a href="{{ route('admin-dashboard') }}"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
        <li class="{{ ($currRoute == 'univercity' || $currRoute == 'edit-univercity' || $currRoute == 'add-univercity')  ? 'active' : '' }}"><a href="{{ route('univercity') }}"><em class="fa fa-university">&nbsp;</em> Univercity</a></li>
        <li class="{{ ($currRoute == 'company' || $currRoute == 'edit-company' || $currRoute == 'add-company')  ? 'active' : '' }}"><a href="{{ route('company') }}"><em class="fa fa-industry">&nbsp;</em> Company</a></li>
        <li class="{{ ($currRoute == 'job' || $currRoute == 'edit-job' || $currRoute == 'add-job')  ? 'active' : '' }}"><a href="{{ route('job') }}"><em class="fa fa-suitcase">&nbsp;</em> Job</a></li>
<!--        <li><a href="widgets.html"><em class="fa fa-calendar">&nbsp;</em> Widgets</a></li>
        <li ><a href="charts.html"><em class="fa fa-bar-chart">&nbsp;</em> Charts</a></li>
        <li><a href="elements.html"><em class="fa fa-toggle-off">&nbsp;</em> UI Elements</a></li>
        <li><a href="panels.html"><em class="fa fa-clone">&nbsp;</em> Alerts &amp; Panels</a></li>
        <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
                <em class="fa fa-navicon">&nbsp;</em> Multilevel <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-1">
                <li><a class="" href="#">
                        <span class="fa fa-arrow-right">&nbsp;</span> Sub Item 1
                    </a></li>
                <li><a class="" href="#">
                        <span class="fa fa-arrow-right">&nbsp;</span> Sub Item 2
                    </a></li>
                <li><a class="" href="#">
                        <span class="fa fa-arrow-right">&nbsp;</span> Sub Item 3
                    </a></li>
            </ul>
        </li>-->
        <!--<li><a href="login.html"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>-->
    </ul>
</div><!--/.sidebar-->
<header class="navbar">
    <div class="container-fluid">
        <button class="navbar-toggler mobile-toggler hidden-lg-up" type="button">&#9776;</button>
        <a class="navbar-brand" href="{{env('APP_URL')}}" style="display: flex; justify-content: center; align-items: center;">
            <img class="nav-logo-container" src="{{url('adminassets/img/logo.png')}}" width="54px" height="54px">
        </a> 
        <!--<a class="navbar-brand" href="{{env('APP_URL')}}"></a>-->

        <ul class="nav navbar-nav hidden-md-down">
            <li class="nav-item">
                <a class="nav-link navbar-toggler layout-toggler" href="#">&#9776;</a>
            </li>
            <li class="nav-item p-x-1">
                <a class="nav-link" href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li class="nav-item p-x-1">
                <a class="nav-link" href="{{route('categories')}}">Categories</a>
            </li>
            <li class="nav-item p-x-1">
                <a class="nav-link" href="{{route('users')}}">Users</a>
            </li>
            <li class="nav-item p-x-1">
                <a class="nav-link" href="{{route('waiting')}}">Waiting list</a>
            </li>
            <li class="nav-item p-x-1">
                <a class="nav-link" href="{{route('rejected')}}">Rejected list</a>
            </li>
            <li class="nav-item p-x-1">
                <a class="nav-link" href="{{route('paid')}}">Paid list</a>
            </li>
            
        </ul>
        <ul class="nav navbar-nav pull-left hidden-md-down">
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="icon-bell"></i><span class="tag tag-pill tag-danger">5</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="icon-list"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="icon-location-pin"></i></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="{{url('adminassets/img/avatars/images.png')}}" class="img-avatar" alt="hi">{{-- {{auth()->user()->image}}--}}
                    <span class="hidden-md-down">{{$admin->name}}</span> {{-- {{auth()->user()->name}}--}}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-xs-center">
                        <strong></strong>
                    </div>
                    <a class="dropdown-item" href="#"><i class="fa fa-bell-o"></i> Updates<span class="tag tag-info">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-envelope-o"></i> Messages<span class="tag tag-success">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-tasks"></i> Tasks<span class="tag tag-danger">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-comments"></i> Comments<span class="tag tag-warning">42</span></a>
                    <div class="dropdown-header text-xs-center">
                        <strong>Settings</strong>
                    </div>
                    <a class="dropdown-item" href="{{route('admin.profile',$admin)}}"><i class="fa fa-user"></i> Profile</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-wrench"></i> Settings</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-usd"></i> Payments<span class="tag tag-default">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-file"></i> Projects<span class="tag tag-primary">42</span></a>
                    <div class="divider"></div>
                    <a class="dropdown-item" href="#"><i class="fa fa-shield"></i> Lock Account</a>
                    <a class="dropdown-item" href="{{route('dashboard.logout')}}"><i class="fa fa-lock"></i> Logout</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link navbar-toggler aside-toggle" href="#">&#9776;</a>
            </li>

        </ul>
    </div>
</header>
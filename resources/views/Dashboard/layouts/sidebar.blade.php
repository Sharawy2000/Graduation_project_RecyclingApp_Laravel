<div class="sidebar" style="background-color: #004100">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{route('dashboard')}}"><i class="icon-speedometer"></i> Dashboard <span class="tag tag-info"></span></a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.profile',$admin)}}"><i class="icon-speedometer"></i> Profile <span class="tag tag-info"></span></a>
            </li>

            <li class="nav-title">
                Admin pages
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-star"></i> Operations</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('users')}}" target="_top"><i class="icon-star"></i> Users </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('waiting')}}" target="_top"><i class="icon-star"></i> Waiting list</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('rejected')}}" target="_top"><i class="icon-star"></i> Rejected list</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('paid')}}" target="_top"><i class="icon-star"></i> Paid list</a>
                    </li>
                </ul>
            </li>

            {{-- <li class="nav-title">
                UI Elements
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i> Components</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="components-buttons.html"><i class="icon-puzzle"></i> Buttons</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="components-social-buttons.html"><i class="icon-puzzle"></i> Social Buttons</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="components-cards.html"><i class="icon-puzzle"></i> Cards</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="components-forms.html"><i class="icon-puzzle"></i> Forms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="components-switches.html"><i class="icon-puzzle"></i> Switches</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="components-tables.html"><i class="icon-puzzle"></i> Tables</a>
                    </li>
                </ul>
            </li> --}}
            {{-- <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-star"></i> Icons</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="icons-font-awesome.html"><i class="icon-star"></i> Font Awesome</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="icons-simple-line-icons.html"><i class="icon-star"></i> Simple Line Icons</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="widgets.html"><i class="icon-calculator"></i> Widgets <span class="tag tag-info">NEW</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="charts.html"><i class="icon-pie-chart"></i> Charts</a>
            </li> --}}

            <li class="nav-item">
                <!--<a class="nav-link" href="{{route("dashboard.setting")}}"><i class="icon-pie"></i> Settings</a>-->
            </li>
            <li class="divider"></li>
            <li class="nav-title">
                Extras
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-star"></i> Pages</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}" target="_top"><i class="icon-star"></i> Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('register')}}" target="_top"><i class="icon-star"></i> Register</a>
                    </li>
                    <!--<li class="nav-item">-->
                        <!--<a class="nav-link" href="pages-404.html" target="_top"><i class="icon-star"></i> Error 404</a>-->
                    <!--</li>-->
                    <!--<li class="nav-item">-->
                        <!--<a class="nav-link" href="pages-500.html" target="_top"><i class="icon-star"></i> Error 500</a>-->
                    <!--</li>-->
                </ul>
            </li>

        </ul>
    </nav>
</div>
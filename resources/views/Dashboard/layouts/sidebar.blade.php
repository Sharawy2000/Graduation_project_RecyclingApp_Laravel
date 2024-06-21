<div class="sidebar" style="color:red;">
    <nav class="sidebar-nav"  style="background-color: #27B645">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link"  href="{{route('dashboard')}}"><i class="icon-star"></i> Dashboard <span class="tag tag-info"></span></a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link"  href="{{route('admin.profile',$admin)}}"><i class="icon-star"></i> Profile <span class="tag tag-info"></span></a>
            </li>

            <li class="nav-title">
                Admin pages
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle"  href="#"><i class="icon-star"></i> Operations</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" id="my-button"  href="{{route('users')}}" target="_top"><i class="icon-star"></i> Users </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="my-button"  href="{{route('waiting')}}" target="_top"><i class="icon-star"></i> Waiting list</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="my-button"  href="{{route('rejected')}}" target="_top"><i class="icon-star"></i> Rejected list</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="my-button"  href="{{route('paid')}}" target="_top"><i class="icon-star"></i> Paid list</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="my-button"  href="{{route('categories')}}" target="_top"><i class="icon-star"></i> Categories</a>
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
                        <a class="nav-link" id="my-button"  href="{{route('login')}}" target="_top"><i class="icon-star"></i> Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="my-button"  href="{{route('register')}}" target="_top"><i class="icon-star"></i> Register</a>
                    </li>
                    <!--<li class="nav-item">-->
                        <!--<a class="nav-link" href="pages-404.html" target="_top"><i class="icon-star"></i> Error 404</a>-->
                    <!--</li>-->
                    <!--<li class="nav-item">-->
                        <!--<a class="nav-link" href="pages-500.html" target="_top"><i class="icon-star"></i> Error 500</a>-->
                    <!--</li>-->
                </ul>
            </li>
            <li class="nav-item">
                        <a class="nav-link" id="my-button"  href="{{route('dashboard.logout')}}" target="_top"><i class="icon-star"></i> Logout</a>
            </li>

        </ul>
    </nav>
</div>
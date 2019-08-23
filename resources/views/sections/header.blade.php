<header class="header-bg">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark-overlay navbar-static-top">
        <div class="container">
            <a class="navbar-brand" href="/">MOTELBOOKING</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav mr-auto">
                    @foreach ($categories as $category)
                    <li class="nav-item text-capitalize"><a class="nav-link"
                            href="{{ route('category_rooms',$category['id']) }}">{{ $category['name'] }}</a>
                    </li>
                    @endforeach
                    <li class="nav-item text-capitalize active"><a class="nav-link" href="#">About Me</a>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item dropdown notifications">
                        <a class="nav-link dropdown-toggle" href="#notifications-panel" id="triggerId"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell" aria-hidden="true" data-count="0" style="color:#fff"></i>
                        </a>

                        <div class="dropdown-menu notifications-menu" aria-labelledby="triggerId">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="dropdown-toolbar-actions">
                                        <a href="#">Mark all as read</a>
                                    </div>
                                    <p class="dropdown-toolbar-title">Notifications (<span class="notif-count">0</span>)
                                    </p>
                                </div>
                                <div class="card-body">
                                    <ul class="list-notifications">
                                    </ul>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="#">View All</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    @if(Auth::guest())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;Register
                        </a>
                    </li>
                    @elseif(Auth::user()->isAdministrator())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/cart') }}">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Cart&nbsp;
                            <span id="number-booking" class="badge badge-warning">{{ $numRoomInCart }}</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="dropdown-toggle nav-link" id="navbarDropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user"></i>&nbsp;{{ Auth::user()->name }}
                            <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a href="{{ url('/admin') }}" class="dropdown-item">
                                <i class="fa fa-th-large" style="color:#204d74;"></i>
                                &nbsp;Admin Manager
                            </a>
                            <a href="{{ url('/order') }}" class="dropdown-item"><i class="fa fa-home"
                                    aria-hidden="true"></i>&nbsp;Order Rooms</a>

                            <a href="{{ url('/profile') }}" class="dropdown-item">
                                <i class="fa fa-address-book" aria-hidden="true"></i>
                                &nbsp;Profile</a>
                            <a href="{{ route('register') }}" class="dropdown-item">
                                <i class="fa fa-address-card" aria-hidden="true"></i>&nbsp;Register</a>
                            <a href="{{ url('/logout') }}" class="dropdown-item">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Logout
                            </a>
                        </div>
                    </li>

                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/cart') }}">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            &nbsp;Cart&nbsp;
                            <span class="badge badge-warning">{{ $numRoomInCart }}</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="dropdown-toggle nav-link" id="navbarDropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user" style="color:#4cae4c;"></i>
                            &nbsp;{{ Auth::user()->name }}
                            <i class="caret"></i>
                        </a>
                        <div class="dropdown-menu" role="menu">
                            <a href="{{ url('/order') }}" class="dropdown-item">
                                <i class="fa fa-home" aria-hidden="true"></i>
                                &nbsp;Order Rooms
                            </a>

                            <a href="{{ url('/profile') }}" class="dropdown-item"><i class="fa fa-address-book"
                                    aria-hidden="true"></i>&nbsp;Profile</a>
                            <a href="{{ route('register') }}" class="dropdown-item">
                                <i class="fa fa-address-card" aria-hidden="true"></i>
                                &nbsp;Register
                            </a>
                            <a href="{{ url('/logout') }}" class="dropdown-item">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                &nbsp;Logout</a>
                        </div>
                    </li>
                    @endif
                </ul>


            </div>
        </div>
    </nav>

    @yield('header')

</header>
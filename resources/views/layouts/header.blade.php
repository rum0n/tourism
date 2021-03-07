<header>

    <div class="Navigation Navigation-wrapper Navigation--guest Navigation--transparentTablet Navigation--staticTablet Navigation--searchHidden">
        <div class="Navigation-body">
            <div class="Container">
                <div class="Navigation-left">
                    <a class="Navigation-item Navigation-mobileMenu"></a>
                </div>

                <a class="Navigation-item Navigation-logo" href="{{ route('home_page') }}">Find Local</a>

                <form class="Navigation-search Navigation-item ng-pristine ng-pending">
                        <span class="Navigation-searchfa">
                          <i class="fa fa-search"></i>
                        </span>
                    <input type="text" placeholder="Where next?" class="ng-pristine ng-untouched ng-isolate-scope ng-empty ng-pending">
                </form>

                <div class="Navigation-right Navigation-guestButtons ng-scope">

                    <div class="Navigation-item Navigation-envelope navigation-links" style="width:auto;padding-top:0px;">
                        <div class="navigation-span"><a class="{{ Request::is('/') ? 'active' : '' }}" href="{{ route('home_page') }}">Home</a></div>
                    </div>
                    <div class="Navigation-item Navigation-envelope navigation-links" style="width:auto;padding-top:0px;">
                        <div class="navigation-span"><a class="{{ Request::is('bookings') ? 'active' : '' }}" href="{{ route('bookings') }}">Bookings</a></div>
                    </div>

                    @guest
                    <div class="Navigation-item Navigation-item--button">
                        <a href="{{ route('login') }}" class="Button Button--gray Button--inverted Button--invertedAlternativeHover">Sign In</a>
                    </div>

                    <div class="Navigation-item Navigation-item--button ng-scope">
                        <a class="Button Button--orange" href="{{ route('register') }}">Sign up</a>
                    </div>
                    @endguest

                    @auth
                    <div class="Navigation-item Navigation-dropdownButton" id="nav1">
                        <img class="ng-isolate-scope" src="{{ asset('profile/picture/'.Auth::user()->pro_pic) }}">
                        <span  class="ng-binding">{{ Auth::user()->name }}</span>

                        <div class="Navigation-dropdown" id="bar">
                            <ul>
                                @if(Auth::user()->role_id != 1)
                                    <li ><a  href="{{ route('local',Auth::user()->id) }}">View profile</a></li>

                                    <li >
                                        @if(Auth::user()->role_id == 2)
                                            <a  href="{{ route('guide.edit.profile',Auth::user()->id) }}">Edit profile</a>
                                        @elseif(Auth::user()->role_id == 3)
                                            <a  href="{{ route('user.edit.profile',Auth::user()->id) }}">Edit profile</a>
                                        @endif
                                    </li>
                                @endif

                                @if(Auth::user()->role_id == 1)
                                <li ><a  href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                @endif
                                <li>
                                    @if(Auth::user()->role_id == 3)
                                    <a href="{{ route('user.dashboard',Auth::user()->id) }}">My Trips</a>
                                    @elseif(Auth::user()->role_id == 2)
                                        <a href="{{ route('guide.dashboard') }}">My Bookings</a>
                                    @endif
                                </li>
                                {{--<li ><a  href="#">Notifications</a></li>--}}
                                <li >
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign out</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @endauth
                </div>

            </div>
        </div>

        <div class="SystemAlert SystemAlert-">
            <span><i class="fa fa-"></i></span>
                <span class="SystemAlert-text ng-binding">

                </span>
        </div>

    </div>

    <section class="MobileNavigation" style="display: none">
        <a class="MobileNavigation-close"></a>

        <div class="MobileNavigation-header ng-scope lazyloaded" style="background-image: url(/img/mnav1.jpg);">
            <div class="MobileNavigation-overlay"></div>
            @auth
            <div class="MobileNavigation-user">
                <img src="img/2.jpg">
                <p class="MobileNavigation-userName ng-binding">{{ Auth::user()->name }}</p>
                <p class="MobileNavigation-userLocation ng-binding ng-scope">
                    <i class="fa fa-marker"></i>{{  Auth::user()->location }}
                </p><!-- end ngIf: ctrl.userModel.item.location.countryCode -->
            </div>
            @endauth

        <ul class="MobileNavigation-links">
            @guest
            <li><a href="{{route('home_page')}}" class="is-active">Home</a></li>
            <li><a href="{{route('login')}}" class="">Sign In</a></li>
            <li><a href="{{route('register')}}" class="">Sign Up</a></li>
            @endguest

            @auth
            <li>
                <a class="" href="{{ route('local',Auth::user()->id) }}">View profile</a>
            </li>

            <li>
                <a class="" href="#">Profile settings</a>
            </li>

            <li>
                @if(Auth::user()->role_id == 3)
                    <a href="{{ route('user.dashboard',Auth::user()->id) }}">My Trips</a>
                @else
                    <a href="#">My Bookings</a>
                @endif
            </li>

            <li>
                <a class="" href="#">Notifications</a>
            </li>

            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign out</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </li>
            @endauth
            <!-- ngIf: !ctrl.userModel.item.id -->
        </ul>
    </div>
        <!-- ngIf: !ctrl.userModel.item.id -->


    </section>




</header>

<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm header custom-width">
    <div class="container">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto d-flex flex-row">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('front.index') }}">Index</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('front.feedback') }}">feedback</a>
            </li>
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto d-flex flex-row">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item">
                    <a class="nav-link"><span class="caret">{{ Auth::user()->name }}</span></a>
                </li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-danger"> log out</button>
                    </form>
                </li>
            @endguest
        </ul>
    </div>
</nav>

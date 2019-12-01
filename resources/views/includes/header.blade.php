<nav class="navbar navbar-expand-md navbar-light fixed-top navbar-laravel">
    <div class="container">
        <a id="logo-text" class="navbar-brand" href="{{ url('/') }}">
            esemes.<span class="blue-text">me</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            @php
                if (auth()->user()) {
                    $company = auth()->user()->companies()->first();
                    $routeName = Route::currentRouteName();
                }
            @endphp

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @auth
                    @if($company)
                        <li class="nav-link {{ $routeName === 'dashboard.index' ? 'active' : ''}}"><a href="{{ '/dashboard/' . $company->id }}"><i class="fas fa-home"></i></a></li>
                        <li class="nav-item {{ $routeName === 'dashboard.details' ? 'active' : ''}} dropdown">
                            <a id="navbarProviderDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fas fa-chart-bar"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarProviderDropdown">
                                <a class="dropdown-item" href="{{ '/dashboard/' . $company->id . '/details/1' }}">
                                    BHTelecom
                                </a>
                                <a class="dropdown-item" href="{{ '/dashboard/' . $company->id . '/details/2' }}">
                                    Eronet
                                </a>
                            </div>
                        </li>
                        <li class="nav-link"><a href="{{ '/dashboard/' . $company->id . '/alerts' }}"><i class="fas fa-bell"></i></a></li>
                    @endif
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
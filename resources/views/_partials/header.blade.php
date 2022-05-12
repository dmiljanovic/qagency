<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse">
        <div class="navbar-nav">
            @if(request()->session()->has('userData'))
            <a class="nav-item nav-link">
            Welocome {{ session('userData')['user']['first_name'] }} {{ session('userData')['user']['last_name'] }}
            </a>
            @endif
            <a class="nav-item nav-link" href="{{ URL::to(route('home.index')) }}">Home</a>
            @if(request()->session()->has('userData'))
            <a class="nav-item nav-link" href="{{ URL::to(route('author.index')) }}">Authors</a>
            <a class="nav-item nav-link" href="{{ URL::to(route('auth.logout')) }}">Logout</a>
            @else
            <a class="nav-item nav-link" href="{{ URL::to(route('auth.login')) }}">Login</a>
            @endif
        </div>
    </div>
</nav>

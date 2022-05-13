<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse">
        <div class="navbar-nav">
            @if(request()->session()->has('user_data'))
            <a class="nav-item nav-link">
            Welocome {{ session('user_data')['user']['first_name'] }} {{ session('user_data')['user']['last_name'] }}
            </a>
            @endif
            <a class="nav-item nav-link" href="{{ URL::to(route('home.index')) }}">Home</a>
            @if(request()->session()->has('user_data'))
            <a class="nav-item nav-link" href="{{ URL::to(route('book.index')) }}">Books</a>
            <a class="nav-item nav-link" href="{{ URL::to(route('author.index')) }}">Authors</a>
            <a class="nav-item nav-link" href="{{ URL::to(route('auth.logout')) }}">Logout</a>
            @else
            <a class="nav-item nav-link" href="{{ URL::to(route('auth.login')) }}">Login</a>
            @endif
        </div>
    </div>
</nav>

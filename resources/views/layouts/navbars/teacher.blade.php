<nav class="navbar navbar-expand-md navbar-dark bg-teacher">

    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <a class="navbar-brand" href="{{route('teachers.dashboard', ['teacher'=>\Illuminate\Support\Facades\Auth::user()->userTypeModel()])}}">
                    <img src="{{ asset("/images/iclogo1.png") }}" width="35" height="35" class="d-inline-block align-top"
                         alt="IC Challenge"> IC Challenge
                </a>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('teachers.dashboard', ['teacher'=>\Illuminate\Support\Facades\Auth::user()->userTypeModel()])}}">
                        <i class="fas fa-home"></i>
                        Home
                    </a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href=""><i class="fas fa-question"></i> Help</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('users.edit', ['user'=>Auth::user()]) }}"><i
                                class="fas fa-user"></i> Profile</></a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Sign out</>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container">
      <a class="navbar-brand text-white" href="{{ url('/')}}">Blog Management</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Category
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                    @foreach ($categories as $category)
                      <li><a class="dropdown-item" href="">{{$category->name}}</a></li>
                    @endforeach
                </ul>
            </li>

            @if(Auth()->user())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ ucfirst(Auth()->user()->name) }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                    <li><a class="dropdown-item" href="{{ route('user.dashboard')}}">User DashBoard</a></li>
                    @if(Auth::user()->is_admin)
                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin DashBoard</a></li>
                    @endif
                    <li class="dropdown-item">
                        <form class="" action="{{ route('logout')}}" method="post">
                        @csrf
                            <button class="btn text-white" type="submit">Logout</button>
                        </form>
                    </li>
                    </ul>
                </li>

            @else
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('registerForm')}}">Register</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('loginForm')}}">Login</a>
                </li>

            @endif
        </ul>

      </div>
    </div>
  </nav>

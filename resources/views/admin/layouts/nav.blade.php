  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
          <form class="form-inline" action="{{ route('logout')}}" method="post">
            @csrf
              <div class="input-group-append">
                <button class="btn btn-danger btn-sm" type="submit">Logout</button>
              </div>
          </form>

      </li>


    </ul>
  </nav>
  <!-- /.navbar -->

 <!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('/')}}alte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Admin Dasboard</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.dashboard')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard</p>
              </a>
            </li>
          </ul>
        </li>


        <li class="nav-item {{ session('lsbm') == 'categories' ? ' menu-open ' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Category
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('admin.categories.index')}}" class="nav-link {{ session('lsbsm') == 'categoriesAll' ? ' active ' : '' }}" >
                    <i class="far fa-circle nav-icon"></i>
                    <p>Categories All</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('admin.categories.create')}}" class="nav-link {{ session('lsbsm') == 'categoriesCreate' ? ' active ' : '' }}" >
                    <i class="far fa-circle nav-icon"></i>
                    <p>New Category Create</p>
                  </a>
                </li>
            </ul>
        </li>

        <li class="nav-item {{ session('lsbm') == 'posts' ? ' menu-open ' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Post
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.posts.index')}}" class="nav-link {{ session('lsbsm') == 'postsAll' ? ' active ' : '' }}" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Posts All</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.posts.create')}}" class="nav-link {{ session('lsbsm') == 'postCreate' ? ' active ' : '' }}" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Post Create</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.vedios.index')}}" class="nav-link {{ session('lsbsm') == 'vediosAll' ? ' active ' : '' }}" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vedios All</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.vedios.create')}}" class="nav-link {{ session('lsbsm') == 'vediosCreate' ? ' active ' : '' }}" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Vedio Create</p>
                </a>
              </li>
            </ul>
        </li>










      </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
  <!-- /.sidebar -->

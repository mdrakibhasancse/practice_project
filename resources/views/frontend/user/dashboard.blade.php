@extends('frontend.layouts.app')


@section('content')
   <div class="container py-5 my-5" style="min-height: 433px">
      <div class="row">
        <div class="col-md-3">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h1>Sidebar</h1>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <form class="form-inline" action="{{ route('logout')}}" method="post">
                              @csrf
                                <div class="input-group-append">
                                  <button class="btn btn-danger btn-sm" type="submit">Logout</button>
                                </div>
                            </form>

                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card shadow border-0">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <h1>Welcome To User Dashboard</h1>
                </div>
            </div>
        </div>
      </div>


   </div>
@endsection

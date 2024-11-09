
@extends('frontend.layouts.app')

@section('content')

<div class="container py-5 mt-5" style="min-height: 481px">
     <div class="row">
         <div class="col-6 offset-3">
            <div class="card shadow border-0">
                <div class="card-body login-card-body p-4">
                  <p class="login-box-msg">Sign in</p>

                  <form action="{{ route('login')}}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                      <input type="email" name="email" value="{{ old('email')}}" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                    </div>
                    <div class="input-group mb-3">
                      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                    </div>
                    <div class="row">
                      {{-- <div class="col-8">
                        <div class="icheck-primary">
                          <input type="checkbox" id="remember">
                          <label for="remember">
                            Remember Me
                          </label>
                        </div>
                      </div> --}}
                      <!-- /.col -->
                      <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                      </div>
                      <!-- /.col -->
                    </div>
                  </form>


                  <!-- /.social-auth-links -->

                  <p class="mb-1">
                    <a href="{{ route('linkRequestForm')}}">I forgot my password</a>
                  </p>
                  <p class="mb-0">
                    <a href="{{ route('registerForm')}}" class="text-center">Register a new user</a>
                  </p>
                </div>
            </div>
         </div>
     </div>
</div>
@endsection


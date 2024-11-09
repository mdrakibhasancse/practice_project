
@extends('frontend.layouts.app')

@section('content')

<div class="container py-5 mt-5" style="min-height: 481px">
     <div class="row">
         <div class="col-6 offset-3">
            <div class="card shadow border-0">
                <div class="card-body register-card-body p-4">
                  <p class="login-box-msg">Registration</p>

                  <form action="{{ route('register')}}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                      <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')}}" placeholder="Full name">
                    </div>

                    <div class="input-group mb-3">
                      <input type="email" name="email" value="{{ old('email')}}" class="form-control @error('email') is-invalid @enderror" placeholder="Email">

                    </div>

                    <div class="input-group mb-3">
                      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">

                    </div>

                    <div class="input-group mb-3">
                      <input type="password" class="form-control" name="password_confirmation" placeholder="Retype password">

                    </div>
                    <div class="row">
                      {{-- <div class="col-8">
                        <div class="icheck-primary">
                          <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                          <label for="agreeTerms">
                           I agree to the <a href="#">terms</a>
                          </label>
                        </div>
                      </div> --}}
                      <!-- /.col -->
                      <div class="col">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                      </div>
                      <!-- /.col -->
                    </div>
                  </form>

                  {{-- <div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <a href="{{ route('google.login') }}" class="btn btn-block btn-danger">
                      <i class="fab fa-google-plus mr-2"></i>
                      Sign up using Google+
                    </a>
                  </div> --}}

                  <a href="{{ route('loginForm')}}" class="text-center">I already have a register</a>
                </div>
                <!-- /.form-box -->
              </div><!-- /.card -->
         </div>
     </div>
</div>
@endsection


@extends('layouts.auth')
@section('login')
    <div class="login-box">
        <div class="login-logo">
            <img src="partials/dist/img/laravel.png" alt="Laravel Store" class="img-circle elevation-3" width="100">
            <h3 class="mt-3 font-weight-bold">Laravel Store</h3>
            <h4>Ahmad Taufik R</h4>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3 @error('email') is-invalid @enderror">
                        <input type="email" name="email" class="form-control" placeholder="Email" required value="{{ old('email') }}">
                        <div class="input-group-append" autofocus>
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                           <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-group mb-3" @error('password') is-invalid @enderror>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                           <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    @endsection

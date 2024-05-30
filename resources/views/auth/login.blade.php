@extends('layouts.app')

@section('content')

    <body>
        <div class="container">
            <div class="row justify-content-center align-items-center vh-100">
                <div class="col-8 col-md-8 col-lg-6 col-xl-4">
                    <div class="card p-3 card-login bg-light text-light shadow">
                        <div class="card-body px-4 py-3">
                            <a href="{{ route('landing') }}"
                                class="text-decoration-none   d-flex flex-column justify-content-center mb-2">
                                <img class="img-fluid" style="height: 100px;" src="{{ asset('assets/img/brain.svg') }}"
                                    alt="Goniometer Logo">
                                <strong class="text-center fw-bold h2 pt-2 pb-0">Goniometer</strong>
                                <hr class="m-0 p-0">
                            </a>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="email"
                                        class="col-12 col-form-label text-start">{{ __('Email Address') }}</label>

                                    <div class="col-12 ">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-start">{{ __('Password') }}</label>

                                    <div class="col-12">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12 ">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-12 d-flex flex-row justify-content-between">
                                        <button type="submit" class="btn btn-light">
                                            {{ __('Login') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link text-light" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
@endsection

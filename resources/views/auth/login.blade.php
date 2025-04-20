{{-- @extends('layouts.app') --}}
@extends('layouts.adminltethemenonav')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            {{-- <div class="col-md-8">

            <div class="card card-info no-radius">
                <div class="card-header no-radius">{{ __('เข้าสู่ระบบ') }}</div>

                <div class="card-body">
                    <div class="text-center mb-2">
                        <img src="{{ asset('mainpage/assets/img/logo-juristq101.jpg') }}" alt="Logo" width="200px">
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-info no-radius">
                                    {{ __('เข้าสู่ระบบ') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('register')  }}">
                                    {{ __('ลงทะเบียน') }}
                                </a>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('forget.password.get')  }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}

    </div>


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10"> <!-- เพิ่มความกว้างของคอนเทนเนอร์ -->
                <h3 class="mb-4 text-center">เข้าสู่ระบบ</h3>
                <div class="card shadow-lg border-0">
                    <div class="row g-0">
                        <div class="col-md-5 d-none d-md-flex align-items-center justify-content-center ">
                            <img src="{{ asset('mainpage/assets/img/logo-juristq101.jpg') }}" width="400px" alt="Logo" class="img-fluid ml-5">
                        </div>
    
                        <div class="col-md-7">
                            <div class="card-body p-lg-5">
                                <form method="POST" action="{{ route('login') }}" class="row g-3">
                                    @csrf
                                   
                                    <div class="col-12">
                                        <label class="form-label">{{ __('Email Address') }}<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-text bg-info text-white"><i class="fa-solid fa-user"></i></div>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                                placeholder="Enter Email Address">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
    
                                    <div class="col-12">
                                        <label class="form-label">Password<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-text bg-info text-white"><i class="fa-solid fa-lock"></i></div>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password" placeholder="Enter Password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
    
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
    
                                    <div class="col-sm-6 text-sm-end">
                                        {{-- <a class="btn btn-link p-0 text-info" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a> --}}
                                    </div>
    
                                    <div class="col-12 text-center mt-3">
                                        <button type="submit" class="btn btn-info w-100 py-2">{{ __('เข้าสู่ระบบ') }}</button>
                                        <a href="{{ route('register') }}" class="btn btn-outline-info w-100 mt-2 py-2">ลงทะเบียน</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
@endsection

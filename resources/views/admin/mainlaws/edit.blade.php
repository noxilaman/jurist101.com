@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('กฎหมาย') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('adminmainlaws.update',$mainlaw->id) }}">
                        @method('PUT')
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $mainlaw->name }}" autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Ios Id') }}</label>

                            <div class="col-md-6">
                                <input id="ios_id" type="text" class="form-control @error('ios_id') is-invalid @enderror" name="username" value="{{ $mainlaw->ios_id }}" autocomplete="ios_id" autofocus>

                                @error('ios_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="app_img" class="col-md-4 col-form-label text-md-end">{{ __('app_img') }}</label>

                            <div class="col-md-6">
                                <input id="app_img" type="text" class="form-control @error('app_img') is-invalid @enderror" name="email" value="{{ $mainlaw->app_img }}" autocomplete="app_img">

                                @error('app_img')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="store_id" class="col-md-4 col-form-label text-md-end">{{ __('store_id') }}</label>

                            <div class="col-md-6">
                                <input id="store_id" type="text" class="form-control @error('store_id') is-invalid @enderror" name="store_id" value="{{ $mainlaw->store_id }}" autocomplete="store_id">

                                @error('store_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="android_id" class="col-md-4 col-form-label text-md-end">{{ __('android_id') }}</label>

                            <div class="col-md-6">
                                <input id="android_id" type="text" class="form-control @error('android_id') is-invalid @enderror" name="android_id" value="{{ $mainlaw->android_id }}" autocomplete="android_id">

                                @error('android_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="android_store" class="col-md-4 col-form-label text-md-end">{{ __('android_store') }}</label>

                            <div class="col-md-6">
                                <input id="android_store" type="text" class="form-control @error('android_store') is-invalid @enderror" name="android_store" value="{{ $mainlaw->android_store }}" autocomplete="android_store">

                                @error('android_store')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="app_desc" class="col-md-4 col-form-label text-md-end">{{ __('app_desc') }}</label>

                            <div class="col-md-6">
                                <textarea id="app_desc" class="form-control @error('app_desc') is-invalid @enderror" name="app_desc" autocomplete="app_desc">{{ $mainlaw->app_desc }}</textarea>

                                @error('app_desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="android_desc" class="col-md-4 col-form-label text-md-end">{{ __('android_desc') }}</label>

                            <div class="col-md-6">
                                <textarea id="android_desc" class="form-control @error('android_desc') is-invalid @enderror" name="android_desc" autocomplete="android_desc">{{ $mainlaw->android_desc }}</textarea>

                                @error('app_desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="row mb-3">
                            <label for="group_app" class="col-md-4 col-form-label text-md-end">{{ __('Group') }}</label>

                            <div class="col-md-6">
                                <input id="group_app" type="text" class="form-control @error('group_app') is-invalid @enderror" name="group_app" value="{{ $mainlaw->group_app }}" autocomplete="group_app">

                                @error('group_app')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="icon_app" class="col-md-4 col-form-label text-md-end">{{ __('Icon Link img') }}</label>

                            <div class="col-md-6">
                                <input id="icon_app" type="text" class="form-control @error('icon_app') is-invalid @enderror" name="icon_app" value="{{ $mainlaw->icon_app }}" autocomplete="icon_app">

                                @error('icon_app')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="short_name" class="col-md-4 col-form-label text-md-end">{{ __('short_name') }}</label>

                            <div class="col-md-6">
                                <input id="short_name" type="text" class="form-control @error('short_name') is-invalid @enderror" name="short_name" value="{{ $mainlaw->short_name }}" autocomplete="store_id">

                                @error('short_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.theme2')

@section('content')

<form 
        id="formAccountSettings" 
        method="POST" 
        action="{{ route('profile.update',auth()->id()) }}" 
        enctype="multipart/form-data"
        class="needs-validation" 
        role="form"
        novalidate
    >
    @csrf
    <div class="card-body">
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input class="form-control" type="text" id="name" name="name" value="{{ auth()->user()->name }}" autofocus="" required>
                <div class="invalid-tooltip">{{ trans('sentence.required')}}</div>
            </div>
            <div class="mb-3 col-md-6">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input class="form-control" type="text" id="email" name="email" value="{{ auth()->user()->email }}" placeholder="john.doe@example.com">
                <div class="invalid-tooltip">{{ trans('sentence.required')}}</div>
            </div>

            <div class="mb-3 col-md-6">
                <label for="email" class="form-label">{{ __('Change New Password') }}</label>
                <input class="form-control" type="password" id="password" name="password" value="" >
                <div class="invalid-tooltip">New Password</div>
            </div>
            <div class="mt-2">
                <button type="submit" class="button-create me-2">{{ __('Update Profile') }}</button>
            </div>
        </div>
    </div>
</form>

@endsection
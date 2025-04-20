@extends('layouts.app')

@section('content')
@php
    $selectedcat = '';
    if(!empty(Request::get('currentcat'))){
        $selectedcat = Request::get('currentcat');
    }
@endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> Edit Keymap : {{ $keymap->mainlaw->name }} # {{ $keymap->id }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('adminkeymaps.update', [$keymap->app_id,$keymap->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="app_img"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Key') }}</label>

                                <div class="col-md-6">
                                    <input id="key" type="text"
                                        class="form-control @error('c_law_code') is-invalid @enderror" name="key"
                                        value="{{ $keymap->key }}" autocomplete="key">

                                    @error('key')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="android_store"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Desc') }}</label>

                                <div class="col-md-6">
                                    <textarea id="desc" 
                                        class="form-control @error('desc') is-invalid @enderror"
                                        name="desc" 
                                        autocomplete="desc">{{ $keymap->desc }}

                                    </textarea>

                                    @error('desc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-0">
                                <input type="hidden" name="status" value="Active" />
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
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

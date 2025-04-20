@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('ฎีกา') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admindekas.update',$deka->id) }}">
                            @method('PUT')
                            @csrf
                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="i_no"
                                    class="col-form-label text-md-end">{{ __('เลขฎีกา') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input id="i_no" type="number"
                                        class="form-control @error('i_no') is-invalid @enderror" name="i_no"
                                        value="{{ $deka->i_no }}" autocomplete="i_no" autofocus>

                                    @error('i_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                <label for="i_subno"
                                    class="col-form-label text-md-end">{{ __('ปีฎีกา') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input id="i_subno" type="number"
                                        class="form-control @error('i_subno') is-invalid @enderror" name="i_subno"
                                        value="{{ $deka->i_subno }}" autocomplete="i_subno" autofocus>

                                    @error('i_subno')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-12">
                                <div class="col-md-2">
                                <label for="name"
                                    class="col-form-label text-md-end">{{ __('ชื่อฎีกา') }}</label>
                                </div>
                                <div class="col-md-10">
                                    <input id="c_name" type="text"
                                        class="form-control @error('c_name') is-invalid @enderror" name="c_name"
                                        value="{{ $deka->c_name }}" autocomplete="c_name" autofocus>

                                    @error('c_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="row mb-3">
                                <div class="col-md-2">
                                <label for="c_desc"
                                    class="col-form-label text-md-end">{{ __('รายละเอียดฎีกา') }}</label>
                                </div>
                                <div class="col-md-10">
                                    <textarea id="c_desc" class="form-control @error('c_desc') is-invalid @enderror" name="c_desc"
                                        autocomplete="c_desc">{{ $deka->c_desc }}</textarea>

                                    @error('c_desc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-12">
                                <div class="col-md-2">
                                <label for="c_comments"
                                    class="col-form-label text-md-end">{{ __('รายละเอียดเพิ่มเติม') }}</label>
                                </div>
                                <div class="col-md-10">
                                    <textarea id="c_comments" class="form-control @error('c_comments') is-invalid @enderror" name="c_comments"
                                        autocomplete="c_comments">{{ $deka->c_comments }}</textarea>

                                    @error('c_comments')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-2">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Edit') }}
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

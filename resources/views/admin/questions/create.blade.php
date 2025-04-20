@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">คำถาม กฎหมาย {{ $lawdatum->mainlaw->name }} {{ $lawdatum->c_name }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('adminquestionslaw.store', $lawdata_id) }}">
                            @csrf

                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="name" class="col-form-label text-md-end">{{ __('หัวข้อ') }}</label>
                                </div>
                                <div class="col-md-10">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="detail" class="col-form-label text-md-end">{{ __('โจทย์') }}</label>
                                </div>
                                <div class="col-md-10">
                                    <textarea id="detail" class="form-control @error('detail') is-invalid @enderror" name="detail">{{ old('detail') }}</textarea>

                                    @error('detail')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="answer" class="col-form-label text-md-end">{{ __('คำตอบ') }}</label>
                                </div>
                                <div class="col-md-10">
                                    <textarea id="answer" class="form-control @error('answer') is-invalid @enderror" name="answer">{{ old('answer') }}</textarea>

                                    @error('answer')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="comments"
                                        class="col-form-label text-md-end">{{ __('รายละเอียดเพิ่มเติม') }}</label>
                                </div>
                                <div class="col-md-10">
                                    <textarea id="comments" class="form-control @error('comments') is-invalid @enderror" name="comments"
                                        autocomplete="comments">{{ old('comments') }}</textarea>

                                    @error('comments')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-2">
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

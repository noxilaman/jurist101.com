@extends('layouts.app')

@section('content')
@php
    $selectedcat = $lawcat->i_parent_id;

@endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('กฎหมาย') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('adminlawcat.data.update', [$tbapp->id,$lawcat->i_id]) }}">
                            @method('PUT')
                            @csrf

                            <div class="row mb-3">
                                <label for="c_name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="c_name" type="text"
                                        class="form-control @error('c_name') is-invalid @enderror" name="c_name"
                                        value="{{ $lawcat->c_name }}" autocomplete="c_name" autofocus>

                                    @error('c_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="i_parent_id"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Parent') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control @error('i_parent_id') is-invalid @enderror" id="i_parent_id"
                                        name="i_parent_id">
                                        <option value="">Select</option>
                                        @foreach ($tbLawCat as $item0)
                                            <option value="{{ $item0->i_id }}"
                                            @if ($selectedcat == $item0->i_id)
                                                 selected
                                            @endif
                                            >{{ $item0->c_name }}</option>
                                            @if ($item0->subcats()->count() > 0)
                                                @foreach ($item0->subcats()->orderBy('i_seq', 'asc')->get() as $item1)
                                                    <option value="{{ $item1->i_id }}"
                                                        @if ($selectedcat == $item1->i_id)
                                                             selected
                                                        @endif
                                                        >--{{ $item1->c_name }}</option>
                                                    @if ($item1->subcats()->count() > 0)
                                                        @foreach ($item1->subcats()->orderBy('i_seq', 'asc')->get() as $item2)
                                                            <option value="{{ $item2->i_id }}"
                                                                @if ($selectedcat == $item2->i_id)
                                                                     selected
                                                                @endif
                                                                >----{{ $item2->c_name }}
                                                            </option>
                                                            @if ($item2->subcats()->count() > 0)
                                                                @foreach ($item2->subcats()->orderBy('i_seq', 'asc')->get() as $item3)
                                                                    <option value="{{ $item3->i_id }}"
                                                                        @if ($selectedcat == $item3->i_id)
                                                                             selected
                                                                        @endif
                                                                        >
                                                                        ------{{ $item3->c_name }}
                                                                    </option>
                                                                    @if ($item3->subcats()->count() > 0)
                                                                        @foreach ($item3->subcats()->orderBy('i_seq', 'asc')->get() as $item4)
                                                                            <option value="{{ $item4->i_id }}"
                                                                                @if ($selectedcat == $item4->i_id)
                                                                                     selected
                                                                                @endif
                                                                                >
                                                                                --------{{ $item4->c_name }}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('i_parent_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="app_img"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Law code') }}</label>

                                <div class="col-md-6">
                                    <input id="c_law_code" type="text"
                                        class="form-control @error('c_law_code') is-invalid @enderror" name="c_law_code"
                                        value="{{ $lawcat->c_law_code }}" autocomplete="c_law_code">

                                    @error('c_law_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="android_store"
                                    class="col-md-4 col-form-label text-md-end">{{ __('i_seq') }}</label>

                                <div class="col-md-6">
                                    <input id="i_seq" type="number"
                                        class="form-control @error('i_seq') is-invalid @enderror"
                                        name="i_seq" value="{{ $lawcat->i_seq }}"
                                        autocomplete="i_seq">

                                    @error('i_seq')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="c_desc"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Desc') }}</label>

                                <div class="col-md-6">
                                    <textarea id="c_desc" class="form-control @error('c_desc') is-invalid @enderror" name="c_desc"
                                        autocomplete="c_desc">{{ $lawcat->c_desc }}</textarea>

                                    @error('c_desc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
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

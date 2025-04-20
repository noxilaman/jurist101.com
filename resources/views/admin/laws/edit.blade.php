@extends('layouts.app')

@section('content')
    @php
        $selectedcat = '';
        if (!empty($lawdata->i_lawcat)) {
            $selectedcat = $lawdata->i_lawcat;
        }
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('กฎหมาย') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admindata.update', [$tbapp->id, $lawdata->i_id]) }}">
                            @method('PUT')
                            @csrf

                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="i_lawcat" class="col-form-label text-md-end">{{ __('หัวข้อ') }}</label>

                                </div>
                                <div class="col-md-10">
                                    <input type="hidden" id="i_app" name="i_app" value="{{ $tbapp->id }}">

                                    <select class="form-control @error('i_lawcat') is-invalid @enderror" id="i_lawcat"
                                        name="i_lawcat">
                                        <option value="">Select</option>
                                        @foreach ($tbLawCat as $item0)
                                            <option value="{{ $item0->i_id }}"
                                                @if ($selectedcat == $item0->i_id) selected @endif>{{ $item0->c_name }}
                                            </option>
                                            @if ($item0->subcats()->count() > 0)
                                                @foreach ($item0->subcats()->orderBy('i_seq', 'asc')->get() as $item1)
                                                    <option value="{{ $item1->i_id }}"
                                                        @if ($selectedcat == $item1->i_id) selected @endif>
                                                        --{{ $item1->c_name }}</option>
                                                    @if ($item1->subcats()->count() > 0)
                                                        @foreach ($item1->subcats()->orderBy('i_seq', 'asc')->get() as $item2)
                                                            <option value="{{ $item2->i_id }}"
                                                                @if ($selectedcat == $item2->i_id) selected @endif>
                                                                ----{{ $item2->c_name }}
                                                            </option>
                                                            @if ($item2->subcats()->count() > 0)
                                                                @foreach ($item2->subcats()->orderBy('i_seq', 'asc')->get() as $item3)
                                                                    <option value="{{ $item3->i_id }}"
                                                                        @if ($selectedcat == $item3->i_id) selected @endif>
                                                                        ------{{ $item3->c_name }}
                                                                    </option>
                                                                    @if ($item3->subcats()->count() > 0)
                                                                        @foreach ($item3->subcats()->orderBy('i_seq', 'asc')->get() as $item4)
                                                                            <option value="{{ $item4->i_id }}"
                                                                                @if ($selectedcat == $item4->i_id) selected @endif>
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

                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="i_no" class="col-form-label text-md-end">{{ __('เลขมาตรา') }}</label>

                                </div>
                                <div class="col-md-4">
                                    <input id="i_no" type="number"
                                        class="form-control @error('i_no') is-invalid @enderror" name="i_no"
                                        value="{{ $lawdata->i_no }}" autocomplete="i_no" autofocus>

                                    @error('i_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="i_subno"
                                        class="col-form-label text-md-end">{{ __('เลขย่อยมาตรา') }}</label>

                                </div>
                                <div class="col-md-4">
                                    <input id="i_subno" type="number"
                                        class="form-control @error('i_subno') is-invalid @enderror" name="i_subno"
                                        value="{{ $lawdata->i_subno }}" autocomplete="i_subno" autofocus>

                                    @error('i_subno')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label for="i_lawno" class="col-form-label text-md-end">{{ __('เลขมาตรา') }}</label>

                                </div>
                                <div class="col-md-4">
                                    <input id="i_lawno" type="number"
                                        class="form-control @error('i_lawno') is-invalid @enderror" name="i_subno"
                                        value="{{ $lawdata->i_lawno }}" autocomplete="i_lawno" autofocus>

                                    @error('i_lawno')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="name" class="col-form-label text-md-end">{{ __('ชื่อมาตรา') }}</label>

                                </div>
                                <div class="col-md-10">
                                    <input id="c_name" type="text"
                                        class="form-control @error('c_name') is-invalid @enderror" name="c_name"
                                        value="{{ $lawdata->c_name }}" autocomplete="c_name" autofocus>

                                    @error('c_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="short_note" class="col-form-label text-md-end">มาตราอย่างย่อ</label>

                                </div>
                                <div class="col-md-10">
                                    <input id="short_note" type="text"
                                        class="form-control @error('short_note') is-invalid @enderror" name="short_note"
                                        value="{{ $lawdata->short_note }}" autocomplete="short_note" autofocus>

                                    @error('short_note')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="c_url" class="col-form-label text-md-end">{{ __('link ภาพ') }}</label>

                                </div>
                                <div class="col-md-10">
                                    <input id="c_url" type="text"
                                        class="form-control @error('c_url') is-invalid @enderror" name="username"
                                        value="{{ $lawdata->c_url }}" autocomplete="c_url" autofocus>

                                    @error('c_url')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="c_desc"
                                        class="col-form-label text-md-end">{{ __('รายละเอียดมาตรา') }}</label>

                                </div>
                                <div class="col-md-10">
                                    <textarea id="c_desc" class="form-control @error('c_desc') is-invalid @enderror" name="c_desc"
                                        autocomplete="c_desc">{{ $lawdata->c_desc }}</textarea>

                                    @error('c_desc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="c_comment"
                                        class="col-form-label text-md-end">{{ __('รายละเอียดเพิ่มเติม') }}</label>

                                </div>
                                <div class="col-md-10">
                                    <textarea id="c_comment" class="form-control @error('c_comment') is-invalid @enderror" name="c_comment"
                                        autocomplete="c_comment">{{ $lawdata->c_comment }}</textarea>

                                    @error('c_comment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="important_keys"
                                        class="col-form-label text-md-end">{{ __('คำสำคัญ ใส่คั่นด้วย , ') }}</label>

                                </div>
                                <div class="col-md-10">
                                    <input id="important_keys" type="text"
                                        class="form-control @error('important_keys') is-invalid @enderror"
                                        name="important_keys" value="{{ $lawdata->important_keys }}"
                                        autocomplete="c_url" autofocus>

                                    @error('important_keys')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            



                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="external_factor"
                                        class="col-form-label text-md-end">{{ __('องค์ประกอบภายนอก/คำอธิบาย') }}</label>

                                </div>
                                <div class="col-md-10">
                                    <textarea id="external_factor" class="form-control @error('external_factor') is-invalid @enderror"
                                        name="external_factor" autocomplete="external_factor">{{ $lawdata->external_factor }}</textarea>

                                    @error('external_factor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="internal_factor"
                                        class="col-form-label text-md-end">{{ __('องค์ประกอบภายใน') }}</label>

                                </div>
                                <div class="col-md-10">
                                    <textarea id="internal_factor" class="form-control @error('internal_factor') is-invalid @enderror"
                                        name="internal_factor" autocomplete="internal_factor">{{ $lawdata->internal_factor }}</textarea>

                                    @error('internal_factor')
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

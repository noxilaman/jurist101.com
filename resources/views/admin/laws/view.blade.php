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
                                <div class="col-md-4">{{ $lawdata->i_no }}
                                </div>
                            </div>

                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="i_subno"
                                        class="col-form-label text-md-end">{{ __('เลขย่อยมาตรา') }}</label>

                                </div>
                                <div class="col-md-4">{{ $lawdata->i_subno }}
                                </div>
                                <div class="col-md-2">
                                    <label for="i_lawno" class="col-form-label text-md-end">{{ __('เลขมาตรา') }}</label>

                                </div>
                                <div class="col-md-4">{{ $lawdata->i_lawno }}</div>
                            </div>

                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="name" class="col-form-label text-md-end">{{ __('ชื่อมาตรา') }}</label>

                                </div>
                                <div class="col-md-10">{{ $lawdata->c_name }}
                                </div>
                            </div>

                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="c_url" class="col-form-label text-md-end">{{ __('link ภาพ') }}</label>

                                </div>
                                <div class="col-md-10">{{ $lawdata->c_url }}
                                </div>
                            </div>

                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="c_desc"
                                        class="col-form-label text-md-end">{{ __('รายละเอียดมาตรา') }}</label>

                                </div>
                                <div class="col-md-10">{!! $lawdata->c_desc !!}
                                </div>
                            </div>

                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="c_comment"
                                        class="col-form-label text-md-end">{{ __('รายละเอียดเพิ่มเติม') }}</label>

                                </div>
                                <div class="col-md-10">{!! $lawdata->c_comment !!}
                                </div>
                            </div>

                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="important_keys"
                                        class="col-form-label text-md-end">{{ __('คำสำคัญ ใส่คั่นด้วย , ') }}</label>

                                </div>
                                <div class="col-md-10">{{ $lawdata->important_keys }}
                                </div>
                            </div>

                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="external_factor"
                                        class="col-form-label text-md-end">{{ __('องค์ประกอบภายนอก/คำอธิบาย') }}</label>

                                </div>
                                <div class="col-md-10">{!! $lawdata->external_factor !!}
                                </div>
                            </div>
                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="internal_factor"
                                        class="col-form-label text-md-end">{{ __('องค์ประกอบความผิดภายใน') }}</label>

                                </div>
                                <div class="col-md-10">{!! $lawdata->internal_factor !!}
                                </div>
                            </div>



                            

                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="short_note" class="col-form-label text-md-end">มาตราอย่างย่อ</label>

                                </div>
                                <div class="col-md-10">
                                    {!! $lawdata->short_note !!}
                                </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

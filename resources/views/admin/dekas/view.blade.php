@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('ฎีกา') }}</div>

                    <div class="card-body">
                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="i_no"
                                    class="col-form-label text-md-end">{{ __('เลขฎีกา') }}</label>
                                </div>
                                <div class="col-md-4">{{ $deka->i_no }}
                                </div>
                                <div class="col-md-2">
                                <label for="i_subno"
                                    class="col-form-label text-md-end">{{ __('ปีฎีกา') }}</label>
                                </div>
                                <div class="col-md-4">{{ $deka->i_subno }}
                                </div>
                            </div>
                            <div class="row mb-12">
                                <div class="col-md-2">
                                <label for="name"
                                    class="col-form-label text-md-end">{{ __('ชื่อฎีกา') }}</label>
                                </div>
                                <div class="col-md-10">{{ $deka->c_name }}
                                </div>
                            </div>

                    

                            <div class="row mb-3">
                                <div class="col-md-2">
                                <label for="c_desc"
                                    class="col-form-label text-md-end">{{ __('รายละเอียดฎีกา') }}</label>
                                </div>
                                <div class="col-md-10">{!! $deka->c_desc !!}
                                </div>
                            </div>

                            <div class="row mb-12">
                                <div class="col-md-2">
                                <label for="c_comment"
                                    class="col-form-label text-md-end">{{ __('รายละเอียดเพิ่มเติม') }}</label>
                                </div>
                                <div class="col-md-10">{!! $deka->c_comment !!}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

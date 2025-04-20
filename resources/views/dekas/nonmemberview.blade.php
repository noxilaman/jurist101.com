@extends('layouts.nonmembertheme')
@push('style')
    <style>
        .card-content {
            position: relative;
            padding: 15px;
            margin-bottom: 15px;
        }

        .bookmark-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: transparent;
            border: none;
            color: #e6c400;
            font-size: 20px;
            cursor: pointer;
        }

        .bookmark-btn:hover {
            color: #e6c400;
        }
    </style>
@endpush
@section('content')
    <div class="law-content-text">
        <div class="row">
            <div class="col-md-12">
                <div class="masonry-item col-md-12">
                    <div class="card p-4" id="mainlaw">
                        <h1 class="mb-3">คำพิพากษาศาลฎีกา</h1>
                        <h3 class="c-grey-900 mb-3">{{ $lawdata->c_name }}  <a
                            href="{{ url('/sharedekaview/' . $lawdata->id. '/' . $lawdata->i_no) }}"
                            class="btn btn-primary no-radius" target="_blank" rel="noopener noreferrer"><i
                                class="far fa-bookmark text-white mr-1"></i> Share </a></h3></h3>

                        <div class="tab-content" id="myTabContent" style="background-color: #ffffff; overflow-y: auto;">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-all" type="button" role="tab">คำพิพากษาศาลฎีกา</button>
                                    <button class="nav-link" id="nav-pang-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-pang" type="button" role="tab">มาตรา</button>
                                </div>
                            </nav>

                            <div class="tab-content m-2"" id="nav-tabContent"
                                style=" height: calc( 100vh - 200px); overflow-y: auto;">
                                <div class="tab-pane fade show active" id="nav-all">
                                    {!! $lawdata->c_desc !!}
                                    <br/>
                            {!! $lawdata->c_comment !!}
                                </div>
                                <div class="tab-pane fade" id="nav-pang" role="tabpanel">
                                    <a href="{{ url('/login/' ) }}"
                                        class="btn btn-primary no-radius">เข้าสู่ระบบ</a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
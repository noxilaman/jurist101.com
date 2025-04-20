@extends('layouts.themenonavshare')
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
                        <a href="{{ url('/') }}" class="brand-link">
                            <img src="{{ asset('jurist-logo.png') }}" alt="JURIST 101"
                                class="brand-image img-circle elevation-1" style="opacity: .8">
                            <span class="brand-text font-weight-light">JURIST 101</span>
                        </a>
                        <h1 class="mb-3">คำพิพากษาศาลฎีกา</h1>
                        <h3 class="c-grey-900 mb-3">{{ $lawdata->c_name }}</h3>
                        <div class="sharethis-inline-share-buttons"></div>
                        <div class="tab-content" id="myTabContent" style="background-color: #ffffff; overflow-y: auto;">

                            <div class="tab-content m-2"" id="nav-tabContent"
                                style=" height: calc( 100vh - 200px); overflow-y: auto;">
                                <div class="tab-pane fade show active" id="nav-all">
                                    {!! $lawdata->c_desc !!}
                                    <br/>
                            {!! $lawdata->c_comment !!}
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
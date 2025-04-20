@extends('layouts.adminltetheme')

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
    <section class="content">

        <h2 class="text-center display-4"><i class="fa-solid fa-scale-balanced"></i> JURIST 101</h2>

        <form action="{{ route('advancesearch') }}" method="GET">
            <div class="input-group w-100">
                @csrf
                <div class="input-group-prepend">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary btn-lg dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-sliders"></i>
                    </button>

                    <div class="dropdown-menu mt-2" aria-labelledby="btnGroupDrop1">
                        <label class="m-2" for="category">เลือกกลุ่มกฏหมาย:</label>
                        {{-- @foreach ($mainapps as $key => $mainitems)
                            <div class="form-check m-2">
                                <input class="form-check-input" type="checkbox"
                                    value="{{ strlen($key) > 0 ? $key : 'ว่าง' }}" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ strlen($key) > 0 ? $key : 'ว่าง' }}
                                </label>
                            </div>
                        @endforeach --}}
                    </div>
                </div>


                <input type="text" class="form-control form-control-lg" name='searchTxt' placeholder="พิมพ์คำค้นหาที่นี่"
                    minlength="3" required value="{{ $searchTxt }}">

                <div class="input-group-append">
                    {{-- reset search button --}}
                    <a href="{{ route('search') }}" class="btn btn-lg btn-default" title="ล้างค่า">
                        <i class="fa-solid fa-arrows-rotate"></i>
                    </a>
                    {{-- Advanced Search button --}}
                    <button type="submit" class="btn btn-lg btn-default" title="ค้นหา">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>



        <div class="col-md-12 mt-2">
            <div class="tab-content" id="myTabContent" style="background-color: #ffffff; overflow-y: auto;">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-all"
                            type="button" role="tab">ทั้งหมด</button>
                        <button class="nav-link" id="nav-pang-tab" data-bs-toggle="tab" data-bs-target="#nav-pang"
                            type="button" role="tab">แพ่ง</button>
                        <button class="nav-link" id="nav-viPang-tab" data-bs-toggle="tab" data-bs-target="#nav-viPang"
                            type="button" role="tab">วิแพ่ง</button>
                        <button class="nav-link" id="nav-deka-tab" data-bs-toggle="tab" data-bs-target="#nav-deka"
                            type="button" role="tab">ฏีกา</button>
                    </div>
                </nav>
                <div class="tab-content m-2" id="nav-tabContent" style=" height: calc( 100vh - 200px); overflow-y: auto;">
                    <div class="tab-pane fade show active" id="nav-all">
                        @foreach ($allLaws as $allLaw)
                            <div class="card card-content">
                                <a href="{{ url('/lawview/'.$allLaw->i_id.'/'.$allLaw->c_name) }}" style="color: black"><strong>{{ $allLaw->mainlaw->name }}</strong>
                                    <u>{{ $allLaw->c_name }}</u>
                                </a>
                                {!! $allLaw->c_desc !!}
                                <button class="bookmark-btn position-absolute" title="Bookmark">
                                    <i class="fa fa-bookmark"></i>
                                </button>
                            </div>
                        @endforeach
                        {{ $allLaws->appends(['dekaLaws' => $dekaLaws->currentPage()])->links() }}
                    </div>

                    <div class="tab-pane fade" id="nav-arya" role="tabpanel">Profile</div>
                    <div class="tab-pane fade" id="nav-pang" role="tabpanel">Contact</div>
                    <div class="tab-pane fade" id="nav-viPang" role="tabpanel">nav-viPang</div>
                    <div class="tab-pane fade" id="nav-deka" role="tabpanel">
                        @foreach ($dekaLaws as $dekaLaw)
                            <div class="card card-content">
                                <a href="{{ url('/dekaview/'.$dekaLaw->id.'/'.str_replace("/", "_",$dekaLaw->c_name)) }}" style="color: black"><strong>{{ $dekaLaw->c_name }}</strong>
                                    <u></u>
                                </a>
                                {!! $dekaLaw->c_desc !!}
                                <button class="bookmark-btn position-absolute" title="Bookmark">
                                    <i class="fa fa-bookmark"></i>
                                </button>
                            </div>
                        @endforeach
                        {{ $dekaLaws->appends(['allLawPage' => $allLaws->currentPage()])->links() }}
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection

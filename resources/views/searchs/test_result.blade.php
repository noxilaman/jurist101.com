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
            color: #15919a;
            font-size: 20px;
            cursor: pointer;
        }

        .bookmark-btn:hover {

            background-color: #ffd900;
        }
    </style>
@endpush

@section('content')
    <section class="content">
        <div class="container-fluid">

            <h2 class="text-center"><i class="fa-solid fa-scale-balanced"></i> JURIST 101</h2>


            <div class="input-group w-100">

                <div class="input-group-prepend">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary btn-lg dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-sliders"></i>
                    </button>

                    <div class="dropdown-menu mt-2" aria-labelledby="btnGroupDrop1">
                        <label class="m-2" for="category">เลือกกลุ่มกฏหมาย:</label>

                    </div>
                </div>

                <input type="text" id="searchTxt" class="form-control form-control-lg" name="searchTxt"
                    placeholder="พิมพ์คำค้นหาที่นี่" minlength="3" required value="{{ $searchTxt }}">


                <div class="input-group-append">
                    <a href="{{ route('search') }}" class="btn btn-lg btn-default" title="ล้างค่า">
                        <i class="fa-solid fa-arrows-rotate"></i>
                    </a>
                    <button type="submit" class="btn btn-lg btn-default" title="ค้นหา" onclick="submitForm('')">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>

            <div class="nav nav-tabs mt-2">
                <button class="nav-link mr-1 {{ $searchType == '' ? 'active' : '' }}" type="button"
                    onclick="submitForm(' ')">ทั้งหมด</button>

                <button class="nav-link mr-1 {{ $searchType == 'ประมวลกฎหมายอาญา' ? 'active' : '' }}" type="button"
                    onclick="submitForm('ประมวลกฎหมายอาญา')">อาญา</button>

                <button class="nav-link mr-1 {{ $searchType == 'ประมวลกฎหมายวิธีพิจารณาความอาญา' ? 'active' : '' }}"
                    type="button" onclick="submitForm('ประมวลกฎหมายวิธีพิจารณาความอาญา')">วิอาญา</button>

                <button class="nav-link mr-1 {{ $searchType == 'ประมวลกฎหมายแพ่งและพาณิชย์' ? 'active' : '' }}"
                    type="button" onclick="submitForm('ประมวลกฎหมายแพ่งและพาณิชย์')">แพ่ง</button>

                <button class="nav-link mr-1 {{ $searchType == 'ประมวลกฎหมายวิธีพิจารณาความแพ่ง' ? 'active' : '' }}"
                    type="button" onclick="submitForm('ประมวลกฎหมายวิธีพิจารณาความแพ่ง')">วิแพ่ง</button>

                <button class="nav-link mr-1 {{ $searchType == 'พระราชบัญญัติ' ? 'active' : '' }}" type="button"
                    onclick="submitForm('พระราชบัญญัติ')">พระราชบัญญัติ</button>

                <button class="nav-link mr-1 {{ $searchType == 'รัฐธรรมนูญ' ? 'active' : '' }}" type="button"
                    onclick="submitForm('รัฐธรรมนูญ')">รัฐธรรมนูญ</button>

                <button class="nav-link mr-1 {{ $searchType == 'พระราชกําหนด' ? 'active' : '' }}" type="button"
                    onclick="submitForm('พระราชกําหนด')">พระราชกําหนด</button>

                <button class="nav-link mr-1 {{ $searchType == 'deka' ? 'active' : '' }}" type="button"
                    onclick="submitForm('deka')">ฏีกา</button>

                <button class="nav-link mr-1 {{ $searchType == 'other' ? 'active' : '' }}" type="button"
                    onclick="submitForm('other')">อื่น ๆ </button>
            </div>

            <div class="tab-content mt-1" id="nav-tabContent" style=" height: calc( 100vh - 300px); overflow-y: auto;">
                <div class="tab-pane fade show active" id="nav-all">

                    @if (!empty($mainLaws) && $mainLaws->count() > 0)
                        @if ($searchType == 'deka')
                            @foreach ($mainLaws as $mainLaw)
                                <div class="card card-content">
                                    <a href="{{ url('/dekaview/' . $mainLaw->id . '/' . str_replace('/', '_', $mainLaw->c_name)) }}"
                                        style="color: black">
                                        <strong>{{ $mainLaw->c_name }}</strong>
                                        <u></u>
                                    </a>
                                    {!! $mainLaw->c_desc !!}
                                    <a href="{{ route('bookmarks.adddeka2bookmark', $mainLaw->id) }}"><i
                                            class="far fa-bookmark text-info bookmark-btn position-absolute"></i></a>
                                </div>
                            @endforeach
                        @else
                            @foreach ($mainLaws as $mainLaw)
                                <div class="card card-content">
                                    <a href="{{ url('/lawview/' . $mainLaw->i_id . '/' . str_replace('/', '_', $mainLaw->c_name))."?searchtext=".$searchTxt }}"
                                        style="color: black">
                                        <strong>{{ $mainLaw->mainlaw->name }}</strong>
                                        <u>{{ $mainLaw->c_name }}</u>
                                    </a>
                                    
                                    @if (isset($searchTxt))
                                        @php
                                            $splitTxt = explode(',', $searchTxt);
                                            foreach($splitTxt as $txt){
                                                $keyword = $txt;
                                                $highlighted = str_replace(
                                                    $keyword,
                                                    "<strong style='background-color: #ffff00;'>$keyword</strong>",
                                                    $mainLaw->c_desc,
                                                );
                                                $highlighted = nl2br($highlighted);
                                            }
                                            // $keyword = $searchTxt;
                                            // $highlighted = str_replace(
                                            //     $keyword,
                                            //     "<strong style='background-color: #ffff00;'>$keyword</strong>",
                                            //     $mainLaw->c_desc,
                                            // );
                                            // $highlighted = nl2br($highlighted);
                                        @endphp

                                        <p> {!! $highlighted !!}</p>
                                    @else
                                        <p> {!! $mainLaw->c_desc !!}</p>
                                    @endif

                                    <a href="{{ route('bookmarks.addlaw2bookmark', $mainLaw->i_id) }}"><i
                                            class="far fa-bookmark bookmark-btn position-absolute"></i></a>

                                </div>
                            @endforeach
                        @endif
                        <div class="my-2">
                            {{ $mainLaws->appends(['type' => $searchType, 'searchTxt' => $searchTxt])->links() }}
                        </div>
                    @else
                        <div class="card card-content">

                            ไม่พบข้อมูล
                        </div>
                    @endif
                </div>

                <script>
                    function submitForm(searchType) {
                        // Get the value from the search box
                        var searchValue = document.getElementById('searchTxt').value;

                        // Define the base URL for your search route
                        var baseUrl = "{{ route('searchact', []) }}";

                        // Create the full URL with search type and search value as query parameters
                        var url = new URL(baseUrl, window.location.origin);
                        url.searchParams.set('type', searchType);
                        url.searchParams.set('searchTxt', searchValue);

                        // Redirect to the constructed URL
                        window.location.href = url.toString();
                    }
                </script>
    </section>
@endsection

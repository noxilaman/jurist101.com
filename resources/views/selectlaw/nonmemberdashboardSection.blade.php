{{-- @extends('layouts.theme2') --}}
@extends('layouts.nonmembertheme')

@push('style')
    <style>
        .content-preview {
            position: relative;
            padding-bottom: 1.5em;
            /* เพิ่มที่ว่างสำหรับปุ่ม */
        }

        .preview-text {
            display: inline;
        }
    </style>
@endpush

@section('content')
    <div class="law-content-text">
        <div class="row my-2">
            <div class="col">
                <h1>{{ $mainapp->name }}</h1>
            </div>
            <div class="col mt-2">
                <a href="{{ route('selectlaw.nonmemberindexCatSection', [$mainapp->id]) }}" class="btn btn-secondary">ตามมาตรา</a>
                <a href="{{ route('selectlaw.nonmemberdashboard', [$mainapp->id]) }}" class="btn btn-secondary">ตามหัวข้อ</a>
            </div>
        </div>


        <div class="card p-4">
            <form action="{{ route('selectlaw.nonmemberindexCatSection', [$mainapp->id]) }}" method="GET">
                <div class="input-group w-100 mb-2">
                    @csrf
                    <div class="input-group-prepend">
                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary btn-lg dropdown-toggle"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-sliders"></i>
                        </button>

                        <div class="dropdown-menu m-2" aria-labelledby="btnGroupDrop1">
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
                    <input type="text" id="searchTxt" class="form-control form-control-lg" name="searchTxt"
                        placeholder="พิมพ์คำค้นหาที่นี่" minlength="3" required value="{{ $searchTxt }}">

                    <div class="input-group-append">
                        <a href="{{ route('selectlaw.nonmemberindexCatSection', [$mainapp->id]) }}" class="btn btn-lg btn-default"
                            title="ล้างค่า">
                            <i class="fa-solid fa-arrows-rotate"></i>
                        </a>
                        <button type="submit" class="btn btn-lg btn-default" title="ค้นหา" onclick="submitForm('')">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            @foreach ($mainLaws as $mainLaw)
                <div class="card-content">
                    <i class="nav-icon fas fa-tachometer-alt text-info"></i>
                    <a href="{{ url('/nonmember/lawview/' . $mainLaw->i_id . '/' . $mainLaw->c_name) }}" style="color: black">
                        <strong>{{ $mainLaw->c_name }}</strong>
                        <u></u>
                    </a>
                    <ul>

                        @php
                        if (isset($searchTxt)) {
                            $keyword = $searchTxt;
                    
                            // ไฮไลต์คำในข้อความต้นฉบับ
                            $highlighted = str_replace(
                                $keyword,
                                "<strong style='background-color: #ffff00;'>$keyword</strong>",
                                $mainLaw->c_desc
                            );
                    
                            // จำกัดความยาวข้อความและไฮไลต์คำในข้อความที่ถูกตัด
                            $excerpt = Str::limit(strip_tags($mainLaw->c_desc), 200);
                            $highlighted_limit = str_replace(
                                $keyword,
                                "<strong style='background-color: #ffff00;'>$keyword</strong>",
                                $excerpt
                            );
                        } else {
                            $highlighted = $mainLaw->c_desc;
                            $highlighted_limit = Str::limit(strip_tags($mainLaw->c_desc), 200);
                        }
                    @endphp

                        <div class="content-preview">
                            <span class="preview-text">
                                {!! $highlighted_limit !!}
                            </span>
                            @if (strlen(strip_tags($highlighted)) > 200)
                                <span class="dots">...</span>
                                <span class="more-content d-none"> {!! $highlighted !!} </span>
                                <button class="btn btn-link btn-sm read-more">เพิ่มเติม</button>
                            @endif
                        </div>
                    </ul>
                </div>
            @endforeach
            <div class="pagination-wrapper"> {!! $mainLaws->appends(['search' => Request::get('search')])->render() !!} </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll(".read-more").forEach(button => {
                    button.addEventListener("click", function() {
                        const contentPreview = this.previousElementSibling; // .more-content
                        const dots = contentPreview.previousElementSibling; // .dots
                        const previewText = contentPreview.previousElementSibling
                            .previousElementSibling; // .preview-text

                        if (contentPreview.classList.contains("d-none")) {
                            contentPreview.classList.remove("d-none");
                            previewText.style.display = "none";
                            dots.style.display = "none";
                            this.textContent = "อ่านน้อยลง";
                        } else {
                            contentPreview.classList.add("d-none");
                            previewText.style.display = "inline";
                            dots.style.display = "inline";
                            this.textContent = "อ่านเพิ่มเติม";
                        }
                    });
                });
            });
        </script>
    @endsection

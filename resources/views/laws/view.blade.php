{{-- @extends('layouts.theme2') --}}
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
    <div class="law-content-text">
        <div class="row">
            <div class="col-md-12">
                <div class="masonry-item col-md-12">
                    <div class="card p-4" id="mainlaw">
                        <h1 class="mb-3">กฎหมาย {{ $lawdata->mainlaw->name }} </h1>
                        <h3 class="c-grey-900 mb-3">{{ $lawdata->c_name }} {{ $lawdata->short_name }} <a
                                href="{{ url('/bookmarks/addlaw2bookmark/' . $lawdata->i_id) }}"
                                class="btn btn-primary no-radius" rel="noopener noreferrer"><i
                                    class="far fa-bookmark text-white mr-1"></i> Add to Bookmark</a> <a
                                    href="{{ url('/sharelawview/' . $lawdata->i_id. '/' . $lawdata->i_no) }}"
                                    class="btn btn-primary no-radius" target="_blank" rel="noopener noreferrer"><i
                                        class="far fa-bookmark text-white mr-1"></i> Share </a></h3>


                        <div class="tab-content" id="myTabContent" style="background-color: #ffffff; overflow-y: auto;">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-all" type="button" role="tab">มาตรา</button>

                                    <button class="nav-link" id="nav-pang-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-pang" type="button" role="tab">คำอธิบาย</button>
                                    <button class="nav-link" id="nav-viPang-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-deka" type="button" role="tab">คำพิพากษาศาลฎีกา</button>
                                        <button class="nav-link" id="nav-viPang-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-viPang" type="button" role="tab">คำถาม</button>
                                </div>
                            </nav>

                            @php
                                $keyword_highlighted = $lawdata->c_desc;

                                foreach ($keymaps as $keymap) {
                                    $text = strip_tags($keymap->desc);

                                    $keyword_highlighted = str_replace(
                                        $keymap->key,
                                        "<a style='color: #1454e8;' data-bs-toggle='tooltip' data-bs-placement='top' title='{$text}'>$keymap->key</a>",
                                        $keyword_highlighted,
                                    );
                                }
                            @endphp


                            <div class="tab-content m-2" id="nav-tabContent"
                                style=" height: calc( 100vh - 200px); overflow-y: auto;">
                                <div class="tab-pane fade show active" id="nav-all">
                                    {{-- {!! $lawdata->c_desc !!}<br /> --}}
                                    
                                    {!! $keyword_highlighted !!}<br />

                                    {{-- {!! $lawdata->c_comment !!} --}}
                                </div>
                                <div class="tab-pane fade" id="nav-pang" role="tabpanel">
                                    <h3 class="mb-5">คำอธิบาย {{ $lawdata->c_name }} {{ $lawdata->short_name }} </h3>
                                    <div class="mt-5">
                                        {!! $lawdata->external_factor !!}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-viPang" role="tabpanel">
                                    <h3 class="mb-5">คำถาม {{ $lawdata->c_name }} {{ $lawdata->short_name }} </h3>
                                    @if (isset($lawdata->questions) && $lawdata->questions->count() > 0)
                                        @foreach ($lawdata->questions()->get()->sortByDesc('question.i_seq') as $questionitem)
                                            <div class="mt-5 border">
                                                <b>คำถาม:</b> {!! $questionitem->detail !!} 
                                                <button class="btn btn-primary"
                                                    onclick="toggleAnswer({{ $questionitem->id }})">Show
                                                    Answer</button>
                                                <div id="answer{{ $questionitem->id }}" style="display:none;">
                                                    <b>คำตอบ:</b> {!! $questionitem->answer !!}
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="nav-deka" role="tabpanel">
                                    @if ($lawdata->dekalawlinks->count() > 0)
                                        <div class="bgc-white p-20 bd">
                                            <div class="list-group">
                                                <h3 class="c-grey-900">เกี่ยวกับฎีกา</h3>

                                                <div id="accordion">

                                                    @foreach ($lawdata->dekalawlinks()->with('deka')->get()->sortByDesc('deka.i_subno') as $sitem)
                                                        @if (isset($sitem->deka->id))
                                                            <div class="card">
                                                                <div class="card-header" data-toggle="collapse"
                                                                    data-target="#collapse{{ $sitem->id }}"
                                                                    aria-expanded="false"
                                                                    aria-controls="collapse{{ $sitem->id }}"
                                                                    id="heading{{ $sitem->id }}">
                                                                    <h5 class="mb-0">
                                                                        <button class="btn btn-link collapsed">
                                                                            {{ $sitem->deka->c_name ?? '' }}
                                                                        </button>
                                                                    </h5>
                                                                </div>
                                                                <div id="collapse{{ $sitem->id }}" class="collapse"
                                                                    aria-labelledby="heading{{ $sitem->id }}"
                                                                    data-parent="#accordion">
                                                                    <div class="card-body">
                                                                        <div class="mB-10 contentdata">
                                                                            {!! $sitem->deka->c_desc ?? '' !!}
                                                                        </div>
                                                                        <div class="mB-10">
                                                                            {!! $sitem->deka->c_comment ?? '' !!}
                                                                        </div>
                                                                        <a class="btn btn-outline-secondary"
                                                                            href="{{ url('/dekaview/' . $sitem->deka->id . '/' . htmlspecialchars(str_replace('/', '_', $sitem->deka->c_name))) }}">อ่านเพิ่ม</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>

                                            </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
    {{-- <script>
        $(function() {


            $('#btnsearch').on('click', function() {

                document.location.href = '/searchact/' + $('#txtsearch').val();

            });


            //press enter on text area..

            $('#txtsearch').keypress(function(e) {
                var key = e.which;
                console.log(key);
                if (key == 13) // the enter key code
                {
                    document.location.href = '/searchact/' + $('#txtsearch').val();
                }
            });

            $('.datacontent').on("mouseup", function() {
                console.log('run');
                console.log(getSelectionText());
            });


            highlightWordsnddescall();


        });

        function getSelectionText() {

            var text = "";
            if (window.getSelection) {
                console.log(window.getSelection());
                text = window.getSelection().toString();
            } else if (document.selection && document.selection.type != "Control") {
                text = document.selection.createRange().text;
            }
            return text;
        }

        function highlightWord() {
            console.log('run');
            const contentDiv = document.getElementById('datacontent');




            const targetWord = '{{ request('keyword') }}';

            // Get the content of the div



            const content = contentDiv.innerText;

            console.log(content);

            const replaceText =
                `<span style="background-color:yellow;" title="{{ request('keyword') }} {{ request('keyword') }} {{ request('keyword') }}">{{ request('keyword') }}</span>`;

            // Split the content into an array of words

            // Iterate through the words and add a span with the "highlight" class to the target word
            const highlightedContent = content.replaceAll(targetWord, replaceText);

            // Set the modified content back to the div
            contentDiv.innerHTML = highlightedContent;
        }

        function highlightWordsnddesc(key, desc) {
            console.log('run');
            const contentDiv = document.getElementById('datacontent');




            const targetWord = key;

            // Get the content of the div



            const content = contentDiv.innerText;

            console.log(content);

            const replaceText = `<span style="background-color:yellow;" title="${desc}">${targetWord}</span>`;

            // Split the content into an array of words

            // Iterate through the words and add a span with the "highlight" class to the target word
            const highlightedContent = content.replaceAll(targetWord, replaceText);

            // Set the modified content back to the div
            contentDiv.innerHTML = highlightedContent;
        }

        function highlightWordsnddescall() {
            console.log('run');
            const contentDiv = document.getElementById('datacontent');

            const keymapdata = {
                @foreach ($keymaps as $item)
                    '{{ $item->key }}': '{{ strip_tags($item->desc) }}',
                @endforeach
            };

            let content = contentDiv.innerText;
            let highlightedContent = contentDiv.innerText;
            for (const [key, value] of Object.entries(keymapdata)) {

                console.log(`${key}: ${value}`);
                let replaceText = `<span style="background-color:yellow;" title="${value}">${key}</span>`;
                highlightedContent = content.replaceAll(key, replaceText);
                content = highlightedContent;
            }
            contentDiv.innerHTML = highlightedContent;


            // const targetWord = key;

            // Get the content of the div



            //const content = contentDiv.innerText;

            // console.log(content);

            // const replaceText = `<span style="background-color:yellow;" title="${desc}">${targetWord}</span>`;

            // Split the content into an array of words

            // Iterate through the words and add a span with the "highlight" class to the target word
            //   const highlightedContent = content.replaceAll(targetWord, replaceText);

            // Set the modified content back to the div
            //    contentDiv.innerHTML = highlightedContent;
        }
    </script> --}}
@endsection

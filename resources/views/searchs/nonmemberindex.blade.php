{{-- @extends('layouts.theme2') --}}
@extends('layouts.nonmembertheme')

@push('style')
    <style>
        .wrap-text {
            width: 200px;
            padding: 10px;
            overflow-wrap: break-word;
        }
    </style>
@endpush

@section('content')
    <section class="content">
        {{-- <h2 class="text-center display-4">คำค้นหา</h2> --}}
        <div class="container-fluid">

            <h2 class="text-center"><i class="fa-solid fa-scale-balanced"></i> JURIST 101</h2>

            {{-- <form action="{{ route('advancesearch') }}" method="GET"> --}}
            <form action="{{ route('nonmember_searchact') }}" method="GET">


                <div class="input-group w-100">
                    @csrf
                    <div class="input-group-prepend">
                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary btn-lg dropdown-toggle"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-sliders"></i>
                        </button>

                        <div class="dropdown-menu m-2" aria-labelledby="btnGroupDrop1">
                            <label class="m-2" for="category">เลือกกลุ่มกฏหมาย:</label>
                            @foreach ($mainapps as $key => $mainitems)
                                <div class="form-check m-2">
                                    <input class="form-check-input" type="checkbox"
                                        value="{{ strlen($key) > 0 ? $key : 'ว่าง' }}" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ strlen($key) > 0 ? $key : 'ว่าง' }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <input type="text" id="searchTxt" class="form-control form-control-lg" name="searchTxt"
                        placeholder="พิมพ์คำค้นหาที่นี่" minlength="3" required>

                    <div class="input-group-append">
                        <a href="{{ route('nonmember_search') }}" class="btn btn-lg btn-default" title="ล้างค่า">
                            <i class="fa-solid fa-arrows-rotate"></i>
                        </a>
                        <button type="submit" class="btn btn-lg btn-default" title="ค้นหา" onclick="submitForm('')">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            {{-- Tab law Showing --}}
            <div class="col-md-12 mt-2">
                <div class="tab-content" id="myTabContent" style="background-color: white">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @foreach ($mainapps as $key => $mainitems)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ $key }}-tab"
                                    data-bs-toggle="tab" data-bs-target="#{{ $key }}-tab-pane" type="button"
                                    role="tab" aria-controls="{{ $key }}-tab-pane"
                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                    {{ strlen($key) > 0 ? $key : 'ว่าง' }}
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    @foreach ($mainapps as $key => $mainitems)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                            id="{{ $key }}-tab-pane" role="tabpanel" aria-labelledby="{{ $key }}-tab"
                            tabindex="0">
                            <!-- เนื้อหาที่ต้องการแสดงในแต่ละแท็บ -->
                            <div class="d-flex flex-wrap">
                                @foreach ($mainitems as $mainitem)
                                    <div class="text-center mt-2">

                                        <div class="card text-cneter"
                                            style="width: 100px; height: 100px; border-radius: 50%;margin:auto">
                                            <div class="card-body d-flex align-items-center justify-content-center">
                                                <a href="{{ url('/nonmember/lawselect/' . $mainitem->id . '/dashboard') }}"
                                                    class="stretched-link"> LOGO
                                                </a>
                                            </div>

                                        </div>
                                        <div class="wrap-text">
                                            <a href="{{ route('selectlaw.nonmemberdashboard', [$mainitem->id]) }}">
                                                {{ $mainitem->name }}
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- <div class="container">
        <div class="row">
            <div class="col-md-12">
                <section class="content-header">
                    <div class="container-fluid">
                        <h1 class="text-center display-4">ค้นหาหลัก</h1>
                    </div>
                    <!-- /.container-fluid -->
                </section>
                <div class="card mb-3">

                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search..." id="txtsearch"
                            value="{{ request('search') }}">
                        <span class="input-group-append">
                            <button class="btn btn-secondary" id="btnsearch" type="button">
                                Search
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
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

        });
    </script>   --}}
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select all tab buttons
            const tabButtons = document.querySelectorAll('.nav-link');

            tabButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent the default action of button

                    // Find the target tab content
                    const targetTabContent = document.querySelector(this.getAttribute(
                        'data-bs-target'));

                    // Remove active classes from all buttons and tab content
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    document.querySelectorAll('.tab-pane').forEach(content => content.classList
                        .remove('show', 'active'));

                    // Add active class to the clicked button and target tab content
                    this.classList.add('active');
                    targetTabContent.classList.add('show', 'active');
                });
            });
        });
    </script>  --}}

    <script>
        function submitForm(searchType) {
            // Get the value from the search box
            var searchValue = document.getElementById('searchTxt').value;

            // Define the base URL for your search route
            var baseUrl = "{{ route('nonmember_searchact', []) }}";

            // Create the full URL with search type and search value as query parameters
            var url = new URL(baseUrl, window.location.origin);
            url.searchParams.set('type', searchType);
            url.searchParams.set('searchTxt', searchValue);

            // Redirect to the constructed URL
            window.location.href = url.toString();
        }
    </script>
@endsection
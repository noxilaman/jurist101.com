{{-- @extends('layouts.theme2') --}}
@extends('layouts.nonmembertheme')

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
        <div class="row">
            
            <div class="col-md-12">
                {{-- <h1 class="ml-3 mb-2">{{ $mainapp->name }}</h1> --}}
                <div class="masonry-item col-md-12">

                    <div class="card p-4">
                        {{-- <form action="{{ route('selectlaw.dashboard', [$mainapp->id]) }}" method="GET">
                            <div class="input-group w-100 mb-2">
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
                                    placeholder="พิมพ์คำค้นหาที่นี่" minlength="3" required value="{{ $searchTxt }}">
                    
                                <div class="input-group-append">
                                    <a href="{{ route('selectlaw.dashboard', [$mainapp->id]) }}" class="btn btn-lg btn-default" title="ล้างค่า">
                                        <i class="fa-solid fa-arrows-rotate"></i>
                                    </a>
                                    <button type="submit" class="btn btn-lg btn-default" title="ค้นหา" onclick="submitForm('')">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form> --}}
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="c-grey-900">หัวข้อ
                                    @if (isset($selectCat))
                                        : {{ $selectCat->c_name }}
                                    @endif
                                </h4>
                                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                    data-accordion="false">

                                    @foreach ($mainCats as $itemCat)
                                        <li class="nav-item">
                                            <a href="{{ route('selectlaw.nonmemberdashboardcatTest', [$mainapp->id, $itemCat->i_id]) }}"
                                                class="nav-link">
                                                <i class="nav-icon fas fa-tachometer-alt text-info"></i>
                                                <p>{{ $itemCat->c_name }}</p>
                                            </a>
                                        </li>
                                    @endforeach



                                </ul>
                            </div>
                            {{-- <div class="col-md-6">
                                <h4 class="c-grey-900">มาตรา</h4>
                                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                    data-accordion="false">
                                    @foreach ($mainLaws as $itemLaw)
                                        <li class="nav-item">
                                            <a href="{{ url('/lawview/' . $itemLaw->i_id . '/' . $itemLaw->c_name) }}"
                                                class="nav-link">
                                                <i class="nav-icon fas fa-tachometer-alt text-info"></i>
                                                <p>{{ $itemLaw->c_name }}</p>
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                                <div class="pagination-wrapper"> {!! $mainLaws->appends(['search' => Request::get('search')])->render() !!} </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
    </div>
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

        });
    </script> --}}
@endsection

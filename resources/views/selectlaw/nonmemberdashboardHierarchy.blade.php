{{-- @extends('layouts.theme2') --}}
@extends('layouts.nonmembertheme')

@section('content')

    <div class="law-content-text">
        <div class="row my-2">
            <div class="col">
                    <h1 >{{ $mainapp->name }}</h1>
                </div>
            <div class="col mt-2">
                <a href="{{route('selectlaw.nonmemberindexCatSection',[$mainapp->id])}}" class="btn btn-secondary">ตามมาตรา</a>
                <a href="{{route('selectlaw.nonmemberdashboard',[$mainapp->id])}}" class="btn btn-secondary">ตามหัวข้อ</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="masonry-item col-md-12">
                    <div class="card p-4">
                        <div class="row">
                                <div class="col-md-6">
                                    <h4 class="c-grey-900">หัวข้อ
                                        @if (isset($selectCat))
                                            : {{ $selectCat->c_name }} 
                                        @endif
                                    </h4>
                                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                        data-accordion="false">

                                        @foreach ($mainCats->where('i_parent_id', 0) as $mainCat)
                                            <li class="nav-item">
                                                <a href="{{ url('/nonmember/lawselect/' . $mainapp->id . '/dashboardcatHierarchy/' . $mainCat->i_id) }}"
                                                    class="nav-link">
                                                    <i class="nav-icon fas fa-tachometer-alt text-info"></i>
                                                    <p>{{ $mainCat->c_name }}</p>
                                                </a>
                                                @if ($mainCat->i_id == $selectCat->i_id)
                                                <ul>
                                                    @foreach ($mainLaws as $itemLaw)
                                                    <li class="nav-item">
                                                        <a href="{{ url('/nonmember/lawview/' . $itemLaw->i_id . '/' . str_replace('/', '_', $itemLaw->c_name) ) }}"
                                                            class="nav-link">
                                                            <i class="nav-icon fas fa-tachometer-alt text-info"></i>
                                                            <p>{{ $itemLaw->c_name }}</p>
                                                        </a>
                                                        <span class="preview-text">
                                                            {!! Str::limit(strip_tags($itemLaw->c_desc), 120) !!}
                                                        </span>
                                                              <a href="{{ url('/nonmember/lawview/' . $itemLaw->i_id . '/' . str_replace('/', '_', $itemLaw->c_name) ) }}" class="btn btn-link btn-sm read-more">เพิ่มเติม</a>
                                                    </li>
                                                @endforeach
                                                </ul>
                                                @endif

                                                <ul>
                                                    @if (isset($parameters))
                                                        @foreach ($parameters as $parameterLavel1)
                                                            @if ($parameterLavel1 == $mainCat->i_id)
                                                                @php
                                                                    $level1s = $mainCats->where('i_parent_id', $parameterLavel1);
                                                                @endphp

                                                                @foreach ($level1s as $level1)
                                                                    <li class="nav-item">
                                                                        <a href="{{ url('/nonmember/lawselect/' . $mainapp->id . '/dashboardcatHierarchy/' . $mainCat->i_id . '/' . $level1->i_id) }}"
                                                                            class="nav-link {{ $level1->i_id == $selectCat->i_id ? 'active' : '' }}">
                                                                            <p>{{ $level1->c_name }} </p>
                                                                        </a>

                                                                    @if ($level1->i_id == $selectCat->i_id)
                                                                    <ul>
                                                                        @foreach ($mainLaws as $itemLaw)
                                                                        <li class="nav-item">
                                                                            <a href="{{ url('/nonmember/lawview/' . $itemLaw->i_id . '/' . str_replace('/', '_', $itemLaw->c_name) ) }}"
                                                                                class="nav-link">
                                                                                <i class="nav-icon fas fa-tachometer-alt text-info"></i>
                                                                                <p>{{ $itemLaw->c_name }}</p>
                                                                            </a>
                                                                            <span class="preview-text">
                                                                                {!! Str::limit(strip_tags($itemLaw->c_desc), 120) !!}
                                                                            </span>
                                                                            <a href="{{ url('/nonmember/lawview/' . $itemLaw->i_id . '/' . str_replace('/', '_', $itemLaw->c_name) ) }}" class="btn btn-link btn-sm read-more">เพิ่มเติม</a>
                                                                        </li>
                                                                    @endforeach
                                                                    {!! $mainLaws->appends(['search' => Request::get('search')])->render() !!}

                                                                    </ul>
                                                                    @endif
                                                                    

                                                                    </li>
                                                                    <ul>
                                                                        @foreach ($parameters as $parameterLevel2)
                                                                            @if ($parameterLevel2 == $level1->i_id)
                                                                                @php
                                                                                    $level2s = $mainCats->where(
                                                                                        'i_parent_id',
                                                                                        $level1->i_id,
                                                                                    );
                                                                                @endphp

                                                                                @foreach ($level2s as $level2)
                                                                                    <li class="nav-item">
                                                                                        <a href="{{ url('/nonmember/lawselect/' . $mainapp->id . '/dashboardcatHierarchy/' . $mainCat->i_id . '/' . $level1->i_id . '/' . $level2->i_id) }}"
                                                                                            class="nav-link {{ $level2->i_id == $selectCat->i_id ? 'active' : '' }}">
                                                                                            <p>{{ $level2->c_name }} </p>
                                                                                        </a>
                                                                                        @if ($level2->i_id == $selectCat->i_id)
                                                                                        <ul>
                                                                                            @foreach ($mainLaws as $itemLaw)
                                                                                            <li class="nav-item">
                                                                                                <a href="{{ url('/nonmember/lawview/' . $itemLaw->i_id . '/' . str_replace('/', '_', $itemLaw->c_name)) }}"
                                                                                                    class="nav-link">
                                                                                                    <i class="nav-icon fas fa-tachometer-alt text-info"></i>
                                                                                                    <p>{{ $itemLaw->c_name }}</p>
                                                                                                </a>
                                                                                                    <span class="preview-text">
                                                                                                        {!! Str::limit(strip_tags($itemLaw->c_desc), 120) !!}
                                                                                                    </span>
                                                                                                          <a href="{{ url('/nonmember/lawview/' . $itemLaw->i_id . '/' . str_replace('/', '_', $itemLaw->c_name) ) }}" class="btn btn-link btn-sm read-more">เพิ่มเติม</a>
                                                                                               
                                                                                            </li>
                                                                                            @endforeach
                                                                                            {!! $mainLaws->appends(['search' => Request::get('search')])->render() !!}

                                                                                        </ul>
                                                                                        @endif
                                                                                    </li>
                                                                                    <ul>
                                                                                        @foreach ($parameters as $parameterLevel3)
                                                                                            @if ($parameterLevel3 == $level2->i_id)
                                                                                                @php
                                                                                                    $level3s = $mainCats->where(
                                                                                                        'i_parent_id',
                                                                                                        $level2->i_id,
                                                                                                    );
                                                                                                @endphp

                                                                                                @foreach ($level3s as $level3)
                                                                                                    <li class="nav-item">
                                                                                                        <a href="{{ url('/nonmember/lawselect/' . $mainapp->id . '/dashboardcatHierarchy/' . $mainCat->i_id . '/' . $level1->i_id . '/' . $level2->i_id . '/' . $level3->i_id) }}"
                                                                                                            class="nav-link {{ $level3->i_id == $selectCat->i_id ? 'active' : '' }}">
                                                                                                            <p>{{ $level3->c_name }}
                                                                                                            </p>
                                                                                                        </a>
                                                                                                        @if ($level3->i_id == $selectCat->i_id)
                                                                                                        <ul>
                                                                                                            @foreach ($mainLaws as $itemLaw)
                                                                                                            <li class="nav-item">
                                                                                                                <a href="{{ url('/nonmember/lawview/' . $itemLaw->i_id . '/' . str_replace('/', '_', $itemLaw->c_name)) }}"
                                                                                                                    class="nav-link">
                                                                                                                    <i class="nav-icon fas fa-tachometer-alt text-info"></i>
                                                                                                                    <p>{{ $itemLaw->c_name }}</p>
                                                                                                                </a>
                                                                                                                    <span class="preview-text">
                                                                                                                        {!! Str::limit(strip_tags($itemLaw->c_desc), 120) !!}
                                                                                                                    </span>
                                                                                                                          <a href="{{ url('/nonmember/lawview/' . $itemLaw->i_id . '/' . str_replace('/', '_', $itemLaw->c_name) ) }}" class="btn btn-link btn-sm read-more">เพิ่มเติม</a>
                                                                                                                
                                                                                                            </li>
                                                                                                        @endforeach
                                                                                                        {!! $mainLaws->appends(['search' => Request::get('search')])->render() !!}
                                                                                                        </ul>
                                                                                                        @endif
                                                                                                    </li>
                                                                                                    <ul>
                                                                                                        @foreach ($parameters as $parameterLevel4)
                                                                                                            @if ($parameterLevel4 == $level3->i_id)
                                                                                                                @php
                                                                                                                    $level4s = $mainCats->where(
                                                                                                                        'i_parent_id',
                                                                                                                        $level3->i_id,
                                                                                                                    );
                                                                                                                @endphp
                    
                                                                                                                @foreach ($level4s as $level4)
                                                                                                                    <li class="nav-item">
                                                                                                                        <a href="{{ url('/nonmember/lawselect/' . $mainapp->id . '/dashboardcatHierarchy/' . $mainCat->i_id . '/' . $level1->i_id . '/' . $level2->i_id . '/' . $level3->i_id.'/'.$level4->i_id) }}"
                                                                                                                            class="nav-link {{ $level4->i_id == $selectCat->i_id ? 'active' : '' }}">
                                                                                                                            <p>{{ $level4->c_name }}
                                                                                                                            </p>
                                                                                                                        </a>
                                                                                                                        @if ($level4->i_id == $selectCat->i_id)
                                                                                                                        <ul>
                                                                                                                            @foreach ($mainLaws as $itemLaw)
                                                                                                                            <li class="nav-item">
                                                                                                                                <a href="{{ url('/nonmember/lawview/' . $itemLaw->i_id . '/' .str_replace('/', '_', $itemLaw->c_name)) }}"
                                                                                                                                    class="nav-link">
                                                                                                                                    <i class="nav-icon fas fa-tachometer-alt text-info"></i>
                                                                                                                                    <p>{{ $itemLaw->c_name }}</p>
                                                                                                                                </a>
                                                                                                                                    <span class="preview-text">
                                                                                                                                        {!! Str::limit(strip_tags($itemLaw->c_desc), 120) !!}
                                                                                                                                    </span>
                                                                                                                                          <a href="{{ url('/nonmember/lawview/' . $itemLaw->i_id . '/' . str_replace('/', '_', $itemLaw->c_name) ) }}" class="btn btn-link btn-sm read-more">เพิ่มเติม</a>
                                                                                                                                
                                                                                                                            </li>
                                                                                                                        @endforeach
                                                                                                                        {!! $mainLaws->appends(['search' => Request::get('search')])->render() !!}
                                                                                                                        </ul>
                                                                                                                        @endif
                                                                                                                    </li>
                                                                                                                @endforeach
                                                                                                            @endif
                                                                                                        @endforeach
                                                                                                    </ul>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </ul>
                                                                                @endforeach
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    @endif

                                                </ul>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @php
 
        @endphp
    </div>
  
    
@endsection

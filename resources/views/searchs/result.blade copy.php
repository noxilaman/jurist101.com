@extends('layouts.theme2')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>กฎหมาย</h1>
            </div>
        </div>
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Search..." id="txtsearch"
                value="{{ $key }}">
            <span class="input-group-append">
                <button class="btn btn-secondary" id="btnsearch" type="button">
                    Search
                </button>
            </span>
        </div>
        <div class="row">
            <div class="col-6">
                <ul class="list-group">
                    <li class="list-group-item active" aria-current="true">กฏมาย</li>
                    @if (isset($dataall['cat']))
                        <li class="list-group-item">
                            <ul class="list-group">
                                <li class="list-group-item active" aria-current="true">หัวข้อ</li>
                                @foreach ($dataall['cat'] as $app => $subitem)
                                    @foreach ($subitem as $item)
                                        <li class="list-group-item">
                                            <a
                                                href="{{ url('/catview/' . $item->i_id . '/' . htmlspecialchars(str_replace('/', '_', $item->c_name))) }}">{{ $app }}
                                                -
                                                {{ $item->c_name }}</a>
                                        </li>
                                    @endforeach
                                @endforeach
                            </ul>
                        </li>
                    @endif
                    @if (isset($dataall['law']))
                        <li class="list-group-item">
                            <ul class="list-group">
                                <li class="list-group-item active" aria-current="true">มาตรา</li>
                                @foreach ($dataall['law'] as $app => $subitem)
                                    @foreach ($subitem as $item)
                                        <li class="list-group-item">
                                            <a
                                                href="{{ url('/lawview/' . $item->i_id . '/' . htmlspecialchars(str_replace('/', '_', $item->c_name))) }}">{{ $app }}
                                                - {{ $item->c_name }}
                                                {{ $item->short_note }} </a>

                                            <a href="{{ route('bookmarks.addlaw2bookmark', $item->i_id) }}"
                                                class="btn btn-xs btn-success">Add To Bookmark</a>

                                        </li>
                                    @endforeach
                                @endforeach
                            </ul>
                        </li>
                    @endif

                </ul>
            </div>
            <div class="col-6">
                <ul class="list-group">
                    <li class="list-group-item active" aria-current="true">ฎีกา</li>
                    @foreach ($dekadatas as $item)
                        <li class="list-group-item">
                            <a
                                href="{{ url('/dekaview/' . $item->id . '/' . htmlspecialchars(str_replace('/', '_', $item->c_name))) }}">{{ $item->c_name }}</a>

                            <a href="{{ route('bookmarks.adddeka2bookmark', $item->id) }}"
                                class="btn btn-xs btn-success">Add To Bookmark</a>

                        </li>
                    @endforeach
                </ul>
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
    </script>
@endsection

{{-- @extends('layouts.theme2') --}}
@extends('layouts.adminltetheme')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Bookmarks</h1>
                {{-- <div class="card">

                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search..." id="txtsearch"
                            value="{{ request('search') }}">
                        <span class="input-group-append">
                            <button class="btn btn-secondary" id="btnsearch" type="button">
                                Search
                            </button>
                        </span>
                    </div>
                </div> --}}
            </div>
            <div class="row">
                <div class="col-12">
                    {{-- <div>Folder : Default</div> --}}
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ประเภท</th>
                                            <th>ชื่อ</th>
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookmarks as $item)
                                            @if (empty($item->law_id))
                                                <tr>
                                                    <td>ฎีกา</td>
                                                    <td>
                                                        <a
                                                            href="{{ url('/dekaview/' . $item->deka->id . '/' . htmlspecialchars(str_replace('/', '_', $item->deka->c_name))) }}">{{ $item->deka->c_name }}
                                                        </a>
                                                    </td>
                                                    <td class="text-center"><a href="{{ url('/bookmarks/addNote/' . $item->id) }}"
                                                            class="text-success"><i class="far fa-sticky-note"></i></a></td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td>กฏหมาย</td>
                                                    <td>
                                                        <a
                                                            href="{{ url('/lawview/' . $item->law->i_id . '/' . htmlspecialchars(str_replace('/', '_', $item->law->c_name))) }}">{{ $item->law->mainlaw->name }}
                                                            {{ $item->law->c_name }} {{ $item->law->short_name }}</a>
                                                    </td>
                                                    <td class="text-center"><a href="{{ url('/bookmarks/addNote/' . $item->id) }}"
                                                            class="text-success"><i class="far fa-sticky-note"></i> </a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- <table class="table">
                        <thead>
                            <tr>
                                <th>ประเภท</th>
                                <th>ชื่อ</th>
                                <th>Note</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookmarks as $item)
                                @if (empty($item->law_id))
                                    <tr>
                                        <td>
                                            ฎีกา
                                        </td>
                                        <td>
                                            <a
                                                href="{{ url('/dekaview/' . $item->deka->id . '/' . htmlspecialchars(str_replace('/', '_', $item->deka->c_name))) }}">{{ $item->deka->c_name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ url('/bookmarks/addNote/' . $item->id) }}" class="btn btn-success">Note</a>
                                        </td>
                                        <td></td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>
                                            กฎหมาย
                                        </td>
                                        <td>
                                            <a
                                                href="{{ url('/lawview/' . $item->law->i_id . '/' . htmlspecialchars(str_replace('/', '_', $item->law->c_name))) }}">{{ $item->law->mainlaw->name }}
                                                {{ $item->law->c_name }} {{ $item->law->short_name }}</a>

                                        </td>
                                        <td>
                                            <a href="{{ url('/bookmarks/addNote/' . $item->id) }}" class="btn btn-success">
                                                Note </a>
                                        </td>
                                        <td></td>
                                    </tr>
                                @endif
                            @endforeach

                        </tbody>
                    </table> --}}
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

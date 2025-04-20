@extends('layouts.adminltetheme')

@section('content')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>กฎหมาย</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <ul class="list-group">

                    @if (!empty($catdata->subcats->count() > 0 ))
                        <li class="list-group-item active" aria-current="true">{{ $catdata->c_name }}</li>
                        @foreach ($catdata->subcats as $cat)
                            <li class="list-group-item">
                                <a
                                    href="{{ url('/catview/' . $cat->i_id . '/' . htmlspecialchars(str_replace('/', '_', $cat->c_name))) }}">{{ $cat->c_name }}</a>
                            </li>
                        @endforeach
                    @else
                        <li class="list-group-item active" aria-current="true">{{ $catdata->c_name }}</li>
                        @foreach ($catdata->laws as $law)
                            <li class="list-group-item">
                                <a href="{{ url('/lawview/' . $law->i_id . '/' . htmlspecialchars(str_replace('/', '_', $law->c_name))) }}">{{ $law->c_name }}</a>
                                <a
                                                                href="{{ route('bookmarks.addlaw2bookmark', $law->i_id) }}"><i
                                                                    class="far fa-bookmark text-info"></i></a>
                            </li>
                        @endforeach
                    @endif

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

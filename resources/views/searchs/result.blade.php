@extends('layouts.adminltetheme')

@section('content')
    <div class="container">

        <section class="content mb-5">
            <div class="container-fluid">
                <h2 class="text-center display-4">ผลการค้นหา</h2>
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="input-group">
                            <input type="search" name="search" id="txtsearch" class="form-control form-control-lg"
                                placeholder="พิมพ์คำค้นหาที่นี่" value="{{ $key }}">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-lg btn-default" id="btnsearch">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="grid-margin stretch-card">
                    <div class="card card-result">
                        <div class="card-body">
                            <h3 class="card-title">กฏหมาย</h3>
                            <div class="table-responsive">
                                @if (isset($dataall['cat']))
                                    <table class="table">
                                        <tbody>
                                            <tr class="table-info">
                                                <td colspan="2">
                                                    หัวข้อ
                                                </td>
                                            </tr>
                                            @foreach ($dataall['cat'] as $app => $subitem)
                                                @foreach ($subitem as $item)
                                                    <tr>
                                                        <td>
                                                            <a
                                                                href="{{ url('/catview/' . $item->i_id . '/' . htmlspecialchars(str_replace('/', '_', $item->c_name))) }}">{{ $app }}
                                                                -
                                                                {{ $item->c_name }}</a>
                                                        </td>
                                                        <td class="text-right">
                                                            <a href="{{ route('bookmarks.addlaw2bookmark', $item->i_id) }}"><i
                                                                    class="far fa-bookmark text-info"></i></a>
                                                        </td>
                                                    </tr>

                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                                @if (isset($dataall['law']))
                                    <table class="table">
                                        <tbody>
                                            <tr class="table-info">
                                                <td colspan="2">
                                                    มาตรา
                                                </td>
                                            </tr>
                                            @foreach ($dataall['law'] as $app => $subitem)
                                                @foreach ($subitem as $item)
                                                    <tr>
                                                        <td>
                                                            <a
                                                                href="{{ url('/lawview/' . $item->i_id . '/' . htmlspecialchars(str_replace('/', '_', $item->c_name))) }}">{{ $app }}
                                                                - {{ $item->c_name }}
                                                                {{ $item->short_note }} </a>
                                                        </td>
                                                        <td class="text-right">
                                                            <a
                                                                href="{{ route('bookmarks.addlaw2bookmark', $item->i_id) }}"><i
                                                                    class="far fa-bookmark text-info"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-md-6">
                <div class="grid-margin stretch-card">
                    <div class="card card-result">
                        <div class="card-body">
                            <h3 class="card-title">ฎีกา</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        @foreach ($dekadatas as $item)
                                            <tr>
                                                <td><a
                                                        href="{{ url('/dekaview/' . $item->id . '/' . htmlspecialchars(str_replace('/', '_', $item->c_name))) }}">{{ $item->c_name }}</a>
                                                </td>
                                                <td class="text-right">
                                                    <a href="{{ route('bookmarks.adddeka2bookmark', $item->id) }}"><i
                                                            class="far fa-bookmark text-info"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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

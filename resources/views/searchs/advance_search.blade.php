{{-- @extends('layouts.theme2') --}}
@extends('layouts.adminltetheme')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <h2 class="text-center display-4">ค้นหาละเอียด</h2>
            <div class="row">
                <div class="col-md-8 offset-md-2">

                    <div class="card p-4">
                        <form method="POST" action="{{ url('advancesearchaction') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 pt-2">
                                    <label class="form-label " for="typedata">ประเภท</label>
                                    <select name="typedata" id="typedata" class="form-control">
                                        <option value=""> ==== All ==== </option>
                                        <option value="law"> เฉพาะกฎหมาย </option>
                                        <option value="deka"> เฉพาะฎีกา </option>
                                    </select>
                                </div>
                                <div class="col-md-6 pt-2">
                                    <label class="form-label" for="mainapp">กฎหมาย</label>
                                    <select name="mainapp" id="mainapp" class="form-control">
                                        <option value=""> ==== All ==== </option>
                                        @foreach ($tbapps as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 pt-2">

                                    <div class="input-group">
                                        <input type="text" name="search" id="txtsearch" class="form-control form-control-lg"
                                            placeholder="พิมพ์คำค้นหาที่นี่" value="{{ request('search') }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-lg btn-default" id="btnsearch">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <div class="container">
        <div class="row">
            <div class="col-md-12">
                <section class="content-header">
                    <div class="container-fluid">
                        <h1 class="text-center display-4">ค้นหาละเอียด</h1>
                    </div>
                    <!-- /.container-fluid -->
                </section>
                <div class="card">
                    <form method="POST" action="{{ url('advancesearchaction') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 pt-2 pl-3">
                                <label class="form-label " for="typedata">ประเภท</label>
                                <select name="typedata" id="typedata" class="form-control">
                                    <option value=""> ==== All ==== </option>
                                    <option value="law"> เฉพาะกฎหมาย </option>
                                    <option value="deka"> เฉพาะฎีกา </option>
                                </select>
                            </div>
                            <div class="col-md-6 pt-2">
                                <label class="form-label pl-3" for="mainapp">กฎหมาย</label>
                                <select name="mainapp" id="mainapp" class="form-control">
                                    <option value=""> ==== All ==== </option>
                                    @foreach ($tbapps as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 pt-2">
                                <input type="text" class="form-control" name="search" placeholder="Search..."
                                    id="txtsearch" value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" id="btnsearch" type="submit">
                                        Search
                                    </button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

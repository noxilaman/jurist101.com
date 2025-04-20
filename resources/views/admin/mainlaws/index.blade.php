@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12"><h1>กฎหมาย</h1> 
            <div class="card">                   

                    <form method="GET" action="{{ url('/admin/mainlaws') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    Search
                                </button>
                            </span>
                        </div>
                    </form>

                    <br/>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>กฎหมาย</th>
                                    <th>รหัส</th>
                                    <th><a href="{{ route('adminmainlaws.create') }}" class="btn btn-success btn-sm" title="Add New group">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                    </a></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($dataapps as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name}}</td>
                                    <td>{{ $item->ios_id }}</td>
                                    <td>
                                        <a href="{{ url('/admin/lawcats/' . $item->id . '/data') }}" title="Edit group"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> หัวข้อ </button></a>
                                        <a href="{{ route('adminkeymaps.index',[$item->id]) }}" title="Edit group"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Keyword </button></a>

                                         <a href="{{ url('/admin/mainlaws/' . $item->id . '/edit') }}" title="Edit group"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                        <form method="POST" action="{{ url('/admin/mainlaws/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete group" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $dataapps->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
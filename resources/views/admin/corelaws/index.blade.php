@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12"><h1>กฎหมาย</h1> 
            <div class="card">                   

                    <form method="GET" action="{{ url('/admin/corelaws') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                    <th>หัวข้อ</th>
                                    <th>เลขมาตรา</th>
                                    <th>มาตราย่อ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($laws as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->mainlaw->name}}</td>
                                    <td>{{ $item->lawcat->c_name ?? '' }}</td>
                                    <td>{{ $item->c_name }}</td>
                                    <td>{{ $item->short_note }}</td>
                                    <td>
                                        <a href="{{ route('admincorelaws.show',$item) }}" title="Edit group"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Show </button></a>

                                         <a href="{{ route('admincorelaws.edit',$item) }}" title="Edit group"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                         <a href="{{ route('adminquestionslaw.list',$item) }}" title="Edit group"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> คำถาม</button></a>


                                        <form method="POST" action="{{ route('admincorelaws.destroy',$item) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete group" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $laws->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
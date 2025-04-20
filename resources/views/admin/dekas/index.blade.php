@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12"><h1>Deka Management</h1> 
            <div class="card">                   

                    <form method="GET" action="{{ route('admindekas.index') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    Search
                                </button>
                            </span>
                        </div>
                    </form>
                    @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                @endif
                    <br/>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No. / Sub No.</th>
                                    <th>Name</th>
                                    <th> <a href="{{ route('admindekas.create') }}" class="btn btn-success btn-sm" title="Add New group"> Add New </a>
                                       


                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($dekas as $item)
                                <tr>
                                    <td>{{ $item->i_no}} / {{ $item->i_subno}}</td>
                                    <td>{{ $item->c_name}}</td>
                                    <td>
                                        
                                        <a href="{{ route('admindekas.listlaw',$item->id) }}" title="Edit group"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Link</button></a>
                                        <a href="{{ route('admindekas.show',$item->id) }}" title="Edit group"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Show</button></a>
                                        <a href="{{ route('admindekas.edit',$item->id) }}" title="Edit group"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                        <form method="POST" action="{{ route('admindekas.destroy',$item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete group" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $dekas->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
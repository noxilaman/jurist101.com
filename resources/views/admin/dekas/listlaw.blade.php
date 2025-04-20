@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12"><h1>Deka Link</h1> 
            <h3>{{$deka->c_name}}</h3>
            <div class="card">                   

                    <form method="GET" action="{{ url('admindekas.index') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                    <th>No. / Sub No.</th>
                                    <th>Name</th>
                                    <th> <a href="{{ route('admindekas.addlaw',$deka->id) }}" class="btn btn-success btn-sm" title="Add New group"> Add New </a>
                                       


                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($dekalaws as $item)
                                <tr>
                                    <td>{{ $item->law->mainlaw->name }} / {{ $item->law->c_name}}</td>
                                    <td>{{ $item->order }}</td>
                                    <td>
                                        
                                         <a href="{{ route('admindekas.show',$item->id) }}" title="Edit group"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Show</button></a>
                                         <a href="{{ route('admindekas.deleteLaw2Deka',[$item->id,$deka->id]) }}" title="Edit group"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button></a>
                                      
                                        
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $dekalaws->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
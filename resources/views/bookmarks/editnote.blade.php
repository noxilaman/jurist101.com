@extends('layouts.adminltetheme')

@section('content')
    <div class="law-content-text">
        <div class="row">
            <div class="col-md-12">
                <div class="masonry-item col-md-12">
                    <div class="card p-4" id="mainlaw">
                        
                        <h3>กฎหมาย {{ $bookmarkdata->law->mainlaw->name }} </h3>
                        {!! $bookmarkdata->law->c_desc !!}<br/>
                        {!! $bookmarkdata->law->c_comment !!}
                    </div>
                    <div class="card p-4" id="mainlaw">
                        <h1>เพิ่ม Note </h1>
                        <form method="POST" action="{{ url('/bookmarks/addNoteAction/' . $bookmarkdata->id) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="note">Note</label>
                                    @if (!empty($note))
                                    <textarea id="note" class="form-control @error('note') is-invalid @enderror" name="note">{{ $note->note }}</textarea>
                                    @else
                                    <textarea id="note" class="form-control @error('note') is-invalid @enderror" name="note"></textarea>
                                    @endif
                                    
                                </div>
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-success" value="บันทึก" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

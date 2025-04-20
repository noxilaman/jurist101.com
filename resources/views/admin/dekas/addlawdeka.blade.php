@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('ฎีกา') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admindekas.addlawaction', $deka->id) }}">
                            @csrf
                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="i_no" class="col-form-label text-md-end">{{ __('เลขฎีกา') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <select id="i_app" class="form-control @error('i_no') is-invalid @enderror"
                                        name="i_app">
                                        <option value="">==== เลือก ====</option>
                                        @foreach ($listApp as $key => $item)
                                            <option value="{{ $key }}">{{ $item }}</option>
                                        @endforeach

                                    </select>

                                    @error('i_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="name" class="col-form-label text-md-end">{{ __('หัวข้อ') }}</label>
                                </div>
                                <div class="col-md-10">
                                    <select id="i_cat" class="form-control @error('i_no') is-invalid @enderror"
                                        name="i_cat">

                                    </select>
                                </div>
                            </div>
                            <div class="row mb-12">
                                <div class="col-md-2">
                                    <label for="name" class="col-form-label text-md-end">{{ __('มาตรา') }}</label>
                                </div>
                                <div class="col-md-10">
                                    <select id="lawdata_id" class="form-control @error('i_no') is-invalid @enderror"
                                        name="lawdata_id" data-live-search="true">

                                    </select>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-2">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#i_app').on('change', function(event) {
                console.log(event.target.value);
                var jqxhr = $.get("/admin/dekas/getcatbyappid/" + event.target.value, function() {
                        console.log('success');
                    })
                    .done(function(data) {
                        $('#i_cat').empty().append('<option selected="selected" value="">==== Selected ====</option>')
                        $.each(data, function(index, value) {
                            $('#i_cat').append($('<option>', {
                                value: value.id,
                                text: value.name
                            }));
                        });
                    });

                    var jqxhr2 = $.get("/admin/dekas/getlawbyappid/" + event.target.value, function() {
                        console.log('success');
                    })
                    .done(function(data) {
                        $('#lawdata_id').empty().append('<option selected="selected" value="">==== Selected ====</option>')
                        $.each(data, function(index, value) {
                            console.log(value);
                            $('#lawdata_id').append($('<option>', {
                                value: value.id,
                                text: value.name
                            }));
                        });
                        
                    });

            });

            $('#i_cat').on('change', function(event) {
                console.log(event.target.value);
                var jqxhr = $.get("/admin/dekas/getlawbycatid/" +  $('#i_app').val() + '/' + event.target.value, function() {
                        console.log('success');
                    })
                    .done(function(data) {
                        $('#lawdata_id').empty().append('<option selected="selected" value="">==== Selected ====</option>')
                        $.each(data, function(index, value) {
                            console.log(value);
                            $('#lawdata_id').append($('<option>', {
                                value: value.id,
                                text: value.name
                            }));
                        });
                        
                    });

            });
        });
    </script>
@endsection

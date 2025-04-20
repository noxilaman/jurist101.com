@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>กฎหมาย</h1>
                <h3>กฎหมาย {{$lawdata->mainlaw->name}} </h3>
                <div class="masonry-item col-md-12">
                    <div class="bgc-white p-20 bd">
                      <h3 class="c-grey-900">{{$lawdata->c_name}} {{$lawdata->short_name}} </h3>
                      <div class="mT-30">
                        {!!$lawdata->c_desc!!}
                      </div>
                      <div class="mT-30">
                        {!!$lawdata->c_comment!!}
                      </div>
                      <div class="mT-30">{{ __('องค์ประกอบภายนอก/คำอธิบาย') }}:<br/>
                        {!!$lawdata->external_factor!!}
                      </div>

                      <div class="mT-30">{{ __('องค์ประกอบความผิดภายใน') }}:<br/>
                        {!!$lawdata->internal_factor!!}
                      </div>
                    </div>
                    @if ($lawdata->dekalawlinks->count() > 0)
                    <div class="bgc-white p-20 bd mT-10">
                    <div class="list-group">
                    <h3 class="c-grey-900">เกี่ยวกับฎีกา</h3>
                    @foreach ($lawdata->dekalawlinks as $sitem)
                    
                        <a class="list-group-item list-group-item-action" data-bs-toggle="collapse" href="#collapseExample{{$sitem->id}}" role="button" aria-expanded="false" aria-controls="collapseExample{{$sitem->id}}">
                            {{ $sitem->deka->c_name }}
                          </a>
                        <div class="collapse" id="collapseExample{{$sitem->id}}">
                            <div class="card card-body">
                                <div class="mB-10">
                                    {!!$sitem->deka->c_desc!!}
                                  </div>
                                  <div class="mB-10">
                                    {!!$sitem->deka->c_comment!!}
                                  </div>
                                  <a href="{{url('/dekaview/'.$sitem->deka->id.'/'.htmlspecialchars(str_replace("/","_",$sitem->deka->c_name)))}}">อ่านเพิ่ม</a> 
                            </div>
                        </div>
                    
                    @endforeach   
                </div> 
            </div> 
                    @endif
                    
                  </div>
            </div>
        </div>
        @php
                    
        //dd($lawdata)
        @endphp
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

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>{{$user->name}}</h3>
                    <h4>{{$service->name}}</h4>
                </div>

                <div class="panel-body">
                <?php /*
                @if($service)
                    @if (count($availabilities) > 0)
                        @foreach($availabilities as $k => $v)
                            @if ($v['slotCount'] > 0)
                                <div><a href="">{{ $k.' ('. $v['slotCount'].')' }}</a></div>
                            @else
                                <div>{{ $k }}</div>
                            @endif
                        @endforeach
                    @endif
                @else
                    <div>No Schedules available.</div>
                @endif
                */ ?>
                @if($service)
                    @if (count($availabilities) > 0)
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        @foreach($availabilities as $k => $v)
                    <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading{{$k}}">
                      <h4 class="panel-title">
                        @if ($v['slotCount'] > 0)
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$k}}" aria-expanded="true" aria-controls="collapse{{$k}}">
                          <div class="text-primary">{{ $k.' ('. $v['slotCount'].')' }}</div>
                        </a>
                        @else
                            <div>{{ $k }}</div>
                        @endif
                      </h4>
                    </div>
                    <div id="collapse{{$k}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$k}}">
                      <div class="panel-body">
                        @foreach($v['slots'] as $vSlot)
                            <div>{{$vSlot['startTime']}}</div>
                        @endforeach
                      </div>
                    </div>
                    </div>
                        @endforeach
                    </div>
                    @endif
                @else
                    <div>No Schedules available.</div>
                @endif    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

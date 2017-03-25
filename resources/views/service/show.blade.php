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
                @if($service)
                    @if ($service->getWeekAvailability()->count() > 0)
                        @foreach($service->getWeekAvailability() as $schedule)
                            <div><a href="">{{$schedule}}</a></div>
                        @endforeach
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

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>{{$user->name}}</h3></div>

                <div class="panel-body">
                    @if ($user->services->count() > 0)
                        <h4>Services Offered</h4>
                        @foreach($user->services as $service)
                            <div><a href="{{route('service',[$user,$service])}}">{{$service->name}}</a></div>
                        @endforeach
                    @else
                        <div>No Services posted yet.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

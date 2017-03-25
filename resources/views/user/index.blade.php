@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Users</h3></div>

                <div class="panel-body">
                    @if ($users->count() > 0)
                        @foreach($users as $user)
                            <div><a href="{{route('user.show',[$user])}}">{{$user->name}}</a></div>
                        @endforeach
                    @else
                        <div>No users yet.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $user->username }}</div>


                    <div class="panel-body">
                        <h2>{{ $user->username }}</h2>
                        <img src="{{Gravatar::get(Auth::user()->email)}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

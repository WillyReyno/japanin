@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Evènements !</div>
                    @if(Auth::check() && Auth::user()->isAdmin())
                        Vous êtes administrateur !
                    @endif

                    <div class="panel-body">
                        <h2>Évènements</h2>
                        @if(Auth::check())
                            <a href="{{ url('/event/create') }}">Ajouter un évènement</a>
                        @endif
                        @if ( !$events->count() )
                            Aucun évènement pour le moment.
                        @else
                            <ul>
                                @foreach( $events as $event )
                                    <li><a href="{{ route('event.show', $event->slug) }}">{{ $event->name }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

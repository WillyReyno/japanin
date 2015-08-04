@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">
                    <div class="panel-heading">{{$event->name}}</div>
                    <div class="panel-body">
                        <ul>
                            <li><strong>Nom :</strong> {{$event->name}}</li>
                            <li><strong>Type :</strong> {{$type->name}}</li> <!-- TODO Dynamiser -->
                            <li><strong>Adresse :</strong> {{$event->address}}</li>
                            <li><strong>Latitude :</strong> {{$event->latitude}}</li>
                            <li><strong>Longitude :</strong> {{$event->longitude}}</li>
                            <li><strong>Date de début :</strong> {{$event->start_date}}</li>
                            <li><strong>Date de fin :</strong> {{$event->end_date}}</li>
                            <li><strong>Description :</strong> {!! html_entity_decode($event->description) !!}</li>
                            @if($event->poster)
                                <li class="col-md-3"><strong>Affiche :</strong> <img src="{{route('getentry', $event->poster)}}" class="img-responsive img-thumbnail"></li>
                            @endif
                            @if($author)
                                <li><strong>Ajouté par :</strong> <a href="{{ route('user.show', $author->slug) }}">{{$author->username}}</a></li>
                            @endif
                        </ul>

                        @allowed('', $event)
                        Tu as créé cet évènement !
                        @endallowed

                        @if(Auth::check() && (Auth::user()->isAdmin() OR Auth::user()->id === $event->user_id))
                            {!! Form::open(array('class' => 'form-inline col-md-12', 'method' => 'DELETE', 'route' => array('event.destroy', $event->id))) !!}

                            @allowed('edit.event', $event)
                            {!! link_to_route('event.edit', 'Modifier', array($event->id), array('class' => 'btn btn-info')) !!}
                            @endallowed

                            @allowed('delete.event', $event)
                            {!! Form::submit('Supprimer', array('class' => 'btn btn-danger')) !!}
                            @endallowed

                            {!! Form::close() !!}

                        @endif

                        {{-- TODO Ajax here --}}
                        @if(Auth::check())
                            @if($went)
                                {!! HTML::linkAction('EventController@userGoing', "Ne plus participer", $event) !!}
                            @else
                                {!! HTML::linkAction('EventController@userGoing', "Participer", $event) !!}
                            @endif
                        @endif

                        <h3>Participants</h3>

                        <ul>
                            @foreach($event->users as $e_users)
                                <li>{{ App\Models\User::find($e_users->pivot->user_id)->username }}</li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')


    <script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('/js/locales/bootstrap-datepicker.fr.min.js') }}"></script>

    <script>
        $('#sandbox-container input').datepicker({
            format: "yyyy-mm-dd",
            language: "fr"
        });

    </script>
@endsection

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
                            <li><strong>Type :</strong> {{$event->type_id}}</li> <!-- TODO Dynamiser -->
                            <li><strong>Adresse :</strong> {{$event->address}}</li>
                            <li><strong>Latitude :</strong> {{$event->latitude}}</li>
                            <li><strong>Longitude :</strong> {{$event->longitude}}</li>
                            <li><strong>Date de début :</strong> {{$event->start_date}}</li>
                            <li><strong>Date de fin :</strong> {{$event->end_date}}</li>
                            <li><strong>Description :</strong> {!! html_entity_decode($event->description) !!}</li>
                            @if($event->poster)
                                <li><strong>Affiche :</strong> <img src="{{route('getentry', $event->poster)}}" class="img-responsive"></li>
                            @endif
                        </ul>
                        @if(Auth::check())
                            <!-- Todo créer les fonctionnalités de modif / suppression
                            Todo faire les vérifications selon si l'utilisateur est le créateur ou non (voir middleware) -->
                            Modifier | Supprimer
                        @endif
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

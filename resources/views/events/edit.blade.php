@extends('app')

@section('css')
    <link href="{{ asset('/css/bootstrap3-wysihtml5.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Modifier l'�v�nement</div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(Auth::check())
                            {!! Form::model(new App\Models\Event, ['files' => true, 'route' => ['event.store'], 'class' => 'form-horizontal']) !!}
                            @include('events/partials/_form', ['submit_text' => 'Enregistrer l\'�v�nement'])
                            {!! Form::close() !!}
                        @else
                            <p>Vous devez �tre connect� afin d'ajouter un �v�nement.<br>
                                <a href="{{ url('/auth/login') }}">Connexion</a> - <a href="{{ url('/auth/register') }}">Inscription</a></p>
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
    <script src="{{ asset('/js/jquery.placepicker.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=places"></script>
    <script src="{{ asset('/js/bootstrap3-wysihtml5.js')}}"></script>
    <script src="{{ asset('/js/locales/bootstrap-wysihtml5.fr-FR.js')}}"></script>

    <script>
        $('#sandbox-container input').datepicker({
            format: "yyyy-mm-dd",
            language: "fr"
        });


        $(document).ready(function() {

            $('.wysiwyg').wysihtml5({locale: "fr-FR"});

            $(".placepicker").each(function() {

                // find map-element
                var target = this;
                var $collapse = $(this).parents('.form-group').next('.collapse');
                var $map = $collapse.find('.placepicker-map');
                var map = $collapse.find('.placepicker-map');



                // init placepicker
                var placepicker = $(this).placepicker({
                    map: $map.get(0),
                    placeChanged: function(){
                        // [Japanin] Save latitude and longitude on place change
                        $('.latitude').val(this.getLatLng().lat());
                        $('.longitude').val(this.getLatLng().lng());
                    }
                }).data('placepicker');

                // [Japanin] Change button text on click
                var btn = $('.btn-map');
                btn.on('click', function() {
                    var show = "Afficher la carte";
                    var hide = "Masquer la carte";
                    if ($(this).text() == show) {
                        $(this).text(hide);
                    } else {
                        $(this).text(show);
                    }
                });

                // reload map after collapse in
                $collapse.on('show.bs.collapse', function () {
                    window.setTimeout(function() {
                        placepicker.resize();
                        placepicker.reload();

                        if (!$(target).prop('value')) {
                            placepicker.geoLocation();
                        }
                    }, 0);

                });

            });

        });
    </script>
@endsection

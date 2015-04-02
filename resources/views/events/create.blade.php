@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Ajouter un évènement</div>
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
                            {!! Form::model(new App\Models\Event, ['route' => ['event.store'], 'class' => 'form-horizontal']) !!}
                            <div class="form-group">
                                {!! Form::label('name', 'Nom de l\'évènement', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {!! Form::text('name', Input::old('name'), array('class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('type_id', 'Type', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {!! Form::select('type_id', [0, 1, 2, 3], Input::old('type_id'), array('class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('address', 'Adresse', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-4">
                                    {!! Form::text('address', Input::old('address'), array('class' => 'form-control placepicker')) !!}
                                </div>
                                <div class="col-md-2">
                                    <button data-toggle="collapse" href="#collapseOne" class="btn btn-default btn-map">Afficher la carte</button>
                                </div>
                            </div>

                            <div id="collapseOne" class="collapse col-md-offset-4 col-md-6">
                                <div class="placepicker-map thumbnail" style="height:500px;"></div>
                            </div>

                            <div class="form-group hidden">
                                <div class="col-md-6">
                                    {!! Form::hidden('latitude', '', array('class' => 'form-control latitude')) !!}
                                </div>
                            </div>

                            <div class="form-group hidden">
                                <div class="col-md-6">
                                    {!! Form::hidden('longitude', '', array('class' => 'form-control longitude')) !!}
                                </div>
                            </div>

                            <div class="form-group" id="sandbox-container">
                                {!! Form::label('start_date', 'Date de début', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {!! Form::input('date', 'start_date', Input::old('star_date'), ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="form-group" id="sandbox-container">
                                {!! Form::label('end_date', 'Date de fin', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {!! Form::input('date', 'end_date', Input::old('end_date'), ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('description', 'Description', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {!! Form::textarea('description', Input::old('description'), array('class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('poster', 'Affiche', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    <!-- TODO Upload fichier -->
                                    {!! Form::text('poster', Input::old('poster'), array('class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('private', 'Évènement privé ?', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {!! Form::checkbox('private', Input::old('private'), null, array('class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="form-group hidden">
                                <div class="col-md-6">
                                    <!-- TODO Trouver un moyen plus propre de placer l'user_id -->
                                    {!! Form::hidden('user_id', Auth::user()->id, array('class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="text-center">
                                {!! Form::submit('Enregistrer l\'évènement',['class'=>'btn btn-primary']) !!}
                            </div>


                            {!! Form::close() !!}
                        @else
                            <p>Vous devez être connecté afin d'ajouter un évènement.<br>
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

    <script>
        $('#sandbox-container input').datepicker({
            format: "yyyy-mm-dd",
            language: "fr"
        });


        $(document).ready(function() {

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
                        console.log("changé !");
                        $('.latitude').val(this.getLatLng().lat());
                        $('.longitude').val(this.getLatLng().lng());
                    }
                }).data('placepicker');


                // [Japanin] Save latitude and longitude
//                var lat = placepicker.getLatLng().lat();
//                var lng = placepicker.getLatLng().lng();



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
                    console.log($(this).text());
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

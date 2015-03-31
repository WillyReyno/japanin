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
                            <div class="col-md-6">
                                <!-- TODO Ajouter Google Maps -->
                                {!! Form::text('address', Input::old('address'), array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group hidden">
                            <div class="col-md-6">
                                {!! Form::hidden('latitude', '1,2', array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group hidden">
                            <div class="col-md-6">
                                {!! Form::hidden('longitude', '1,3', array('class' => 'form-control')) !!}
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


<div class="form-group">
    {!! Form::label('name', 'Nom de l\'évènement', array('class' => 'col-md-4 control-label')) !!}
    <div class="col-md-6">
        {!! Form::text('name', Input::old('name'), array('class' => 'form-control')) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('type_id', 'Type', array('class' => 'col-md-4 control-label')) !!}
    <div class="col-md-6">
        <!-- TODO : Comment faire pour transférer $types ? -->
        {!! Form::select('type_id', $types, Input::old('type_id'), array('class' => 'form-control')) !!}
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
        {!! Form::input('date', 'start_date', Input::old('start_date'), ['class' => 'form-control']) !!}
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
    <div class="col-md-8">
        {!! Form::textarea('description', Input::old('description'), array('class' => 'form-control wysiwyg')) !!}
    </div>
</div>

<div class="form-group">

    <!-- TODO Display affiche actuelle if edit, et changer le texte du champs -->
    {!! Form::label('poster', 'Affiche', array('class' => 'col-md-4 control-label')) !!}
    <div class="col-md-6">
        {!! Form::file('poster', Input::old('poster'), array('class' => 'form-control')) !!}
    </div>
</div>

@if(Request::is('*/edit') && $event->poster))
    <div class="form-group">
        <div class="col-md-4 control-label">
            Ancienne image
        </div>
        <div class="col-md-3">
            <img src="{{route('getentry', $event->poster)}}" class="img-responsive">
        </div>
    </div>
@endif

<div class="form-group">
    {!! Form::label('private', 'Évènement privé ?', array('class' => 'col-md-4 control-label')) !!}
    <div class="pull-left">
        {!! Form::checkbox('private', Input::old('private'), null, array('class' => 'form-control')) !!}
    </div>
</div>

<div class="text-center">
    {!! Form::submit($submit_text, ['class'=>'btn btn-primary']) !!}
</div>
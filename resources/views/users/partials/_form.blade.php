
<div class="form-group">
    {!! Form::label('username', 'Pseudo', array('class' => 'col-md-4 control-label')) !!}
    <div class="col-md-6">
        {!! Form::text('username', Input::old('username'), array('class' => 'form-control')) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('email', 'E-mail', array('class' => 'col-md-4 control-label')) !!}
    <div class="col-md-6">
        {!! Form::email('email', Input::old('email'), array('class' => 'form-control')) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('password', 'Mot de passe', array('class' => 'col-md-4 control-label')) !!}
    <div class="col-md-6">
        {!! Form::password('password', array('class' => 'form-control')) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('password_confirmation', 'Confirmation Mot de passe', array('class' => 'col-md-4 control-label')) !!}
    <div class="col-md-6">
        {!! Form::password('password_confirmation', array('class' => 'form-control')) !!}
    </div>
</div>

<div class="form-group" id="sandbox-container">
    {!! Form::label('birth', 'Date de naissance', array('class' => 'col-md-4 control-label')) !!}
    <div class="col-md-6">
        {!! Form::input('date', 'birth', Input::old('birth'), ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Sexe</label>

    <div class="col-md-2">
        {!! Form::select('sex', ['female' => 'Femme', 'male' => 'Homme', 'other' => 'Autre'], Input::old('type_id'), ['class' => 'form-control']) !!}
    </div>
</div>


<div class="text-center">
    {!! Form::submit($submit_text, ['class'=>'btn btn-primary']) !!}
</div>
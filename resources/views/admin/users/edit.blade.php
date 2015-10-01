@extends('admin')



@section('content')
        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

        @if(Session::get('message'))
            <div class="alert alert-{!! Session::get('color') !!}" role="alert">
                {{Session::get('message')}}
            </div>
        @endif

        {!! Form::open(['method' => 'put', 'url' => route('admin.user.update', $user->id)]) !!}

        <div class="form-group">
            {!! Form::label('username', 'Pseudo') !!}

            {!! Form::text('username', $user->username, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', 'Adresse e-mail') !!}

            {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
        </div>

        @if(!$user->provider)
            <div class="form-group">
                {!! Form::label('password', 'Mot de passe') !!}

                {!! Form::password('password', array('class' => 'form-control')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('password_confirmation', 'Confirmation Mot de passe') !!}

                {!! Form::password('password_confirmation', array('class' => 'form-control')) !!}
            </div>
        @endif

        <div class="form-group" id="sandbox-container">
            {!! Form::label('birth', 'Date de naissance') !!}

            {!! Form::input('date', 'birth', $user->birth, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('sex', 'Sexe') !!}

            {!! Form::select('sex', [null => 'Non renseigné', 'female' => 'Femme', 'male' => 'Homme', 'other' => 'Autre'], $user->sex, ['class' => 'form-control']) !!}
        </div>

        <button class="btn btn-primary">Sauvegarder</button>

        {!! Form::close() !!}
                <!-- Main row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

@endsection

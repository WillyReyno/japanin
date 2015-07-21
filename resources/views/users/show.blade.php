@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $user->username }}</div>


                    <div class="panel-body">
                        <h2>{{ $user->username }}</h2>
                        <img src="{{Gravatar::get($user->email)}}">
                        <ul>
                            <li>Pseudo : {{ $user->username }}</li>
                            <li>E-mail : {{ $user->email }}</li> <!-- TODO à masquer plus tard -->
                            <li>Date de naissance : {{ $user->birth }}</li>
                            <li>Sexe : {{ $user->sex }}</li>
                        </ul>

                        <!-- TODO afficher les évènements auquels il participe -->



                        @if(Auth::user()->isAdmin() OR Auth::user()->id == $user->id)
                            {!! Form::open(array('class' => 'form-inline col-md-12', 'method' => 'DELETE', 'route' => array('user.destroy', $user->slug))) !!}

                            @allowed('edit.user', $user)
                            {!! link_to_route('user.edit', 'Modifier', array($user->slug), array('class' => 'btn btn-info')) !!}
                            @endallowed

                            @allowed('delete.user', $user)
                            {!! Form::submit('Supprimer', array('class' => 'btn btn-danger')) !!}
                            @endallowed

                            {!! Form::close() !!}

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $user->username }}</div>


                    <div class="panel-body">
                        <h2>{{ $user->username }}</h2>
                        @if($user->avatar)
                            <img src="{{ $user->avatar }}">
                        @elseif(Gravatar::get($user->email))
                            <img src="{{Gravatar::get($user->email)}}">
                        @else
                            <!-- TODO avatar par défaut -->
                        @endif

                        <h3>Informations</h3>
                        <ul>
                            <!-- TODO une option dans le profil pour masquer ces infos ? -->
                            @if($user->email)
                                <li>E-mail : {{ $user->email }}</li>
                            @endif

                            @if($user->birth != "0000-00-00")
                                <li>Date de naissance : {{ $user->birth }}</li>
                            @endif

                            @if(!empty($user->sex))
                                <li>Sexe : {{ $user->sex }}</li>
                            @endif
                        </ul>

                        <h3>Évènements ajoutés</h3>
                        <ul>
                            @forelse($events_created as $event_created)
                                <li><a href="{{ route('event.show', $event_created->slug) }}">{{$event_created->name}}</a></li>
                            @empty
                                <li>Aucun évènement ajouté pour le moment.</li>
                            @endforelse
                        </ul>

                        {{--<h3>A été aux évènements suivants : </h3>
                        <ul>
                            @foreach($events_created as $event_created)
                                <li>{{$event_created}}</li>
                            @endforeach
                        </ul>--}}
                        <!-- TODO afficher les évènements auquels il participe -->

                        @if(Auth::check() && (Auth::user()->isAdmin() OR Auth::user()->id === $user->id))

                            {!! Form::open(array('class' => 'form-inline col-md-12', 'method' => 'DELETE', 'route' => array('user.destroy', $user->slug))) !!}

                            {!! link_to_route('user.edit', 'Modifier', array($user->slug), array('class' => 'btn btn-info')) !!}

                            {!! Form::submit('Supprimer', array('class' => 'btn btn-danger')) !!}

                            {!! Form::close() !!}

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Utilisateurs</div>


                    <div class="panel-body">
                        <h2>Liste des membres</h2>
                        @if ( !$users->count() )
                            Il n'y a aucun utilisateur inscrit.
                        @else
                            <ul>
                                @foreach( $users as $user )
                                    <li><a href="{{ route('user.show', $user->slug) }}">{{ $user->username }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

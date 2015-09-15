<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Japanin</title>

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">

    <!-- Fonts -->
    {{--<link href='//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>--}}
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    @yield('css')

            <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#japanin-navbar">
                <span class="sr-only">Afficher la navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">Japanin</a>
        </div>

        <div class="collapse navbar-collapse" id="japanin-navbar">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/event') }}">Évènements</a></li>
                <li><a href="{{ url('/user') }}">Membres</a></li>
                <li><a href="{{ url('/admin') }}">Admin</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())

                    <li><a href="{{ url('/auth/login') }}">Connexion</a></li>
                    <li><a href="{{ url('/auth/register') }}">Inscription</a></li>
                @else
                    <li>
                        @if(Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}">
                        @elseif(Gravatar::get(Auth::user()->email))
                            <img src="{{Gravatar::get(Auth::user()->email)}}">
                            <!-- TODO avatar par défaut -->
                        @endif
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->username }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/user', Auth::user()->slug) }}">Profil</a></li>
                            <li><a href="{{ url('/auth/logout') }}">Déconnexion</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@if(!Auth::check())
    <div class="container">
        <div class="row">
           <!-- <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
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
                        <a class="btn btn-primary" href="/login/facebook">Se connecter avec Facebook</a><br>
                        <a class="btn btn-danger" href="/login/google">Se connecter avec Google</a><br>
                        <a class="btn btn-info" href="/login/twitter">Se connecter avec Twitter</a><br>

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Username</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">Login</button>

                                    <a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>-->

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
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

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Pseudo</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">E-mail</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Mot de passe</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Confirmation Mot de passe</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                            {{--<div class="form-group" id="sandbox-container">
                                <label class="col-md-4 control-label">Date de naissance</label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control" name="birth" value="{{ old('birth') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Sexe</label>

                                <div class="col-md-2">
                                    {!! Form::select('sex', ['female' => 'Femme', 'male' => 'Homme', 'other' => 'Autre'], Input::old('type_id'), ['class' => 'form-control']) !!}
                                </div>
                            </div>--}}

                            <!--<div class="form-group">
                            <label class="col-md-4 control-label">Avatar</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="avatar" value="{{ old('avatar') }}">
                            </div>
                        </div>-->

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Inscription
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endif

    @yield('content')

            <!-- Scripts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

    @yield('scripts')
</body>
</html>

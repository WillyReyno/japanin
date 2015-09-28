@extends('app')

@section('content')
	<div class="container">
		<div class="col-md-8 col-md-offset-2">
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
		</div>

		<div class="col-md-4 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Inscription</div>
				<div class="panel-body">
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

		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">S'inscire avec les réseaux sociaux</div>
				<div class="panel-body">
					<a class="btn btn-primary btn-block" href="/login/facebook">Inscription avec Facebook</a><br>
					<a class="btn btn-danger btn-block" href="/login/google">Inscription avec Google</a><br>
					<a class="btn btn-info btn-block" href="/login/twitter">Inscription avec Twitter</a><br>
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
			startView: 2,
			language: "fr"
		});
	</script>
@endsection

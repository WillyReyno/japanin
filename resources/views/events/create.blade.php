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

					{!! Form::model(new App\Models\Event, ['route' => ['event.store']]) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Nom de lévènement') !!}
                            {!! Form::text('name') !!}
                        </div>
					{!! Form::close() !!}

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/event/store') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Nom de l'évènement</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Type</label>
							<div class="col-md-6">
							<!-- TODO Dynamiser les types -->
								<select class="form-control" name="type_id">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
								</select>
							</div>
						</div>

						<div class="form-group">
                            <label class="col-md-4 control-label">Adresse</label>
                            <div class="col-md-6">
                            <!-- TODO Ajouter Google Maps -->
                                <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                            </div>
                        </div>

						<div class="form-group hidden">
                            <div class="col-md-6">
                            <!-- TODO Ajouter Google Maps -->
                                <input type="hidden" class="form-control" name="latitude" value="{{ old('latitude') }}">
                            </div>
                        </div>

						<div class="form-group hidden">
                            <div class="col-md-6">
                            <!-- TODO Ajouter Google Maps -->
                                <input type="hidden" class="form-control" name="longitude" value="{{ old('longitude') }}">
                            </div>
                        </div>

						<div class="form-group" id="sandbox-container">
                            <label class="col-md-4 control-label">Date de début</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="star_date" value="{{ old('star_date') }}">
                            </div>
                        </div>

						<div class="form-group" id="sandbox-container">
                            <label class="col-md-4 control-label">Date de fin</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="end_date" value="{{ old('end_date') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Description</label>
                            <div class="col-md-6">
                            <!-- TODO Ajouter WYSIWYG -->
                                <textarea class="form-control" name="description">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group hidden">
                            <label class="col-md-4 control-label">Affiche</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="poster" value="{{ old('poster') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Évènement privé ?</label>
                            <div class="col-md-6">
                                <input type="checkbox" class="form-control" name="private" value="{{ old('private') }}">
                            </div>
                        </div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Enregistrer l'évènement
								</button>
							</div>
						</div>

					</form>
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

@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Ajouter un évènement</div>
                    <div class="panel-body">
                        <p>Show {{$current_event->name}}! {{ var_dump($current_event) }}</p>
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

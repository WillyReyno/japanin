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

        {!! Form::open(['method' => 'put', 'files' => true, 'url' => route('admin.event.update', $event)]) !!}

        <div class="form-group">
            {!! Form::label('name', 'Titre') !!}

            {!! Form::text('name', $event->name, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('type_slug', 'Type') !!}

            {!! Form::select('type_slug', $types, $event->type_slug, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('address', 'Adresse') !!}

            {!! Form::text('address', $event->address, ['class' => 'form-control placepicker']) !!}

            <button data-toggle="collapse" href="#collapseOne" class="btn btn-default btn-map">Afficher la carte</button>

        </div>

        <div id="collapseOne" class="collapse">
            <div class="placepicker-map thumbnail" style="height:500px;"></div>
        </div>

        <div class="form-group hidden">
            {!! Form::hidden('latitude', '', ['class' => 'form-control latitude']) !!}
        </div>

        <div class="form-group hidden">
            {!! Form::hidden('longitude', '', ['class' => 'form-control longitude']) !!}
        </div>

        <div class="form-group" id="sandbox-container">
            {!! Form::label('start_date', 'Date de début') !!}
            {!! Form::input('date', 'start_date', $event->start_date, ['class' => 'form-control']) !!}

        </div>

        <div class="form-group" id="sandbox-container">
            {!! Form::label('end_date', 'Date de fin') !!}

            {!! Form::input('date', 'end_date', $event->end_date, ['class' => 'form-control']) !!}

        </div>

        <div class="form-group">
            {!! Form::label('description', 'Description'    ) !!}

            {!! Form::textarea('description', $event->description, ['class' => 'form-control wysiwyg']) !!}
        </div>

        <div class="form-group">

            <!-- TODO Display affiche actuelle if edit, et changer le texte du champs -->
            {!! Form::label('poster', 'Affiche') !!}

            @if($event->poster)
                {!! Form::file('poster', null, array('class' => 'form-control')) !!}
            @else
                {!! Form::file('poster', $event->poster, array('class' => 'form-control')) !!}
            @endif

        </div>

            {{--  TODO Bug upload image --}}
        @if(Request::is('*/edit') && $event->poster))

        <div class="form-group">
            <div class="control-label">
                Ancienne image
            </div>
            <img src="{{route('getentry', $event->poster)}}" class="img-responsive">
        </div>
        @endif

        <div class="form-group">
            {!! Form::label('private', 'Évènement privé ?') !!}
            {!! Form::checkbox('private', $event->private, null) !!}
        </div>
        {{-- TODO Remaining fields --}}

        <button class="btn btn-primary">Sauvegarder</button>

        {!! Form::close() !!}
                <!-- Main row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

@endsection

@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Evènements !</div>

				<div class="panel-body">
					<h2>Évènements</h2>
                         @if ( !$events->count() )
                            Aucun évènement pour le moment.
                        @else
                            <ul>
                                @foreach( $events as $event )
                                    <li><a href="{{ route('events.show', $event->slug) }}">{{ $event->name }}</a></li>
                                @endforeach
                            </ul>
                        @endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
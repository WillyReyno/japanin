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
                    <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-12">
                    <!-- TABLE: LATEST ORDERS -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Évènements</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body ">
                            <div class="table-responsive">
                                <table class="table no-margin event-table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Type</th>
                                        <th>Début</th>
                                        <th>Fin</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach ($events as $event)
                                        <tr>
                                            <td>{{ $event->id }}</td>

                                            <td><a href="{{ route('showEvents', [$event->type_slug, $event->slug, $event->id]) }}">{{ $event->name }}</a></td>
                                            <td>{{ $event->type_slug }}</td>
                                            <td>{{ $event->start_date }}</td>
                                            <td>{{ $event->end_date }}</td>
                                            <td><a href="{{ route('admin.event.edit', $event) }}" class="btn btn-warning">Modifier</a></td>
                                            <td>
                                                {!! Form::open(array('class' => 'form-inline col-md-12', 'method' => 'DELETE', 'route' => array('admin.event.destroy', $event->id))) !!}

                                                {!! Form::submit('Supprimer', array('class' => 'btn btn-danger')) !!}

                                                {!! Form::close() !!}</td>

                                            {{--@if($issue['state'] == 'open')--}}
                                            {{--<td><span class="label label-success">{{ $issue['state'] }}</span></td>--}}
                                            {{--@else--}}
                                            {{--<td><span class="label label-danger">{{ $issue['state'] }}</span></td>--}}
                                            {{--@endif--}}
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div><!-- /.table-responsive -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

@endsection

@section('script')

    <script type="text/javascript">

        $(function(){
            $('.event-table').DataTable(
                    {
                        "columnDefs": [
                            { "searchable": false, "targets": [5, 6] }
                        ]
                    }
            );
        });
    </script>
@endsection

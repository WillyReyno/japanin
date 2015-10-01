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
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-blue"><i class="fa fa-facebook"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Facebook</span>
                            <span class="info-box-number">{{ $facebook }}</span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-twitter"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Twitter</span>
                            <span class="info-box-number">{{ $twitter }}</span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-google"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Google</span>
                            <span class="info-box-number">{{ $google }}</span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-orange"><i class="ion ion-ios-people-outline"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Japanin</span>
                            <span class="info-box-number">{{ $japanin }}</span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
                    <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-12">
                    <!-- TABLE: LATEST ORDERS -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Utilisateurs</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin user-table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Pseudo</th>
                                        <th>Provider</th>
                                        <th>Actif</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            @if($user == Auth::user())
                                                <strong></strong>
                                            @endif
                                            <td>
                                                @if($user == Auth::user())
                                                    <strong> {{--Temporaire, pour afficher le pseudo du compte actuel en gras--}}
                                                        @endif
                                                        {{ $user->username }}
                                                        @if($user == Auth::user())
                                                    </strong> {{--Temporaire, pour afficher le pseudo du compte actuel en gras--}}
                                                @endif
                                            </td>
                                            <td>{{ ($user->provider) ? $user->provider : 'japanin' }}</td>
                                            <td>{{ ($user->active) ? 'Oui' : 'Non' }}</td>
                                            <td><a href="{{ route('admin.user.edit', $user) }}" class="btn btn-warning">Modifier</a></td>
                                            <td>
                                                {!! Form::open(array('class' => 'form-inline col-md-12', 'method' => 'DELETE', 'route' => array('admin.user.destroy', $user->id))) !!}

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
                                {{-- $users->render() --}}

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
            $('.user-table').DataTable(
                    {
                        "columnDefs": [
                            { "searchable": false, "targets": [4, 5] }
                        ]
                    }
            );
        });
    </script>
@endsection
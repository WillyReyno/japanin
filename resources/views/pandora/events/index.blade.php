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
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
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

                                            <td>{{ $event->name }}</td>
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
                                {!! $events->render() !!}
                            </div><!-- /.table-responsive -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->

                    <div class="row hidden">
                        <div class="col-md-6">
                            <!-- DIRECT CHAT -->
                            <div class="box box-warning direct-chat direct-chat-warning">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Direct Chat</h3>
                                    <div class="box-tools pull-right">
                                        <span data-toggle="tooltip" title="3 New Messages" class="badge bg-yellow">3</span>
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"><i class="fa fa-comments"></i></button>
                                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <!-- Conversations are loaded here -->
                                    <div class="direct-chat-messages">
                                        <!-- Message. Default to the left -->
                                        <div class="direct-chat-msg">
                                            <div class="direct-chat-info clearfix">
                                                <span class="direct-chat-name pull-left">Alexander Pierce</span>
                                                <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
                                            </div><!-- /.direct-chat-info -->
                                            <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image" /><!-- /.direct-chat-img -->
                                            <div class="direct-chat-text">
                                                Is this template really for free? That's unbelievable!
                                            </div><!-- /.direct-chat-text -->
                                        </div><!-- /.direct-chat-msg -->

                                        <!-- Message to the right -->
                                        <div class="direct-chat-msg right">
                                            <div class="direct-chat-info clearfix">
                                                <span class="direct-chat-name pull-right">Sarah Bullock</span>
                                                <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
                                            </div><!-- /.direct-chat-info -->
                                            <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image" /><!-- /.direct-chat-img -->
                                            <div class="direct-chat-text">
                                                You better believe it!
                                            </div><!-- /.direct-chat-text -->
                                        </div><!-- /.direct-chat-msg -->

                                        <!-- Message. Default to the left -->
                                        <div class="direct-chat-msg">
                                            <div class="direct-chat-info clearfix">
                                                <span class="direct-chat-name pull-left">Alexander Pierce</span>
                                                <span class="direct-chat-timestamp pull-right">23 Jan 5:37 pm</span>
                                            </div><!-- /.direct-chat-info -->
                                            <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image" /><!-- /.direct-chat-img -->
                                            <div class="direct-chat-text">
                                                Working with AdminLTE on a great new app! Wanna join?
                                            </div><!-- /.direct-chat-text -->
                                        </div><!-- /.direct-chat-msg -->

                                        <!-- Message to the right -->
                                        <div class="direct-chat-msg right">
                                            <div class="direct-chat-info clearfix">
                                                <span class="direct-chat-name pull-right">Sarah Bullock</span>
                                                <span class="direct-chat-timestamp pull-left">23 Jan 6:10 pm</span>
                                            </div><!-- /.direct-chat-info -->
                                            <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image" /><!-- /.direct-chat-img -->
                                            <div class="direct-chat-text">
                                                I would love to.
                                            </div><!-- /.direct-chat-text -->
                                        </div><!-- /.direct-chat-msg -->

                                    </div><!--/.direct-chat-messages-->

                                    <!-- Contacts are loaded here -->
                                    <div class="direct-chat-contacts">
                                        <ul class="contacts-list">
                                            <li>
                                                <a href="#">
                                                    <img class="contacts-list-img" src="dist/img/user1-128x128.jpg" />
                                                    <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  Count Dracula
                                  <small class="contacts-list-date pull-right">2/28/2015</small>
                                </span>
                                                        <span class="contacts-list-msg">How have you been? I was...</span>
                                                    </div><!-- /.contacts-list-info -->
                                                </a>
                                            </li><!-- End Contact Item -->
                                            <li>
                                                <a href="#">
                                                    <img class="contacts-list-img" src="dist/img/user7-128x128.jpg" />
                                                    <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  Sarah Doe
                                  <small class="contacts-list-date pull-right">2/23/2015</small>
                                </span>
                                                        <span class="contacts-list-msg">I will be waiting for...</span>
                                                    </div><!-- /.contacts-list-info -->
                                                </a>
                                            </li><!-- End Contact Item -->
                                            <li>
                                                <a href="#">
                                                    <img class="contacts-list-img" src="dist/img/user3-128x128.jpg" />
                                                    <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  Nadia Jolie
                                  <small class="contacts-list-date pull-right">2/20/2015</small>
                                </span>
                                                        <span class="contacts-list-msg">I'll call you back at...</span>
                                                    </div><!-- /.contacts-list-info -->
                                                </a>
                                            </li><!-- End Contact Item -->
                                            <li>
                                                <a href="#">
                                                    <img class="contacts-list-img" src="dist/img/user5-128x128.jpg" />
                                                    <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  Nora S. Vans
                                  <small class="contacts-list-date pull-right">2/10/2015</small>
                                </span>
                                                        <span class="contacts-list-msg">Where is your new...</span>
                                                    </div><!-- /.contacts-list-info -->
                                                </a>
                                            </li><!-- End Contact Item -->
                                            <li>
                                                <a href="#">
                                                    <img class="contacts-list-img" src="dist/img/user6-128x128.jpg" />
                                                    <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  John K.
                                  <small class="contacts-list-date pull-right">1/27/2015</small>
                                </span>
                                                        <span class="contacts-list-msg">Can I take a look at...</span>
                                                    </div><!-- /.contacts-list-info -->
                                                </a>
                                            </li><!-- End Contact Item -->
                                            <li>
                                                <a href="#">
                                                    <img class="contacts-list-img" src="dist/img/user8-128x128.jpg" />
                                                    <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  Kenneth M.
                                  <small class="contacts-list-date pull-right">1/4/2015</small>
                                </span>
                                                        <span class="contacts-list-msg">Never mind I found...</span>
                                                    </div><!-- /.contacts-list-info -->
                                                </a>
                                            </li><!-- End Contact Item -->
                                        </ul><!-- /.contatcts-list -->
                                    </div><!-- /.direct-chat-pane -->
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <form action="#" method="post">
                                        <div class="input-group">
                                            <input type="text" name="message" placeholder="Type Message ..." class="form-control" />
                          <span class="input-group-btn">
                            <button type="button" class="btn btn-warning btn-flat">Send</button>
                          </span>
                                        </div>
                                    </form>
                                </div><!-- /.box-footer-->
                            </div><!--/.direct-chat -->
                        </div><!-- /.col -->

                        <div class="col-md-6">
                            <!-- USERS LIST -->
                            <div class="box box-danger">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Dernières inscriptions</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <ul class="users-list clearfix">
                                        {{--@foreach ($latestUsers as $user)
                                            <li>
                                                @if($user->avatar)
                                                    <img src="{{ $user->avatar }}">
                                                @elseif(Gravatar::get($user->email))
                                                    <img src="{{Gravatar::get($user->email)}}">
                                                    <!-- TODO avatar par défaut -->
                                                @endif
                                                <a class="users-list-name" href="#">{{ $user->username }}</a>

                                                <span class="users-list-date">{{ $user->created_at->format('d M') }}</span>
                                            </li>
                                        @endforeach--}}
                                    </ul><!-- /.users-list -->
                                </div><!-- /.box-body -->
                                <div class="box-footer text-center">
                                    <a href="javascript::" class="uppercase">View All Users</a>
                                </div><!-- /.box-footer -->
                            </div><!--/.box -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <!-- MAP & BOX PANE -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Visitors Report</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body no-padding">
                            <div class="row">
                                <div class="col-md-9 col-sm-8">
                                    <div class="pad">
                                        <!-- Map will be created here -->
                                        <div id="world-map-markers" style="height: 325px;"></div>
                                    </div>
                                </div><!-- /.col -->
                                <div class="col-md-3 col-sm-4">
                                    <div class="pad box-pane-right bg-green" style="min-height: 280px">
                                        <div class="description-block margin-bottom">
                                            <div class="sparkbar pad" data-color="#fff">90,70,90,70,75,80,70</div>
                                            <h5 class="description-header">8390</h5>
                                            <span class="description-text">Visits</span>
                                        </div><!-- /.description-block -->
                                        <div class="description-block margin-bottom">
                                            <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                                            <h5 class="description-header">30%</h5>
                                            <span class="description-text">Referrals</span>
                                        </div><!-- /.description-block -->
                                        <div class="description-block">
                                            <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                                            <h5 class="description-header">70%</h5>
                                            <span class="description-text">Organic</span>
                                        </div><!-- /.description-block -->
                                    </div>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->

                </div><!-- /.col -->

                <div class="col-md-4">
                    <!-- PRODUCT LIST -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Derniers évènements ajoutés</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div><!-- /.box-header -->


                        <div class="box-body">
                            <ul class="products-list product-list-in-box">
                                {{--@foreach($latestEvents as $event)

                                    <li class="item">
                                        <div class="product-img">
                                            @if($event->poster)
                                                <img src="{{route('getentry', $event->poster)}}" alt="Product Image" />
                                            @endif
                                        </div>
                                        <div class="product-info">

                                            <a href="{{ route('showEvents', [$event->type_slug, $event->slug, $event->id]) }}" class="product-title">
                                                {{$event->name}} <span class="label label-info pull-right">{{$event->type_slug}}</span>
                                            </a>
                                                    <span class="product-description">
                                                      {{  $event->description }}
                                                    </span>
                                        </div>
                                    </li><!-- /.item -->
                                @endforeach--}}
                            </ul>
                        </div><!-- /.box-body -->
                        <div class="box-footer text-center">
                            <a href="javascript::;" class="uppercase">Voir tous les évènements</a>
                        </div><!-- /.box-footer -->
                    </div><!-- /.box -->

                    <!-- USERS LIST -->
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Dernières inscriptions</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body no-padding">
                            <ul class="users-list clearfix">
                                {{--@foreach ($latestUsers as $user)
                                    <li>
                                        @if($user->avatar)
                                            <img src="{{ $user->avatar }}">
                                        @elseif(Gravatar::get($user->email))
                                            <img src="{{Gravatar::get($user->email)}}">
                                            <!-- TODO avatar par défaut -->
                                        @endif
                                        <a class="users-list-name" href="#">{{ $user->username }}</a>

                                        <span class="users-list-date">{{ $user->created_at->format('d M') }}</span>
                                    </li>
                                @endforeach--}}
                            </ul><!-- /.users-list -->
                        </div><!-- /.box-body -->
                        <div class="box-footer text-center">
                            <a href="javascript::" class="uppercase">View All Users</a>
                        </div><!-- /.box-footer -->
                    </div><!--/.box -->
                    <!-- Info Boxes Style 2 -->
                    <div class="info-box bg-yellow">
                        <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Inventory</span>
                            <span class="info-box-number">5,200</span>
                            <div class="progress">
                                <div class="progress-bar" style="width: 50%"></div>
                            </div>
                  <span class="progress-description">
                    50% Increase in 30 Days
                  </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                    <div class="info-box bg-green">
                        <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Mentions</span>
                            <span class="info-box-number">92,050</span>
                            <div class="progress">
                                <div class="progress-bar" style="width: 20%"></div>
                            </div>
                  <span class="progress-description">
                    20% Increase in 30 Days
                  </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                    <div class="info-box bg-red">
                        <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Downloads</span>
                            <span class="info-box-number">114,381</span>
                            <div class="progress">
                                <div class="progress-bar" style="width: 70%"></div>
                            </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                    <div class="info-box bg-aqua">
                        <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Direct Messages</span>
                            <span class="info-box-number">163,921</span>
                            <div class="progress">
                                <div class="progress-bar" style="width: 40%"></div>
                            </div>
                  <span class="progress-description">
                    40% Increase in 30 Days
                  </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->

                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Browser Usage</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="chart-responsive">
                                        <canvas id="pieChart" height="150"></canvas>
                                    </div><!-- ./chart-responsive -->
                                </div><!-- /.col -->
                                <div class="col-md-4">
                                    <ul class="chart-legend clearfix">
                                        <li><i class="fa fa-circle-o text-red"></i> Chrome</li>
                                        <li><i class="fa fa-circle-o text-green"></i> IE</li>
                                        <li><i class="fa fa-circle-o text-yellow"></i> FireFox</li>
                                        <li><i class="fa fa-circle-o text-aqua"></i> Safari</li>
                                        <li><i class="fa fa-circle-o text-light-blue"></i> Opera</li>
                                        <li><i class="fa fa-circle-o text-gray"></i> Navigator</li>
                                    </ul>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.box-body -->
                        <div class="box-footer no-padding">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">United States of America <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
                                <li><a href="#">India <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a></li>
                                <li><a href="#">China <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>
                            </ul>
                        </div><!-- /.footer -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->




@endsection
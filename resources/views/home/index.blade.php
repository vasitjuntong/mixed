@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <span class="pull-left"><i class="fa fa-bar-chart-o fa-lg"></i> REQUISITION Traffic</span>
                    <ul class="tool-bar">
                        <li><a href="#" class="refresh-widget" data-toggle="tooltip" data-placement="bottom" title=""
                               data-original-title="Refresh"><i class="fa fa-refresh"></i></a></li>
                    </ul>
                </div>
                <div class="panel-body" id="trafficWidget">
                    <div id="placeholder" class="graph" style="height:250px"></div>
                </div>

                <div class="loading-overlay">
                    <i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
                </div>
            </div><!-- /panel -->

            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="panel panel-default panel-stat1 bg-success">
                        <div class="panel-body">
                            <div class="value">{{ $productCount }}</div>
                            <div class="title">
                                <i class="fa fa-folder"></i>
                                <span class="m-left-xs">PRODUCT</span>
                            </div>
                        </div>
                    </div><!-- /panel -->
                </div><!-- /.col -->
                <div class="col-md-4 col-sm-4">
                    <div class="panel panel-default panel-stat2 bg-warning">
                        <div class="panel-body">
						<span class="stat-icon">
							<i class="fa fa-bar-chart-o"></i>
						</span>
                            <div class="pull-right text-right">
                                <div class="value">{{ $receiveCount }}</div>
                                <div class="title">RECEIVE</div>
                            </div>
                        </div>
                    </div><!-- /panel -->
                </div><!-- /.col -->
                <div class="col-md-4 col-sm-4">
                    <div class="panel panel-default panel-stat2 bg-info">
                        <div class="panel-body">
						<span class="stat-icon">
							<i class="fa fa-bar-chart-o"></i>
						</span>
                            <div class="pull-right text-right">
                                <div class="value">{{ $requisitionCount }}</div>
                                <div class="title">REQUISITION</div>
                            </div>
                        </div>
                    </div><!-- /panel -->
                </div><!-- /.col -->
            </div>
            <p><!-- /.row --></p>
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading clearfix">
                            <span class="pull-left">Receive Feeds</span>
                            <ul class="tool-bar">
                                <li><a href="#feedList" data-toggle="collapse"><i class="fa fa-arrows-v"></i></a></li>
                            </ul>
                        </div>
                        <ul class="list-group collapse in" id="feedList">
                            @foreach($receives as $receive)
                                <li class="list-group-item clearfix">

                                    <div class="pull-left m-left-sm">
                                        <span><a href="/receives/review/{{ $receive->id }}">{!! $receive->statusHtml() !!} {{ $receive->document_no }} </a></span><br/>
                                        <small class="text-muted">
                                            <i class="fa fa-clock-o"></i>
                                            {{ $receive->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </li>
                            @endforeach
                        </ul><!-- /list-group -->
                        <div class="loading-overlay">
                            <i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
                        </div>
                    </div><!-- /panel -->
                </div><!-- /.col -->

                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading clearfix">
                            <span class="pull-left">Requisition Feeds</span>
                            <ul class="tool-bar">
                                <li><a href="#feedList" data-toggle="collapse"><i class="fa fa-arrows-v"></i></a></li>
                            </ul>
                        </div>
                        <ul class="list-group collapse in" id="feedList">
                            @foreach($requisitions as $requisition)
                                <li class="list-group-item clearfix">
                                    <div class="pull-left m-left-sm">
                                        <span><a href="/requisitions/{{ $requisition->id }}">{!! $requisition->statusHtml() !!}  {{ $requisition->document_no }}</a></span><br/>
                                        <small class="text-muted"><i class="fa fa-clock-o"></i> {{ $requisition->created_at->diffForHumans() }}</small>
                                    </div>
                                </li>
                            @endforeach
                        </ul><!-- /list-group -->
                        <div class="loading-overlay">
                            <i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
                        </div>
                    </div><!-- /panel -->
                </div><!-- /.col -->
            </div><!-- ./row -->
        </div><!-- /.col -->
    </div><!-- /.row -->

@endsection
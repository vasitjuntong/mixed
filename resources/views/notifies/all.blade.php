@extends('layouts.app')

@section('breadcrump')
    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i>
                <a href="/"> {{ trans('main.breadcrump.home')}}</a>
            </li>
            <li class="active">Notify</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    You have new {{ $notifies->count() }} notifications.
                </div>
                <ul class="list-group">
                    @foreach($notifies as $notify)
                        <li class="list-group-item">
                            <h5 class="list-group-item-heading"><i class="alert-warning fa fa-warning"></i> {{ $notify->title }}</h5>
                            <em class="list-group-item-text">{{ $notify->created_at->diffForHumans() }}</em>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
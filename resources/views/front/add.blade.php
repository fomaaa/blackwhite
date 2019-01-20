@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{trans('message.choose')}}</div>

                <div class="panel-body">
                   <div class="row">
                       <div class="col-md-6 text-center"><a href="/add/black"><button type="button" class="btn  btn-lg btn-black big-btn">{{trans('message.bl')}}</button></a></div>
                       <div class="col-md-6 text-center"><a href="/add/white"><button type="button" class="btn big-btn btn-lg btn-default  ">{{trans('message.wl')}}</button></a></div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

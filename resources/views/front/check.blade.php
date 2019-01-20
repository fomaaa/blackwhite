@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{trans('message.check_client')}}</div>

                <div class="panel-body check-form">
                    <div class="row">
                        <form action="/checkbyphone" id="checkbyphone" method="post">
                             {{ csrf_field() }}
                            <div class="form-group">
                                <label for="phone" class="col-md-4 control-label">{{trans('message.enter_phone')}}</label>

                                <div class="col-md-4">
                                    <input id="phone" type="text" class="form-control" min="10" name="phone" placeholder="+97100000000">
                                    <span class="error">{{trans('message.ph_val')}}</span>
                                </div>
                                <div class="col-md-2">
                                     <button type="submit"  class="btn check-btn btn-primary ">{{trans('message.check')}}</button>
                                </div>
                            </div>  
                        </form>
                    </div>
                    <div class="row">
                        <form action="/checkbyemail" id="checkbyemail" method="post">
                             {{ csrf_field() }}
                            <div class="form-group">
                                <label for="phone" class="col-md-4 control-label">{{trans('message.enter_email')}}</label>

                                <div class="col-md-4">
                                    <input id="email" type="text" class="form-control" name="email" placeholder="Client email">
                                    <span class="error">{{trans('message.em_val')}}</span>
                                </div>
                                <div class="col-md-2">
                                     <button type="submit" class="btn check-btn btn-primary ">{{trans('message.check')}}</button>
                                </div>
                            </div>  
                        </form>
                    </div>  
                </div>
            </div>
        </div>
    </div>
    <div class="row review-block">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{trans('message.result')}}</div>
                <div class="res-container">
                    
                </div>


            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{trans('message.add_wl')}}</div>

                <div class="panel-body" data-tab="1">
                    <div class="row">
                        <div class="col-md-12">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                   <div class="row">
                    <form class="form-horizontal" id="addform" role="form" method="POST" action="/add/white" enctype='multipart/form-data'>
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="phone" class="col-md-4 control-label">{{trans('message.phone')}}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" placeholder="+97100000000">

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label for="phone" class="col-md-4 control-label">{{trans('message.cl_email')}}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" placeholder="client@mail.com">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label for="phone" class="col-md-4 control-label">{{trans('message.address')}}</label>

                            <div class="col-md-6">
                                <select class="form-control select" name="address" id="address">
                                    @foreach ($cities as $city)
                                    <option value="{{$city->id}}">{{$city->english}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label for="link" class="col-md-4 control-label">{{trans('message.socials')}}</label>
                            <div class="col-md-6">
                                <textarea id="link" type="text" class="form-control" rows="3" name="link" ></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-md-4 control-label">{{trans('message.review')}}</label>
                            <div class="col-md-6">
                                <textarea class="form-control" rows="3" id="description" type="text"  name="description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-md-4 control-label">{{trans('message.photos')}}</label>
                            <div class="col-md-6">
                                <input type="file" class="files form-control" id="photos" name="photos[]" multiple>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-md-4 control-label">{{trans('message.review')}}</label>

                            <div class="col-md-6">
                                <label class="checkbox-inline">
                                  <input type="radio" id="author" class="author" checked name="author" value="No"> {{trans('message.your_name')}}
                                </label>
                                <label class="checkbox-inline">
                                  <input type="radio" id="author" class="author" name="author" value="Yes"> {{trans('message.anon')}}
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-6 col-md-6">
                                <button  class="btn btn-primary btn-lg btn-success next-tab">{{trans('message.add_review')}}</button>
                            </div>
                        </div>
                        <input type="hidden" name="personal-mark">

                    </form>                     
                    </div>
                </div>
                <div class="panel-body result-body" data-tab="2">

                    <div class="form-horizontal">
                        <div class="row">
                            <div class="form-group">
                                <label for="phone" class="col-md-4 control-label">{{trans('message.phone')}}</label>
                                <div class="col-md-6">
                                    <label for="phone" class="col-md-4 control-label value"></label>
                                </div>
                            </div> 
                        </div>
                    </div>

                    <div class="form-horizontal">
                        <div class="row">
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">{{trans('message.cl_email')}}</label>
                                <div class="col-md-6">
                                    <label for="email" class="col-md-4 control-label value"></label>
                                </div>
                            </div> 
                        </div>
                    </div>

                    <div class="form-horizontal">
                        <div class="row">
                            <div class="form-group">
                                <label for="address" class="col-md-4 control-label">{{trans('message.address')}}</label>
                                <div class="col-md-6">
                                    <label for="address" class="col-md-4 control-label value">Dubia</label>
                                </div>
                            </div> 
                        </div>
                    </div>

                    <div class="form-horizontal">
                        <div class="row">
                            <div class="form-group">
                                <label for="link" class="col-md-4 control-label">{{trans('message.socials')}}</label>
                                <div class="col-md-6">
                                    <label for="link" class="col-md-4 control-label value"></label>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="form-horizontal">
                        <div class="row">
                            <div class="form-group">
                                <label for="description" class="col-md-4 control-label">{{trans('message.review')}}</label>
                                <div class="col-md-6">
                                    <label for="description" class="col-md-4 control-label value"></label>
                                </div>
                            </div> 
                        </div>
                    </div>                                        
                    <div class="form-horizontal">
                        <div class="row">
                            <div class="form-group">
                                <label for="author" class="col-md-4 control-label">{{trans('message.author')}}</label>
                                <div class="col-md-6">
                                    <label for="author" class="col-md-4 control-label value">
                                        {{trans('message.your_name')}}
                                    </label>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="form-horizontal">

                    <div class="form-horizontal">
                        <div class="row">
                            <div class=" col-md-6 btn-block">
                                <button  class="btn btn-primary btn-lg btn-primary prew-tab">{{trans('message.back_edit')}}</button>
                                <button type="submit" class="btn btn-primary btn-lg btn-success submit">{{trans('message.confirm_add')}}</button>
                            </div>                            
                        </div>                            
                    </div>

    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

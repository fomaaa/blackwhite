@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row client-header">
                        <div class="col-md-8 cl-id col-12" data-client="{{$data['client_id']}}">
                            <h2>
                            @if ($data['phone'])
                                {{$data['phone']}}
                            @else
                                {{$data['email']}}
                            @endif
                        </h2>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-primary info-btn" type="button">
                                        {{trans('message.reviews')}} <span class="badge">{{$data['reviewCount']}}</span>
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-info info-btn" type="button">
                                        {{trans('message.comments')}} <span class="badge">{{$data['commentsCount']}}</span>
                                    </button> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mark">
                        <div class="col-md-6">
                            <i>{{$data['mark']}}</i>
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>  
                            <form action="" class="mark-form">
                                <input type="text" value="{{$data['mark']}}" name="mark" class="personal-mark form-control">
                                <button type='submit' class="btn btn-primary">{{trans('message.edit')}}</button>
                            </form>     
                        </div>
                    </div>

                </div>

                <div class="panel-body  reviews-list">
                    @foreach ($data['reviews'] as $index => $review)
                    <div class="row review-item panel panel-default review-list-{{$review['list']}}">
                        <div class="col-md-4 ">
                            <div class="row">
                                <div class="col-md-12 thumb-row">
                                    <div class="inform-head">{{trans('message.type')}}:</div>
                                    @if ($review['list'] == "Black")
                                        <i class="fa fa-thumbs-down thumb"></i>
                                    @else
                                        <i class="fa fa-thumbs-up thumb"></i>
                                    @endif
                                </div>
                                <div class="col-md-12 ">
                                    <div class="inform-head">{{trans('message.author')}}:</div>
                                         <span class="author">
                                            <strong>
                                            @if($review['anon'] == 'Yes')
                                                {{trans('message.anon')}}
                                                @if(Auth::user()->type == "Admin" || Auth::user()->type == "SuperAdmin")   
                                                ({{$review['author']['name']}})     
                                                @endif
                                            @else
                                                {{$review['author']['name']}}
                                            @endif
                                            </strong>
                                        </span>
                                </div>                                
                                <div class="col-md-12 ">
                                    @if ($location == 'en')
                                        <div class="inform-head">{{trans('message.status')}}:</div> <span class="author"><strong>{{$review->status['english']}}</strong></span>

                                    @else
                                        <div class="inform-head">{{trans('message.status')}}:</div> <span class="author"><strong>{{$review->status['russian']}}</strong></span>
                                    @endif
                                </div>
                                <div class="col-md-12 ">
                                    <div class="inform-head">{{trans('message.phone')}}:</div> <span class="author"><strong>{{$review['phone']}}</strong></span>
                                </div>                                
                                <div class="col-md-12 ">
                                    @if ($location == 'en')
                                        <div class="inform-head">{{trans('message.address')}}:</div> <span class="author"><strong>{{$review['address']['english']}}</strong></span>
                                    @else
                                        <div class="inform-head">{{trans('message.address')}}:</div> <span class="author"><strong>{{$review['address']['russian']}}</strong></span>
                                    @endif
                                </div>
                                <div class="col-md-12 ">
                                    <div class="inform-head">{{trans('message.email')}}:</div> <span class="author"><strong>{{$review['email']}}</strong></span>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="inform-head">{{trans('message.links')}}:</div> <span class="author"><strong>{{$review['links']}}</strong></span>
                                </div>
                                <div class="col-md-12 ">
                                    @foreach ($review->images() as $key => $image)
                                        <a href="{{$image}}" data-fancybox='review-{{$index}}'>
                                            <img src="{{$image}}" class="small-photo" alt="">
                                        </a>                                    
                                    @endforeach
                                </div>   

                            </div>
                                        
                        </div>
                        <div class="col-md-8 review">
                           {{$review['review']}}
                        </div>
                        <div class="col-md-12 text-center">
                            @if(!empty($review['comments'][0]))
                            <button class="btn btn-success show-comments" data-show="false" type="button">
                                <span class="text">{{trans('message.show_com')}}</span>   <span class="badge">{{count($review['comments'])}}</span>
                            </button> 
                            @endif
                            <button data-review="1" class="btn btn-primary add-comment" type="button">
                                {{trans('message.add_com')}}
                            </button> 
                        </div>
                        <div class="col-md-12 comments-list">
                            <div class="row">
                                @foreach ($review['comments'] as $comment)
                                <div class="col-md-12 comment-item ">
                                    <div class="comment__header">
                                        <div class="comment__header-left">{{trans('message.author')}} : <span>
                                            @if($comment['anon'] == 'Yes')
                                                {{trans('message.anon')}}

                                                @if(Auth::user()->type == "Admin" || Auth::user()->type == "SuperAdmin")   
                                                ({{$comment['user']}})     
                                                @endif                              
                                            @else
                                                {{$comment['user']}}
                                            @endif  
                                        </span></div>
                                        <div class="comment__header-right">{{trans('message.date')}}: <span>{{$comment->created_at}}</span></div>
                                    </div>
                                    <div class="comment-body">
                                        {{$comment->comment}}
                                    </div>
                                </div> 
                                @endforeach                               
                            </div>
                        </div>
                        <form class="col-md-12 new-comment" data-review="{{$review->id}}" action="/addcomment" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="phone" class="col-md-4 control-label">{{trans('message.comment')}}</label>
                                <textarea id="phone" type="text" class="form-control" name="comment" placeholder=""></textarea>
                            </div>  
                            <div class="form-group">
                                <label class="checkbox-inline">
                                  <input type="radio" id="author" checked class="author" name="author" value="0"> {{trans('message.your_name')}}
                                </label>
                                <label class="checkbox-inline">
                                  <input type="radio" id="author" class="author" name="author" value="1"> {{trans('message.anon')}}
                                </label>
                                <button class="btn btn-warning">{{trans('message.add')}}</button>
                            </div>
                        </form>
                    </div>                     
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


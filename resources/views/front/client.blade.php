@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row client-header">
                        <div class="col-md-8"><h2>+799999999</h2></div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="button">
                                        Reviews <span class="badge">4</span>
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-info" type="button">
                                        Comments <span class="badge">55</span>
                                    </button> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mark">
                        <div class="col-md-6">
                            <i>You can leave a personal note for this user.</i>
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>  
                            <form action="" class="mark-form">
                                <input type="text" value="You can leave a personal note for this user." name="mark" class="personal-mark form-control">
                                <button type='submit' class="btn btn-primary">edit</button>
                            </form>     
                        </div>
                    </div>

                </div>

                <div class="panel-body  reviews-list">
                    <div class="row review-item panel panel-default">
                        <div class="col-md-4 ">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="inform-head">Author:</div> <span class="author"><strong>Nina 282</strong></span>
                                </div>                                
                                <div class="col-md-12 ">
                                    <div class="inform-head">Status:</div> <span class="author"><strong>Police</strong></span>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="inform-head">Phone:</div> <span class="author"><strong>+799999999</strong></span>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="inform-head">Email:</div> <span class="author"><strong>Client@mail.com</strong></span>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="inform-head">links:</div> <span class="author"><strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia, laboriosam.</strong></span>
                                </div>
                                <div class="col-md-12 ">
                                    <a href="http://via.placeholder.com/1024x1024" data-fancybox='review-1'>
                                        <img src="http://via.placeholder.com/100x100" class="small-photo" alt="">
                                    </a>                                    
                                    <a href="http://via.placeholder.com/1024x1024" data-fancybox='review-1'>
                                        <img src="http://via.placeholder.com/100x100" class="small-photo" alt="">
                                    </a>                                    
                                    <a href="http://via.placeholder.com/1024x1024" data-fancybox='review-1'>
                                        <img src="http://via.placeholder.com/100x100" class="small-photo" alt="">
                                    </a>                                    
                                    <a href="http://via.placeholder.com/1024x1024" data-fancybox='review-1'>
                                        <img src="http://via.placeholder.com/100x100" class="small-photo" alt="">
                                    </a>
                                </div>   

                            </div>
                                        
                        </div>
                        <div class="col-md-8 review">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. In veniam, blanditiis saepe, amet praesentium iusto odit labore, deleniti inventore sit quis vero aliquam atque debitis quibusdam perferendis omnis perspiciatis nam, asperiores est! Autem repudiandae nihil ullam neque, sequi delectus, vitae minima molestiae aliquid eius deleniti! Qui perferendis quo impedit voluptatem possimus aliquid velit, corporis dolorem minima, adipisci accusamus odit autem dolore numquam nemo! Quod distinctio suscipit, quos eaque asperiores consectetur, mollitia molestiae sequi corporis vitae nulla adipisci a vel odit ad harum. Eius, eligendi. Rerum dignissimos ex reprehenderit illo velit, rem atque odio molestias cupiditate non sequi aut, adipisci at!
                        </div>
                        <div class="col-md-12 text-center">
                            <button class="btn btn-success show-comments" type="button">
                                Show comments   <span class="badge">3</span>
                            </button> 
                            <button data-review="1" class="btn btn-primary add-comment" type="button">
                                Add comment   
                            </button> 
                        </div>
                        <div class="col-md-12 comments-list">
                            <div class="row">
                                <div class="col-md-12 comment-item ">
                                    <div class="comment__header">
                                        <div class="comment__header-left">Author : <span>Mashsa</span></div>
                                        <div class="comment__header-right">Data: <span>12.21.2020</span></div>
                                    </div>
                                    <div class="comment-body">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla vel corporis quas mollitia blanditiis, placeat, ea aut, repellat unde delectus repudiandae porro distinctio sequi nisi magnam voluptate voluptas dolore! Fugiat.
                                    </div>
                                </div>                                
                                <div class="col-md-12 comment-item ">
                                    <div class="comment__header">
                                        <div class="comment__header-left">Author : <span>Mashsa</span></div>
                                        <div class="comment__header-right">Data: <span>12.21.2020</span></div>
                                    </div>
                                    <div class="comment-body">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla vel corporis quas mollitia blanditiis, placeat, ea aut, repellat unde delectus repudiandae porro distinctio sequi nisi magnam voluptate voluptas dolore! Fugiat.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form class="col-md-12 new-comment" action="">
                            <div class="form-group">
                                <label for="phone" class="col-md-4 control-label">Comment</label>
                                <textarea id="phone" type="text" class="form-control" name="comment" placeholder=""></textarea>
                            </div>  
                            <div class="form-group">
                                <label class="checkbox-inline">
                                  <input type="radio" id="author" class="author" name="author" value="0"> Your name
                                </label>
                                <label class="checkbox-inline">
                                  <input type="radio" id="author" class="author" name="author" value="1"> Anonymously
                                </label>
                                <button class="btn btn-warning">Submit</button>
                            </div>
                        </form>
                    </div>                     
                    <div class="row review-item panel panel-default">
                        <div class="col-md-4 ">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="inform-head">Author:</div> <span class="author"><strong>Nina 282</strong></span>
                                </div>                                
                                <div class="col-md-12 ">
                                    <div class="inform-head">Status:</div> <span class="author"><strong>Police</strong></span>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="inform-head">Phone:</div> <span class="author"><strong>+799999999</strong></span>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="inform-head">Email:</div> <span class="author"><strong>Client@mail.com</strong></span>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="inform-head">links:</div> <span class="author"><strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia, laboriosam.</strong></span>
                                </div>
                                <div class="col-md-12 ">
                                    <a href="http://via.placeholder.com/1024x1024" data-fancybox='review-1'>
                                        <img src="http://via.placeholder.com/100x100" class="small-photo" alt="">
                                    </a>                                    
                                    <a href="http://via.placeholder.com/1024x1024" data-fancybox='review-1'>
                                        <img src="http://via.placeholder.com/100x100" class="small-photo" alt="">
                                    </a>                                    
                                    <a href="http://via.placeholder.com/1024x1024" data-fancybox='review-1'>
                                        <img src="http://via.placeholder.com/100x100" class="small-photo" alt="">
                                    </a>                                    
                                    <a href="http://via.placeholder.com/1024x1024" data-fancybox='review-1'>
                                        <img src="http://via.placeholder.com/100x100" class="small-photo" alt="">
                                    </a>
                                </div>   

                            </div>
                                        
                        </div>
                        <div class="col-md-8 review">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. In veniam, blanditiis saepe, amet praesentium iusto odit labore, deleniti inventore sit quis vero aliquam atque debitis quibusdam perferendis omnis perspiciatis nam, asperiores est! Autem repudiandae nihil ullam neque, sequi delectus, vitae minima molestiae aliquid eius deleniti! Qui perferendis quo impedit voluptatem possimus aliquid velit, corporis dolorem minima, adipisci accusamus odit autem dolore numquam nemo! Quod distinctio suscipit, quos eaque asperiores consectetur, mollitia molestiae sequi corporis vitae nulla adipisci a vel odit ad harum. Eius, eligendi. Rerum dignissimos ex reprehenderit illo velit, rem atque odio molestias cupiditate non sequi aut, adipisci at!
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

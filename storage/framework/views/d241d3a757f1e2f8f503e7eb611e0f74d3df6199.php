<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row client-header">
                        <div class="col-md-8 cl-id col-12" data-client="<?php echo e($data['client_id']); ?>">
                            <h2>
                            <?php if($data['phone']): ?>
                                <?php echo e($data['phone']); ?>

                            <?php else: ?>
                                <?php echo e($data['email']); ?>

                            <?php endif; ?>
                        </h2>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-primary info-btn" type="button">
                                        Reviews <span class="badge"><?php echo e($data['reviewCount']); ?></span>
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-info info-btn" type="button">
                                        Comments <span class="badge"><?php echo e($data['commentsCount']); ?></span>
                                    </button> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mark">
                        <div class="col-md-6">
                            <i><?php echo e($data['mark']); ?></i>
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>  
                            <form action="" class="mark-form">
                                <input type="text" value="<?php echo e($data['mark']); ?>" name="mark" class="personal-mark form-control">
                                <button type='submit' class="btn btn-primary">edit</button>
                            </form>     
                        </div>
                    </div>

                </div>

                <div class="panel-body  reviews-list">
                    <?php foreach($data['reviews'] as $index => $review): ?>
                    <div class="row review-item panel panel-default review-list-<?php echo e($review['list']); ?>">
                        <div class="col-md-4 ">
                            <div class="row">
                                <div class="col-md-12 thumb-row">
                                    <div class="inform-head">Type:</div>
                                    <?php if($review['list'] == "Black"): ?>
                                        <i class="fa fa-thumbs-down thumb"></i>
                                    <?php else: ?>
                                        <i class="fa fa-thumbs-up thumb"></i>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="inform-head">Author:</div>
                                         <span class="author">
                                            <strong>
                                            <?php if($review['anon'] == 'Yes'): ?>
                                                Anonymously
                                            <?php else: ?>
                                                <?php echo e($review['author']['name']); ?>

                                            <?php endif; ?>
                                            </strong>
                                        </span>
                                </div>                                
                                <div class="col-md-12 ">
                                    <div class="inform-head">Status:</div> <span class="author"><strong><?php echo e($review->status['english']); ?></strong></span>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="inform-head">Phone:</div> <span class="author"><strong><?php echo e($review['phone']); ?></strong></span>
                                </div>                                
                                <div class="col-md-12 ">
                                    <div class="inform-head">Address:</div> <span class="author"><strong><?php echo e($review['address']['english']); ?></strong></span>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="inform-head">Email:</div> <span class="author"><strong><?php echo e($review['email']); ?></strong></span>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="inform-head">links:</div> <span class="author"><strong><?php echo e($review['links']); ?></strong></span>
                                </div>
                                <div class="col-md-12 ">
                                    <?php foreach($review->images() as $key => $image): ?>
                                        <a href="<?php echo e($image); ?>" data-fancybox='review-<?php echo e($index); ?>'>
                                            <img src="<?php echo e($image); ?>" class="small-photo" alt="">
                                        </a>                                    
                                    <?php endforeach; ?>
                                </div>   

                            </div>
                                        
                        </div>
                        <div class="col-md-8 review">
                           <?php echo e($review['review']); ?>

                        </div>
                        <div class="col-md-12 text-center">
                            <?php if(!empty($review['comments'][0])): ?>
                            <button class="btn btn-success show-comments" data-show="false" type="button">
                                <span class="text">Show comments</span>   <span class="badge"><?php echo e(count($review['comments'])); ?></span>
                            </button> 
                            <?php endif; ?>
                            <button data-review="1" class="btn btn-primary add-comment" type="button">
                                Add comment   
                            </button> 
                        </div>
                        <div class="col-md-12 comments-list">
                            <div class="row">
                                <?php foreach($review['comments'] as $comment): ?>
                                <div class="col-md-12 comment-item ">
                                    <div class="comment__header">
                                        <div class="comment__header-left">Author : <span>
                                            <?php if($comment['anon'] == 'Yes'): ?>
                                                Anonymously
                                            <?php else: ?>
                                                <?php echo e($comment['user']); ?>

                                            <?php endif; ?>                                        </span></div>
                                        <div class="comment__header-right">Data: <span><?php echo e($comment->created_at); ?></span></div>
                                    </div>
                                    <div class="comment-body">
                                        <?php echo e($comment->comment); ?>

                                    </div>
                                </div> 
                                <?php endforeach; ?>                               
                            </div>
                        </div>
                        <form class="col-md-12 new-comment" data-review="<?php echo e($review->id); ?>" action="/addcomment" method="post">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label for="phone" class="col-md-4 control-label">Comment</label>
                                <textarea id="phone" type="text" class="form-control" name="comment" placeholder=""></textarea>
                            </div>  
                            <div class="form-group">
                                <label class="checkbox-inline">
                                  <input type="radio" id="author" checked class="author" name="author" value="0"> Your name
                                </label>
                                <label class="checkbox-inline">
                                  <input type="radio" id="author" class="author" name="author" value="1"> Anonymously
                                </label>
                                <button class="btn btn-warning">Submit</button>
                            </div>
                        </form>
                    </div>                     
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
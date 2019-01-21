<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo e(trans('message.choose')); ?></div>

                <div class="panel-body">
                   <div class="row">
                       <div class="col-md-6 text-center"><a href="/check"><button type="button" class="btn btn-lg btn-success big-btn"><?php echo e(trans('message.check')); ?></button></a></div>
                       <div class="col-md-6 text-center"><a href="/add"><button type="button" class="btn btn-lg btn-warning big-btn"><?php echo e(trans('message.add')); ?></button></a></div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
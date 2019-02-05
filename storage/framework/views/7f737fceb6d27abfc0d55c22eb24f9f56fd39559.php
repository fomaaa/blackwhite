<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo e(trans('message.choose')); ?></div>

                <div class="panel-body">
                   <div class="row">
                       <div class="col-md-6 text-center"><a href="/add/black"><button type="button" class="btn  btn-lg btn-black big-btn"><?php echo e(trans('message.bl')); ?></button></a></div>
                       <div class="col-md-6 text-center"><a href="/add/white"><button type="button" class="btn big-btn btn-lg btn-default  "><?php echo e(trans('message.wl')); ?></button></a></div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
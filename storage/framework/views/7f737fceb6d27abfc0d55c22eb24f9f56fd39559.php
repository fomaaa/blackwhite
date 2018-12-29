<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                   <div class="row">
                       <div class="col-md-6 text-center"><a href="/add/black"><button type="button" class="btn  btn-lg btn-danger">Black list</button></a></div>
                       <div class="col-md-6 text-center"><a href="/add/white"><button type="button" class="btn  btn-lg btn-default  ">White list</button></a></div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
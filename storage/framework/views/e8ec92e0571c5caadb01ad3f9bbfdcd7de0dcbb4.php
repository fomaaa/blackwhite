<?php $__env->startSection("contentheader_title"); ?>
	<a href="<?php echo e(url(config('laraadmin.adminRoute') . '/reviews')); ?>">Review</a> :
<?php $__env->stopSection(); ?>
<?php $__env->startSection("contentheader_description", $review->$view_col); ?>
<?php $__env->startSection("section", "Reviews"); ?>
<?php $__env->startSection("section_url", url(config('laraadmin.adminRoute') . '/reviews')); ?>
<?php $__env->startSection("sub_section", "Edit"); ?>

<?php $__env->startSection("htmlheader_title", "Reviews Edit : ".$review->$view_col); ?>

<?php $__env->startSection("main-content"); ?>

<?php if(count($errors) > 0): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach($errors->all() as $error): ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="box">
	<div class="box-header">
		
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<?php echo Form::model($review, ['route' => [config('laraadmin.adminRoute') . '.reviews.update', $review->id ], 'method'=>'PUT', 'id' => 'review-edit-form']); ?>

					<?php echo LAFormMaker::form($module); ?>
					
					<?php /*
					<?php echo LAFormMaker::input($module, 'list'); ?>
					<?php echo LAFormMaker::input($module, 'client'); ?>
					<?php echo LAFormMaker::input($module, 'status'); ?>
					<?php echo LAFormMaker::input($module, 'photos'); ?>
					<?php echo LAFormMaker::input($module, 'phone'); ?>
					<?php echo LAFormMaker::input($module, 'email'); ?>
					<?php echo LAFormMaker::input($module, 'address'); ?>
					<?php echo LAFormMaker::input($module, 'links'); ?>
					<?php echo LAFormMaker::input($module, 'review'); ?>
					<?php echo LAFormMaker::input($module, 'author'); ?>
					<?php echo LAFormMaker::input($module, 'anon'); ?>
					*/ ?>
                    <br>
					<div class="form-group">
						<?php echo Form::submit( 'Update', ['class'=>'btn btn-success']); ?> <button class="btn btn-default pull-right"><a href="<?php echo e(url(config('laraadmin.adminRoute') . '/reviews')); ?>">Cancel</a></button>
					</div>
				<?php echo Form::close(); ?>

			</div>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
$(function () {
	$("#review-edit-form").validate({
		
	});
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make("la.layouts.app", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
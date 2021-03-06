<?php $__env->startSection("contentheader_title", "Reviews"); ?>
<?php $__env->startSection("contentheader_description", "Reviews listing"); ?>
<?php $__env->startSection("section", "Reviews"); ?>
<?php $__env->startSection("sub_section", "Listing"); ?>
<?php $__env->startSection("htmlheader_title", "Reviews Listing"); ?>

<?php $__env->startSection("headerElems"); ?>
<?php if(LAFormMaker::la_access("Reviews", "create")) { ?>
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Review</button>
<?php } ?>
<?php $__env->stopSection(); ?>

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

<div class="box box-success">
	<!--<div class="box-header"></div>-->
	<div class="box-body">
		<table id="review_container" class="table table-bordered">
		<thead>
		<tr class="success">
			<?php foreach( $listing_cols as $col ): ?>
			<th><?php echo e(isset($module->fields[$col]['label']) ? $module->fields[$col]['label'] : ucfirst($col)); ?></th>
			<?php endforeach; ?>
			<?php if($show_actions): ?>
			<th>Actions</th>
			<?php endif; ?>
		</tr>
		</thead>
		<tbody>
			
		</tbody>
		</table>
	</div>
</div>

<?php if(LAFormMaker::la_access("Reviews", "create")) { ?>
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Review</h4>
			</div>
			<?php echo Form::open(['action' => 'LA\ReviewsController@store', 'id' => 'review-add-form']); ?>

			<div class="modal-body">
				<div class="box-body">
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
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<?php echo Form::submit( 'Submit', ['class'=>'btn btn-success']); ?>

			</div>
			<?php echo Form::close(); ?>

		</div>
	</div>
</div>
<?php } ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('la-assets/plugins/datatables/datatables.min.css')); ?>"/>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('la-assets/plugins/datatables/datatables.min.js')); ?>"></script>
<script>
$(function () {
	$("#review_container").DataTable({
		order : [['0', 'desc']],
		processing: true,
        serverSide: true,
        ajax: "<?php echo e(url(config('laraadmin.adminRoute') . '/review_dt_ajax')); ?>",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		<?php if($show_actions): ?>
		columnDefs: [ { orderable: false, targets: [-1] }],
		<?php endif; ?>
	});
	$("#review-add-form").validate({
		
	});
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make("la.layouts.app", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
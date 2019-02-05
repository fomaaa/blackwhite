<?php $__env->startSection('htmlheader_title'); ?>
	User View
<?php $__env->stopSection(); ?>


<?php $__env->startSection('main-content'); ?>
<div id="page-content" class="profile2">


	<ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
		<li class=""><a href="<?php echo e(url(config('laraadmin.adminRoute') . '/users')); ?>" data-toggle="tooltip" data-placement="right" title="Back to Users"><i class="fa fa-chevron-left"></i></a></li>
		<li class="active"><a role="tab" data-toggle="tab" class="active" href="#tab-general-info" data-target="#tab-info"><i class="fa fa-bars"></i> General Info</a></li>
	</ul>

	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active fade in" id="tab-info">
			<div class="tab-content">
				<div class="panel infolist">
					<div class="panel-default panel-heading">
						<h4>General Info</h4>
					</div>
					<div class="panel-body">
						<?php echo LAFormMaker::display($module, 'name'); ?>
						<?php echo LAFormMaker::display($module, 'email'); ?>
						<?php echo LAFormMaker::display($module, 'phone'); ?>
						<?php echo LAFormMaker::display($module, 'type'); ?>
						<?php echo LAFormMaker::display($module, 'is_ban'); ?>
						<?php echo LAFormMaker::display($module, 'created'); ?>
						<?php echo LAFormMaker::display($module, 'com_count'); ?>
						<?php echo LAFormMaker::display($module, 'rev_count'); ?>
						<?php echo LAFormMaker::display($module, 'last_login'); ?>
						<?php echo LAFormMaker::display($module, 'email_confirmed'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('la.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
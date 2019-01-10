<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Add client to black list</div>

                <div class="panel-body" data-tab="1">
	                <div class="row">
	                    <div class="col-md-12">
	                        <?php if($errors->any()): ?>
	                            <div class="alert alert-danger">
	                                <ul>
	                                    <?php foreach($errors->all() as $error): ?>
	                                        <li><?php echo e($error); ?></li>
	                                    <?php endforeach; ?>
	                                </ul>
	                            </div>
	                        <?php endif; ?>
	                    </div>
	                </div>
                    <form class="form-horizontal" id="addform" role="form" method="POST" action="/add/black" enctype='multipart/form-data'>
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group">
                            <label for="phone" class="col-md-4 control-label">Phone</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" required class="form-control" name="phone" placeholder="+97100000000">

                                <?php if($errors->has('phone')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('phone')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label for="phone" class="col-md-4 control-label">Client e-mail</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" placeholder="client@mail.com">

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label for="phone" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                <select class="form-control select" name="address" id="address">
                                	<?php foreach($cities as $city): ?>
									<option value="<?php echo e($city->id); ?>"><?php echo e($city->english); ?></option>
									<?php endforeach; ?>
                                </select>
                            </div>
                        </div>                        
                        <div class="form-group">
                        	<label for="link" class="col-md-4 control-label">Socials links</label>
                        	<div class="col-md-6">
 								<textarea id="link" type="text" class="form-control" rows="3" name="link" ></textarea>
							</div>
                        </div>
                        <div class="form-group">
                        	<label for="description" class="col-md-4 control-label">Review</label>
                        	<div class="col-md-6">
 								<textarea class="form-control" rows="3" id="description" type="text"  name="description"></textarea>
 							</div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-md-4 control-label">Status</label>

                            <div class="col-md-6">
                                <select class="form-control select" name="status" id="status">
                                	<?php foreach($statuses as $status): ?>
									<option value="<?php echo e($status->id); ?>"><?php echo e($status->english); ?></option>
									<?php endforeach; ?>
                                </select>
                            </div>
                        </div>  
                        <div class="form-group">
                        	<label for="phone" class="col-md-4 control-label">Photos</label>
                        	<div class="col-md-6">
                        		<input type="file" class="files form-control" id="photos" name="photos[]" multiple>
                        	</div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-md-4 control-label">Review</label>

                            <div class="col-md-6">
		                        <label class="checkbox-inline">
								  <input type="radio" id="author" class="author" checked name="author" value="No"> Your name
								</label>
								<label class="checkbox-inline">
								  <input type="radio" id="author" class="author" name="author" value="Yes"> Anonymously
								</label>
                            </div>
						</div>
						<div class="form-group">
							<div class="col-md-offset-6 col-md-6">
								<button  class="btn btn-primary btn-lg btn-success next-tab">Add review</button>
							</div>
						</div>
                        <input type="hidden" name="personal_mark">
                        <input type="hidden" name="list" value="black">
        
                    </form>						
                    </div>
                </div>
                <div class="panel-body result-body" data-tab="2">

                    <div class="form-horizontal">
                        <div class="row">
                            <div class="form-group">
                                <label for="phone" class="col-md-4 control-label">Phone</label>
                                <div class="col-md-6">
                                    <label for="phone" class="col-md-4 control-label value"></label>
                                </div>
                            </div> 
                        </div>
                    </div>

                    <div class="form-horizontal">
                        <div class="row">
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Client e-mail</label>
                                <div class="col-md-6">
                                    <label for="email" class="col-md-4 control-label value"></label>
                                </div>
                            </div> 
                        </div>
                    </div>

                    <div class="form-horizontal">
                        <div class="row">
                            <div class="form-group">
                                <label for="address" class="col-md-4 control-label">Address</label>
                                <div class="col-md-6">
                                    <label for="address" class="col-md-4 control-label value">Dubia</label>
                                </div>
                            </div> 
                        </div>
                    </div>

                    <div class="form-horizontal">
                        <div class="row">
                            <div class="form-group">
                                <label for="link" class="col-md-4 control-label">Socials links</label>
                                <div class="col-md-6">
                                    <label for="link" class="col-md-4 control-label value"></label>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="form-horizontal">
                        <div class="row">
                            <div class="form-group">
                                <label for="status" class="col-md-4 control-label">Status</label>
                                <div class="col-md-6">
                                    <label for="status" class="col-md-4 control-label value">Police</label>
                                </div>
                            </div> 
                        </div>
                    </div>                                          
                    <div class="form-horizontal">
                        <div class="row">
                            <div class="form-group">
                                <label for="description" class="col-md-4 control-label">Review</label>
                                <div class="col-md-6">
                                    <label for="description" class="col-md-4 control-label value"></label>
                                </div>
                            </div> 
                        </div>
                    </div>                                    
                    <div class="form-horizontal">
                        <div class="form-horizontal">
                            <div class="row">
                                <div class=" col-md-6 btn-block">
                                    <button  class="btn btn-primary btn-lg btn-primary prew-tab">Back and Edit</button>
                                    <button type="submit"  class="btn btn-primary btn-lg btn-success submit">Confirm and Add</button>
                                </div>                            
                            </div>                            
                        </div>

    
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
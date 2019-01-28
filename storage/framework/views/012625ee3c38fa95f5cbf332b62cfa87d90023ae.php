                <div class="panel-body">
                    <?php foreach($clients as $client): ?>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1 panel panel-default">
                            <div class="row">
                                <div class="col-md-4"><?php echo e(trans('message.phone')); ?></div>
                                <div class="col-md-4"><?php echo e(trans('message.email')); ?></div>
                                <div class="col-md-4"><?php echo e(trans('message.date_add')); ?></div>

                            </div>

                        </div>

                    </div>                     
                    <div class="row">
                        <a href="/client/<?php echo e($client->id); ?>">
                            <div class="col-md-10 col-md-offset-1 panel panel-default">
                                <div class="row">
                                    <div class="col-md-4"><?php echo e($client->phone); ?></div>
                                    <div class="col-md-4"><?php echo e($client->email); ?></div>
                                    <div class="col-md-4"><?php echo e($client->created_at); ?></div>

                                </div>
                            </div>
                        </a>
                    </div>  
                    <?php endforeach; ?>
                     <div class="row nth-found">
                        
                            <div class="col-md-10 col-md-offset-1 panel panel-default">
                                <div class="row">
                                    <div class="col-md-10 ">
                                        <?php echo e(trans('message.nth_fount')); ?>

                                    </div>
                                </div>
                            </div>
                    </div>  
                </div>
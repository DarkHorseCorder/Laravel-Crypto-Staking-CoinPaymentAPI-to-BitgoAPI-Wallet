

<?php $__env->startSection('title'); ?>
   <?php echo translate('Two Step Authentication'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <?php echo translate('Two Step Authentication'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-center">
        <?php if($gs->two_fa): ?>
              <?php if(auth()->user()->two_fa_status): ?>
                <div class="col-md-12">
                    <div class="card default--card">
                        <div class="card-body text-center">
                            <h1 class="text--success"><i class="far fa-check-circle"></i></h1>
                            <h5><?php echo translate('Your Phone Number Has been Verified'); ?></h5>
                            <span><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deactivated"><?php echo translate('Deactivate Two Step Authentication'); ?></a></span>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="col-md-12">
                    <div class="card default--card">
                        <div class="card-body">
                            <form action="" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="form-group mb-2">
                                    <label class="mb-1"><?php echo translate('Provide Your Password'); ?></label>
                                    <input class="form-control" type="password" name="password" required>
                                </div>
                                <div class="form-group  mb-3">
                                    <label class="mb-1"><?php echo translate('Confirm Password'); ?></label>
                                    <input class="form-control" type="password" name="password_confirmation" required>
                                </div>
                                <div class="form-group text-end">
                                <button type="submit" class="btn btn--base"><?php echo translate('Submit'); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php else: ?>
        <div class="col-md-12">
            <div class="card default--card">
                <div class="card-body text-center  p-4">
                    <h2 class="text-warning mb-2"><i class="fas fa-exclamation-triangle"></i></h2>
                    <h4><?php echo translate('Two step authentication is temporary unavailable.'); ?></h4>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deactivated" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo translate('Deactivate Two Step Authentication'); ?></h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label class="mb-1"><?php echo translate('Enter Password'); ?></label>
                            <input class="form-control" type="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label class="mb-1"><?php echo translate('Confirm Password'); ?></label>
                            <input class="form-control" type="password" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><?php echo translate('Cancel'); ?></button>
                        <button type="submit" class="btn btn--base"><?php echo translate('Submit'); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/user/twostep/two_step.blade.php ENDPATH**/ ?>


<?php $__env->startSection('title'); ?>
   <?php echo translate('Verify phone no.'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>

    <?php echo translate('Verify phone no.'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-center">
       
              <?php if(auth()->user()->phone_verified): ?>
                <div class="col-md-12">
                    <div class="card default--card py-5">
                        <div class="card-body text-center">
                            <h1 class="text--success mb-3"><i class="far fa-check-circle"></i></h1>
                            <h5><?php echo translate('Your phone number is verified'); ?></h5>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="col-md-12">
                    <div class="card default--card py-5">
                        <div class="card-body">
                            <form action="" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="form-group mb-4 d-flex justify-content-between">
                                   <a href="<?php echo e(route('user.send.code')); ?>" class="btn btn--base"><?php echo translate('Send verification code'); ?></a>
                                    <h6 class="mt-2"><?php echo translate('Your phone no : '); ?> <?php echo e(auth()->user()->phone); ?></h6>
                                </div>
                                <div class="form-group  mb-3">
                                    <label class="mb-1"><?php echo translate('Verification Code'); ?></label>
                                    <input class="form-control" type="text" name="verification_code" required>
                                </div>
                                <div class="form-group text-end">
                                <button type="submit" class="btn btn--base"><?php echo translate('Submit'); ?></button>
                                </div>
                            </form>
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
                        <h5 class="modal-title"><?php echo translate('Deativate Two Step Authentication'); ?></h5>
                           
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label class="mb-1"><?php echo translate('Provide Your Password'); ?></label>
                            <input class="form-control" type="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label class="mb-1"><?php echo translate('Confirm Password'); ?></label>
                            <input class="form-control" type="password" name="password_confirmation" required>
                        </div>
                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><?php echo translate('Close'); ?></button>
                        <button type="submit" class="btn btn--base"><?php echo translate('Submit'); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/user/verify_phone.blade.php ENDPATH**/ ?>
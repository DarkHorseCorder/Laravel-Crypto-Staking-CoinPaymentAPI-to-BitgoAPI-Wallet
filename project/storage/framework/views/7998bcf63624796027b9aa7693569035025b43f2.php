

<?php $__env->startSection('title'); ?>
<?php if(auth()->user()->two_fa_status == 1): ?>
<?php echo translate('Deactivate Two Step Authentication'); ?>
<?php else: ?>
<?php echo translate('Activate Two Step Authentication'); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
    <div class="dashboard--content-item">
        <h6 class="dashboard-title"><?php echo translate('Verification Code Sent Successfully. Phone Number: '.auth()->user()->phone); ?></h6>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card default--card">
                    
                    <div class="card-body">
                        <form action="" method="POST">
                            <?php echo csrf_field(); ?>
                            
                            <div class="form-group mb-2">
                                <label class="mb-1"><?php echo translate('Enter Verification Code'); ?></label>
                                <input class="form-control" type="text" name="code" required>
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <a href="<?php echo e(route('user.two.step.resend')); ?>" class="text-left"><?php echo translate('Resend Verification Code'); ?></a>
                               <button type="submit" class="btn btn--base"><?php echo translate('Submit'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/user/twostep/verify.blade.php ENDPATH**/ ?>


<?php $__env->startSection('title'); ?>
   <?php echo translate('Change Password'); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <div class="dashboard--content-item">

        <form method="POST" action="">
          <div class="profile--card">
                <?php echo csrf_field(); ?>
                <div class="row gy-4">
                    <div class="col-sm-6 col-xxl-12">
                        <label class="mb-2"><?php echo translate('Old Password'); ?></label>
                        <input class="form-control" type="password" name="old_pass" required>
                    </div>
                    <div class="col-sm-6 col-xxl-12">
                        <label class="mb-2"><?php echo translate('New Password'); ?></label>
                        <input class="form-control" type="password" name="password" required>
                    </div>
                    <div class="col-sm-6 col-xxl-12">
                        <label class="mb-2"><?php echo translate('Confirm Password'); ?></label>
                        <input class="form-control" type="password" name="password_confirmation" required>
                    </div>
                    <div class="col-sm-12">
                        <div class="text-end">
                            <button type="submit" class="cmn--btn"><?php echo translate('Update Password'); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/user/change_password.blade.php ENDPATH**/ ?>
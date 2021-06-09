

<?php $__env->startSection('title'); ?>
   <?php echo translate('Change Password'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header">
        <h1><?php echo translate('Change Password'); ?></h1>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-body">
                <form action="<?php echo e(route('admin.password.update')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label><?php echo translate('Old Password'); ?></label>
                        <input class="form-control" type="password" name="old_password"  required>
                    </div>
                    <div class="form-group">
                        <label><?php echo translate('New Password'); ?></label>
                        <input class="form-control" type="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label><?php echo translate('Confirm Password'); ?></label>
                        <input class="form-control" type="password" name="password_confirmation" required>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary btn-lg"><?php echo translate('Submit'); ?></button>
                    </div>
                   
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/change_password.blade.php ENDPATH**/ ?>
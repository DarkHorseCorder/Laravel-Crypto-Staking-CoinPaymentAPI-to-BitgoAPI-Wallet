

<?php $__env->startSection('title'); ?>
   <?php echo translate('Edit Config'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header justify-content-between">
        <h1><?php echo translate('Edit Config : '.$gateway->name); ?></h1>
        <a href="<?php echo e(route('admin.sms.index')); ?>" class="btn btn-primary"><i class="fas fa-backward"></i> <?php echo translate('Back'); ?></a>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <?php if($gateway->status == 1): ?>
                <div class="card-header">
                    <span class="badge badge-success"><?php echo translate('Default'); ?></span>
                </div>
                <?php endif; ?>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.sms.update',$gateway->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php $__currentLoopData = $gateway->config; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-group">
                            <label><?php echo e(ucfirst(str_replace('_',' ',$key))); ?></label>
                            <input class="form-control" type="text" name="<?php echo e($key); ?>" value="<?php echo e($value); ?>" required>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($gateway->status != 1): ?>
                        <div class="form-group border p-2 rounded">
                            <label class="cswitch mb-0 d-flex justify-content-between align-items-center">
                                <input class="cswitch--input permission" name="status" type="checkbox" />
                                <span class="cswitch--trigger wrapper"></span>
                                <span class="cswitch--label font-weight-bold "><?php echo translate('Set as default gateway'); ?></span>
                            </label>
                        </div>
                        <?php endif; ?>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary btn-lg"><?php echo translate('Submit'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/sms/edit.blade.php ENDPATH**/ ?>
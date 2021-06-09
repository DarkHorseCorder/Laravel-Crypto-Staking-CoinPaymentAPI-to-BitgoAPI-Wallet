

<?php $__env->startSection('title'); ?>
   <?php echo translate('Login info : '.$user->name); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header">
        <h1><?php echo translate('Login info : '.$user->name); ?></h1>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
   
                <div class="card-body text-center">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th><?php echo translate('User ID'); ?></th>
                                <th><?php echo translate('User'); ?></th>
                                <th><?php echo translate('IP'); ?></th>
                                <th><?php echo translate('City'); ?></th>
                                <th><?php echo translate('Country'); ?></th>
                            </tr>
                            <?php $__empty_1 = true; $__currentLoopData = $loginInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td data-label="<?php echo translate('Sl'); ?>"><?php echo e($key + $loginInfo->firstItem()); ?></td>
                                     <td data-label="<?php echo translate('User'); ?>">
                                       <?php echo e($item->user->email); ?>

                                     </td>
                                     <td data-label="<?php echo translate('IP'); ?>"><?php echo e($item->ip); ?></td>
                                     <td data-label="<?php echo translate('City'); ?>"><?php echo e($item->city); ?></td>
                                     <td data-label="<?php echo translate('Country'); ?>"><?php echo e($item->country); ?></td>
                                   
                                </tr>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    
                                <tr>
                                    <td class="text-center" colspan="100%"><?php echo translate('No Data Found'); ?></td>
                                </tr>
    
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
                <?php if($loginInfo->hasPages()): ?>
                    <?php echo e($loginInfo->links('admin.partials.paginate')); ?>

                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/user/login_info.blade.php ENDPATH**/ ?>
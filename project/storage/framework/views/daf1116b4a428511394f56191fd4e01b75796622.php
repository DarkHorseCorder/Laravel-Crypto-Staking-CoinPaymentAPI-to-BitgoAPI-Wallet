

<?php $__env->startSection('title'); ?>
   <?php echo app('translator')->get('Previous Deposit Addresses'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard--content-item">
    <div class="d-flex justify-content-between align-items-center">
        <a href="<?php echo e(route('user.deposit.index')); ?>" class="btn btn--base mb-2 btn-sm"><i class="fas fa-backward"></i> <?php echo translate('Back'); ?></a>
    </div>
    <div class="table-responsive table--mobile-lg">
        <table class="table crypto-offer-table bg--body">
            <thead>
                <tr>
                    <th><?php echo translate('Created On'); ?></th>
                    <th><?php echo translate('Xnet Wallet Address'); ?></th>
                    <th><?php echo translate('Currency Type'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td data-label="<?php echo translate('Created At'); ?>">
                        <div>
                            <?php echo e(dateFormat($item->created_at,'d M Y')); ?>

                        </div>
                    </td>
                    
                    <td data-label="<?php echo translate('Address'); ?>">
                        <div>
                            <?php echo e($item->address); ?>

                        </div>
                    </td>
                    <td data-label="<?php echo translate('Currency'); ?>">
                        <span class="badge badge--success">
                           <?php echo e($item->curr->code); ?>

                        </span>
                    </td>
       
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td class="text-center" colspan="12"><?php echo translate('No data found!'); ?></td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php echo e($addresses->links()); ?>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\custom\exchange\project\resources\views/user/deposit/existing_address.blade.php ENDPATH**/ ?>
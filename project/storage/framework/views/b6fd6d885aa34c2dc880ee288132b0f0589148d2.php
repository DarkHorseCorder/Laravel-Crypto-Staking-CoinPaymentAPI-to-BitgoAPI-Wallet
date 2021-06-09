

<?php $__env->startSection('title'); ?>
   <?php echo app('translator')->get('Deposit History'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard--content-item">

     
    <div class="table-responsive table--mobile-lg">
        <table class="table crypto-offer-table bg--body">
            <thead>
                <tr>
                  <th><?php echo translate('TRANSACTION ID'); ?></th>
                  <th><?php echo translate('Amount'); ?></th>
                  <th><?php echo translate('Fees'); ?></th>
                  <th><?php echo translate('COIN PAYMENT ID'); ?></th>
                  <th><?php echo translate('Date'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $deposits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td data-label="<?php echo translate('TRANSACTION ID'); ?>">
                        <div>
                            <?php echo e($item->tnx); ?>

                        </div>
                    </td>
                    
                    <td data-label="<?php echo translate('Amount'); ?>">
                        <div>
                            <?php echo e(numFormat($item->total_amount,8)); ?>  <?php echo e($item->currency->code); ?>

                        </div>
                    </td>
                    <td data-label="<?php echo translate('Fees'); ?>">
                        <div>
                           <?php echo e(numFormat($item->charge,8)); ?>

                        </div>
                    </td>
                    <td data-label="<?php echo translate('COIN PAYMENT ID'); ?>">
                        <div>
                           <?php echo e($item->coinpayment_tnx); ?>

                        </div>
                    </td>
                    <td data-label="<?php echo translate('Date'); ?>">
                        <div>
                           <?php echo e(dateFormat($item->created_at)); ?>

                        </div>
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
    <?php echo e($deposits->links()); ?>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\custom\exchange\project\resources\views/user/deposit/history.blade.php ENDPATH**/ ?>
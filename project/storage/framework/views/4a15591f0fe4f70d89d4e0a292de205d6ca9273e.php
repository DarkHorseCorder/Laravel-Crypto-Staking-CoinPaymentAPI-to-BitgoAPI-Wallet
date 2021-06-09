

<?php $__env->startSection('title'); ?>
   <?php echo translate('Withdraw History'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

        <div class="dashboard--content-item">
       
             
            <div class="table-responsive table--mobile-lg">
                <table class="table crypto-offer-table bg--body">
                    <thead>
                        <tr>
                            <th><?php echo translate('Transaction ID'); ?></th>
                            <th><?php echo translate('Amount'); ?></th>
                            <th><?php echo translate('Fees'); ?></th>
                            <th><?php echo translate('Total Amount'); ?></th>
                            <th><?php echo translate('Withdraw Address'); ?></th>
                            <th><?php echo translate('Status'); ?></th>
                            <th><?php echo translate('Date'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $withdrawals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td data-label="<?php echo translate('Transaction'); ?>"><div><?php echo e($item->trx); ?></div></td>
                            <td data-label="<?php echo translate('Amount'); ?>"><div><?php echo e(numFormat($item->amount,8)); ?> <?php echo e($item->currency->code); ?></div></td>
                            <td data-label="<?php echo translate('Charge'); ?>"><div><?php echo e(numFormat($item->charge,8)); ?> <?php echo e($item->currency->code); ?></div></td>
                            <td data-label="<?php echo translate('Total Amount'); ?>"><div>
                                <?php echo e(numFormat($item->total_amount,8)); ?> <?php echo e($item->currency->code); ?></div></td>
                            <td data-label="<?php echo translate('Withdraw Address'); ?>"><div><?php echo e($item->wallet_address); ?></div></td>
                            <td data-label="<?php echo translate('Status'); ?>">

                                <?php if($item->status == 1): ?>
                                    <span class="badge bg-success"><?php echo translate('Accepted'); ?></span>
                                <?php elseif($item->status == 2): ?>
                                     <span class="badge bg-danger"><?php echo translate('Rejected'); ?></span>
                                     <button class="badge bg-secondary reason" data-bs-toggle="modal" data-bs-target="#modal-team" data-reason="<?php echo e($item->reject_reason); ?>"><i class="fas fa-info"></i></button>
                                <?php else: ?>
                                    <span class="badge bg-warning"><?php echo translate('Pending'); ?></span>

                                <?php endif; ?>
                            </td>
                            <td data-label="<?php echo translate('Date'); ?>"><div><?php echo e(dateFormat($item->created_at)); ?></div></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td class="text-center" colspan="12"><?php echo translate('No data found!'); ?></td>
                        </tr>
                     <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php echo e($withdrawals->links()); ?>

        </div>


    <div class="modal modal-blur fade" id="modal-team" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><?php echo translate('Reject Reason'); ?></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div>
                <textarea class="form-control reject-reason" rows="5" disabled></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn ms-auto" data-bs-dismiss="modal"><?php echo translate('Close'); ?></button>
             
            </div>
          </div>
        </div>
      </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        $('.reason').on('click',function() { 
            $('#modal-team').find('.reject-reason').val($(this).data('reason'))
            $('#modal-team').modal('show')
        })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/user/withdraw/history.blade.php ENDPATH**/ ?>
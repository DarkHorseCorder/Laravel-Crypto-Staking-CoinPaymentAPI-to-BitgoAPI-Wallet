

<?php $__env->startSection('title'); ?>
   <?php echo app('translator')->get($title); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard--content-item">
    <div class="table-responsive table--mobile-lg">
        <table class="table crypto-offer-table bg--body">
            <thead>
                <tr>
                    <th><?php echo translate('Trade Code'); ?></th>
                    <th><?php echo translate('Type/Fee/Duration'); ?></th>
                    <?php if(request()->routeIs('user.trade.requests')): ?>
                    <th><?php echo translate('Requested By'); ?></th>
                    <?php endif; ?>
                    <th><?php echo translate('Amount/Rates'); ?></th>
                    <th><?php echo translate('Status'); ?></th>
                    <th><?php echo translate('Action'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $trades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td data-label="<?php echo translate('Trade Code'); ?>">
                        <div>
                            <?php echo e($item->trade_code); ?>

                        </div>
                    </td>
                    
                    <td data-label="<?php echo translate('Trade Basic'); ?>">
                        <div class="text-center pt-3 pt-md-0">
                            <h6 class="m-0 mb-md-1"><?php echo e(ucfirst($item->offer->type)); ?></h6>
                            <div class="text-center mb-2">
                                <span class="rate text--success font--sm">
                                      <?php echo e(numFormat($item->trade_fee,8)); ?> <?php echo e($item->crypto->code); ?>

                                </span>
                            </div>
                            <span class="font--sm me-2"><?php echo e($item->trade_duration); ?> <?php echo translate('Minutes'); ?></span>
                        </div>
                    </td>
                    
                    <?php if(request()->routeIs('user.trade.requests')): ?>
                    <td data-label="<?php echo translate('Requested By'); ?>">
                        <div class="text-center">
                            <h6 class="m-0">
                               <?php echo e($item->trader->id == auth()->id() ? 'You' : $item->trader->username); ?>

                            </h6>
                        </div>
                    </td>
                    <?php endif; ?>
                    <td data-label="<?php echo translate('Amount/Rates'); ?>">
                        <div class="text-center pt-3 pt-md-0">
                            <h6 class="m-0 mb-md-1"><?php echo e(numFormat($item->crypto_amount,8)); ?> <?php echo e($item->crypto->code); ?></h6>
                            <div class="text-center mb-2">
                                <span class="rate text--success font--sm">
                                        <?php echo e(amount($item->rate)); ?> <?php echo e($item->fiat->code); ?>

                                </span>
                            </div>
                            <span class="font--sm me-2"><?php echo e(amount($item->fiat_amount)); ?> <?php echo e($item->fiat->code); ?></span>
                        </div>
                    </td>
                    <td data-label="<?php echo translate('Status'); ?>">
                        <?php if($item->status == 0): ?>
                        <span class="badge badge--warning text-white">
                            <?php echo translate('Trade Escrowed'); ?>
                        </span>
                        <?php elseif($item->status == 1): ?>
                        <span class="badge badge--primary">
                            <?php echo translate('Paid'); ?>
                        </span>
                        <?php elseif($item->status == 2): ?>
                        <span class="badge badge--danger">
                            <?php echo translate('Canceled'); ?>
                        </span>
                        <?php elseif($item->status == 3): ?>
                        <span class="badge badge--success">
                            <?php echo translate('Compleled/Released'); ?>
                        </span>
                        <?php elseif($item->status == 4): ?>
                        <span class="badge badge--info">
                            <?php echo translate('Disputed'); ?>
                        </span>
                        <?php endif; ?>
                    </td>
          
                   
                    <td data-label="<?php echo translate('Action'); ?>">
                       <div>
                            <a href="<?php echo e(route('user.trade.details',$item->trade_code)); ?>" class="btn btn--success btn-sm "><i class="fas fa-arrow-right"></i> <?php echo translate('Details'); ?></i></a>
                       </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td class="text-center" colspan="12"><?php echo translate('No Trades Found!'); ?></td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php echo e($trades->links()); ?>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\custom\exchange\project\resources\views/user/trade/trades.blade.php ENDPATH**/ ?>
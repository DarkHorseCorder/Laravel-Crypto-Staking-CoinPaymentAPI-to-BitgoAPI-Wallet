
<?php $__env->startSection('title'); ?>
    <?php echo translate('User Dashboard'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard--content-item">
  <div class="dashboard--wrapper">
      <?php $__currentLoopData = $wallets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="dashboard--width">
            <div class="dashboard-card">
                <div class="dashboard-card__header">
                    <div class="dashboard-card__header__icon">
                        <img src="<?php echo e(getPhoto($item->curr->icon)); ?>" alt="wallet">
                    </div>
                    <div class="dashboard-card__header__cont">
                        <h4 class="name"><?php echo e($item->curr->code); ?></h4>
                        <div class="balance"><?php echo e(numFormat($item->balance,8)); ?></div>
                    </div>
                </div>
                <div class="dashboard-card__content">
                    <h6 class="m-0"><span class="text--base">1 <?php echo e($item->curr->code); ?></span> = <span><?php echo e(amount($item->curr->rate)); ?> <?php echo e($gs->curr_code); ?></span>
                    </h6>
                </div>
            </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
  </div>
</div>

<div class="dashboard--content-item">
    <h5 class="dashboard-title"><?php echo translate('Latest Trade Requests'); ?></h5>
    <div class="table-responsive table--mobile-lg">
        <table class="table crypto-offer-table bg--body">
            <thead>
                <tr>
                    <th><?php echo translate('Trade Code'); ?></th>
                    <th><?php echo translate('Type/Fee/Duration'); ?></th>
                    <th><?php echo translate('Requested By'); ?></th>
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
                        <div class="text-center">
                            <h6 class="m-0 mb-lg-1"><?php echo e(ucfirst($item->offer->type)); ?></h6>
                            <div class="text-center mb--lg-2 d-flex d-lg-block">
                                <span class="rate text--success font--sm d-block">
                                      <?php echo e(numFormat($item->trade_fee,8)); ?> <?php echo e($item->crypto->code); ?>

                                </span>
                            </div>
                            <span class="font--sm me-2"><?php echo e($item->trade_duration); ?> <?php echo translate('Minutes'); ?></span>
                        </div>
                    </td>
               
                    <td data-label="<?php echo translate('Requested By'); ?>">
                        <div class="text-center">
                            <h6 class="m-0">
                               <?php echo e($item->trader->id == auth()->id() ? 'You' : $item->trader->name); ?>

                            </h6>
                        </div>
                    </td>
           
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
                            <?php echo translate('Trade Funds Escrowed'); ?>
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
                            <?php echo translate('Completed/Released'); ?>
                        </span>
                        <?php elseif($item->status == 4): ?>
                        <span class="badge badge--info">
                            <?php echo translate('Disputed'); ?>
                        </span>
                        <?php endif; ?>
                    </td>
          
                   
                    <td data-label="<?php echo translate('Action'); ?>">
                       <div>
                            <a href="<?php echo e(route('user.trade.details',$item->trade_code)); ?>" class="btn btn--success btn-sm "><?php echo translate('Details'); ?> <i class="fas fa-arrow-right"></i></i></a>
                       </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td class="text-center" colspan="12"><?php echo translate('No trades found!'); ?></td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
  
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/user/dashboard.blade.php ENDPATH**/ ?>
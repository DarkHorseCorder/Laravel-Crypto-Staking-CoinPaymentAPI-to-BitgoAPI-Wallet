

<?php $__env->startSection('title'); ?>
   <?php echo app('translator')->get('Trades'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header">
        <h1><?php echo app('translator')->get('Trades'); ?></h1>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
           <div class="card">
               <div class="card-header">
                <form action="" class="d-flex flex-wrap justify-content-end">
                    <div class="form-group m-1 flex-grow-1">
                        <div class="input-group">
                            <input type="text" class="form-control" value="<?php echo e(request('search')); ?>" name="search" placeholder="<?php echo translate('Trade Code'); ?>">
                            <div class="input-group-append">
                                <button class="input-group-text btn btn-primary text-white" id="my-addon"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                   </form>
               </div>
               <div class="card-body">
                <div class="table-responsive table--mobile-lg">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th><?php echo translate('Trade Code'); ?></th>
                                <th><?php echo translate('Offer Owner'); ?></th>
                                <th><?php echo translate('Requested By'); ?></th>
                                <th><?php echo translate('Type/Fee/Duration'); ?></th>
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
                                
                             
                                <td data-label="<?php echo translate('Offer Owner'); ?>">
                                    <div class="">
                                        <h6 class="m-0">
                                           <a href="<?php echo e(route('admin.user.details',$item->offer_user_id)); ?>"><?php echo e($item->offerOwner->name); ?></a>
                                        </h6>
                                    </div>
                                </td>
                                <td data-label="<?php echo translate('Requested By'); ?>">
                                    <div class="">
                                        <h6 class="m-0">
                                           <a href="<?php echo e(route('admin.user.details',$item->trader_id)); ?>"><?php echo e($item->trader->name); ?></a>
                                        </h6>
                                    </div>
                                </td>

                                <td data-label="<?php echo translate('Type/Fee/Duration'); ?>" class="p-3">
                                    <div class=" pt-3 pt-md-0">
                                        <h6 class="m-0 mb-md-1"><?php echo e(ucfirst($item->offer->type)); ?></h6>
                                        <div class="mb-2">
                                            <span class="rate text-success font--sm">
                                                  <?php echo e(numFormat($item->trade_fee,8)); ?> <?php echo e($item->crypto->code); ?>

                                            </span>
                                        </div>
                                        <span class="font--sm me-2"><?php echo e($item->trade_duration); ?> <?php echo translate('Minutes'); ?></span>
                                    </div>
                                </td>
                             
                                <td data-label="<?php echo translate('Amount/Rates'); ?>" class="p-3">
                                    <div class="pt-3 pt-md-0">
                                        <h6 class="m-0 mb-md-1"><?php echo e(numFormat($item->crypto_amount,8)); ?> <?php echo e($item->crypto->code); ?></h6>
                                        <div class="mb-2">
                                            <span class="rate text-success font--sm">
                                                 <?php echo e(amount($item->rate)); ?> <?php echo e($item->fiat->code); ?>

                                            </span>
                                        </div>
                                        <span class="font--sm me-2"><?php echo e(amount($item->fiat_amount)); ?> <?php echo e($item->fiat->code); ?></span>
                                    </div>
                                </td>
                                <td data-label="<?php echo translate('Status'); ?>">
                                    <?php if($item->status == 0): ?>
                                    <span class="badge badge-warning text-white">
                                        <?php echo translate('Trade Escrowed'); ?>
                                    </span>
                                    <?php elseif($item->status == 1): ?>
                                    <span class="badge badge-primary">
                                        <?php echo translate('Paid'); ?>
                                    </span>
                                    <?php elseif($item->status == 2): ?>
                                    <span class="badge badge-danger">
                                        <?php echo translate('Canceled'); ?>
                                    </span>
                                    <?php elseif($item->status == 3): ?>
                                    <span class="badge badge-success">
                                        <?php echo translate('Compleled/Released'); ?>
                                    </span>
                                    <?php elseif($item->status == 4): ?>
                                    <span class="badge badge-info">
                                        <?php echo translate('Disputed'); ?>
                                    </span>
                                    <?php endif; ?>
                                </td>
                      
                               
                                <td data-label="<?php echo translate('Action'); ?>">
                                   <div>
                                        <a href="<?php echo e(route('admin.trade.details',$item->trade_code)); ?>" class="btn btn-success btn-sm "><?php echo translate('Details'); ?> <i class="fas fa-arrow-right"></i></i></a>
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
               <?php if($trades->hasPages()): ?>
                <div class="card-footer">
                    <?php echo e($trades->links()); ?>

                </div>
               <?php endif; ?>
           </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/trade/trades.blade.php ENDPATH**/ ?>
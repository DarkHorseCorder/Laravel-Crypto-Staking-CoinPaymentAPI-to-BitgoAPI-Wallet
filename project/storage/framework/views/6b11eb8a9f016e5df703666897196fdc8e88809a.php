

<?php $__env->startSection('title'); ?>
   <?php echo translate('Deposit History'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header">
        <h1><?php echo translate('Deposits'); ?></h1>
        
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
        
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-end">
                <form action="" class="d-flex flex-wrap justify-content-end align-items-center">
                     <div class="form-group m-1 flex-grow-1">
                         <div class="input-group">
                             <input type="text" class="form-control" name="search" value="<?php echo e($search ?? ''); ?>" placeholder="<?php echo translate('Transaction ID'); ?>">
                             <div class="input-group-append">
                                 <button class="input-group-text btn btn-primary text-white" id="my-addon"><i class="fas fa-search"></i></button>
                             </div>
                         </div>
                     </div>
                </form>
            </div>
            <div class="card-body text-center">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th><?php echo translate('Transaction ID'); ?></th>
                            <th><?php echo translate('User'); ?></th>
                            <th><?php echo translate('Amount(With Charge)'); ?></th>
                            <th><?php echo translate('Charge'); ?></th>
                            <th><?php echo translate('Coinpayment Txn'); ?></th>
                            <th><?php echo translate('Date'); ?></th>
                           
                        </tr>
                        <?php $__empty_1 = true; $__currentLoopData = $deposits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>

                                 <td data-label="<?php echo translate('Transaction ID'); ?>">
                                   <?php echo e($info->tnx); ?>

                                 </td>
                                 <td data-label="<?php echo translate('User'); ?>"><?php echo e($info->user->email); ?></td>

                                 <td data-label="<?php echo translate('Charge'); ?>"><?php echo e(numFormat($info->charge,8)); ?> <?php echo e($info->currency->code); ?></td>

                                 <td data-label="<?php echo translate('Amount'); ?>"><?php echo e(numFormat($info->total_amount,8)); ?> <?php echo e($info->currency->code); ?></td>
                                 
                                 <td data-label="<?php echo translate('Coinpayment Txn'); ?>">
                                   <?php echo e($info->coinpayment_tnx); ?>

                                   
                                 </td>
                                 <td data-label="<?php echo translate('Date'); ?>">
                                   <?php echo e(dateFormat($info->created_at)); ?>

                                   
                                 </td>

                                
                            </tr>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <tr>
                                <td class="text-center" colspan="100%"><?php echo translate('No Data Found'); ?></td>
                            </tr>

                        <?php endif; ?>
                    </table>
                </div>
                <?php if($deposits->hasPages()): ?>
                <div class="card-footer">
                    <?php echo e($deposits->links()); ?>

                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/deposit/index.blade.php ENDPATH**/ ?>
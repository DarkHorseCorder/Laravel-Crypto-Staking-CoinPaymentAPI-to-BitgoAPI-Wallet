

<?php $__env->startSection('title'); ?>
   <?php echo translate('Transactions'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<section class="section">
    <div class="section-header">
        <h1> <?php echo translate('Transactions'); ?></h1>
    </div>
</section>
 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header d-flex justify-content-end">
                    <form action="" class="d-flex flex-wrap justify-content-end">
                        <div class="form-group m-1 flex-grow-1">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="<?php echo translate('Transaction ID'); ?>">
                                <div class="input-group-append">
                                    <button class="input-group-text btn btn-primary text-white" id="my-addon"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                       </form>
                  </div>
                 
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th><?php echo translate('Date'); ?></th>
                          <th><?php echo translate('Transaction ID'); ?></th>
                          <th><?php echo translate('Description'); ?></th>
                          <th><?php echo translate('Remark'); ?></th>
                          <th><?php echo translate('Amount'); ?></th>
                          <th><?php echo translate('Charge'); ?></th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                          <tr>
                            <td data-label="<?php echo translate('Date'); ?>"><?php echo e(dateFormat($item->created_at,'d-M-Y')); ?></td>
                            <td data-label="<?php echo translate('Transaction ID'); ?>">
                              <?php echo e(translate($item->trnx)); ?>

                            </td>
                            <td data-label="<?php echo translate('Description'); ?>">
                              <?php echo e(translate($item->details)); ?>

                            </td>
                            <td data-label="<?php echo translate('Remark'); ?>">
                              <span class="badge badge-dark"><?php echo e(ucwords(str_replace('_',' ',$item->remark))); ?></span>
                            </td>
                            <td data-label="<?php echo translate('Amount'); ?>">
                                <span class="<?php echo e($item->type == '+' ? 'text-success':'text-danger'); ?>"><?php echo e($item->type); ?> <?php echo e(amount($item->amount,$item->currency->type,2)); ?> <?php echo e($item->currency->code); ?></span> 
                            </td>
                           <td data-label="<?php echo translate('Charge'); ?>">
                            <?php echo e(amount($item->charge,$item->currency->type,2)); ?> <?php echo e($item->currency->code); ?>

                           </td>
                          </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td class="text-center" colspan="12"><?php echo translate('No data found!'); ?></td></tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                  <?php if($transactions->hasPages()): ?>
                      <div class="card-footer">
                          <?php echo e($transactions->links('admin.partials.paginate')); ?>

                      </div>
                  <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

   
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/transactions.blade.php ENDPATH**/ ?>


<?php $__env->startSection('title'); ?>
   <?php echo translate('Transactions'); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="dashboard--content-item">
      <form action="" class="d-flex justify-content-end mb-3">
        <div class="form-group">
          <div class="input-group">
              <input type="text" class="form-control shadow-none" value="<?php echo e($search ?? ''); ?>" name="search" placeholder="<?php echo translate('Transaction ID'); ?>">
                  <button class="input-group-text btn btn-primary text-white" id="my-addon"><i class="fas fa-search"></i>
                  </button>
          </div>
        </div>
     </form>
      <div class="table-responsive table--mobile-lg">
        <table class="table crypto-offer-table bg--body">
            <thead>
              <tr>
                <th><?php echo translate('Date'); ?></th>
                <th><?php echo translate('Transaction ID'); ?></th>
                <th><?php echo translate('Remark'); ?></th>
                <th><?php echo translate('Amount'); ?></th>
                <th><?php echo translate('Details'); ?></th>
              </tr>
            </thead>
            <tbody>
              <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                  <td data-label="<?php echo translate('Date'); ?>"><div><?php echo e(dateFormat($item->created_at,'d-M-Y')); ?></div></td>
                  <td data-label="<?php echo translate('Transaction ID'); ?>">
                    <div><?php echo e(translate($item->trnx)); ?></div>
                  </td>
                  <td data-label="<?php echo translate('Remark'); ?>">
                    <span class="badge bg-dark"><?php echo e(ucwords(str_replace('_',' ',$item->remark))); ?></span>
                  </td>
                  <td data-label="<?php echo translate('Amount'); ?>">
                      <span class="<?php echo e($item->type == '+' ? 'text-success':'text-danger'); ?>"><?php echo e($item->type); ?> <?php echo e(numFormat($item->amount,8)); ?> <?php echo e($item->currency->code); ?></span> 
                  </td>
                  <td data-label="<?php echo translate('Details'); ?>">
                      <div><button class="btn btn--success btn-sm details" data-data="<?php echo e($item); ?>"><?php echo translate('Details'); ?></button></div>
                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <tr><td class="text-center" colspan="12"><?php echo translate('No data found!'); ?></td></tr>
              <?php endif; ?>
            </tbody>
          </table>
      </div>
        <?php if($transactions->hasPages()): ?>
            
          <?php echo e($transactions->links()); ?>

           
        <?php endif; ?>
    </div>

    <div class="modal modal-blur fade" id="modal-success" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center py-4">
              <i  class="fas fa-info-circle fa-3x mb-2"></i>
              <h5 class="mb-2"><?php echo translate('Transaction Details'); ?></h5>
              <p class="trx_details"></p>
              <ul class="list-group mt-2">
                
              </ul>
            </div>
            <div class="modal-footer">
            <div class="w-100">
                <div class="row">
                <div class="col"><a href="#" class="btn btn--base w-100" data-bs-dismiss="modal">
                    <?php echo translate('Close'); ?>
                    </a></div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
      'use strict';
   
      $('.details').on('click',function () { 
        var url = "<?php echo e(url('user/transaction/details/')); ?>"+'/'+$(this).data('data').id
        $('.trx_details').text($(this).data('data').details)
        $.get(url,function (res) { 
          if(res == 'empty'){
            $('.list-group').html('<p><?php echo translate('No details found!'); ?></p>')
          }else{
            $('.list-group').html(res)
          }
          $('#modal-success').modal('show')
        })
      })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/user/transactions.blade.php ENDPATH**/ ?>
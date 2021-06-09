

<?php $__env->startSection('title'); ?>
    <?php echo translate('Deposit'); ?>
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
                            <div class="balance"><?php echo e(numFormat($item->balance,8)); ?> <?php echo e($item->curr->code); ?></div>
                        </div>
                    </div>
                    <div class="dashboard-card__content">
                        <div class="deposit-btn-grp">
                            <?php if(request()->routeIs('user.deposit.index')): ?>
                            <a href="javascript:void(0)" data-code="<?php echo e($item->curr->code); ?>" data-charge="<?php echo e(@$item->curr->charges->deposit_charge); ?>" class="btn btn-sm btn--primary deposit"><?php echo translate('See Deposit Address'); ?></a>

                            <a href="<?php echo e(route('user.deposit.address.existing',$item->curr->code)); ?>" class="btn btn-sm btn--info btn-block"><?php echo translate('Previous Addresses'); ?></a>
                            <?php endif; ?>
                            <?php if(request()->routeIs('user.withdraw.wallets')): ?>
                              <a href="<?php echo e(route('user.withdraw.form',$item->curr->code)); ?>" class="btn btn-sm btn--info btn-block"><?php echo translate('Withdraw'); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       
    </div>
</div>

<div id="addressModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body p-4 text-center">
                <label class="form-label text--primary"><?php echo translate('Deposit Address'); ?></label>
                <div class="input-group">
                    <input type="text"  class="form-control form--control bg--section address"  readonly>
                    <button type="button" class="input-group-text copy"><?php echo translate('Copy'); ?></button>
                    <code class="charge"><?php echo translate(''); ?></code>
                </div>
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn--dark" data-bs-dismiss="modal"><?php echo translate('Close'); ?></button>
            </div>
        
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        $('.deposit').on('click', function () { 
            var code = $(this).data('code')
            $(this).html('<i class="fas fa-spinner fa-spin"></i>')
            $('.charge').text($(this).data('charge')+'% '+'<?php echo translate('Deposit fee will be deducted from all deposits.'); ?>')
            $.post("<?php echo e(route('user.deposit.address')); ?>", {code:code,_token:'<?php echo e(csrf_token()); ?>'}, function(res) {
                if(res.error == 'ok'){
                    $('.deposit').html('See Deposit Address')
                    $('#addressModal').find('.address').val(res.result.address)
                    $('#addressModal').modal('show')  
                }
                else{
                    toast('error',res.error);
                    $('.deposit').html('Get Deposit Address')
                    return false
                }
            });
        })

        $(".copy").on("click", () => {
			var textInput = $('.address');
			textInput.select();
			document.execCommand("copy");
            toast('success','<?php echo translate('Address copied'); ?>');
            return false;
		});

    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/user/wallets.blade.php ENDPATH**/ ?>
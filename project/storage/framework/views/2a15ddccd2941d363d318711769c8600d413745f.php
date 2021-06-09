
<li class="list-group-item d-flex justify-content-between"><?php echo translate('Transaction ID'); ?><span><?php echo e($transaction->trnx); ?></span></li>
<li class="list-group-item d-flex justify-content-between"><?php echo translate('Remark'); ?><span class="badge badge--dark"><?php echo e(ucwords(str_replace('_',' ',$transaction->remark))); ?></span></li>
<li class="list-group-item d-flex justify-content-between"><?php echo translate('Currency'); ?><span class="font-weight-bold"><?php echo e($transaction->currency->code); ?></span></li>
<li class="list-group-item d-flex justify-content-between"><?php echo translate('Amount'); ?><span class="badge <?php echo e($transaction->type == '+' ? 'bg-success':'bg-danger'); ?>"><?php echo e($transaction->type); ?><?php echo e(amount($transaction->amount,$transaction->currency->type,2)); ?> <?php echo e($transaction->currency->code); ?></span></li>
<li class="list-group-item d-flex justify-content-between"><?php echo translate('Charge'); ?><span><?php echo e(amount($transaction->charge,$transaction->currency->type,2)); ?> <?php echo e($transaction->currency->code); ?></span></li>
<?php if($transaction->invoice_num): ?>
 <li class="list-group-item d-flex justify-content-between"><?php echo translate('Invoice'); ?><a target="_blank" href="<?php echo e(route('user.invoice.view',$transaction->invoice_num)); ?>"><?php echo e($transaction->invoice_num); ?></a></li>
<?php endif; ?>
<li class="list-group-item d-flex justify-content-between"><?php echo translate('Date'); ?><span><?php echo e(dateFormat($transaction->created_at,'d M y')); ?></span></li><?php /**PATH /home/xnettrading/public_html/project/resources/views/user/trx_details.blade.php ENDPATH**/ ?>
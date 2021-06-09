

<?php $__env->startSection('title'); ?>
   <?php echo translate('Payment Gateways (FIAT)'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
	<div class="section-header justify-content-between">
		<h1><?php echo translate('Payment Gateways (FIAT)'); ?></h1>
    <a href="javascript:void(0)" data-toggle="modal" data-target="#add" class="btn btn-primary"><i class="fas fa-plus"></i> <?php echo translate('Add New'); ?></a>
	</div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <?php $__currentLoopData = $gateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-6 col-lg-6 col-xl-3">
      <div class="card card-primary">
        <div class="card-header justify-content-center">
          <h4><i class="fas fa-money-check-alt"></i> <?php echo e($item->name); ?></h4>
        </div>
        <div class="card-body">
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between"><?php echo translate('Total Currency :'); ?>
              <span class="font-weight-bold"><?php echo e(count($item->currency_id)); ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between"><?php echo translate('Status :'); ?>
              <span class="badge badge-<?php echo e($item->status == 1 ? 'success' : 'danger'); ?>"><?php echo e($item->status == 1 ? 'Active' : 'Inactive'); ?></span>
            </li>
          </ul>
            <a href="javascript:void(0)" class="btn btn-primary btn-block edit" data-item="<?php echo e($item); ?>" data-route="<?php echo e(route('admin.gateway.update',$item)); ?>"><i class="fas fa-edit"></i> <?php echo translate('Edit Gateway'); ?></a>
        </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div class="modal fade" id="add" tabindex="-1" role="dialog"  aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form action="" method="POST">
          <?php echo csrf_field(); ?>
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><?php echo translate('Add New Gateway'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label><?php echo translate('Gateway Name'); ?></label>
                  <input class="form-control" type="text" name="name" required>
                </div>

                <div class="form-group">
                  <label class="cswitch d-flex justify-content-between align-items-center border p-2">
                      <input class="cswitch--input update" name="status" type="checkbox"/><span class="cswitch--trigger wrapper"></span>
                      <span class="cswitch--label font-weight-bold"><?php echo translate('Status'); ?></span>
                  </label>
                </div>

                <div class="form-group border p-3">
                  <?php $__currentLoopData = DB::table('currencies')->where('type',1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dcurr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <input  name="currency_id[]" type="checkbox" id="currency_id<?php echo e($dcurr->id); ?>" value="<?php echo e($dcurr->id); ?>">
                  <label class="mr-4 currency_label" for="currency_id<?php echo e($dcurr->id); ?>"><?php echo e($dcurr->code); ?></label>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo translate('Close'); ?></button>
              <button type="submit" class="btn btn-primary"><?php echo translate('Submit'); ?></button>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="modal fade" id="edit" tabindex="-1" role="dialog"  aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form action="" method="POST">
          <?php echo csrf_field(); ?>
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><?php echo translate('Edit Gateway'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label><?php echo translate('Gateway Name'); ?></label>
                  <input class="form-control" type="text" name="name" required>
                </div>

                <div class="form-group">
                  <label class="cswitch d-flex justify-content-between align-items-center border p-2">
                      <input class="cswitch--input update" name="status" type="checkbox"/><span class="cswitch--trigger wrapper"></span>
                      <span class="cswitch--label font-weight-bold"><?php echo translate('Status'); ?></span>
                  </label>
                </div>

                <div class="form-group border p-3">
                  <?php $__currentLoopData = DB::table('currencies')->where('type',1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dcurr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <input class="curr"  name="currency_id[]" type="checkbox" id="currency_id<?php echo e($dcurr->id); ?>" value="<?php echo e($dcurr->id); ?>">
                  <label class="mr-4 currency_label" for="currency_id<?php echo e($dcurr->id); ?>"><?php echo e($dcurr->code); ?></label>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo translate('Close'); ?></button>
              <button type="submit" class="btn btn-primary"><?php echo translate('Submit'); ?></button>
            </div>
          </div>
        </form>
      </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('style'); ?>
    <style>
      .currency_label{
        font-size: 18px!important;
      }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
      'use strict';
      $('.edit').on('click',function () { 
        var item = $(this).data('item')
        const modal = $('#edit')
        modal.find('input[name=name]').val(item.name)
        if(item.status == 1) modal.find('input[name=status]').attr('checked',true)
        var item_curr = item.currency_id;

        $.each(modal.find('.curr'), function (i, val) {
          var id = val.id;
          var curr_id = id.replace("currency_id", "")
          if(item_curr.includes(curr_id)) $(val).attr('checked',true)
          else $(val).attr('checked',false)
        });
        modal.find('form').attr('action',$(this).data('route'))
        modal.modal('show')
      })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/payment/index.blade.php ENDPATH**/ ?>
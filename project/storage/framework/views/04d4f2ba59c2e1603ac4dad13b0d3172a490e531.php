

<?php $__env->startSection('title'); ?>
   <?php echo translate('Trade Durations'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header d-flex flex-wrap justify-content-between">
      <h1 class="mb-1 mr-auto"><?php echo translate('Trade Durations'); ?></h1>
      <div class="d-flex flex-wrap ">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#add" class="btn btn-primary mb-1 mr-3"><i class="fas fa-plus"></i> <?php echo translate('Add New'); ?></a>
          </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <?php $__empty_1 = true; $__currentLoopData = $durations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="col-md-3 col-lg-3 col-xl-2 currency--card">
      <div class="card card-primary">
        <div class="card-header  d-flex justify-content-center">
            <h5 class="text-center text-primary"> <i class="far fa-clock clock"></i> <?php echo e($item->duration); ?> <?php echo translate(' Minutes'); ?></h5>
        </div>
        <div class="card-body d-flex flex-wrap justify-content-between">
          <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-block edit" data-item="<?php echo e($item); ?>"><i class="fas fa-edit"></i> <?php echo translate('Edit'); ?></a>  
          <a href="javascript:void(0)" class="btn btn-danger btn-sm  btn-block remove" data-item="<?php echo e($item); ?>"><i class="fas fa-trash-alt"></i> <?php echo translate('Remove'); ?></a>  
        </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="col-md-12">
        <h4 class="text-center"><?php echo translate('No trade duration found!!'); ?></h4>
    </div>
    <?php endif; ?>
    <?php if($durations->hasPages()): ?>
    <div class="col-md-12">
        <?php echo e($durations->links()); ?>

    </div>
    <?php endif; ?>
</div>


<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" method="POST">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo translate('Add Duration'); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                   <div class="form-group">
                       <label><?php echo translate('Duration in minute'); ?></label>
                       <input class="form-control" type="text" name="duration" required>
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
<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?php echo e(route('admin.trade.duration.update')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo translate('Edit Duration'); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                   <div class="form-group">
                       <label><?php echo translate('Duration in minute'); ?></label>
                       <input class="form-control" type="text" name="duration" required>
                   </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo translate('Close'); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo translate('Update'); ?></button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="remove" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?php echo e(route('admin.trade.duration.remove')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-body p-4 text-center">
                   <h4><?php echo translate('Are you sure to remove?'); ?></h4>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo translate('Cancel'); ?></button>
                    <button type="submit" class="btn btn-danger"><?php echo translate('Remove'); ?></button>
                </div>
            </div>
        </form>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .clock{
            font-size: 18px!important
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        $('.edit').on('click',function () { 
            const item = $(this).data('item')
            $('#edit').find('input[name=duration]').val(item.duration)
            $('#edit').find('input[name=id]').val(item.id)
            $('#edit').modal('show')
        })
        $('.remove').on('click',function () { 
            const item = $(this).data('item')
            $('#remove').find('input[name=id]').val(item.id)
            $('#remove').modal('show')
        })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/trade/durations.blade.php ENDPATH**/ ?>
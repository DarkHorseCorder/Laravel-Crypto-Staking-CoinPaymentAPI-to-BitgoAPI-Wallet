

<?php $__env->startSection('title'); ?>
   <?php echo translate('SMS gateways'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header">
        <h1><?php echo translate('SMS gateways'); ?></h1>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <?php $__currentLoopData = $gateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-6 col-lg-6 col-xl-3 currency--card">
      <div class="card card-primary">
        <div class="card-header <?php echo e($item->status == 1 ? 'default' : ''); ?>">
          <h4><?php echo e($item->name); ?></h4>
        </div>
        <div class="card-body">
          <a href="<?php echo e(route('admin.sms.edit',$item->id)); ?>" class="btn btn-primary"><i class="fas fa-edit"></i> <?php echo translate('Edit Configuration'); ?></a>
         
        </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .default{
          background-color: #6777ef26!important;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/sms/gateways.blade.php ENDPATH**/ ?>


<?php $__env->startSection('title'); ?>
   <?php echo translate('SMS Templates'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header">
        <h1><?php echo translate('SMS Templates'); ?></h1>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-6 col-lg-6 col-xl-3 currency--card">
      <div class="card card-primary">
        <div class="card-header">
          <h4><?php echo e($item->email_subject); ?></h4>
        </div>
        <div class="card-body">
            <?php if(access('sms template edit')): ?>
             <a href="<?php echo e(route('admin.sms.template.edit',$item->id)); ?>" class="btn btn-primary"><i class="fas fa-edit"></i> <?php echo translate('Edit Template'); ?></a>
            <?php endif; ?>
        </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/sms/templates.blade.php ENDPATH**/ ?>
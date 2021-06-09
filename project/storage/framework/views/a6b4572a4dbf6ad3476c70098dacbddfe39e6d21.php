

<?php $__env->startSection('title'); ?>
   <?php echo translate('Site Contents'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header">
        <h1><?php echo translate('Site Contents'); ?></h1>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-6 col-lg-6 col-xl-3 currency--card">
      <div class="card card-primary">
        <div class="card-header d-flex justify-content-between">
          <h4><?php echo e(ucfirst($item->name)); ?> <?php echo e($item->status != 9 ? ' Section':''); ?></h4>
          <?php if($item->status != 9): ?>
            <label class="cswitch align-items-center">
              <input class="cswitch--input update" value="<?php echo e($item->id); ?>" type="checkbox" <?php echo e($item->status == 1 ? 'checked':''); ?> /><span class="cswitch--trigger wrapper"></span>
          </label>
          <?php endif; ?>
        </div>
        <div class="card-body">
            <a href="<?php echo e(route('admin.frontend.edit',$item->id)); ?>" class="btn btn-primary"><i class="fas fa-edit"></i> <?php echo translate('Edit '.ucfirst($item->name).' Section'); ?></a>
        </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
      'use strict';
      $('.update').on('change', function () {
          var url = "<?php echo e(route('admin.frontend.status.update')); ?>"
          var data = {
              id:$(this).val(),
              _token:"<?php echo e(csrf_token()); ?>"
          }
          $.post(url,data,function(response) {
              if(response.error){
                  toast('error',response.error)
                  return false;
              }
              toast('success',response.success)
          })
          });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/site_contents/index.blade.php ENDPATH**/ ?>
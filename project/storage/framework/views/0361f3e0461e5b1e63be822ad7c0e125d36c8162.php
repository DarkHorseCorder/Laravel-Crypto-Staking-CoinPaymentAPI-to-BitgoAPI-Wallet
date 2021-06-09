

<?php $__env->startSection('title'); ?>
   <?php echo translate('Group Email'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header">
        <h1><?php echo translate('Group Email'); ?></h1>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-12">
       <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
             <h6 class="m-0 font-weight-bold text-primary"><?php echo e(translate('Group Mail Form')); ?></h6>
             <a href="<?php echo e(route('admin.user.index')); ?>" class="btn btn-primary"><i class="fas fa-backward"></i> <?php echo translate('Back'); ?></a>
          </div>
          <div class="card-body">
             <form action="<?php echo e(route('admin.group.submit')); ?>" enctype="multipart/form-data" method="POST">
                 <?php echo csrf_field(); ?>
                 
                 <div class="row">
                     <div class="col-md-12">
                     <div class="form-group">
                         <label for="subject"><?php echo e(translate('Email Subject')); ?></label>
                         <input type="text" class="form-control" name="subject" id="subject" placeholder="<?php echo e(translate('Email Subject')); ?>">
                     </div>
                     </div>
             
                     <div class="col-md-12">
                        <div class="form-group">
                            <label for="body"><?php echo e(translate('Message')); ?></label>
                            <textarea id="body" class="form-control summernote" name="message" rows="5" placeholder="<?php echo e(translate('Description')); ?>"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary btn-lg"><?php echo e(__('Submit')); ?></button>
                    </div>
             </form>
          </div>
       </div>
    </div>
 </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/email/group_mail.blade.php ENDPATH**/ ?>
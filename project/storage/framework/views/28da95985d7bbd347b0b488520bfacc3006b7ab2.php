
<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
        <div class="section-header">
        <h1><?php echo translate('Logo Settings'); ?></h1>
        </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
   <?php echo translate('Site Logo and Favicon'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
               <h6 class="text-primary"> <?php echo translate('Logo'); ?></h6>
            </div>
            <div class="card-body">
              <form id="geniusformUpdate" action="<?php echo e(route('admin.gs.update')); ?>" enctype="text/plain" method="POST">
                <?php echo csrf_field(); ?>
              
                 <div class="form-group d-flex justify-content-center">
                    <div id="image-preview" class="image-preview image-preview_alt"
                        style="background-image:url(<?php echo e(getPhoto($gs->header_logo)); ?>);">
                        <label for="image-upload" id="image-label"><?php echo translate('Choose File'); ?></label>
                        <input type="file" name="header_logo" id="image-upload" />
                    </div>
                 </div>
                   <div class="form-group row">
                    <div class="col-sm-12 text-center">
                      <button type="submit" class="btn btn-primary btn-block"><?php echo e(__('Update')); ?></button>
                    </div>
                  </div>
              </form>
            </div>
        </div>
    </div>

   
    <div class="col-md-6">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('Favicon')); ?></h6>
        </div>
        <div class="card-body">
            <form id="geniusformUpdate" action="<?php echo e(route('admin.gs.update')); ?>" enctype="multipart/form-data" method="POST">
              <?php echo csrf_field(); ?>
              <div class="form-group d-flex justify-content-center">
                <div id="image-preview1" class="image-preview image-preview_alt"
                    style="background-image:url(<?php echo e(getPhoto($gs->favicon)); ?>);">
                    <label for="image-upload1" id="image-label"><?php echo translate('Choose File'); ?></label>
                    <input type="file" name="favicon" id="image-upload1" />
                </div>
             </div>
             <div class="form-group row">
              <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-primary btn-block"><?php echo e(__('Update')); ?></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>



<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
      'use strict';
      $.uploadPreview({
                input_field: "#image-upload", // Default: .image-upload
                preview_box: "#image-preview", // Default: .image-preview
                label_field: "#image-label", // Default: .image-label
                label_default: "<?php echo e(translate('Choose File')); ?>", // Default: Choose File
                label_selected: "<?php echo e(translate('Update Image')); ?>", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });
        $.uploadPreview({
                input_field: "#image-upload1", // Default: .image-upload
                preview_box: "#image-preview1", // Default: .image-preview
                label_field: "#image-label1", // Default: .image-label
                label_default: "<?php echo e(translate('Choose File')); ?>", // Default: Choose File
                label_selected: "<?php echo e(translate('Update Image')); ?>", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\custom\exchange\project\resources\views/admin/generalsetting/logo.blade.php ENDPATH**/ ?>
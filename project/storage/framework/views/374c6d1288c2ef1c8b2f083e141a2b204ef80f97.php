

<?php $__env->startSection('title'); ?>
   <?php echo translate('SEO Settings'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header">
        <h1><?php echo translate('SEO Settings'); ?></h1>
    </div>
</section>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

<div class="row justify-content-center mt-3">
   <div class="col-lg-12">
      <div class="card mb-4">
         <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('SEO Settings Form')); ?></h6>
         </div>
         <div class="card-body">
            <div class="gocover" style="background: url(<?php echo e(asset('assets/images/'.$gs->dashboard_loader)); ?>) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
            <form id="geniusformUpdate" action="<?php echo e(route('admin.seo-setting.update',$seosetting->id)); ?>" enctype="multipart/form-data" method="POST">
               <?php echo csrf_field(); ?>
               <?php echo method_field('PUT'); ?>
               <?php echo $__env->make('admin.partials.form-both', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="form-group row mb-3">
                    <label for="title" class="col-sm-3 col-form-label"><?php echo e(__('Title')); ?></label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="title" name="title" placeholder="<?php echo e(__('Title')); ?>" value="<?php echo e($seosetting->title); ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tag" class="col-sm-3 col-form-label"><?php echo e(__('Meta Tags')); ?></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control tagify__input"  id="tag" name="meta_tag" value="<?php echo e($seosetting->meta_tag); ?>" placeholder="<?php echo e(__('Meta Tags')); ?>" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="meta_description" class="col-sm-3 col-form-label"><?php echo e(__('Meta Description')); ?></label>
                    <div class="col-sm-9">
                     <textarea id="meta_description" class="form-control" name="meta_description" placeholder="<?php echo e(__('Meta Description')); ?>"><?php echo e($seosetting->meta_description); ?></textarea>
                    </div>
                </div>

               <div class="form-group row ">
                  <label for="" class="col-sm-3 col-form-label"><?php echo translate('Meta Image'); ?></label>
                  <div class="col-sm-9">
                     <div class="gallery gallery-fw" data-item-height="450">
                        <img class="gallery-item imageShow" src="<?php echo e(getPhoto($seosetting->meta_image)); ?>" data-image="<?php echo e(getPhoto($seosetting->meta_image)); ?>">
                     </div>
                     <div class="custom-file">
                        <input type="file" name="meta_image" class="custom-file-input imageUpload" id="customFile">
                        <label class="custom-file-label"  for="customFile"><?php echo translate('Choose file'); ?></label>
                     </div>
                  </div>
               </div>

               <div class="form-group row">
                  <div class="col-sm-12 text-right">
                     <button type="submit" class="btn btn-primary btn-lg"><?php echo e(translate('Save')); ?></button>
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
      $('input[name=meta_tag]').tagify();

       function imageShow(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).parents('.form-group').find('.imageShow').attr('src',e.target.result)
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".imageUpload").on('change', function () {
            imageShow(this);
        });

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/seo/index.blade.php ENDPATH**/ ?>
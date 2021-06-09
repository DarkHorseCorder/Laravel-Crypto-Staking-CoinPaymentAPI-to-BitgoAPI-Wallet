

<?php $__env->startSection('title'); ?>
   <?php echo app('translator')->get(ucfirst($section->name).' Section'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1><?php echo app('translator')->get(ucfirst($section->name).' Section'); ?></h1>
        <a href="<?php echo e(route('admin.frontend.index')); ?>" class="btn btn-primary"><i class="fa fa-backward"></i> <?php echo translate('Back'); ?></a>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php if($section->content): ?>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><?php echo app('translator')->get(ucfirst($section->name).' Content'); ?></h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.frontend.content.update',$section->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for=""><?php echo translate('Background Image'); ?></label>
                                <div class="gallery gallery-fw"  data-item-height="450">
                                    <img class="gallery-item imageShow" data-image="<?php echo e(getPhoto(@$section->content->image)); ?>">
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="image"  class="custom-file-input imageUpload mb-2" id="customFile">
                                    <code class="text-danger"><?php echo translate('Image size : 1052 x 945 px'); ?></code>
                                    <input type="hidden" name="image_size" value="1052x945">
                                    <label class="custom-file-label" for="customFile"><?php echo translate('Choose file'); ?></label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for=""><?php echo translate('First Heading'); ?></label>
                                <input type="text" name="first_heading" class="form-control" placeholder="<?php echo translate('First Heading'); ?>" value="<?php echo e(@$section->content->first_heading); ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for=""><?php echo translate('First Sub Heading'); ?></label>
                                <input type="text" name="first_sub_heading" class="form-control" placeholder="<?php echo translate('First Sub Heading'); ?>" value="<?php echo e(@$section->content->first_sub_heading); ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for=""><?php echo translate('Second Heading'); ?></label>
                                <input type="text" name="second_heading" class="form-control" placeholder="<?php echo translate('Second Heading'); ?>" value="<?php echo e(@$section->content->second_heading); ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for=""><?php echo translate('Second Sub Heading'); ?></label>
                                <input type="text" name="second_sub_heading" class="form-control" placeholder="<?php echo translate('Second Sub Heading'); ?>" value="<?php echo e(@$section->content->second_sub_heading); ?>" required>
                            </div>
                           
                            
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block btn-lg"><?php echo translate('Submit'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict'
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/site_contents/register.blade.php ENDPATH**/ ?>


<?php $__env->startSection('title'); ?>
   <?php echo translate('Profile Setting'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header">
        <h1><?php echo translate('Profile Setting'); ?></h1>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo e(route('admin.profile.update')); ?>" class="row" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label"><?php echo translate('Profile Picture'); ?></label>
                                <div id="image-preview" class="image-preview"
                                    style="background-image:url(<?php echo e(getPhoto( $data->photo)); ?>);">
                                    <label for="image-upload" id="image-label"><?php echo translate('Choose File'); ?></label>
                                    <input type="file" name="photo" id="image-upload" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label><?php echo translate('Name'); ?></label>
                                <input class="form-control" type="text" name="name" value="<?php echo e($data->name); ?>" required>
                            </div>
                            <div class="form-group">
                                <label><?php echo translate('Email'); ?></label>
                                <input class="form-control" type="email" name="email" value="<?php echo e($data->email); ?>" required>
                            </div>
                            <div class="form-group">
                                <label><?php echo translate('Phone'); ?></label>
                                <input class="form-control" type="text" name="phone" value="<?php echo e($data->phone); ?>" required>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary btn-lg"><?php echo translate('Submit'); ?></button>
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

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/profile.blade.php ENDPATH**/ ?>
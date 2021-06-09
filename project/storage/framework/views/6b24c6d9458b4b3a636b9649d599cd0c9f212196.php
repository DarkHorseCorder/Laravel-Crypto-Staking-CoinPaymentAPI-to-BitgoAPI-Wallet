

<?php $__env->startSection('title'); ?>
   <?php echo app('translator')->get('KYC Form'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-xl">
        <div class="card default--card">
            <div class="card-body p-3">
                <form action="" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <?php $__currentLoopData = $kycForm; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($field->type == 1): ?>
                                <div class="form-group col-md-12 mb-3">
                                    <label for="" class="mb-2">
                                        <?php echo app('translator')->get($field->label); ?> <?php if($field->required == 1): ?> 
                                         <code><?php echo app('translator')->get('(required)'); ?></code> <?php else: ?> <code><?php echo app('translator')->get('(optional)'); ?></code> <?php endif; ?>
                                    </label>
                                    <input type="text" class="form-control shadow-none" name="<?php echo e($field->name); ?>" <?php echo e($field->required == 1 ? 'required':''); ?>>
                                </div>
                            <?php elseif($field->type == 2): ?>
                                <div class="form-group col-md-12 mb-3">
                                    <label for="" class="mb-2"><?php echo app('translator')->get($field->label); ?> <small class="text-danger"><?php echo app('translator')->get('(allowed extention : .png, .jpg, .jpeg)'); ?></small> <?php if($field->required == 1): ?> 
                                        <code><?php echo app('translator')->get('(required)'); ?></code> <?php else: ?> <code><?php echo app('translator')->get('(optional)'); ?></code> <?php endif; ?></label>
                                    <input type="file" class="form-control shadow-none file-type" name="<?php echo e($field->name); ?>" <?php echo e($field->required == 1 ? 'required':''); ?>>
                                </div>
                            <?php elseif($field->type == 3): ?>
                                <div class="form-group col-md-12 mb-3">
                                    <label for="" class="mb-2"><?php echo app('translator')->get($field->label); ?><?php if($field->required == 1): ?> 
                                        <code><?php echo app('translator')->get('(required)'); ?></code> <?php else: ?> <code><?php echo app('translator')->get('(optional)'); ?></code> <?php endif; ?></label>
                                    <textarea  class="form-control shadow-none" rows="5" name="<?php echo e($field->name); ?>" <?php echo e($field->required == 1 ? 'required':''); ?>></textarea>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <div class="form-group col-md-12 mb-3 text-end">
                            <button type="submit" class="btn btn--base"><?php echo app('translator')->get('Submit'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/user/kyc_form.blade.php ENDPATH**/ ?>
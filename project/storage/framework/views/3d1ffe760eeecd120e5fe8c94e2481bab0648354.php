

<?php $__env->startSection('title'); ?>
    <?php echo translate('Cookie Concent'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header">
    <h1><?php echo translate('Cookie Concent'); ?></h1>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                    
                    <?php echo csrf_field(); ?>

                    <div class="row">
                    
                    
                        <div class="form-group col-md-6">
                            <label for=""><?php echo translate('Cookie Status'); ?></label>
                            <select name="status" id="" class="form-control" required>

                                <option value="1" <?php echo e(@$gs->cookie->status ? 'selected' : ''); ?>><?php echo translate('Yes'); ?></option>
                                <option value="0" <?php echo e(@$gs->cookie->status ? '' : 'selected'); ?>><?php echo translate('No'); ?></option>
                            
                            </select>
                        
                        </div> 
                        
                        <div class="form-group col-md-6">
                        
                            <label for=""><?php echo translate('Cookie Button Text'); ?></label>
                            <input type="text" name="button_text" class="form-control"  value="<?php echo e(@$gs->cookie->button_text); ?>" required>
                        
                        </div> 
                        
                        <div class="form-group col-md-12">
                        
                            <label for=""><?php echo translate('Cookie condition text'); ?></label>

                            <textarea name="cookie_text" id="" cols="30" rows="10" class="form-control" required><?php echo e(translate(@$gs->cookie->cookie_text)); ?></textarea>
                        
                        </div> 
                        
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary"><?php echo translate('Update'); ?></button>
                        </div>
                    
                    </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/cookie.blade.php ENDPATH**/ ?>
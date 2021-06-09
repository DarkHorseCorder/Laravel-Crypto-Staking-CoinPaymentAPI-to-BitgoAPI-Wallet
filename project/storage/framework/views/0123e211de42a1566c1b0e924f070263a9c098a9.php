

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
                          
                            <div class="form-group col-md-6">
                                <label for=""><?php echo translate('Title'); ?></label>
                                <input type="text" name="title" class="form-control" placeholder="<?php echo translate('Title'); ?>" value="<?php echo e(@$section->content->title); ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for=""><?php echo translate('Heading'); ?></label>
                                <input type="text" name="heading" class="form-control" placeholder="<?php echo translate('Heading'); ?>" value="<?php echo e(@$section->content->heading); ?>" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for=""><?php echo translate('Sub Heading'); ?></label>
                                <input type="text" name="sub_heading" class="form-control" placeholder="<?php echo translate('Sub Heading'); ?>" value="<?php echo e(@$section->content->sub_heading); ?>" required>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block btn-lg"><?php echo translate('Submit'); ?></button>
                            </div>
                        </div>
                    </form>
               </div>
           </div>
        </div>
        <?php endif; ?>
    </div>
       
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/site_contents/blog.blade.php ENDPATH**/ ?>

<?php $__env->startSection('title'); ?>
   <?php echo translate('Edit Blog'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header  d-flex justify-content-between">
        <h1><?php echo translate('Edit Blog'); ?></h1>
        <a href="<?php echo e(route('admin.blog.index')); ?>" class="btn btn-primary"><i class="fas fa-backward"></i> <?php echo translate('Back'); ?></a>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="row justify-content-center">
   <div class="col-md-12">
      <!-- Form Basic -->
      <div class="card mb-4">
         <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('Edit Blog Form')); ?></h6>
         </div>
         <div class="card-body">
           
            <form action="<?php echo e(route('admin.blog.update',$blog->id)); ?>" enctype="multipart/form-data" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="col-md-12 ShowImage mb-3  text-center">
                    <img src="<?php echo e(getPhoto($blog->photo)); ?>" class="img-fluid" alt="image" width="400">
                 </div>
                <div class="form-group">
                    <label for="title"><?php echo e(__('Blog Title')); ?></label>
                    <input type="text" class="form-control" name="title" value="<?php echo e($blog->title); ?>" required placeholder="<?php echo e(__('Blog Title')); ?>">
                </div>
            
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="form-group">
                            <label for="categorys"><?php echo e(__('Category')); ?></label>
                            <select class="form-control  mb-3" id="categorys" name="category_id" required>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>" <?php echo e($blog->category_id == $item->id ? 'selected':''); ?>><?php echo e($item->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image"><?php echo e(__('Blog Photo')); ?></label>
                            <span class="ml-3"><?php echo e(__('(Extension:jpeg,jpg,png)')); ?></span>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="photo" id="image" accept="image/*">
                                <label class="custom-file-label" for="photo"><?php echo e(__('Choose file')); ?></label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="description"><?php echo e(__('Description')); ?></label>
                    <textarea id="area1" class="form-control summernote" name="description" placeholder="<?php echo e(__('Description')); ?>" required><?php echo e($blog->description); ?></textarea>
                </div>

             
                    <div class="form-group">
                        <label><?php echo e(__('Status')); ?></label>
                        <select class="form-control  mb-3"  name="status" required>
                            <option value="1" <?php echo e($blog->status == 1 ? 'selected':''); ?>><?php echo e(translate('Active')); ?></option>
                            <option value="0" <?php echo e($blog->status == 0 ? 'selected':''); ?>><?php echo e(translate('Inactive')); ?></option>
                        </select>
                    </div>        
              
           
                <button type="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
            </form>
         </div>
      </div>
      <!-- Form Sizing -->
      <!-- Horizontal Form -->
   </div>
</div>
<!--Row-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/blog/edit.blade.php ENDPATH**/ ?>
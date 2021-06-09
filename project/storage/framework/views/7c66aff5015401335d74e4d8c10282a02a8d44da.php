
<?php $__env->startSection('title'); ?>
   <?php echo translate('Edit Page'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1><?php echo translate('Edit Page'); ?></h1>
        <a href="<?php echo e(route('admin.page.index')); ?>" class="btn btn-primary"><i class="fas fa-backward"></i> <?php echo translate('Back'); ?> </a>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="row justify-content-center">
   <div class="col-md-12">
      <div class="card mb-4">
         <div class="card-body">
          
            <form action="<?php echo e(route('admin.page.update',$page->id)); ?>" method="POST" enctype="multipart/form-data">
               <?php echo csrf_field(); ?>
               <?php echo method_field('PUT'); ?>
               <div class="form-group">
                  <label for="inp-name"><?php echo e(__('Language')); ?></label>
                  <select name="lang" class="form-control">
                     <?php $__currentLoopData = DB::table('languages')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <option value="<?php echo e($item->code); ?>" <?php echo e($page->lang == $item->code ? 'selected':''); ?>><?php echo e($item->language); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
               </div>
               <div class="form-group">
                  <label for="inp-name"><?php echo e(__('Title')); ?></label>
                  <input type="text" class="form-control" id="inp-name" name="title"  placeholder="<?php echo e(__('Enter Title')); ?>" value="<?php echo e($page->title); ?>" required>
               </div>
               <div class="form-group">
                  <label for="description"><?php echo e(__('Description')); ?></label>
                  <textarea id="area1" class="form-control summernote" name="details" placeholder="<?php echo e(__('Description')); ?>"><?php echo e($page->details); ?></textarea>
              </div>
               <button type="submit" id="submit-btn" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
            </form>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/page/edit.blade.php ENDPATH**/ ?>
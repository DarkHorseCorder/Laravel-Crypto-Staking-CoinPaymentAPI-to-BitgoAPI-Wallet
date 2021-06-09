

<?php $__env->startSection('title'); ?>
   <?php echo translate('Manage Blog'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header">
        <h1><?php echo translate('Manage Blog'); ?></h1>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<!-- Row -->
<div class="row">
  <div class="col-lg-12">
	<div class="card mb-4">
    <div class="card-header d-flex justify-content-end">
      <a href="<?php echo e(route('admin.blog.create')); ?>" class="btn btn-primary"><i class="fas fa-plus"></i> <?php echo translate('Add New'); ?></a>
    </div>
	  <div class="table-responsive p-3">
      <table class="table align-items-center table-striped">

          <tr>
            <th><?php echo e(__('Title')); ?></th>
            <th><?php echo e(__('Category')); ?></th>
            <th><?php echo e(__('Views')); ?></th>
            <th><?php echo e(__('Status')); ?></th>
            <th><?php echo e(__('Action')); ?></th>
          </tr>
  
 
          <?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>

               <td data-label="<?php echo e(__('Title')); ?>">
                 <?php echo e($item->title); ?>

               </td>
               <td data-label="<?php echo e(__('Category')); ?>">
                 <?php echo e($item->category->name); ?>

               </td>
               <td data-label="<?php echo e(__('Views')); ?>">
                 <?php echo e($item->views); ?>

               </td>
             
               <td data-label="<?php echo e(__('Status')); ?>">
                  <?php if($item->status == 1): ?>
                  <span class="badge badge-success"> <?php echo translate('Active'); ?> </span>
                  <?php else: ?>
                  <span class="badge badge-warning"> <?php echo translate('Inactive'); ?> </span>
                  <?php endif; ?>
               </td>

               <td data-label="<?php echo e(__('Action')); ?>">
                  <a href="<?php echo e(route('admin.blog.edit',$item->id)); ?>" class="btn btn-primary  btn-sm edit mb-1" data-toggle="tooltip" title="<?php echo translate('Edit'); ?>"><i class="fas fa-edit"></i></a>

                  <a href="javascript:void(0)" class="btn btn-danger  btn-sm remove mb-1" data-route="<?php echo e(route('admin.blog.destroy',$item)); ?>" data-toggle="tooltip" title="<?php echo translate('Delete'); ?>"><i class="fas fa-trash"></i></a>
                  
               </td>
          </tr>
       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

          <tr>
              <td class="text-center" colspan="100%"><?php echo translate('No Data Found'); ?></td>
          </tr>

       <?php endif; ?>
      
      </table>
	  </div>
	</div>
  </div>
  <!-- DataTable with Hover -->

</div>
<!--Row-->



<!-- Modal -->
<div class="modal fade" id="del" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
   <form action="" method="post">
      <?php echo csrf_field(); ?>
      <?php echo method_field('DELETE'); ?>
      <div class="modal-content">
        <div class="modal-body">
          <h5 class="mt-3"><?php echo translate('Are you sure to remove?'); ?></h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo translate('Close'); ?></button>
          <button type="submit" class="btn btn-danger"><?php echo translate('Confirm'); ?></button>
        </div>
      </div>
   </form>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
      'use strict';
      $('.remove').on('click',function () { 
        var route = $(this).data('route')
        $('#del').find('form').attr('action',route)
        $('#del').modal('show')
      })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/blog/index.blade.php ENDPATH**/ ?>
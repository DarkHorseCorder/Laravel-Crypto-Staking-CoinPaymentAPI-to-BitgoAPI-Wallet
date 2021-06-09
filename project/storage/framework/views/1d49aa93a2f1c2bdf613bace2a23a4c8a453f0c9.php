


<?php $__env->startSection('title'); ?>
   <?php echo translate('Page Settings'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1><?php echo translate('Page Settings'); ?></h1>
        <a href="<?php echo e(route('admin.page.create')); ?>" class="btn btn-primary"><i class="fas fa-plus"></i> <?php echo translate('Create New'); ?> </a>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row mt-3">
   <div class="col-lg-12">
      <div class="card mb-4">
         <div class="table-responsive p-3">
            <table class="table table-striped">
                <tr>
                    <th><?php echo translate('Title'); ?></th>
                    <th><?php echo translate('URL Slug'); ?></th>
                    <th><?php echo translate('Details'); ?></th>
                    <th><?php echo translate('Language'); ?></th>
                    <th><?php echo translate('Actions'); ?></th>
                </tr>
                <?php $__empty_1 = true; $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>

                         <td data-label="<?php echo translate('Title'); ?>">
                           <?php echo e($info->title); ?>

                         </td>
                         <td data-label="<?php echo translate('URL Slug'); ?>">
                           <?php echo e($info->slug); ?>

                         </td>
                         <td data-label="<?php echo translate('Details'); ?>"><?php echo e(Str::limit(strip_tags($info->details),40)); ?></td>
                         <td data-label="<?php echo translate('Language'); ?>">
                           <?php echo e($info->lang); ?>

                         </td>
                         <td data-label="<?php echo translate('Actions'); ?>">
                            <a href="<?php echo e(route('admin.page.edit',$info)); ?>" class="btn btn-primary btn-sm mb-1"  data-toggle="tooltip" title="<?php echo translate('Edit'); ?>"><i class="fas fa-edit"></i></a>

                            <?php if($info->slug != 'about'): ?>
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm remove mb-1" data-id="<?php echo e($info->id); ?>"  data-toggle="tooltip" title="<?php echo translate('Remove'); ?>"><i class="fas fa-trash"></i></a>
                            <?php endif; ?>
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
</div>

<!-- Modal -->
<div class="modal fade" id="removeMod" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
      <form action="<?php echo e(route('admin.page.remove')); ?>" method="POST">
         <?php echo csrf_field(); ?>
         <input type="hidden" name="id">
         <div class="modal-content">
            <div class="modal-body">
               <h5><?php echo translate('Are you sure to remove?'); ?></h5>
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
         $('#removeMod').find('input[name=id]').val($(this).data('id'))
         $('#removeMod').modal('show')
       })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/page/index.blade.php ENDPATH**/ ?>
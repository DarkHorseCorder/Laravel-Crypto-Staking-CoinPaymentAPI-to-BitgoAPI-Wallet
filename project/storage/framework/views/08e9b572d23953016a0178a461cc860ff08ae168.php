

<?php $__env->startSection('title'); ?>
   <?php echo translate('Blog Categories'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header">
        <h1><?php echo translate('Blog Categories'); ?></h1>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="row">
   <div class="col-lg-12">
      <div class="card mb-4">
         <div class="card-header d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
               <i class="fas fa-plus"></i> <?php echo translate('Add New'); ?>
             </button>

         </div>
         <div class="table-responsive p-3">
            <table class="table table-striped">
               <tr>
                   <th><?php echo translate('Name'); ?></th>
                   <th><?php echo translate('Slug'); ?></th>
                   <th><?php echo translate('Status'); ?></th>
                   <th class="text-right"><?php echo translate('Action'); ?></th>
               </tr>
               <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                   <tr>

                        <td data-label="<?php echo translate('Name'); ?>">
                          <?php echo e($item->name); ?>

                        </td>
                        <td data-label="<?php echo translate('Slug'); ?>">
                          <?php echo e($item->slug); ?>

                        </td>
                      
                        <td data-label="<?php echo translate('Status'); ?>">
                           <?php if($item->status == 1): ?>
                           <span class="badge badge-success"> <?php echo translate('Active'); ?> </span>
                           <?php else: ?>
                           <span class="badge badge-warning"> <?php echo translate('Inactive'); ?> </span>
                           <?php endif; ?>
                        </td>
                        <td data-label="<?php echo translate('Action'); ?>" class="text-right">
                           <a href="javascript:void()" class="btn btn-primary approve btn-sm edit" data-route="<?php echo e(route('admin.bcategory.update',$item->id)); ?>" data-item="<?php echo e($item); ?>" data-toggle="tooltip" title="<?php echo translate('Edit'); ?>"><i class="fas fa-edit"></i></a>
                           
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
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <form action="<?php echo e(route('admin.bcategory.store')); ?>" method="POST">
         <?php echo csrf_field(); ?>
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title"><?php echo translate('Add new category'); ?></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label><?php echo translate('Name'); ?></label>
                  <input class="form-control" type="text" name="name">
               </div>
               <div class="form-group">
                  <label><?php echo translate('Status'); ?></label>
                  <select name="status" class="form-control">
                     <option value="1"><?php echo translate('Active'); ?></option>
                     <option value="0"><?php echo translate('Inactive'); ?></option>
                  </select>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo translate('Close'); ?></button>
               <button type="submit" class="btn btn-primary"><?php echo translate('Submit'); ?></button>
            </div>
         </div>
      </form>
   </div>
</div>

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <form action="" method="POST">
         <?php echo csrf_field(); ?>
         <?php echo method_field('PUT'); ?>
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title"><?php echo translate('Edit category'); ?></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label><?php echo translate('Name'); ?></label>
                  <input class="form-control" type="text" name="name">
               </div>
               <div class="form-group">
                  <label><?php echo translate('Status'); ?></label>
                  <select name="status" class="form-control">
                     <option value="1"><?php echo translate('Active'); ?></option>
                     <option value="0"><?php echo translate('Inactive'); ?></option>
                  </select>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo translate('Close'); ?></button>
               <button type="submit" class="btn btn-primary"><?php echo translate('Submit'); ?></button>
            </div>
         </div>
      </form>
   </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
       'use strict';
       $('.edit').on('click',function () { 
          var data = $(this).data('item')
          $('#edit').find('input[name=name]').val(data.name)
          $('#edit').find('select[name=status]').val(data.status)
          $('#edit').find('form').attr('action',$(this).data('route'))
          $('#edit').modal('show')
       })
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/cblog/index.blade.php ENDPATH**/ ?>
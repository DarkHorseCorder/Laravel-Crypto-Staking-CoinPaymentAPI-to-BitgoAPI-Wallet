

<?php $__env->startSection('title'); ?>
   <?php echo translate('Manage Language'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header justify-content-between">
        <h1><?php echo translate('Manage Language'); ?></h1>
        <button class="btn btn-primary" data-toggle="modal" data-target="#modelId"> <i class="fas fa-plus"></i> <?php echo translate('Add New Language'); ?></button>
    </div>
</section>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<div class="row">
    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 currency--card">
      <div class="card card-primary">
        <div class="card-header d-flex justify-content-between <?php echo e($lang->is_default == 1 ? 'default' : ''); ?>">
          <h4><i class="fas fa-language"></i> <?php echo e($lang->language); ?></h4>
          <?php if($lang->is_default != 1): ?>
          <a href="javascript:void(0)" class="btn btn-danger btn-sm remove" data-id="<?php echo e($lang->id); ?>"><i class="fas fa-trash-alt"></i></a>
          <?php endif; ?>
        </div>
        <div class="card-body">
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between"><?php echo translate('Language Code :'); ?>
              <span class="font-weight-bold"><?php echo e($lang->code); ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between"><?php echo translate('Set as default :'); ?>
               <label class="cswitch d-flex justify-content-between align-items-center">
                  <input class="cswitch--input update" value="<?php echo e($lang->id); ?>" type="checkbox" <?php echo e($lang->is_default == 1 ? 'checked  disabled' : ''); ?> />
                  <span class="cswitch--trigger wrapper"></span>
              </label>
            </li>
          </ul>
        
          <a href="<?php echo e(route('admin.language.edit',$lang->id)); ?>" class="btn btn-primary btn-block"><i class="fas fa-edit"></i> <?php echo translate('Edit Language'); ?></a>  
          
        </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php if($languages->hasPages()): ?>
 <?php echo e($languages->links('admin.partials.paginate')); ?>

<?php endif; ?>

<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <form action="<?php echo e(route('admin.language.store')); ?>" method="POST">
         <?php echo csrf_field(); ?>
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title"><?php echo translate('Add New Language'); ?></h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label><?php echo translate('Language Name'); ?></label>
                  <input class="form-control" type="text" name="name" required>
               </div>
               <div class="form-group">
                  <label><?php echo translate('Language Code'); ?></label>
                  <input class="form-control" type="text" name="code" required>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo translate('Close'); ?></button>
               <button type="submit" class="btn btn-primary"><?php echo translate('Save'); ?></button>
            </div>
         </div>
      </form>
   </div>
</div>

<!-- Modal -->
<div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <form action="<?php echo e(route('admin.remove.language')); ?>" method="POST">
         <?php echo csrf_field(); ?>
         <input type="hidden" name="id">
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
       $('.update').on('change', function () {
            var url = "<?php echo e(route('admin.update-status.language')); ?>"
            var val = $(this).val()
            var data = {
               id:val,
               _token:"<?php echo e(csrf_token()); ?>"
            }
            $(this).attr('disabled',true)
            $.post(url,data,function(response) {
               if(response.error){
                  toast('error',response.error)
                  return false;
               }
               $(document).find('.cswitch input[type=checkbox]').each(function() {
                  if ($(this).is(":checked")) {
                     $(this).attr('checked',false)
                     $(this).attr('disabled',false)
                  }
               });
               toast('success',response.success)
            })
            
         });

         $('.remove').on('click',function () { 
            $('#removeModal').find('input[name=id]').val($(this).data('id'))
            $('#removeModal').modal('show')
         })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/language/index.blade.php ENDPATH**/ ?>
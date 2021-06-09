

<?php $__env->startSection('title'); ?>
   <?php echo app('translator')->get('Identity Verification'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header justify-content-between">
        <h1><?php echo translate('Identity Verification'); ?></h1>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
<div class="row justify-content-center mb-5">
    <div class="col-lg-8">
        <div class="card b-radius--10 ">
            <div class="card-header mb-3">
                <h5><?php echo app('translator')->get('KYC Form Fields'); ?></h5>
            </div>
            <div class="card-body px-5 pb-4">
                <form action="" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label ><?php echo app('translator')->get('Select Input Type'); ?></label>
                        <select class="form-control type" name="type" required>
                            <option value="1"><?php echo app('translator')->get('Input'); ?></option>
                            <option value="2"><?php echo app('translator')->get('Image'); ?></option>
                            <option value="3"><?php echo app('translator')->get('Textarea'); ?></option>
                        </select>
                    </div>
                    <div class="append">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('label'); ?></label>
                            <input class="form-control" type="text" name="label" required>
                        </div>
                       
                    </div>
                   
                    <div class="form-group">
                        <label><?php echo app('translator')->get('Required'); ?></label>
                        <select class="form-control" name="required" required>
                            <option value="1"><?php echo app('translator')->get('Yes'); ?></option>
                            <option value="0"><?php echo app('translator')->get('No'); ?></option>
                        </select>
                    </div>
                    <?php if(access('kyc form add')): ?>
                    <div class="form-group mt-2 text-right">
                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('Add Field'); ?></button>
                    </div>
                    <?php endif; ?>
                </form>
                <hr>
                    <?php $__empty_1 = true; $__currentLoopData = $userForms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php if($field->type == 1 || $field->type == 3 ): ?>
                            <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="font-weight-bold"><?php echo app('translator')->get($field->label); ?> <small class="text--danger" >(<?php echo e($field->required == 1 ? 'Required':'Optional'); ?>)</small> </label>
                                            <?php if($field->type == 1): ?>
                                                <input class="form-control" type="text" placeholder="<?php echo e(strtolower($field->label)); ?>">
                                            <?php else: ?>
                                               <textarea class="form-control"></textarea>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div>
                                       <div class="form-group">
                                            <label for="" class="d-block">&nbsp;</label>
                                            <?php if(access('kyc form update')): ?>
                                            <a href="javascript:void(0)" class="btn btn-primary edit" data-info="<?php echo e($field); ?>"><i class="fas fa-edit"></i></a>
                                            <?php endif; ?>
                                            <?php if(access('kyc form delete')): ?>
                                            <a href="javascript:void(0)" data-id="<?php echo e($field->id); ?>"  class="btn  btn-danger delete"><i class="fas fa-times"></i></a>
                                            <?php endif; ?>
                                       </div>
                                    </div>
                            </div> 

                        <?php elseif($field->type == 2): ?>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <?php if($field->type == 2 ): ?>
                                        <label class="font-weight-bold"><?php echo app('translator')->get($field->label); ?></label>
                                        <input class="form-control" type="file" class="form-control">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div>
                                    <div class="form-group">
                                         <label class="d-block">&nbsp;</label>
                                         <?php if(access('kyc form update')): ?>
                                         <a href="javascript:void(0)" class="btn btn-primary edit" data-info="<?php echo e($field); ?>"><i class="fas fa-edit"></i></a>
                                         <?php endif; ?>
                                         <?php if(access('kyc form delete')): ?>
                                         <a href="javascript:void(0)" data-id="<?php echo e($field->id); ?>" class="btn  btn-danger delete"><i class="fas fa-times"></i></a>
                                             
                                         <?php endif; ?>
                                    </div>
                                 </div>
                            </div> 
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="form-group text-center">
                            <h6 class="my-3"><?php echo app('translator')->get('No fields available'); ?></h6>
                        </div>
                    <?php endif; ?>
                
            </div>
        </div>
    </div>
    
</div>

<?php if(access('kyc form update')): ?>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><h6><?php echo app('translator')->get('Update Field'); ?></h6></div>
            <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <form action="<?php echo e(route('admin.kyc.form.update')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id">
               
                <div class="modal-body">
                    <div class="form-group">
                        <label ><?php echo app('translator')->get('Select Input Type'); ?></label>
                        <select class="form-control type" name="type" required>
                            <option value="1"><?php echo app('translator')->get('Input'); ?></option>
                            <option value="2"><?php echo app('translator')->get('Image'); ?></option>
                            <option value="3"><?php echo app('translator')->get('Textarea'); ?></option>
                        </select>
                    </div>
                    <div class="append">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('label'); ?></label>
                            <input class="form-control" type="text" name="label" required>
                        </div>
                       
                    </div>
                   
                    <div class="form-group">
                        <label><?php echo app('translator')->get('Required'); ?></label>
                        <select class="form-control" name="required" required>
                            <option value="1"><?php echo app('translator')->get('Yes'); ?></option>
                            <option value="0"><?php echo app('translator')->get('No'); ?></option>
                        </select>
                    </div>
        
                </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo app('translator')->get('Cancel'); ?></button>
              <button type="submit"  class="btn btn-primary"><?php echo app('translator')->get('Update'); ?></button>
            </div>
            
        </form>
      </div>
    </div>
</div>
<?php endif; ?>
<?php if(access('kyc form delete')): ?>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
       <button type="button" class="close ml-auto m-3" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
       </button>
            <form action="<?php echo e(route('admin.kyc.form.delete')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id">
                <div class="modal-body text-center">
                    
                    <i class="las la-exclamation-circle text-danger display-2 mb-15"></i>
                    <h4 class="text--secondary mb-15"><?php echo app('translator')->get('Are you sure want to delete this?'); ?></h4>

                </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo app('translator')->get('No'); ?></button>
              <button type="submit"  class="btn btn-danger"><?php echo app('translator')->get('Yes'); ?></button>
            </div>
            
            </form>
      </div>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    
<script>
    'use strict';
(function ($) {


     $('.edit').on('click',function(){
        var modal = $('#editModal');
        var data = $(this).data('info')
        modal.find('input[name=id]').val(data.id)
        modal.find('select[name=type]').val(data.type)
        modal.find('input[name=label]').val(data.label)
        modal.find('select[name=required]').val(data.required)
        modal.modal('show');
    })
     $('.delete').on('click',function(){
        var modal = $('#deleteModal');
        modal.find('input[name=id]').val($(this).data('id'))
        modal.modal('show');
    })
})(jQuery);
</script>

<?php $__env->stopPush(); ?>
<?php $__env->startPush('style'); ?>
    <style>
       .form-control{
           line-height: 1.2 !important
       }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/kyc/user_forms.blade.php ENDPATH**/ ?>
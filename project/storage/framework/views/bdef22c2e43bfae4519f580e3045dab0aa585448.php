

<?php $__env->startSection('title'); ?>
   <?php echo translate('Manage Country'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header d-flex flex-wrap justify-content-between">
        <h1 class="mt-2"><?php echo translate('Manage Country'); ?></h1>
        <form action="">
            <div class="input-group has_append mt-2">
              <input type="text" class="form-control" placeholder="<?php echo translate('Country Name'); ?>" name="search" value="<?php echo e($search ?? ''); ?>"/>
              <div class="input-group-append">
                  <button class="input-group-text bg-primary border-0"><i class="fas fa-search text-white"></i></button>
              </div>
            </div>
          </form>
        <?php if(access('add country')): ?>
        <button class="btn btn-primary mt-2" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> <?php echo translate('Add New'); ?></button>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <?php $__empty_1 = true; $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="col-sm-6 col-lg-6 col-xl-3 currency--card">
      <div class="card card-primary">
        <div class="card-header">
          <h4><?php echo e($country->name); ?></h4>
        </div>
        <div class="card-body">
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between"><?php echo translate('Flag'); ?>
                <img src="<?php echo e($country->flag); ?>" width="50px" height="45px">
                 
            </li>
            <li class="list-group-item d-flex justify-content-between"><?php echo translate('Currency'); ?>
              <span class="font-weight-bold"><?php echo e($country->currency->code); ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between"><?php echo translate('Country Code'); ?>
              <span class="font-weight-bold"><?php echo e($country->code); ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between"><?php echo translate('Dial Code'); ?>
              <span class="font-weight-bold"><?php echo e($country->dial_code); ?></span>
            </li>
            
          </ul>
            <?php if(access('update country')): ?>
            <a href="javascript:void(0)" data-target="#editModal" data-toggle="modal" data-id="<?php echo e($country->id); ?>" data-curr="<?php echo e($country->currency_id); ?>" class="btn btn-primary btn-block edit"><i class="fas fa-edit"></i> <?php echo translate('Edit Country'); ?></a>
                
            <?php endif; ?>
        </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="col-md-12 text-center">
        <h5><?php echo translate('No Country Found'); ?></h5>
    </div>
    <?php endif; ?>
</div>

<!-- Modal -->
<?php if(access('add country')): ?>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo translate('Add new country'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
               <form action="<?php echo e(route('admin.country.store')); ?>" method="POST">
                  <?php echo csrf_field(); ?>
                   <div class="form-group">
                     <label for=""><?php echo translate('Select Country'); ?></label>
                     <select name="unique_key" class="form-control js-example-basic-single">
                         <?php $__currentLoopData = $countryJson; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($key); ?>"><?php echo e($item->name); ?></option>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </select>
                   </div>

                   <div class="form-group">
                        <label for=""><?php echo translate('Select Currency'); ?></label>
                        <select name="currency" class="form-control js-example-basic-single">
                            <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($curr->id); ?>"><?php echo e($curr->code); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                   </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo translate('Close'); ?></button>
                <button type="submit" class="btn btn-primary"><?php echo translate('Save'); ?></button>
            </div>
        </form>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(access('update country')): ?>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo translate('Edit country'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
               <form action="<?php echo e(route('admin.country.update')); ?>" method="POST">
                  <?php echo csrf_field(); ?>
                  <input type="hidden" name="id">
                   <div class="form-group">
                        <label for=""><?php echo translate('Select Currency'); ?></label>
                        <select name="currency" class="form-control editCurr">
                            <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <option value="<?php echo e($curr->id); ?>"><?php echo e($curr->code); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                   </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo translate('Close'); ?></button>
                <button type="submit" class="btn btn-primary"><?php echo translate('Save'); ?></button>
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
        $(document).ready(function() {
           $('.js-example-basic-single').select2({
            dropdownParent: $('#addModal')
           });
        });
        $(document).ready(function() {
           $('.editCurr').select2({
            dropdownParent: $('#editModal')
           });
        });

        $('.edit').on('click',function () { 
            $('#editModal').find('select[name=currency]').val($(this).data('curr'))
            $('#editModal').find('input[name=id]').val($(this).data('id'))
        })

   
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/country/index.blade.php ENDPATH**/ ?>
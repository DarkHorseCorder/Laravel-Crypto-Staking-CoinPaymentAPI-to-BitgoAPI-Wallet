

<?php $__env->startSection('title'); ?>
   <?php echo translate('SMS Template'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header justify-content-between">
        <h1><?php echo translate('Edit SMS Template'); ?></h1>
        <a class="btn btn-primary" href="<?php echo e(route('admin.sms.templates')); ?>"><i class="fas fa-backward"></i> <?php echo translate('Back'); ?></a>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center mt-3">
    <div class="col-lg-10">
       <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
             <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('Edit SMS Template Form')); ?></h6>
          </div>
          <div class="card-body">
           <div class="gocover" style="background: url(<?php echo e(asset('assets/images/'.$gs->dashboard_loader)); ?>) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
           <form id="geniusformUpdate" action="<?php echo e(route('admin.sms.template.update',$data->id)); ?>" method="POST" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
              <?php echo $__env->make('admin.partials.form-both', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
             <div class="row justify-content-center mb-3" >
                <div class="col-md-12">
                   <p><?php echo e(__('Use the BB codes, it show the data dynamically in your sms.')); ?></p>
                   <br>
                   <table class="table table-bordered">
                      <thead>
                         <tr>
                            <th><?php echo e(__('Meaning')); ?></th>
                            <th><?php echo e(__('BB Code')); ?></th>
                         </tr>
                      </thead>
                      <tbody>
                    
                          <?php if($data->codes): ?>
                            <?php $__currentLoopData = $data->codes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $meaning): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(__($meaning)); ?></td>
                                    <td class="font-weight-bold"><?php echo e('{'.$code.'}'); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         <?php endif; ?>
                      </tbody>
                   </table>
                </div>
             </div>
            
                <div class="form-group">
                   <label for="type"><?php echo e(__('Email Type')); ?></label>
                   <input type="text" class="form-control" disabled="" value="<?php echo e($data->email_type); ?>" id="type" placeholder="<?php echo e(__('Email Type')); ?>">
                </div>
                <div class="form-group">
                   <label for="type"><?php echo e(__('Email Subject')); ?></label>
                   <input type="text" class="form-control" name="email_subject" value="<?php echo e($data->email_subject); ?>" id="type" placeholder="<?php echo e(__('Email Subject')); ?>">
                </div>
                <div class="form-group">
                   <label for="description"><?php echo e(__('Email Body')); ?></label>
                   <textarea id="area1" class="form-control" rows="10" name="sms" placeholder="<?php echo e(__('Email Body')); ?>"><?php echo e($data->sms); ?></textarea>
                </div>
                <div class="row">
                   <div class="col-lg-4">
                      <div class="left-area">
                      </div>
                   </div>
                   
                     <div class="col-lg-12 text-right">
                        <button class="btn btn-primary btn-lg" type="submit"><?php echo e(__('Update')); ?></button>
                     </div>
                   
                </div>
             </form>
          </div>
       </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
         $(function() {
            'use strict'
            $('.summernote').summernote();
        })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/sms/edit_template.blade.php ENDPATH**/ ?>
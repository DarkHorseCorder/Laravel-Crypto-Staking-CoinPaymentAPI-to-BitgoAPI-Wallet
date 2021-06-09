

<?php $__env->startSection('title'); ?>
   <?php echo translate('Email Configuration'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header">
        <h1><?php echo translate('Email Configuration'); ?></h1>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center mt-3">
    <div class="col-lg-12">
       <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
             <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('Email Configuration Form')); ?></h6>
          </div>
          <div class="card-body">
             <div class="gocover" style="background: url(<?php echo e(asset('assets/images/'.$gs->dashboard_loader)); ?>) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
             <form id="geniusformUpdate" action="<?php echo e(route('admin.gs.update')); ?>" enctype="multipart/form-data" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo $__env->make('admin.partials.form-both', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                   <input type="hidden" name="check_smtp" value="1">
                   <div class="form-group row mb-3">
                       <label class="col-sm-3 col-form-label" for="mail_type"><?php echo e(__('Mail System')); ?></label>
                       <div class="col-sm-9">
                       <select class="form-control" id="mail_type" name="mail_type">
                           <option value="php_mail" <?php echo e($gs->mail_type == 'php_mail' ? 'selected' : ''); ?>><?php echo e(translate('PHP Mail')); ?></option>
                           <option value="php_mailer" <?php echo e($gs->mail_type == 'php_mailer' ? 'selected' : ''); ?>><?php echo e(translate('SMTP Mail')); ?></option>
                       </select>
                     </div>        
                   </div>        
               
                   <div class="smtp__check <?php echo e($gs->mail_type != 'php_mail' ? '' : 'd-none'); ?>">
                      <div class="form-group row mb-3">
                         <label for="smtp_host" class="col-sm-3 col-form-label"><?php echo e(__('SMTP Host')); ?></label>
                         <div class="col-sm-9">
                            <input type="text" class="form-control" id="smtp_host" name="smtp_host" placeholder="<?php echo e(__('SMTP Host')); ?>" value="<?php echo e($gs->smtp_host); ?>">
                         </div>
                      </div>
                      <div class="form-group row mb-3">
                         <label for="smtp_port" class="col-sm-3 col-form-label"><?php echo e(__('SMTP Port')); ?></label>
                         <div class="col-sm-9">
                            <input type="text" class="form-control" id="smtp_port" name="smtp_port" placeholder="<?php echo e(__('SMTP Port')); ?>" value="<?php echo e($gs->smtp_port); ?>">
                         </div>
                      </div>
                      <div class="form-group row mb-3">
                         <label for="smtp_user" class="col-sm-3 col-form-label"><?php echo e(__('SMTP Username')); ?></label>
                         <div class="col-sm-9">
                            <input type="text" class="form-control" id="smtp_user" name="smtp_user" placeholder="<?php echo e(__('SMTP Username')); ?>" value="<?php echo e($gs->smtp_user); ?>">
                         </div>
                      </div>
                      <div class="form-group row mb-3">
                         <label for="smtp_pass" class="col-sm-3 col-form-label"><?php echo e(__('SMTP Password')); ?></label>
                         <div class="col-sm-9">
                            <input type="text" class="form-control" id="smtp_pass" name="smtp_pass" placeholder="<?php echo e(__('SMTP Password')); ?>" value="<?php echo e($gs->smtp_pass); ?>">
                         </div>
                      </div>
                      <div class="form-group row mb-3">
                         <label class="col-sm-3 col-form-label" for="mail_encryption"><?php echo e(__('Mail Encryption')); ?></label>
                         <div class="col-sm-9">
                         <select class="form-control" id="mail_encryption" name="mail_encryption">
                             <option value="tls" <?php echo e($gs->mail_encryption == 'tls' ? 'selected' : ''); ?>><?php echo e(translate('TLS')); ?></option>
                             <option value="ssl" <?php echo e($gs->mail_encryption == 'ssl' ? 'selected' : ''); ?>><?php echo e(translate('SSL')); ?></option>
                         </select>
                       </div>        
                     </div>
                   </div>
 
                <div class="form-group row mb-3">
                   <label for="from_email" class="col-sm-3 col-form-label"><?php echo e(__('From Email')); ?></label>
                   <div class="col-sm-9">
                      <input type="text" class="form-control" id="from_email" name="from_email" placeholder="<?php echo e(__('From Email')); ?>" value="<?php echo e($gs->from_email); ?>">
                   </div>
                </div>
                <div class="form-group row mb-3">
                   <label for="from_name" class="col-sm-3 col-form-label"><?php echo e(__('From Name')); ?></label>
                   <div class="col-sm-9">
                      <input type="text" class="form-control" id="from_name" name="from_name" placeholder="<?php echo e(__('From Name')); ?>" value="<?php echo e($gs->from_name); ?>">
                   </div>
                </div>
                <div class="form-group row">
                   <div class="col-sm-12 text-right">
                      <button type="submit" class="btn btn-primary btn-lg"><?php echo e(translate('Save')); ?></button>
                   </div>
                </div>
             </form>
          </div>
       </div>
    </div>
 </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/email/config.blade.php ENDPATH**/ ?>
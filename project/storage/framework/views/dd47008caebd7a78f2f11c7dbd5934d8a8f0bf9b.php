
<?php $__env->startSection('title'); ?>
    <?php echo translate('General Settings'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
        <div class="section-header">
        <h1><?php echo translate('Site Settings'); ?></h1>
        </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
   <?php echo translate('General Settings'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
               <h6><?php echo translate('Basic Settings'); ?></h6>
            </div>
            <div class="card-body">
              
                <form id="geniusformUpdate" action="<?php echo e(route('admin.gs.update')); ?>" enctype="multipart/form-data" method="POST">
                   <?php echo csrf_field(); ?>
                   <input type="hidden" value="1" name="setting">
                   <?php echo $__env->make('admin.partials.form-both', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                      
                    <div class="form-group row mb-3">
                        <label for="title" class="col-sm-3 col-form-label"><?php echo e(__('Website Title')); ?></label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="title" name="title" placeholder="<?php echo e(__('Website Title')); ?>" value="<?php echo e($gs->title); ?>">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="title" class="col-sm-3 col-form-label"><?php echo e(__('Contact No')); ?></label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="title" name="contact_no" placeholder="<?php echo e(__('Contact No')); ?>" value="<?php echo e($gs->contact_no); ?>">
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <label for="theme_color" class="col-sm-3 col-form-label"><?php echo e(__('Theme Color')); ?></label>
                        <div class="col-sm-9 input-group cp">
                            <input type="text" class="form-control colorpicker-element" value="<?php echo e("#".$gs->theme_color); ?>" id="theme_color" name="theme_color" placeholder="<?php echo e(__('Theme Color')); ?>" >
                            <span class="input-group-append">
                                <span class="input-group-text colorpicker-input-addon"><i></i></span>
                              </span>
                        </div>
                    </div>

                    <div class="form-group row mt-5">
                        <label for="secendary_color" class="col-sm-3 col-form-label"><?php echo e(__('Site Maintainance Mode')); ?></label>
                        <div class="col-sm-9">
                            <div class="btn-group mb-1">
                                <button type="button" class="btn dropdown-toggle <?php echo e($gs->is_maintenance == 1 ? 'btn-success' : 'btn-danger'); ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   <?php echo e($gs->is_maintenance == 1 ? __('Activated') : __('Deactivated')); ?>

                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <a class="dropdown-item gs-status-check cursor-pointer" data-href="<?php echo e(route('admin.gs.status','1,is_maintenance')); ?>"><?php echo e(__('Activated')); ?></a>
                                    <a class="dropdown-item gs-status-check cursor-pointer" data-href="<?php echo e(route('admin.gs.status','0,is_maintenance')); ?>"><?php echo e(__('Deactivated')); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mt-5">
                        <label for="secendary_color" class="col-sm-3 col-form-label"><?php echo e(__('Tawk.to')); ?></label>
                        <div class="col-sm-9">
                            <div class="btn-group mb-1">
                                <button type="button" class="btn dropdown-toggle <?php echo e($gs->is_tawk == 1 ? 'btn-success' : 'btn-danger'); ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   <?php echo e($gs->is_tawk == 1 ? __('Activated') : __('Deactivated')); ?>

                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <a class="dropdown-item gs-status-check cursor-pointer" data-href="<?php echo e(route('admin.gs.status','1,is_tawk')); ?>"><?php echo e(__('Activated')); ?></a>
                                    <a class="dropdown-item gs-status-check cursor-pointer" data-href="<?php echo e(route('admin.gs.status','0,is_tawk')); ?>"><?php echo e(__('Deactivated')); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    
                  <div class="form-group row mb-5">
                    <label for="tawk_id" class="col-sm-3 col-form-label"><?php echo e(__('Tawk.to ID')); ?></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tawk_id" name="tawk_id" value="<?php echo e($gs->tawk_id); ?>" placeholder="<?php echo e(__('Tawk.to ID')); ?>">
                    </div>
                  </div>

                  <div class="form-group row mt-5">
                    <label for="secendary_color" class="col-sm-3 col-form-label"><?php echo e(__('Google Recaptcha')); ?></label>
                    <div class="col-sm-9">
                        <div class="btn-group mb-1">
                            <button type="button" class="btn dropdown-toggle <?php echo e($gs->recaptcha == 1 ? 'btn-success' : 'btn-danger'); ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               <?php echo e($gs->recaptcha == 1 ? __('Activated') : __('Deactivated')); ?>

                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <a class="dropdown-item gs-status-check cursor-pointer" data-href="<?php echo e(route('admin.gs.status','1,recaptcha')); ?>"><?php echo e(__('Activated')); ?></a>
                                <a class="dropdown-item gs-status-check cursor-pointer" data-href="<?php echo e(route('admin.gs.status','0,recaptcha')); ?>"><?php echo e(__('Deactivated')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>

                  <div class="form-group row mb-5">
                    <label for="tawk_id" class="col-sm-3 col-form-label"><?php echo e(__('Google Recaptcha Site Key')); ?></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tawk_id" name="recaptcha_key" value="<?php echo e($gs->recaptcha_key); ?>" placeholder="<?php echo e(__('Google Recaptcha Key')); ?>">
                    </div>
                  </div>
                  <div class="form-group row mb-5">
                    <label for="tawk_id" class="col-sm-3 col-form-label"><?php echo e(__('Google Recaptcha Secret Key')); ?></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tawk_id" name="recaptcha_secret" value="<?php echo e($gs->recaptcha_secret); ?>" placeholder="<?php echo e(__('Google Recaptcha Secret')); ?>">
                    </div>
                  </div>
                  <div class="form-group row mb-5">
                    <label for="tawk_id" class="col-sm-3 col-form-label"><?php echo e(__('Allowed Registration Email Domains')); ?></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control tagify__input"  id="tag" name="allowed_email" value="<?php echo e($gs->allowed_email); ?>">
                         <code><?php echo translate('Keep this field blank if you want any email domain to be allowed.'); ?></code>
                    </div>
                  </div>

                  <div class="form-group row ">
                    <label for="secendary_color" class="col-sm-3 col-form-label"><?php echo e(__('Register Email Verification')); ?></label>
                    <div class="col-sm-9">
                        <div class="btn-group mb-1">
                            <button type="button" class="btn dropdown-toggle <?php echo e($gs->is_verify == 1 ? 'btn-success' : 'btn-danger'); ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               <?php echo e($gs->is_verify == 1 ? __('Activated') : __('Deactivated')); ?>

                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <a class="dropdown-item gs-status-check cursor-pointer" data-href="<?php echo e(route('admin.gs.status','1,is_verify')); ?>"><?php echo e(__('Activated')); ?></a>
                                <a class="dropdown-item gs-status-check cursor-pointer" data-href="<?php echo e(route('admin.gs.status','0,is_verify')); ?>"><?php echo e(__('Deactivated')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>       
                  <div class="form-group row ">
                    <label for="secendary_color" class="col-sm-3 col-form-label"><?php echo e(__('User Registration')); ?></label>
                    <div class="col-sm-9">
                        <div class="btn-group mb-1">
                            <button type="button" class="btn dropdown-toggle <?php echo e($gs->registration == 1 ? 'btn-success' : 'btn-danger'); ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               <?php echo e($gs->registration == 1 ? __('Activated') : __('Deactivated')); ?>

                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <a class="dropdown-item gs-status-check cursor-pointer" data-href="<?php echo e(route('admin.gs.status','1,registration')); ?>"><?php echo e(__('Activated')); ?></a>
                                <a class="dropdown-item gs-status-check cursor-pointer" data-href="<?php echo e(route('admin.gs.status','0,registration')); ?>"><?php echo e(__('Deactivated')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>       
                <div class="form-group row ">
                    <label for="secendary_color" class="col-sm-3 col-form-label"><?php echo e(__('Know Your Customer(KYC)')); ?></label>
                    <div class="col-sm-9">
                        <div class="btn-group mb-1">
                            <button type="button" class="btn dropdown-toggle <?php echo e($gs->kyc == 1 ? 'btn-success' : 'btn-danger'); ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               <?php echo e($gs->kyc == 1 ? __('Activated') : __('Deactivated')); ?>

                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <a class="dropdown-item gs-status-check cursor-pointer" data-href="<?php echo e(route('admin.gs.status','1,kyc')); ?>"><?php echo e(__('Activated')); ?></a>
                                <a class="dropdown-item gs-status-check cursor-pointer" data-href="<?php echo e(route('admin.gs.status','0,kyc')); ?>"><?php echo e(__('Deactivated')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tawk_id" class="col-sm-3 col-form-label"><?php echo e(__('KYC Offer Limit')); ?> <i class="fas fa-info-circle" data-toggle="tooltip" title="<?php echo translate('User can create offer you put the number here, if they are not KYC verified. Put 0 for no limit.'); ?>"></i></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="" name="kyc_offer_limit" value="<?php echo e($gs->kyc_offer_limit); ?>" placeholder="<?php echo e(__('KYC Offer Limit')); ?>">
                    </div>
                  </div>       
                <div class="form-group row">
                    <label for="tawk_id" class="col-sm-3 col-form-label"><?php echo e(__('KYC Trade Limit')); ?> <i class="fas fa-info-circle" data-toggle="tooltip" title="<?php echo translate('User can trade you put the number here, if they are not KYC verified. Put 0 for no limit.'); ?>"></i></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="" name="kyc_trade_limit" value="<?php echo e($gs->kyc_trade_limit); ?>" placeholder="<?php echo e(__('KYC Trade Limit')); ?>">
                    </div>
                  </div>       
                  <div class="form-group row ">
                    <label for="secendary_color" class="col-sm-3 col-form-label"><?php echo e(__('Email Notification')); ?></label>
                    <div class="col-sm-9">
                        <div class="btn-group mb-1">
                            <button type="button" class="btn dropdown-toggle <?php echo e($gs->email_notify == 1 ? 'btn-success' : 'btn-danger'); ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               <?php echo e($gs->email_notify == 1 ? __('Activated') : __('Deactivated')); ?>

                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <a class="dropdown-item gs-status-check cursor-pointer" data-href="<?php echo e(route('admin.gs.status','1,email_notify')); ?>"><?php echo e(__('Activated')); ?></a>
                                <a class="dropdown-item gs-status-check cursor-pointer" data-href="<?php echo e(route('admin.gs.status','0,email_notify')); ?>"><?php echo e(__('Deactivated')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>       
                <div class="form-group row ">
                    <label for="secendary_color" class="col-sm-3 col-form-label"><?php echo e(__('SMS Notification')); ?></label>
                    <div class="col-sm-9">
                        <div class="btn-group mb-1">
                            <button type="button" class="btn dropdown-toggle <?php echo e($gs->sms_notify == 1 ? 'btn-success' : 'btn-danger'); ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               <?php echo e($gs->sms_notify == 1 ? __('Activated') : __('Deactivated')); ?>

                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <a class="dropdown-item gs-status-check cursor-pointer" data-href="<?php echo e(route('admin.gs.status','1,sms_notify')); ?>"><?php echo e(__('Activated')); ?></a>
                                <a class="dropdown-item gs-status-check cursor-pointer" data-href="<?php echo e(route('admin.gs.status','0,sms_notify')); ?>"><?php echo e(__('Deactivated')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>       
                <div class="form-group row ">
                    <label for="secendary_color" class="col-sm-3 col-form-label"><?php echo e(__('Two Step Authentication')); ?></label>
                    <div class="col-sm-9">
                        <div class="btn-group mb-1">
                            <button type="button" class="btn dropdown-toggle <?php echo e($gs->two_fa == 1 ? 'btn-success' : 'btn-danger'); ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               <?php echo e($gs->two_fa == 1 ? __('Activated') : __('Deactivated')); ?>

                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <a class="dropdown-item gs-status-check cursor-pointer" data-href="<?php echo e(route('admin.gs.status','1,two_fa')); ?>"><?php echo e(__('Activated')); ?></a>
                                <a class="dropdown-item gs-status-check cursor-pointer" data-href="<?php echo e(route('admin.gs.status','0,two_fa')); ?>"><?php echo e(__('Deactivated')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>       
      
                   <div class="form-group row">
                      <div class="col-12 text-right">
                         <button type="submit" class="btn btn-primary"><?php echo e(translate('Update Settings')); ?></button>
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
        'use strict';
        $('input[name=allowed_email]').tagify();
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/generalsetting/settings.blade.php ENDPATH**/ ?>


<?php $__env->startSection('title'); ?>
   <?php echo translate('User Account Information'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header justify-content-between">
        <h1><?php echo translate('User Information'); ?></h1>
        <a href="<?php echo e(route('admin.user.index')); ?>" class="btn btn-primary"><i class="fas fa-backward"></i> <?php echo translate('Back'); ?></a>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-center">
        <div class="col-xxl-8 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h6><?php echo app('translator')->get('User Wallets'); ?></h6>
                    <hr>
                    <div class="row justify-content-center">
                        <?php $__empty_1 = true; $__currentLoopData = $user->wallets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-xxl-6 col-lg-12 col-md-6">
                            <a href="javascript:void(0)" class="wallet"  data-code="<?php echo e($item->curr->code); ?>" data-id="<?php echo e($item->id); ?>" data-toggle="tooltip" title="<?php echo app('translator')->get('Click to Add or Subtract Balance'); ?>">
                                <div class="card card-statistic-1 bg-sec">
                                    <div class="card-icon bg-primary text-white">
                                        <?php echo e($item->curr->code); ?>

                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header ">
                                            <h4 class="text-dark"><?php echo app('translator')->get($item->curr->curr_name); ?></h4>
                                        </div>
                                        <div class="card-body">
                                            <?php echo e(numFormat($item->balance,8)); ?> <?php echo e($item->curr->code); ?>

                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p><?php echo app('translator')->get('No wallet found'); ?></p>
                      <?php endif; ?>
                    </div>
                    <h6 class="mt-3"><?php echo translate('User Account Information'); ?></h6>
                    <hr>
                    <form action="<?php echo e(route('admin.user.profile.update',$user->id)); ?>" method="POST" class="row">
                        <?php echo csrf_field(); ?>
                        <div class="form-group col-md-6">
                            <label><?php echo translate('User Name'); ?></label>
                            <input class="form-control" type="text" name="name" value="<?php echo e($user->name); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label><?php echo translate('Email Address'); ?></label>
                            <input class="form-control" type="email" name="email" value="<?php echo e($user->email); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label><?php echo translate('Phone Number'); ?></label>
                            <input class="form-control" type="text" name="phone" value="<?php echo e($user->phone); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label><?php echo translate('Country'); ?></label>
                            <Select class="form-control js-example-basic-single" name="country" required>
                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->name); ?>" <?php echo e($user->country == $item->name ? 'selected':''); ?>><?php echo e($item->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </Select>
                        </div>
                        <div class="form-group col-md-6">
                            <label><?php echo translate('HOME ADDRESS'); ?></label>
                            <input class="form-control" type="text" name="city" value="<?php echo e($user->city); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label><?php echo translate('Zip Code'); ?></label>
                            <input class="form-control" type="text" name="zip" value="<?php echo e($user->zip); ?>">
                        </div>
                        <div class="form-group col-md-12">
                            <label><?php echo translate('LEGAL FIRST AND LAST NAME'); ?></label>
                            <input class="form-control" type="text" name="address" value="<?php echo e($user->address); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="cswitch d-flex justify-content-between align-items-center border p-2">
                                <input class="cswitch--input" name="status" type="checkbox" <?php echo e($user->status == 1 ? 'checked':''); ?> /><span class="cswitch--trigger wrapper"></span>
                                <span class="cswitch--label font-weight-bold"><?php echo translate('User status'); ?></span>
                            </label>
                        </div>
                        <div class="form-group col-md-6 ">
                            <label class="cswitch d-flex justify-content-between align-items-center border p-2">
                                <input class="cswitch--input update" name="email_verified" type="checkbox" <?php echo e($user->email_verified == 1 ? 'checked':''); ?> /><span class="cswitch--trigger wrapper"></span>
                                <span class="cswitch--label font-weight-bold"><?php echo translate('Email Verified'); ?></span>
                            </label>
                        </div>
                        
                        <?php if(access('update user')): ?>
                        <div class="form-group col-md-12 text-right">
                           <button type="submit" class="btn btn-primary btn-lg"><?php echo translate('Submit'); ?></button>
                        </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-lg-6 col-md-8">
            <div class="card">
                <div class="card-body">
                        <label class="font-weight-bold"><?php echo translate('Profile Picture'); ?></label>
                        <div id="image-preview" class="image-preview u_details w-100"
                        style="background-image:url(<?php echo e(getPhoto($user->photo)); ?>);">
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item active"><h5><?php echo translate('Additional Information'); ?></h5></li>

                        <li class="list-group-item d-flex justify-content-between"><?php echo translate('Deposit History'); ?> <a target="_blank" href="<?php echo e(route('admin.user.deposit.history',$user->id)); ?>" class="btn btn-dark btn-sm"><?php echo translate('View'); ?></a></li>

                        <li class="list-group-item d-flex justify-content-between"><?php echo translate('Withdraw History'); ?> <a target="_blank" href="<?php echo e(route('admin.user.withdraw.history',$user->id)); ?>" class="btn btn-dark btn-sm"><?php echo translate('View'); ?></a></li>

                        <li class="list-group-item d-flex justify-content-between"><?php echo translate('User Login History'); ?> <span><a href="<?php echo e(route('admin.user.login.info',$user->id)); ?>" class="btn btn-dark btn-sm"><?php echo translate('View'); ?></a></span></li>

                        <?php if(access('user login')): ?>
                        <li class="list-group-item d-flex justify-content-between"><?php echo translate('Login to User Account'); ?> <span><a target="_blank" href="<?php echo e(route('admin.user.login',$user->id)); ?>" class="btn btn-dark btn-sm"><?php echo translate('Login'); ?></a></span></li>
                       <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <?php if(access('user balance modify')): ?>
    <div class="modal fade" id="balanceModal" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?php echo e(route('admin.user.balance.modify')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="wallet_id">
                <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo translate('Add Credit/Subract Balance -- '); ?> <span class="code"></span></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                       <div class="form-group">
                           <label><?php echo translate('Amount'); ?></label>
                           <input class="form-control" type="text" name="amount" required>
                       </div>
                       <div class="form-group">
                           <label><?php echo translate('Type'); ?></label>
                          <select name="type" id="" class="form-control">
                              <option value="1"><?php echo translate('Add Credit'); ?></option>
                              <option value="2"><?php echo translate('Subtract Balance'); ?></option>
                          </select>
                       </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo translate('Close'); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo translate('Confirm'); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        $.uploadPreview({
            input_field: "#image-upload", // Default: .image-upload
            preview_box: "#image-preview", // Default: .image-preview
            label_field: "#image-label", // Default: .image-label
            label_default: "<?php echo translate('Choose File'); ?>", // Default: Choose File
            label_selected: "<?php echo translate('Update Image'); ?>", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });

        $('.wallet').on('click',function () { 
            $('#balanceModal').find('input[name=wallet_id]').val($(this).data('id'))
            $('#balanceModal').find('.code').text($(this).data('code'))
            $('#balanceModal').modal('show')
        })

        $(document).ready(function() {
           $('.js-example-basic-single').select2();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .bg-sec{
            background-color: #cdd3d83c
        }
        .u_details{
            height: 370px!important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/user/details.blade.php ENDPATH**/ ?>
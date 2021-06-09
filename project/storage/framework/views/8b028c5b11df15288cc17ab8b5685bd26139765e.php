<?php $__env->startSection('title'); ?>
   <?php echo translate('User Register'); ?>
<?php $__env->stopSection(); ?>

<?php
$register = \App\Models\SiteContent::where('id',19)->first();
?>

<?php $__env->startSection('content'); ?>
<section class="accounts-section">
    <div class="accounts-inner">
        <div class="accounts-inner__wrapper bg--section">
            <div class="accounts-left">
                <div class="accounts-left-content mw-100">
                    <a href="<?php echo e(url('/')); ?>" class="top--icon">
                        <i class="fas fa-bolt"></i>
                    </a>
                    <div class="section-header">
                        <h6 class="section-header__subtitle"></h6>
                        <h3 class="section-header__title"><?php echo app('translator')->get(@$register->content->first_heading); ?></h3>
                        <p>
                            <?php echo app('translator')->get(@$register->content->first_sub_heading); ?>
                        </p>
                    </div>
                    <form class="row g-4" action="" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="col-sm-6 form-group">
                            <label class="form--label"><?php echo translate('Create User Name'); ?></label>
                            <input type="text" class="form-control" name="name" placeholder="<?php echo translate('Do Not Copy Others'); ?>" required value="<?php echo e(old('name')); ?>">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="form--label"><?php echo translate('Email Address'); ?></label>
                            <input type="email" class="form-control" name="email" placeholder="<?php echo translate('Enter email'); ?>" required value="<?php echo e(old('email')); ?>">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="form--label"><?php echo translate('Country'); ?></label>
                            <select name="country" class="form-control country" required>
                                <option value=""><?php echo translate('Select'); ?></option>
                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->name); ?>" data-dial_code="<?php echo e($item->dial_code); ?>" <?php echo e(@$info->geoplugin_countryCode == $item->code ? 'selected':''); ?>><?php echo e($item->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
    
                        <div class="col-sm-6 form-group">
                             <label class="form--label"><?php echo translate('Mobile Phone Number'); ?></label>
                            <input type="hidden" name="dial_code">
                            <div class="input-group">
                                <span class="input-group-text d_code"></span>
                                <input type="text" name="phone"  class="form-control" placeholder="<?php echo translate('Phone Number'); ?>" required value="<?php echo e(old('phone')); ?>">
                            </div>
                        </div>
    
                        <div class="col-sm-12 form-group">
                            <label class="form--label"><?php echo translate('Legal First and Last Name'); ?></label>
                            <input type="text" name="address" value="<?php echo e(old('address')); ?>" class="form-control" placeholder="<?php echo translate('Enter Your Name as it appears on your ID'); ?>" required>
                        </div>
                           <div class="col-sm-6 form-group">
                            <label class="form--label"><?php echo translate('Password'); ?></label>
                            <div class="input-group input-group-flat">
                                <input type="password" name="password" class="form-control"  placeholder="<?php echo translate('Do Not Use 1234'); ?>"  autocomplete="off" required>
                            </div>
                          </div>
                        <div class="col-sm-6 form-group">
                            <label class="form--label"><?php echo translate('Confirm Password'); ?></label>
                            <div class="input-group input-group-flat">
                                <input type="password" name="password_confirmation" class="form-control"  placeholder="<?php echo translate('Confirm Password'); ?>"  autocomplete="off">
                            </div>
                        </div>
                        <?php if($gs->recaptcha): ?>
                            <div class="col-sm-12 form-group">
                                <?php echo NoCaptcha::display(); ?>

                                <?php echo NoCaptcha::renderJs(); ?>

                                <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="my-2 text--danger"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        <?php endif; ?>
                        <div class="col-xl-12 form-group">
                            <div class="d-flex flex-wrap justify-content-between">
    
                                <div>
                                    <a class="text--base" href="<?php echo e(route('user.login')); ?>"><?php echo translate('Already have an Account ?'); ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 form-group">
                            <button type="submit" class="btn btn--base"><?php echo translate('Create Account'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="accounts-right bg--blue">
                <img src="<?php echo e(getPhoto(@$register->content->image)); ?>" alt="images">
                <div class="section-header text-center text-white mb-0">
                    <h6 class="section-header__subtitle"></h6>
                    <h3 class="section-header__title"><?php echo app('translator')->get(@$register->content->second_heading); ?></h3>
                    <p>
                        <?php echo app('translator')->get(@$register->content->second_sub_heading); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    
    <script>
      'use strict';
     function auto() {
        var code = $('.country option:selected').data('dial_code')
        $('.d_code').text(code)
        $('input[name=dial_code]').val(code)
      }
      auto();
      $('.country').on('change',function () {
        auto();
      })

    
      

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/user/auth/register.blade.php ENDPATH**/ ?>
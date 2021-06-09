<?php $__env->startSection('title'); ?>
   <?php echo translate('Verify Email'); ?>
<?php $__env->stopSection(); ?>

<?php
$login = App\Models\SiteContent::where('slug','login')->first();
?>

<?php $__env->startSection('content'); ?>

<section class="accounts-section">
    <div class="accounts-inner">
        <div class="accounts-inner__wrapper bg--section">
            <div class="accounts-left">
                <div class="accounts-left-content">
                    <a href="<?php echo e(url('/')); ?>" class="top--icon">
                        <i class="fas fa-bolt"></i>
                    </a>
                    <div class="section-header">
                        <h6 class="section-header__subtitle"></h6>
                        <h3 class="section-header__title"><?php echo translate('Email Verify Code'); ?></h3>
                        <p>
                            <?php echo translate('Enter the verification code'); ?>
                        </p>
                    </div>
                    <form class="row gy-4" action="" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="col-sm-12 form-group">
                            <label class="form--label" for="email"><?php echo translate('Verify Code'); ?> <a class="ms-3" href="<?php echo e(route('user.verify.email.resend')); ?>"><?php echo translate('Resend Code'); ?></a></label>
                            <input type="text" name="code" class="form-control"  placeholder="<?php echo translate('Reset Code'); ?>" value="<?php echo e(old('code')); ?>" required>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="cmn--btn"><?php echo translate('Verify Code'); ?></button>
                        </div>
                      
                    </form>
                </div>
            </div>
            <div class="accounts-right bg--blue">
                <img src="<?php echo e(getPhoto($login->content->image)); ?>" alt="images">
                <div class="section-header text-center text-white mb-0">
                    <h6 class="section-header__subtitle"></h6>
                    <h3 class="section-header__title"><?php echo translate('Email Verification ?'); ?></h3>
                    <p>
                        <?php echo translate('Email Verification is required.'); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/user/email_verify/verify_code.blade.php ENDPATH**/ ?>
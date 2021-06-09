<?php $__env->startSection('title'); ?>
   <?php echo translate('User Login'); ?>
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
                        <h3 class="section-header__title"><?php echo app('translator')->get(@$login->content->first_heading); ?></h3>
                        <p>
                            <?php echo app('translator')->get(@$login->content->first_sub_heading); ?>
                        </p>
                    </div>
                    <form class="row gy-4" action="<?php echo e(route('user.login')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="col-sm-12">
                            <label for="username" class="form-label"><?php echo translate('Your email'); ?></label>
                            <input type="email" name="email" id="username" class="form-control" required value="<?php echo e(old('email')); ?>">
                        </div>
                        <div class="col-sm-12">
                            <label for="password" class="form-label"><?php echo translate('Your Password'); ?></label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                       
                         <?php if($gs->recaptcha): ?>
                            <div class="col-sm-12">
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
                        
                        <div class="col-12 mt-2">
                          <a href="<?php echo e(route('user.forgot.password')); ?>" class="text--base"><?php echo translate('Forgot Password?'); ?></a>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="cmn--btn"><?php echo translate('Sign In'); ?></button>
                        </div>
                        <div class="col-sm-12">
                            <?php echo translate('Not registered yet ?'); ?> <a href="<?php echo e(route('user.register')); ?>" class="text--base"><?php echo translate('Create an Account For Free'); ?></a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="accounts-right bg--blue">
                <img src="<?php echo e(getPhoto($login->content->image)); ?>" alt="images">
                <div class="section-header text-center text-white mb-0">
                    <h6 class="section-header__subtitle"></h6>
                    <h3 class="section-header__title"><?php echo app('translator')->get(@$login->content->second_heading); ?></h3>
                    <p>
                        <?php echo app('translator')->get(@$login->content->second_sub_heading); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/user/auth/login.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title'); ?>
    <?php echo translate('Admin login'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
    <div class="card card-primary logincard">
      <div class="card-header d-flex justify-content-between">
          <h4><?php echo translate('Admin Login'); ?></h4>
          <a href="<?php echo e(url('/')); ?>"><?php echo translate('Home'); ?></a>
        </div>

      <div class="card-body">
          <?php if(session()->has('error')): ?>
            <div class="my-2 text-center creds  p-2">
              <span class="text-danger  mt-2"><?php echo e(session('error')); ?></span>
            </div>
         <?php endif; ?>
        <form method="POST" action="" class="needs-validation">
            <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="email"><?php echo translate('Email'); ?></label>
                    <input id="email" type="email" class="form-control  <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" tabindex="1" required value="<?php echo e(old('email')); ?>">
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                     <span class="text-danger mt-2"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="password" class="control-label"><?php echo translate('Password'); ?></label>
                    <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> " name="password" tabindex="2">
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger mt-2"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group text-right">
                <a href="<?php echo e(route('admin.forgot.password')); ?>" class="float-left mt-3">
                    <?php echo translate('Forgot Password'); ?>?
                </a>
                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                    <?php echo translate('Login'); ?>
                </button>
                </div>
            </form>
      </div>
    </div>

  </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .logincard{
            margin-top: 250px !important;
            border-radius: 3px
        }
        .creds{
            background-color: #fc544b19;
            border-radius: 3px
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin_auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/auth/login.blade.php ENDPATH**/ ?>
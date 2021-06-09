<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php echo $__env->make('other.seo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <title><?php echo e(__($gs->title)); ?>-<?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend')); ?>/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend')); ?>/css/animate.css" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend')); ?>/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/summernote.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend')); ?>/css/lightbox.min.css" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend')); ?>/css/odometer.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend')); ?>/css/owl.min.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend')); ?>/css/main.css">
    <link rel="stylesheet" href="<?php echo e(asset('assets/user')); ?>/css/custom.css">
    <link href="<?php echo e(asset('assets/frontend/css/main.php')); ?>?color=<?php echo e($gs->theme_color); ?>" rel="stylesheet" />
    <link rel="shortcut icon" href="<?php echo e(getPhoto($gs->favicon)); ?>">
    <?php echo $__env->yieldPushContent('style'); ?>
</head>
<body>
     <!-- Overlayer -->
  <span class="toTopBtn">
    <i class="fas fa-angle-up"></i>
  </span>
  <div class="overlayer"></div>
  <div class="loader"></div>
  <!-- Overlayer -->
    <main class="dashboard-section">
       <?php echo $__env->make('user.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
       <article class="main--content">
          <?php echo $__env->make('user.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <div class="dashborad--content">
            <div class="breadcrumb-area pt-0">
              <h5 class="title mt-3"><?php echo $__env->yieldContent('title'); ?></h5>
              <ul class="breadcrumb">
                  <li>
                      <a href="<?php echo e(route('user.dashboard')); ?>"><?php echo translate('User Dashboard'); ?></a>
                  </li>
                  <li>
                    <?php echo $__env->yieldContent('title'); ?>
                  </li>
              </ul>

            </div>
            <div class="row">
              <?php if($gs->kyc): ?>
                <?php echo $__env->make('user.partials.kyc_info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              <?php endif; ?>
            </div>
            <?php echo $__env->yieldContent('content'); ?>
            <div class="footer-copyright text-center mt-auto">
              &copy; <?php echo translate('All Right Reserved by'); ?> <a href="<?php echo e(url('/')); ?>" class="text--base"><?php echo e($gs->title); ?></a>
          </div>
          </div>
       </article>
    </main>

    <script src="<?php echo e(asset('assets/frontend')); ?>/js/jquery-3.6.0.min.js"></script>
    <script src="<?php echo e(asset('assets/frontend')); ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo e(asset('assets/frontend')); ?>/js/bootstrap.bundle.js"></script>
    <script src="<?php echo e(asset('assets/frontend')); ?>/js/viewport.jquery.js"></script>
    <script src="<?php echo e(asset('assets/frontend')); ?>/js/odometer.min.js"></script>
    <script src="<?php echo e(asset('assets/frontend')); ?>/js/owl.min.js"></script>
    <script src="<?php echo e(asset('assets/frontend')); ?>/js/lightbox.min.js"></script>
    <script src="<?php echo e(asset('assets/frontend')); ?>/js/main.js"></script>
    <script src="<?php echo e(asset('assets/admin/js/summernote.js')); ?>"></script>
    <?php echo $__env->make('notify.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldPushContent('script'); ?>

    <script>
       'use strict';
        $('.reason').on('click',function(){
          $('#modal-reason').find('.reason-text').val($(this).data('reason'))
          $('#modal-reason').modal('show')
        })
    </script>
</body>

<?php /**PATH C:\xampp\htdocs\custom\exchange\project\resources\views/layouts/user.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($gs->title.'-'); ?><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="shortcut icon" type="image/png" href="<?php echo e(getPhoto($gs->favicon)); ?>">
    
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/font-awsome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/custom.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/components.css')); ?>">
    <?php echo $__env->yieldPushContent('style'); ?>
    <!-- Favicon -->
</head>
<body>
     <div id="app">
        <section class="section">
            <div class="container">
                <div class="row">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
        </section>     
    </div>
    <script src="<?php echo e(asset('assets/admin/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/proper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/scripts.js')); ?>"></script>
    <?php echo $__env->make('notify.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
</body>
</html><?php /**PATH C:\xampp\htdocs\custom\exchange\project\resources\views/layouts/admin_auth.blade.php ENDPATH**/ ?>
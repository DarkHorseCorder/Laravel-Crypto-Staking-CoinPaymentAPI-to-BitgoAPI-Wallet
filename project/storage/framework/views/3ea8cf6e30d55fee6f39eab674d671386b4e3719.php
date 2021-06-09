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
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend')); ?>/css/lightbox.min.css" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend')); ?>/css/odometer.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend')); ?>/css/owl.min.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend')); ?>/css/main.css">
    <link href="<?php echo e(asset('assets/frontend/css/main.php')); ?>?color=<?php echo e($gs->theme_color); ?>" rel="stylesheet" />
    <link rel="shortcut icon" href="<?php echo e(getPhoto($gs->favicon)); ?>">
    <?php echo $__env->yieldPushContent('style'); ?>
</head>
<body>
    <?php
       $bg = @json_decode(DB::table('site_contents')->where('slug','banner')->first()->content)->image;
    ?>
    <div class="overlayer"></div>

     <?php echo $__env->make('frontend.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

     <?php if(!request()->routeIs('front.index')): ?>
        <!-- Hero -->
        <section class="banner-section bg_img" data-img="<?php echo e(getPhoto($bg)); ?>">
            <div class="banner-overlay bg--gradient">&nbsp;</div>
            <div class="container">
                <div class="hero-text">
                    <h2 class="hero-text-title"><?php echo $__env->yieldContent('title'); ?></h2>
                    <ul class="breadcrumb">
                        <li>
                            <a href="<?php echo e(url('/')); ?>"><?php echo translate('Home'); ?></a>
                        </li>
                        <li>
                            <?php echo $__env->yieldContent('title'); ?>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    <!-- Hero -->
     <?php endif; ?>

     <?php echo $__env->yieldContent('content'); ?>

     <?php echo $__env->make('frontend.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

     <?php if(@$gs->is_tawk): ?>
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
        'use strict';
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src="https://embed.tawk.to/<?php echo e(@$gs->tawk_id); ?>";
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
        <!--End of Tawk.to Script-->
    <?php endif; ?>


    <script src="<?php echo e(asset('assets/frontend')); ?>/js/jquery-3.6.0.min.js"></script>
    <script src="<?php echo e(asset('assets/frontend')); ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo e(asset('assets/frontend')); ?>/js/viewport.jquery.js"></script>
    <script src="<?php echo e(asset('assets/frontend')); ?>/js/odometer.min.js"></script>
    <script src="<?php echo e(asset('assets/frontend')); ?>/js//owl.min.js"></script>
    <script src="<?php echo e(asset('assets/frontend')); ?>/js/main.js"></script>
    <?php echo $__env->make('notify.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldPushContent('script'); ?>
   
    
</body>

</html>
<?php /**PATH C:\xampp\htdocs\custom\exchange\project\resources\views/layouts/frontend.blade.php ENDPATH**/ ?>
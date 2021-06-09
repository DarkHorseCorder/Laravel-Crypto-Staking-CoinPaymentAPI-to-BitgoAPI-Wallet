<?php
   $seo = App\Models\SeoSetting::first();
?>

<meta name="title" Content="<?php echo e($gs->title); ?>">
<meta name="description" content="<?php echo e($seo->meta_description); ?>">
<meta name="keywords" content="<?php echo e($seo->meta_tag); ?>">


<link rel="apple-touch-icon" href="<?php echo e(getPhoto($gs->header_logo)); ?>">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-title" content="<?php echo $__env->yieldContent('title'); ?>">

<meta itemprop="name" content="<?php echo $__env->yieldContent('title'); ?>">
<meta itemprop="description" content="<?php echo e($seo->meta_description); ?>">
<meta itemprop="image" content="<?php echo e(getPhoto($seo->meta_image)); ?>">

<meta property="og:type" content="website">
<meta property="og:title" content="<?php echo e($seo->title); ?>">
<meta property="og:description" content="<?php echo e($seo->meta_description); ?>">
<meta property="og:image" content="<?php echo e(getPhoto($seo->meta_image)); ?>"/>
<meta property="og:image:type" content="image/<?php echo e(pathinfo(getPhoto($seo->meta_image))['extension']); ?>" />

<meta property="og:url" content="<?php echo e(url()->current()); ?>">

<meta name="twitter:card" content="summary_large_image"><?php /**PATH F:\xampp\htdocs\new\crypto\project\resources\views/other/seo.blade.php ENDPATH**/ ?>
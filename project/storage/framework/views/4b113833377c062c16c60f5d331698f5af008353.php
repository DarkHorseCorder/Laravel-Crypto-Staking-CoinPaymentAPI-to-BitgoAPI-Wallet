

<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get(@$page->title ?? 'About'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  
   <?php if($page): ?>
   <section class="pt-50 pb-100 position-relative overflow-hidden">
    <div class="container">
        <div class="blog__details">
            <p>
                <?php
                    echo $page->details;
                ?>
            </p>          
        </div>
    </div>
  
   </section>
   <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/frontend/about.blade.php ENDPATH**/ ?>
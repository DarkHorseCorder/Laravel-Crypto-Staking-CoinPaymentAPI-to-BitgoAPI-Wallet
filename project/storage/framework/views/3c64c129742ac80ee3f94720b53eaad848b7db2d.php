

<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get(@$page->title); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
        <span class="banner-elem elem1">&nbsp;</span>
        <span class="banner-elem elem3">&nbsp;</span>
        <span class="banner-elem elem5">&nbsp;</span>
        <span class="banner-elem elem6">&nbsp;</span>
    </section>
 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/frontend/page_details.blade.php ENDPATH**/ ?>
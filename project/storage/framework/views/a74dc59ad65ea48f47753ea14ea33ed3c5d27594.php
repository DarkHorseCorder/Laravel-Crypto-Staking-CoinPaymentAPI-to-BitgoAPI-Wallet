

<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get(@$content->title); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Blog -->
    <section class="blog__details blog-section pt-100 pb-100">
        <div class="container">
            <div class="row justify-content-center gy-4">
                <?php
                    echo $content->description;
                ?>
            </div>
        </div>
    </section>
    <!-- Blog -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/frontend/terms_policies.blade.php ENDPATH**/ ?>
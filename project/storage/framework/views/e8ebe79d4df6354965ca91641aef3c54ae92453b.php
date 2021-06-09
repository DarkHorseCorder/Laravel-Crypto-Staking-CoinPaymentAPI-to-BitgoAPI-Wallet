

<?php $__env->startSection('title'); ?>
    <?php echo translate('Blogs'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="blog-section pt-100 pb-100 bg--section">
    <div class="container">
        <div class="row g-4 g-lg-3 g-xl-4 justify-content-center">
            <?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-lg-4 col-md-6 col-sm-10">
                <div class="blog__item">
                    <a href="<?php echo e(route('blog.details',[$item->id,$item->slug])); ?>" class="blog-link">&nbsp;</a>
                    <div class="blog__item-img">
                        <img src="<?php echo e(getPhoto($item->photo)); ?>" alt="blog">
                        <span class="date">
                            <span><?php echo e(dateFormat($item->created_at,'M')); ?></span>
                            <span><?php echo e(dateFormat($item->created_at,'d')); ?></span>
                        </span>
                    </div>
                    <div class="blog__item-cont">
                        <h5 class="blog__item-cont-title line--2">
                            <?php echo e(Str::limit($item->title,30)); ?>

                        </h5>
                        <p class="line--3">
                            <?php echo e(Str::limit(strip_tags($item->description),130)); ?>

                        </p>
                        <div class="blog__author">
                            <div class="author">
                               
                                <h6>By Admin</h6>
                            </div>
                            <span class="read--more"><?php echo translate('Read More'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-lg-4 col-md-6 col-sm-10">
                <div class="blog__item">
                    <h5><?php echo translate('No blogs found!'); ?></h5>
                </div>
            </div>
            <?php endif; ?>
            <?php if($blogs->hasPages()): ?>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <?php echo e($blogs->links()); ?>

            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/frontend/blog/blogs.blade.php ENDPATH**/ ?>
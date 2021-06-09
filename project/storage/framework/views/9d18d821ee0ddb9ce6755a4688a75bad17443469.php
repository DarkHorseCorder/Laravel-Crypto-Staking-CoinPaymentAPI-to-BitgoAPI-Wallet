

<?php $__env->startSection('title'); ?>
    <?php echo translate('Blog Details'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
        <!-- Blog -->
        <section class="blog-section pt-100 pb-100">
            <div class="container">
                <div class="row gy-5">
                    <div class="col-lg-8">
                        <div class="blog__item blog__item-details">
                            <div class="blog__item-img">
                                <img src="<?php echo e(getPhoto($blog->photo)); ?>">
                            </div>
                            <div class="blog__item-cont">
                                <div class="blog__author mb-4 mt-3">
                                    <div class="author w-auto">
                                        <h6>by Admin</h6>
                                    </div>
                                    <a href="#0" class="text--base"><?php echo e(dateFormat($blog->created_at,'d M Y')); ?></a>
                                </div>
                                <h5 class="blog__item-content-title">
                                    <?php echo app('translator')->get($blog->title); ?>
                                </h5>
                                <div class="blog__details">
                                    <p>
                                        <?php
                                            echo  $blog->description;
                                        ?>
                                    </p>
                                    <div class="d-flex align-items-center flex-wrap">
                                        <h6 class="m-0 me-2 align-items-center">Share Now</h6>
                                        <ul class="social-icons social-icons-dark">
                                            <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(url()->current())); ?>"><i class="fab fa-facebook-f"></i></a></li>
                       
                                            <li><a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo e(urlencode(url()->current())); ?>&description=<?php echo e(__($blog->title)); ?>&media=<?php echo e(getPhoto($blog->photo)); ?>"><i class="fab fa-pinterest"></i></a></li>
                                           
                                            <li><a target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo e(__($blog->title)); ?>&amp;url=<?php echo e(urlencode(url()->current())); ?>"><i class="fab fa-twitter"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <aside class="blog-sidebar ps-xxl-5">
                            <div class="widget">
                                <div class="widget-header text-center">
                                    <h5 class="m-0 text-white"><?php echo translate('Latest Blog Posts'); ?></h5>
                                </div>
                                <div class="widget-body">
                                    <ul class="latest-posts">
                                        <?php $__currentLoopData = $latests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a href="<?php echo e(route('blog.details',[$item->id,$item->slug])); ?>">
                                                <div class="img">
                                                    <img src="<?php echo e(getPhoto($item->photo)); ?>" alt="blog">
                                                </div>
                                                <div class="cont">
                                                    <h5 class="subtitle"><?php echo app('translator')->get($item->title); ?></h5>
                                                    <span class="date"><?php echo e(dateFormat($item->created_at,'d M Y')); ?></span>
                                                </div>
                                            </a>
                                        </li>
                                            
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                    </ul>
                                </div>
                            </div>
                            <div class="widget">
                                <div class="widget-header text-center">
                                    <h5 class="m-0 text-white"><?php echo translate('Category'); ?></h5>
                                </div>
                                <div class="widget-body">
                                    <ul class="archive-links">
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a href="<?php echo e(route('blogs',['category'=> $item->slug])); ?>">
                                                <span><?php echo app('translator')->get($item->name); ?></span>
                                                <span>(<?php echo e($item->blogs_count); ?>)</span>
                                            </a>
                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                    </ul>
                                </div>
                            </div>
                            
                        </aside>
                    </div>
                </div>
            </div>
        </section>
        <!-- Blog -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
       .blog__details img{
            width: 800px!important
        }
    </style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/frontend/blog/blog_details.blade.php ENDPATH**/ ?>
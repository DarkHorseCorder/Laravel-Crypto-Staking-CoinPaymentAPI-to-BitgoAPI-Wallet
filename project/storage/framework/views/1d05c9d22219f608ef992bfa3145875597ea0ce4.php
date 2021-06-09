

<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('Frequently Asked Questions'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="faqs-section pt-50 pb-100">
        <div class="container">
            
            <div class="row flex-wrap-reverse gy-5 justify-content-center">
                <div class="col-lg-10">
                    <?php if(!empty($faq->sub_content)): ?>
                    <div class="accordion-wrapper">
                        <?php $__currentLoopData = $faq->sub_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                                <div class="accordion-item <?php echo e($loop->first ? 'open active':''); ?>">
                                    <div class="accordion-title">
                                        <h6 class="title">
                                            <?php echo e(translate(@$item->question)); ?>

                                        </h6>
                                        <span class="icon"></span>
                                    </div>
                                    <div class="accordion-content">
                                        <p>
                                            <?php echo e(translate(@$item->answer)); ?>

                                        </p>
                                    </div>
                                </div>
                                
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                    <?php endif; ?>
                </div>
                
            </div>
        </div>
        <span class="banner-elem elem1">&nbsp;</span>
        <span class="banner-elem elem3">&nbsp;</span>
        <span class="banner-elem elem5">&nbsp;</span>
        <span class="banner-elem elem6">&nbsp;</span>
    </section>
 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/frontend/faq.blade.php ENDPATH**/ ?>
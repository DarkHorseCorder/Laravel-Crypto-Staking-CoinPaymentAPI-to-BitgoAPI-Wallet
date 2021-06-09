<section class="testimonial-section bg--section pt-100 pb-100">
    <div class="container">
        <div class="section-header">
            <h6 class="section-header__subtitle"><?php echo app('translator')->get(@$section->content->title); ?></h6>
            <h3 class="section-header__title"><?php echo app('translator')->get(@$section->content->heading); ?></h3>
        </div>
        <?php if(!empty(@$section->sub_content)): ?>
        <div class="testimonial-slider owl-carousel owl-theme">
            <?php $__currentLoopData = $section->sub_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="testimonial-item">
                    <div class="testimonial-header">
                        <div class="thumb">
                            <img src="<?php echo e(getPhoto(@$item->image)); ?>">
                        </div>
                        <div class="icon">
                            <i class="fas fa-quote-left"></i>
                        </div>
                    </div>
                   
                    <div class="testimonial-content">
                        <p>
                            <?php echo app('translator')->get(@$item->quote); ?>
                        </p>
                        <h5 class="name text--base mt-3"><?php echo app('translator')->get(@$item->name); ?></h5>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
    </div>
</section><?php /**PATH /home/xnettrading/public_html/project/resources/views/frontend/sections/testimonial.blade.php ENDPATH**/ ?>
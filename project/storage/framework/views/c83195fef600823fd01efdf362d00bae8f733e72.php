<section class="how-to-get-started-section pt-100 pb-100">
    <div class="container">
        <div class="section-header text-center">
            <h6 class="section-header__subtitle"><?php echo app('translator')->get(@$section->content->title); ?></h6>
            <h3 class="section-header__title"><?php echo app('translator')->get(@$section->content->heading); ?></h3>
            <p>
                <?php echo app('translator')->get(@$section->content->sub_heading); ?>
            </p>
        </div>
        <?php if(!empty($section->sub_content)): ?>
            <div class="how--wrapper">
                <?php $__currentLoopData = @$section->sub_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="how__item">
                        <div class="how__item-icon">
                            <i class="<?php echo e(@$item->icon); ?>"></i>
                        </div>
                        <div class="how__item-cont">
                            <h5 class="title"><?php echo app('translator')->get(@$item->title); ?></h5>
                            <p>
                                <?php echo app('translator')->get(@$item->details); ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
</section><?php /**PATH F:\xampp\htdocs\new\crypto\project\resources\views/frontend/sections/how.blade.php ENDPATH**/ ?>
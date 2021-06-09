<section class="crypto-section pt-100 pb-50">
    <div class="container">
        <div class="section-header">
            <h6 class="section-header__subtitle"><?php echo app('translator')->get(@$section->content->title); ?></h6>
            <h3 class="section-header__title"><?php echo app('translator')->get(@$section->content->heading); ?></h3>
        </div>
        <?php if(!empty($section->sub_content)): ?>
        <div class="row g-4 justify-content-center">
            <?php $__currentLoopData = $section->sub_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-sm-6">
                    <div class="crp__item">
                        <a href="#0" class="crp--link">&nbsp;</a>
                        <div class="crp__item-icon">
                            <i class="<?php echo e(@$item->icon); ?>"></i>
                        </div>
                        <div class="crp__item-cont">
                            <h5 class="crp__item-cont-title"><?php echo app('translator')->get(@$item->title); ?></h5>
                            <p>
                               <?php echo app('translator')->get(@$item->details); ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
        
    </div>
</section><?php /**PATH C:\xampp\htdocs\cc\crypto\project\resources\views/frontend/sections/service.blade.php ENDPATH**/ ?>
<section class="shield-section bg--section pt-100 pb-100">
    <div class="container">
        <div class="row gy-5 justify-content-evenly align-items-center">
            <div class="col-lg-6">
                <div class="shield-content">
                    <h2 class="title">
                       <?php echo app('translator')->get(@$section->content->heading); ?>
                    </h2>
                    <?php if(!empty($section->sub_content)): ?>
                        <ul class="security-feature-list">
                            <?php $__currentLoopData = $section->sub_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <?php echo app('translator')->get($item->feature); ?>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                    <div class="mt-4 pt-3">
                        <a href="<?php echo e(url(@$section->content->btn_url ?? '/')); ?>" class="cmn--btn"><?php echo app('translator')->get(@$section->content->btn_name); ?> <span class="round-effect">
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </span></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-xl-4">
                <div class="shield-area">
                    <h4 class="title text--white">
                        <?php echo app('translator')->get(@$section->content->feature_text); ?>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</section><?php /**PATH F:\xampp\htdocs\new\crypto\project\resources\views/frontend/sections/feature.blade.php ENDPATH**/ ?>
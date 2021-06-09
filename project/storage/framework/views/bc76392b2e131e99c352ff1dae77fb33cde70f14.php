<section class="faq-section pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="section-header mb-lg-0">
                    <h6 class="section-header__subtitle"><?php echo app('translator')->get(@$section->content->title); ?></h6>
                    <h3 class="section-header__title"><?php echo app('translator')->get(@$section->content->heading); ?></h3>
                    <p>
                        <?php echo app('translator')->get(@$section->content->sub_heading); ?>
                    </p>
                    <a href="<?php echo e(url(@$section->content->btn_url)); ?>" class="cmn--btn">
                        <?php echo app('translator')->get(@$section->content->btn_name); ?> 
                        <span class="round-effect">
                           <i class="fas fa-long-arrow-alt-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-lg-7">
                <?php if(!empty($section->sub_content)): ?>
                <div class="accordion-wrapper">
                    <?php $__currentLoopData = $section->sub_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($key < 5): ?>
                        <div class="accordion-item <?php echo e($loop->first ? 'open active':''); ?>">
                            <div class="accordion-title">
                                <h5 class="title">
                                    <?php echo e(__(@$item->question)); ?>

                                </h5>
                                <span class="right-icon"></span>
                            </div>
                            <div class="accordion-content">
                                <?php echo e(__(@$item->answer)); ?>

                            </div>
                        </div>
                     <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section><?php /**PATH C:\xampp\htdocs\custom\exchange\project\resources\views/frontend/sections/faq.blade.php ENDPATH**/ ?>
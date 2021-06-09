
    <nav class="d-inline-block ml-4">
        <ul class="pagination flex-wrap">
            <?php if($paginator->onFirstPage()): ?>

            <?php else: ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo e($paginator->previousPageUrl()); ?>" tabindex="-1">
                <i class="fas fa-chevron-left"></i>
                </a>
            </li>
            <?php endif; ?>

            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php if(count($element) < 2): ?>


                <?php else: ?>

                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $el): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <li class="page-item <?php echo e($key == $paginator->currentPage() ? 'active' : ''); ?>">
                        <a class="page-link" href="<?php echo e($el); ?>"><?php echo e($key); ?></a>
                    </li>
                    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

         <?php if($paginator->hasMorePages()): ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo e($paginator->nextPageUrl()); ?>">
                <i class="fas fa-chevron-right"></i>
                </a>
            </li>
        <?php endif; ?>
        </ul>
    </nav>
<?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/partials/paginate.blade.php ENDPATH**/ ?>
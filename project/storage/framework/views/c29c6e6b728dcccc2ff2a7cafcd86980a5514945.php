<?php if(@$gs->cookie->status): ?>
    <?php if(!session('cookie-deny')): ?>
        <div class="cookie-section">
           <?php echo $__env->make('frontend.partials.cookie', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>   
    <?php endif; ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\cc\crypto\project\vendor\spatie\laravel-cookie-consent\src/../resources/views/dialogContents.blade.php ENDPATH**/ ?>
<div class="container cookie_content">
    <div class="js-cookie-consent cookie-consent">
        <span class="cookie-consent__message m-2">
            <?php echo app('translator')->get(@$gs->cookie->cookie_text); ?>
        </span>

        <div class="d-flex">
            <button class="js-cookie-consent-agree cookie-consent__agree cmn--btn m-2">
                <?php echo app('translator')->get(@$gs->cookie->button_text); ?>
            </button>
            <button class="btn-outline-warning text-white btn m-2 deny">
                <?php echo app('translator')->get('Don\'t Allow'); ?>
            </button>
        </div>
    </div>
</div>

<script>
    'use strict';
    $('.deny').on('click',function () { 
        $(document).find('.cookie-section').addClass('d-none')
        $.get("<?php echo e(route('cookie.deny')); ?>", {data:''},
            function (res) {},
        );
    })
</script><?php /**PATH F:\xampp\htdocs\new\crypto\project\resources\views/frontend/partials/cookie.blade.php ENDPATH**/ ?>
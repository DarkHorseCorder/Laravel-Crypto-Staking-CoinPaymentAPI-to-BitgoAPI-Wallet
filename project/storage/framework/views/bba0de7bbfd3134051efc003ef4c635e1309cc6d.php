<section class="banner-section bg_img" data-img="<?php echo e(getPhoto(@$section->content->image)); ?>">
    <div class="banner-overlay bg--gradient">&nbsp;</div>
    <div class="container">
        <div class="banner-wrapper">
            <div class="banner-exchange-area">
                <div class="exchange-area">
                    <h4 class="title"><?php echo e(__(@$section->content->title)); ?></h4>
                    <form method="GET" action="<?php echo e(route('offer.list')); ?>">
                        <div class="row gy-4">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <select name="type" class="form-control text--dark">
                                        <option value="buy" <?php echo e(request('type') == 'buy' ? 'selected':''); ?>><?php echo translate('Buy'); ?></option>
                                        <option value="sell" <?php echo e(request('type') == 'sell' ? 'selected':''); ?>><?php echo translate('Sell'); ?></option>
                                    </select>
                                   
                                    <select name="crypto" class="form-control text--dark">
                                        <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                         <option value="<?php echo e($item->code); ?>" <?php echo e(request('crypto') == $item->code ? 'selected':''); ?>><?php echo e($item->code); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                               
                            </div>
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <select name="gateway" class="form-control gateway_id text--dark">
                                        <option value=""><?php echo translate('Select One'); ?></option>
                                        <?php $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->slug); ?>" data-currency="<?php echo e(json_encode($item->fiats())); ?>" <?php echo e(request('gateway') == $item->slug ? 'selected':''); ?>><?php echo e($item->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <select name="currency" class="form-control fiats text--dark" disabled>
                                            
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <input type="number" name="amount"  class="form-control text--dark" placeholder="<?php echo translate('Amount'); ?>"
                                    name="amount">
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="cmn--btn w-100 rounded">Find Offer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="banner-cont text--light">
                <h1 class="title text--base"><?php echo app('translator')->get(@$section->content->heading); ?></h1>
                <p>
                    <?php echo app('translator')->get(@$section->content->sub_heading); ?>
                </p>
                <h5 class="subtitle text--white"> <?php echo app('translator')->get(@$section->content->payment_text); ?></h5>
                <?php if(!empty($section->sub_content)): ?>
                    <div class="btn__grp">
                        <?php $__currentLoopData = $section->sub_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="javascript:void(0)" class="cmn--btn">
                            <img src="<?php echo e(getPhoto(@$item->image)); ?>" alt="banner">
                            <?php echo e(@$item->title); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        $('.gateway_id').on('change',function () { 
           const currency = $(this).find('option:selected').data('currency')
           var option = '<option value=""><?php echo translate('Select'); ?></option>';
           $.each(currency, function (i, val) { 
              option += `<option value="${val.code}">${val.code}</option>`
           });
           $('.fiats').attr('disabled',false)
           $('.fiats').html(option)
        })
    </script>
<?php $__env->stopPush(); ?><?php /**PATH F:\xampp\htdocs\new\crypto\project\resources\views/frontend/sections/banner.blade.php ENDPATH**/ ?>
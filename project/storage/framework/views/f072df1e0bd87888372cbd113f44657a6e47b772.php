

<?php $__env->startSection('title'); ?>
   <?php echo app('translator')->get('Trade Details'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard--content-item">
    <div class="row gy-5">
        <?php echo $__env->make('user.trade.tradebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('user.trade.chat', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="col-md-6">
            <div class="accordion-wrapper">
                <div class="accordion-item bg--body">
                    <div class="accordion-title">
                        <h5 class="title">
                            <?php echo translate('Offer Terms'); ?>
                        </h5>
                        <span class="right-icon"></span>
                    </div>
                    <div class="accordion-content">
                        <?php echo e($trade->offer->offer_terms); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="accordion-wrapper">
                <div class="accordion-item bg--body">
                    <div class="accordion-title">
                        <h5 class="title">
                            <?php echo translate('Trade Instructions'); ?>
                        </h5>
                        <span class="right-icon"></span>
                    </div>
                    <div class="accordion-content">
                        <?php echo e($trade->offer->trade_instructions); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div id="disputeModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="<?php echo e(route('user.trade.dispute')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="trade_code" value="<?php echo e($trade->trade_code); ?>">
                <div class="modal-body p-4 text-center">
                    <h5><?php echo translate('Please Confirm You Want To Start a Dispute'); ?></h5>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn  btn--danger" data-bs-dismiss="modal"><?php echo translate('Cancel'); ?></button><button type="submit" class="btn btn--primary"><?php echo translate('Confirm'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="releaseModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="<?php echo e(route('user.trade.release')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="trade_code" value="<?php echo e($trade->trade_code); ?>">
                <div class="modal-body p-4 text-center">
                    <h5><?php echo translate('Are you sure you want to release this trade ?.'); ?></h5>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn  btn--danger" data-bs-dismiss="modal"><?php echo translate('NO'); ?></button><button type="submit" class="btn btn--primary"><?php echo translate('YES'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="paidModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="<?php echo e(route('user.trade.paid')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="trade_code" value="<?php echo e($trade->trade_code); ?>">
                <div class="modal-body p-4 text-center">
                    <h5><?php echo translate('Was Payment Information Submitted ?'); ?></h5>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn  btn--danger" data-bs-dismiss="modal"><?php echo translate('No'); ?></button><button type="submit" class="btn btn--primary"><?php echo translate('Yes'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="<?php echo e(route('user.trade.cancel')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="trade_code" value="<?php echo e($trade->trade_code); ?>">
                <div class="modal-body p-4 text-center">
                    <h5><?php echo translate('Are you sure about this ?'); ?></h5>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn  btn--danger" data-bs-dismiss="modal"><?php echo translate('NO'); ?></button><button type="submit" class="btn btn--primary"><?php echo translate('YES'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="userInfo" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="about-offer">
                <div class="about-offer-area border rounded">
                    <div class="cmn--media ms-0">
                        <img src="" alt="clients" class="img">
                        <div class="subtitle">
                            <h5 class="m-0 name"></h5>
                            <span class="m-0 tradeCount"></span>
                        </div>
                    </div>
                    <ul class="user-info-list"></ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php
    $to = Carbon\Carbon::parse($trade->created_at)->addMinutes($trade->trade_duration);
    $from   = \Carbon\Carbon::now();
    $diff = $from->diffInMinutes($to) - 0.5;
    if($from > $to) $diff = 0;
    
?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
            function counter(duration, id = true,trade = true,chat = false) { 
                var duration = duration
                var countDownDate = new Date();
                countDownDate.setMinutes(countDownDate.getMinutes() + parseInt(duration));
                var x = setInterval(function () {  
                    var now = new Date().getTime();  
                    var distance = countDownDate - now; 
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000); 
                    
                    if(id){
                       document.getElementById("time").innerHTML = minutes + "m " + seconds + "s "; 
                    }
                    if(distance < 0) {
                        if(id){
                            document.getElementById("time").innerHTML = '0m 0s'
                        }
                        clearInterval(x);
                        if(trade){
                            $(".trade").html(`<a href="#0" class="btn btn--danger cancel"><?php echo translate('Cancel Trade'); ?></a>`)
                        }

                        if(chat){
                            $("#load").load(location.href + " #messages");
                            setTimeout(function () {
                                $("#messages").animate({ scrollTop: $('#messages').prop("scrollHeight")}, 1000);
                            },300)
                        }
                    }
                }, 1000);

            }
            counter("<?php echo e($diff); ?>")
            counter(1,false,false,true)

            $(document).on('click','.cancel',function () { 
                $('#deleteModal').modal('show')
            })

            $(".imageUpload").on('change', function () {
              $('.files').text('File : '+this.files[0].name) ;
            });

            $(".reload").on('click', function () {
                $("#load").load(location.href + " #messages");
                setTimeout(function () {
                    $("#messages").animate({ scrollTop: $('#messages').prop("scrollHeight")}, 1000);
                },300)
            });
            $("#messages").scrollTop($('#messages')[0].scrollHeight);

            $('.user_info').on('click',function () {
                var img = $(this).data('img')
                var tradeCount = $(this).data('trade_count')
                var info = $(this).data('info')
                var content = '';
                if(info.kyc_status == 1){
                    content += `<li><?php echo translate('ID Verified'); ?></li>`
                }else{
                    content += `<li  class="no"><?php echo translate('ID Verification Pending'); ?></li>`
                }
                if(info.email_verified == 1){
                    content += `<li><?php echo translate('Email Verified'); ?></li>`
                }else{
                    content += `<li  class="no"><?php echo translate('Email Not Verified'); ?></li>`
                }

                if(info.phone_verified == 1){
                    content += `<li><?php echo translate('Phone Verified'); ?></li>`
                }else{
                    content += `<li  class="no"><?php echo translate('Phone Verification Pending'); ?></li>`
                }
                $('#userInfo').find('.img').attr('src',img)
                $('#userInfo').find('.user-info-list').html(content)
                $('#userInfo').find('.tradeCount').text('<?php echo translate('Total Completed Trades : '); ?>'+' '+tradeCount)
                $('#userInfo').find('.name').text(info.name)
                $('#userInfo').modal('show')
            })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/user/trade/details.blade.php ENDPATH**/ ?>
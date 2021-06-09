

<?php $__env->startSection('title'); ?>
   <?php echo app('translator')->get('Trade Details'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header">
        <h1><?php echo app('translator')->get('Trade Details : '); ?> <?php echo e($trade->trade_code); ?></h1>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between flex-wrap">
                    <h6><?php echo translate('Trade Details'); ?></h6>
                    <div class="d-flex justify-content-between">
                        <?php if($trade->status != 3): ?>
                        <a href="javascript:void(0)" data-trade_code="<?php echo e($trade->trade_code); ?>" data-route="<?php echo e(route('admin.trade.release')); ?>" class="btn btn-success btn-sm m-1 action"><?php echo translate('Release'); ?> <?php echo e($trade->crypto->code); ?></a>
                        <?php endif; ?>

                        <?php if($trade->status != 3 && $trade->status != 5): ?>
                        <a href="javascript:void(0)" data-trade_code="<?php echo e($trade->trade_code); ?>" data-route="<?php echo e(route('admin.trade.refund')); ?>" class="btn btn-primary btn-sm m-1 action"><?php echo translate('Refund'); ?> <?php echo e($trade->crypto->code); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center"><?php echo translate('Offer Type :'); ?><span class="badge badge-success"><?php echo e(ucfirst($trade->offer->type)); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center"><?php echo translate('Status'); ?>
                            <?php if($trade->status == 0): ?>
                            <span class="badge badge-warning text-white">
                                <?php echo translate('Trade Escrowed'); ?>
                            </span>
                            <?php elseif($trade->status == 1): ?>
                            <span class="badge badge-primary">
                                <?php echo translate('Paid'); ?>
                            </span>
                            <?php elseif($trade->status == 2): ?>
                            <span class="badge badge-danger">
                                <?php echo translate('Canceled'); ?>
                            </span>
                            <?php elseif($trade->status == 3): ?>
                            <span class="badge badge-success">
                                <?php echo translate('Compleled/Released'); ?>
                            </span>
                            <?php elseif($trade->status == 4): ?>
                            <span class="badge badge-info">
                                <?php echo translate('Disputed'); ?>
                            </span>
                            <?php endif; ?>
                        
                        </li>

                        <li class="list-group-item d-flex justify-content-between"><?php echo translate('Offer Owner :'); ?><span><?php echo e($trade->offerOwner->name); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><?php echo translate('Requested By :'); ?><span><?php echo e($trade->trader->name); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><?php echo translate('Crypto Amount :'); ?><span><?php echo e(numFormat($trade->crypto_amount,8)); ?> <?php echo e($trade->crypto->code); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><?php echo translate('Fiat Amount :'); ?><span><?php echo e(amount($trade->fiat_amount)); ?> <?php echo e($trade->fiat->code); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><?php echo translate('Trade Duration'); ?><span><?php echo e($trade->trade_duration); ?> <?php echo translate('Minutes'); ?></span></li>
                    </ul>
                   
                    <hr>

                    <p class="text-right">
                        <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#offer-terms" aria-expanded="false" aria-controls="collapseExample">
                            <?php echo translate('Offer Terms'); ?>
                        </button>

                        <button class="btn btn-info collapsed" type="button" data-toggle="collapse" data-target="#trade-ins" aria-expanded="false" aria-controls="collapseExample">
                            <?php echo translate('Trade Instructions'); ?>
                        </button>
                    </p>
                    <div class="collapse" id="offer-terms" style="">
                        <p>
                            <?php echo e($trade->offer->offer_terms); ?>

                        </p>
                    </div>
                    <hr>
                    <div class="collapse" id="trade-ins" style="">
                        <p>
                            <?php echo e($trade->offer->trade_instructions); ?>

                        </p>
                    </div>
                      
                      
                </div>

            </div>
            
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show fade active" id="c1">
                            <div class="chat__msg">
                                <div class="chat__msg-header">
                                    <div class="post__creator align-items-center">
                                        <div class="post__creator-content">
                                            <h5 class="name d-inline-block"><?php echo translate('Trade Chat'); ?> </h5>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="chat__msg-body">
                                    <ul class="msg__wrapper mt-3">
                                            <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <?php if($item->admin_id == null): ?>
                                                <li class="incoming__msg">
                                                    <div class="msg__item">
                                                        <div class="post__creator">
                                                            <div class="post__creator-content">
                                                                
                                                                <?php if($item->message): ?>
                                                                 <p><small class="font-weight-bold text-primary"><?php echo e($item->user->name); ?> : </small> <br> <?php echo e($item->message); ?></p>
                                                                <?php endif; ?>
                                                                <?php if($item->file): ?>
                                                                    <div class="text-start">
                                                                        <a href="<?php echo e(asset('assets/ticket/'.$item->file)); ?>" download=""><?php echo e($item->file); ?></a>
                                                                    </div>
                                                                    <?php endif; ?>
                                                                <span class="comment-date text--secondary"><?php echo e(diffTime($item->created_at)); ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php else: ?>
                                                <li class="outgoing__msg">
                                                    <div class="msg__item">
                                                        <div class="post__creator">
                                                            <div class="post__creator-content">
                                                               
                                                                <?php if($item->message): ?>
                                                                 <p class="out__msg"><?php echo e($item->message); ?></p>
                                                                <?php endif; ?>
                                                                <?php if($item->file): ?>
                                                                    <div class="text-end ms-auto">
                                                                        <a href="<?php echo e(asset('assets/ticket/'.$item->file)); ?>" download=""><?php echo e($item->file); ?></a>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <span class="comment-date text--secondary"><?php echo e(diffTime($item->created_at)); ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <li class="incoming__msg">
                                                <div class="msg__item">
                                                    <div class="post__creator">
                                                        <div class="post__creator-content">
                                                            <h6 class="text-center"><?php echo translate('No messages yet!!'); ?></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php endif; ?>
                                       
                                    </ul>
                                </div>
                                <?php if($trade->status != 3 && $trade->status != 2): ?>
                                    <div class="chat__msg-footer">
                                        <form action="<?php echo e(route('admin.trade.submit.chat')); ?>" class="send__msg" method="post" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="trade_id" value="<?php echo e($trade->id); ?>">
                                            <div class="input-group">
                                                <input id="upload-file" type="file" name="file" class="form-control d-none">
                                                <label class="-formlabel upload-file" for="upload-file"><i class="fas fa-paperclip"></i>
                                            </div>
                                            <div class="input-group">
                                                <textarea class="form-control form--control" name="message"></textarea>
                                                <button class="border-0 outline-0 send-btn" type="submit"><i class="fab fa-telegram-plane"></i></button>
                                            </div>
                                        </form>
                                        <small class="files mt-2 text-primary"></small>
                                    </div>
                                <?php endif; ?>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>


    <div class="modal fade" id="actionModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="trade_code">
                <div class="modal-content">
                    <div class="modal-body p-4">
                       <h5 class="text-center"><?php echo translate('Are you sure about this action ?'); ?></h5>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo translate('Cancel'); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo translate('Confirm'); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        $("#upload-file").on('change', function () {
             $('.files').text('File : '+this.files[0].name) ;
        });

        $('.action').on('click',function () { 
            const code = $(this).data('trade_code')
            const route = $(this).data('route')

            $('#actionModal').find('input[name=trade_code]').val(code)
            $('#actionModal').find('form').attr('action',route)
            $('#actionModal').modal('show')
        })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/trade/trade_details.blade.php ENDPATH**/ ?>
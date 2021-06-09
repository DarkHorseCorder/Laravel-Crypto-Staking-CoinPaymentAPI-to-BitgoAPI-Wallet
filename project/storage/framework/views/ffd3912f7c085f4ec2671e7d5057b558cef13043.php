<div class="col-xl-6 col-xxl-7">
    <div class="chat-wrapper bg--body">
        <div class="chat-wrapper-header d-flex align-items-center justify-content-between">
            <?php if($trade->trader_id == auth()->id()): ?>
                <a href="javascript:void(0)" class="table-buyer ms-0 user_info" data-img="<?php echo e(getPhoto($trade->offerOwner->photo)); ?>" data-trade_count="<?php echo e($trade->offerOwner->completedTrade()); ?>" data-info="<?php echo e($trade->offerOwner); ?>">
                    <img src="<?php echo e(getPhoto($trade->offerOwner->photo)); ?>" alt="clients">
                    <h6 class="m-0 subtitle text--white"><?php echo e($trade->offerOwner->name); ?></h6>
                    <small class="badge badge--base badge-sm ms-2"><i class="fas fa-info"></i></small>
                </a>
            <?php else: ?>
                <a href="javascript:void(0)" class="table-buyer ms-0 user_info" data-img="<?php echo e(getPhoto($trade->trader->photo)); ?>" data-trade_count="<?php echo e($trade->trader->completedTrade()); ?>" data-info="<?php echo e($trade->trader); ?>">
                    <img src="<?php echo e(getPhoto($trade->trader->photo)); ?>" alt="clients">
                    <h6 class="m-0 subtitle text--white"><?php echo e($trade->trader->name); ?></h6>
                    <small class="badge badge--base badge-sm ms-2"><i class="fas fa-info"></i></small>
                </a>
            <?php endif; ?>
            <?php if($trade->status != 2 && $trade->status != 3): ?> 
            <a href="javascript:void(0)" class="btn btn--success me-1 reload btn-sm"><?php echo translate('Reload Chat'); ?></a>
            <?php endif; ?>

            <?php
                $lastTime = Carbon\Carbon::parse($trade->created_at)->addMinutes($trade->trade_duration);
            ?>
            
            <?php if($trade->offer->type == 'sell'): ?>
                <?php if($trade->trader_id == auth()->id()): ?>
                    <?php if($trade->status == 1 && $trade->status != 4): ?> 
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#disputeModal"  class="btn btn--base btn-sm"><?php echo translate('Start Dispute'); ?></a>
                    <?php else: ?>
                        <a href="javascript:void(0)" class="btn btn--base disabled btn-sm"><?php echo translate('Start Dispute'); ?></a>
                    <?php endif; ?>
                <?php elseif($trade->offer_user_id == auth()->id()): ?>
                   <?php if($lastTime <= Carbon\Carbon::now() && $trade->status != 4): ?>
                     <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#disputeModal"  class="btn btn--base btn-sm"><?php echo translate('Start Dispute'); ?></a>
                    <?php else: ?>
                     <a href="javascript:void(0)" class="btn btn--base disabled btn-sm"><?php echo translate('Start Dispute'); ?></a>
                   <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>


          
        </div>
        <div class="chat-wrapper-body border-bottom-0" id="load">
            <ul class="create-chat-context" id="messages">
                <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <?php if($message->user_id && $message->user_id != auth()->id()): ?>
                     <li>
                         <div class="incoming__msg">
                             <div class="opponent__img">
                                 <img src="<?php echo e(getPhoto($message->user->photo)); ?>" alt="client">
                             </div>
                             <div class="message__content">
                                 <p>
                                 <?php echo e($message->message); ?>

                                 </p>
                                 <?php if($message->file): ?>
                                     <a href="<?php echo e(asset('assets/images/'.$message->file)); ?>" class="attachments--img m-1"
                                         data-lightbox>
                                         <img src="<?php echo e(getPhoto($message->file)); ?>" alt="clients">
                                     </a>
                                 <?php endif; ?>
                                 <small class="mt-2"><?php echo e(diffTime($message->created_at)); ?></small>
                             </div>
                         </div>
                     </li>
                 <?php endif; ?>

                 <?php if($message->user_id && $message->user_id == auth()->id()): ?>
                     <li>
                         <div class="outgoing__msg">
                             <div class="opponent__img">
                                 <img src="<?php echo e(getPhoto($message->user->photo)); ?>" alt="client">
                             </div>
                             <div class="message__content">
                                 <p>
                                     <?php echo e($message->message); ?>

                                 </p>
                                 <?php if($message->file): ?>
                                     <a href="<?php echo e(asset('assets/images/'.$message->file)); ?>" class="attachments--img m-1"
                                         data-lightbox>
                                         <img src="<?php echo e(getPhoto($message->file)); ?>" alt="clients">
                                     </a>
                                 <?php endif; ?>
                                 <small class="mt-2"><?php echo e(diffTime($message->created_at)); ?></small>
                             </div>
                         </div>
                     </li>
                  <?php endif; ?>
                 
                    <?php if($message->admin_id): ?>
                    <li>
                        <div class="incoming__msg">
                            <div class="opponent__img">
                                <img src="<?php echo e(getPhoto($message->admin->photo)); ?>" alt="client">
                            </div>
                            <div class="message__content">
                                <b><?php echo translate('Moderator : '); ?></b>
                                <p>
                                <?php echo e($message->message); ?>

                                </p>
                                <?php if($message->file): ?>
                                    <a href="<?php echo e(asset('assets/images/'.$message->file)); ?>" class="attachments--img p-2"
                                        data-lightbox>
                                        <img src="<?php echo e(getPhoto($message->file)); ?>" alt="clients">
                                    </a>
                                <?php endif; ?>
                                <small class="mt-2"><?php echo e(diffTime($message->created_at)); ?></small>
                            </div>
                        </div>
                    </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             </ul>
           </div>
           <div class="chat-wrapper-body pt-0">
                <?php if($trade->status != 2 && $trade->status != 3): ?>
                <form action="<?php echo e(route('user.submit.trade.chat')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="trade_id" value="<?php echo e($trade->id); ?>">
                    <div class="position-relative">
                        <textarea class="form-control pb-5" name="message" placeholder="<?php echo app('translator')->get('Write Message'); ?>"></textarea>
                        <label class="message--file">
                            <i class="fas fa-paperclip"></i>
                            <input type="file" name="file" class="imageUpload" accept="image/*" hidden>
                        </label>
                        
                        <button type="submit" class="btn btn--base send--btn"><i class="fas fa-paper-plane"></i></button>
                    </div>
                    <small class="files mt-2 text--base"></small>
                </form>
                <?php endif; ?>
           </div>
        </div>
</div>
<?php /**PATH /home/xnettrading/public_html/project/resources/views/user/trade/chat.blade.php ENDPATH**/ ?>
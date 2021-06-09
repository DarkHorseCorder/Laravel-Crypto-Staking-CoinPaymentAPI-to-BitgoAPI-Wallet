
<?php $__env->startSection('title'); ?>
    <?php if(request()->routeIs('admin.withdraw.pending')): ?>
         <?php echo translate('Pending Withdraws'); ?>
    <?php elseif(request()->routeIs('admin.withdraw.accepted')): ?>
          <?php echo translate('Accepted Withdraws'); ?>
    <?php else: ?>
          <?php echo translate('Rejected Withdraws'); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
        <div class="section-header">
            <?php if(request()->routeIs('admin.withdraw.pending')): ?>
            <h1><?php echo translate('Pending Withdraws'); ?></h1>
            <?php elseif(request()->routeIs('admin.withdraw.accepted')): ?>
            <h1><?php echo translate('Accepted Withdraws'); ?></h1>
            <?php else: ?>
                <h1><?php echo translate('Rejected Withdraws'); ?></h1>
            <?php endif; ?>
        </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
               
                <div class="card-body text-center">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th><?php echo translate('Sl'); ?></th>
                                <th><?php echo translate('User'); ?></th>
                                <th><?php echo translate('Withdraw Amount'); ?></th>
                                <th><?php echo translate('Charge'); ?></th>
                                <th><?php echo translate('status'); ?></th>
                                <th><?php echo translate('Action'); ?></th>
                            </tr>
                            <?php $__empty_1 = true; $__currentLoopData = $withdrawlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $withdrawlog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td data-label="<?php echo translate('Sl'); ?>"><?php echo e($key + $withdrawlogs->firstItem()); ?></td>
                        
                                    <td data-label="<?php echo translate('User'); ?>">
                                        <?php echo e($withdrawlog->user ? $withdrawlog->user->email.'(user)' : $withdrawlog->merchant->email.' (merchant)'); ?>

                                     </td>
                                    <td data-label="<?php echo translate('Withdraw Amount'); ?>"><?php echo e(__(amount($withdrawlog->amount,$withdrawlog->currency->type,2).' '.$withdrawlog->currency->code)); ?></td>
                               
                                    <td data-label="<?php echo translate('Charge'); ?>">
                                       <?php echo e(amount($withdrawlog->charge,$withdrawlog->currency->type,2)); ?>

                                    </td> 
                                

                                    <td data-label="<?php echo translate('status'); ?>">

                                        <?php if($withdrawlog->status == 1): ?>
                                            <span class="badge badge-success"><?php echo translate('Accepted'); ?></span>
                                        <?php elseif($withdrawlog->status == 2): ?>
                                             <span class="badge badge-danger"><?php echo translate('Rejected'); ?></span>
                                        <?php else: ?>
                                            <span class="badge badge-warning"><?php echo translate('Pending'); ?></span>
                                        <?php endif; ?>
                                    </td>

                                    <td data-label="<?php echo translate('Action'); ?>">
                                    
                                        <div class="d-flex flex-wrap align-items-center justify-content-end justify-content-lg-center">
                                            <button class="btn btn-info details m-1"  
                                                data-transaction="<?php echo e($withdrawlog->trx); ?>" 
                                                data-provider="<?php echo e($withdrawlog->user->email); ?>"  
                                                data-date = "<?php echo e(__($withdrawlog->created_at->format('d F Y'))); ?>"
                                                data-amount = <?php echo e(numFormat($withdrawlog->amount,8)); ?>

                                                data-charge = <?php echo e(numFormat($withdrawlog->charge,8)); ?>

                                                data-total = <?php echo e(numFormat($withdrawlog->charge,8)); ?>

                                                data-wallet_address = <?php echo e($withdrawlog->wallet_address); ?>

                                                data-curr = <?php echo e($withdrawlog->currency->code); ?>

                                            
                                            >
                                            <?php echo translate('Details'); ?></button>

                                            <?php if($withdrawlog->status == 0): ?>
                                                <button class="btn btn-primary accept m-1" data-url="<?php echo e(route('admin.withdraw.accept', $withdrawlog)); ?>" ><?php echo translate('Accept'); ?></button>
                                            
                                                <button class="btn btn-danger reject m-1" data-url="<?php echo e(route('admin.withdraw.reject',$withdrawlog)); ?>"><?php echo translate('Reject'); ?></button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                <tr>
                                    <td class="text-center" colspan="100%"><?php echo translate('No Data Found'); ?></td>
                                </tr>

                            <?php endif; ?>
                        </table>
                    </div>
                </div>
                <?php if($withdrawlogs->hasPages()): ?>
                <div class="card-footer">
                    <?php echo e($withdrawlogs->links('admin.partials.paginate')); ?>

                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>


    
    <!-- Modal -->
    <div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

           
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title"><?php echo translate('Withdraw Details'); ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                    </div>
                <div class="modal-body">
                    <div class="container-fluid withdraw-details">
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo translate('Close'); ?></button>
                    
                </div>
            </div>
           
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="accept" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">

           <form action="" method="post">
           <?php echo csrf_field(); ?>
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title"><?php echo translate('Withdraw Accept'); ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <p><?php echo translate('Are you sure to Accept this withdraw request'); ?>?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo translate('Close'); ?></button>
                    <button type="submit" class="btn btn-primary" ><?php echo translate('Accept'); ?></button>
                    
                </div>
            </div>
           </form>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

           <form action="" method="post">
           <?php echo csrf_field(); ?>
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title"><?php echo translate('Withdraw Reject'); ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group col-md-12">

                            <label for=""><?php echo translate('Reason Of Reject'); ?></label>
                            <textarea name="reason_of_reject" id="" cols="30" rows="10" class="form-control"> </textarea>
                        
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo translate('Close'); ?></button>
                    <button type="submit" class="btn btn-danger" ><?php echo translate('Reject'); ?></button>
                    
                </div>
            </div>
           </form>
        </div>
    </div>
    


<?php $__env->stopSection(); ?>


<?php $__env->startPush('script'); ?>

    <script>
    
        $(function(){
            'use strict';

            $('.details').on('click',function(){
                const modal = $('#details');

                let html = `
                
                    <ul class="list-group">
                           
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo translate('Transaction Id'); ?>
                                <span>${$(this).data('transaction')}</span>
                            </li>  
                            
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo translate('User Name'); ?>
                                <span>${$(this).data('provider')}</span>
                            </li> 
                            
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo translate('Wallet Address :'); ?>
                                <span>${$(this).data('wallet_address')}</span>
                            </li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo translate('Amount'); ?>
                                <span>${$(this).data('amount')} ${$(this).data('curr')}</span>
                            </li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo translate('Charge'); ?>
                                <span>${$(this).data('charge')} ${$(this).data('curr')}</span>
                            </li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo translate('Final Amount(- charge)'); ?>
                                <span>${$(this).data('total')} ${$(this).data('curr')}</span>
                            </li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo translate('Withdraw Date'); ?>
                                <span>${$(this).data('date')}</span>
                            </li> 
                        </ul>
                        
                
                
                `;

                modal.find('.withdraw-details').html(html);
                modal.modal('show');
            })

            $('.accept').on('click',function(){
                 const modal = $('#accept');

                 modal.find('form').attr('action', $(this).data('url'));
                 modal.modal('show');
            })
            
            $('.reject').on('click',function(){
                 const modal = $('#reject');

                 modal.find('form').attr('action', $(this).data('url'));
                 modal.modal('show');
            })

        })
    
    
    </script>
    
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/withdraw/withdraw_all.blade.php ENDPATH**/ ?>
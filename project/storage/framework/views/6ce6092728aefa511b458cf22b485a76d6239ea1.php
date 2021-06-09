

<?php $__env->startSection('title'); ?>
   <?php echo translate('Manage Staff'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header justify-content-between">
        <h1> <?php echo translate('Manage Staff'); ?></h1>
        <?php if(access('add staff')): ?>
            <a href="javascript:void(0)" data-toggle="modal" data-target="#addModal" class="btn btn-primary add"><i class="fas fa-plus"></i> <?php echo translate('Add New Staff'); ?></a>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <form action="" class="card-header justify-content-end">
                    <div class="row flex-grow-1 flex-sm-grow-0">
                        <div class="col-sm-6 my-2">
                            <select class="form-control" id="" onChange="window.location.href=this.value">
                                <option value="<?php echo e(url('admin/manage/staff'.'?status=all')); ?>" <?php echo e(request('status') == 'all'?'selected':''); ?>><?php echo translate('All'); ?></option>
                                <option value="<?php echo e(url('admin/manage/staff'.'?status=active')); ?>" <?php echo e(request('status') == 'active'?'selected':''); ?>><?php echo translate('Active'); ?></option>
                                <option value="<?php echo e(url('admin/manage/staff'.'?status=banned')); ?>" <?php echo e(request('status') == 'banned'?'selected':''); ?>><?php echo translate('Banned'); ?></option>
                            </select>
                        </div>
                        <div class="col-sm-6 my-2">
                            <div class="input-group has_append ">
                              <input type="text" class="form-control" placeholder="<?php echo translate('email'); ?>" name="search" value="<?php echo e($search ?? ''); ?>"/>
                              <div class="input-group-append">
                                  <button class="input-group-text bg-primary border-0"><i class="fas fa-search text-white"></i></button>
                              </div>
                            </div>
                        </div>
                        
                    </div>
                </form>
   
            <div class="card-body text-center">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th><?php echo translate('Sl'); ?></th>
                            <th><?php echo translate('Name'); ?></th>
                            <th><?php echo translate('Email'); ?></th>
                            <th><?php echo translate('Role'); ?></th>
                            <th><?php echo translate('Status'); ?></th>
                            <th><?php echo translate('Action'); ?></th>
                        </tr>
                        <?php $__empty_1 = true; $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                          
                            <tr>
                                <td data-label="<?php echo translate('Sl'); ?>"><?php echo e($key + $staffs->firstItem()); ?></td>
                    
                                 <td data-label="<?php echo translate('Name'); ?>">
                                   <?php echo e($user->name); ?>

                                 </td>
                                 <td data-label="<?php echo translate('Email'); ?>"><?php echo e($user->email); ?></td>
                                 <td data-label="<?php echo translate('Role'); ?>">
                                     <span class="badge badge-dark"><?php echo e(strtoupper($user->role)); ?></span>
                                 </td>
                                 <td data-label="<?php echo translate('Status'); ?>">
                                    <?php if($user->status == 1): ?>
                                        <span class="badge badge-success"><?php echo translate('active'); ?></span>
                                    <?php elseif($user->status == 2): ?>
                                         <span class="badge badge-danger"><?php echo translate('banned'); ?></span>
                                    <?php endif; ?>
                                 </td>

                                <td data-label="<?php echo translate('Action'); ?>">
                                    <a class="btn btn-primary details" data-staff="<?php echo e($user); ?>" href="javascript:void(0)" data-route="<?php echo e(route('admin.staff.update',$user->id)); ?>"><?php echo translate('Details'); ?></a>
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
            <?php if($staffs->hasPages()): ?>
                <?php echo e($staffs->links('admin.partials.paginate')); ?>

            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal -->
<?php if(access('add staff')): ?>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?php echo e(route('admin.staff.add')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo translate('Add New Staff'); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label><?php echo translate('Name'); ?></label>
                        <input class="form-control" type="text" name="name" required value="<?php echo e(old('name')); ?>">
                    </div>
                    <div class="form-group">
                        <label><?php echo translate('Email'); ?></label>
                        <input class="form-control" type="email" name="email" required value="<?php echo e(old('email')); ?>">
                    </div>
                    <div class="form-group">
                        <label><?php echo translate('Password'); ?></label>
                        <input class="form-control" type="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label><?php echo translate('Confirm Password'); ?></label>
                        <input class="form-control" type="password" name="password_confirmation" required>
                    </div>
                    <div class="append"></div>
                    <div class="form-group">
                        <label><?php echo translate('Select Role'); ?></label>
                        <select name="role" class="form-control">
                            <option value="">Select</option>
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($item); ?>"><?php echo e($item); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo translate('Close'); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo translate('Submit'); ?></button>
                </div>
            </div>
        </form>
    </div>
</div>
    
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        $('.add').on('click',function () { 
            $('#addModal').find('.append').children().remove()
            $('#addModal').find('form')[0].reset();
        })
        $('.details').on('click',function () { 
            $('#addModal').find('.modal-title').text("<?php echo translate('Edit staff'); ?>")
            $('#addModal').find('input[name=name]').val($(this).data('staff').name)
            $('#addModal').find('input[name=email]').val($(this).data('staff').email)
            $('#addModal').find('input[name=password]').attr('required',false)
            $('#addModal').find('input[name=password_confirmation]').attr('required',false)
            $('#addModal').find('select[name=role]').val($(this).data('staff').role)

            $('#addModal').find('.append').html(`
                   <div class="form-group">
                        <label><?php echo translate('Status'); ?></label>
                        <select name="status" class="form-control">
                            <option value="1"><?php echo translate('Active'); ?></option>
                            <option value="2"><?php echo translate('Banned'); ?></option>
                        </select>
                    </div>
            `)
            $(document).find('select[name=status]').val($(this).data('staff').status)
            $('#addModal').find('form').attr('action',$(this).data('route'))
            $('#addModal').modal('show')
        })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/staff/index.blade.php ENDPATH**/ ?>
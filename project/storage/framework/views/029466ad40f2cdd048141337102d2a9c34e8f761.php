
<?php $__env->startSection('title'); ?>
    <?php echo translate('Admin Dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<section class="section">
    <div class="section-header">
        <h1><?php echo translate('Dashboard'); ?></h1>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    
    <?php if(access('dashboard info')): ?>
    <div class="row">
       <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
           <div class="card card-statistic-1">
               <div class="card-icon bg-primary">
                   <i class="far fa-user"></i>
               </div>
               <div class="card-wrap">
                   <div class="card-header">
                       <h4><?php echo translate('Total User'); ?></h4>
                   </div>
                   <div class="card-body">
                      <?php echo e($totalUser); ?>

                   </div>
               </div>
           </div>
       </div>
     
       <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
           <div class="card card-statistic-1">
               <div class="card-icon bg-primary">
                <i class="fas fa-coins"></i>
               </div>
               <div class="card-wrap">
                   <div class="card-header">
                       <h4><?php echo translate('Total Crypto Currency'); ?></h4>
                   </div>
                   <div class="card-body">
                      <?php echo e($totalCrypto); ?>

                   </div>
               </div>
           </div>
       </div>
       <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
           <div class="card card-statistic-1">
               <div class="card-icon bg-primary">
                <i class="fas fa-coins"></i>
               </div>
               <div class="card-wrap">
                   <div class="card-header">
                       <h4><?php echo translate('Total Fiat Currency'); ?></h4>
                   </div>
                   <div class="card-body">
                      <?php echo e($totalFiat); ?>

                   </div>
               </div>
           </div>
       </div>
       <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
           <div class="card card-statistic-1">
               <div class="card-icon bg-primary">
                <i class="fas fa-globe"></i>
               </div>
               <div class="card-wrap">
                   <div class="card-header">
                       <h4><?php echo translate('Total Country'); ?></h4>
                   </div>
                   <div class="card-body">
                      <?php echo e($totalCountry); ?>

                   </div>
               </div>
           </div>
       </div>
       <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
           <div class="card card-statistic-1">
               <div class="card-icon bg-primary">
                <i class="fas fa-user-tag"></i>
               </div>
               <div class="card-wrap">
                   <div class="card-header">
                       <h4><?php echo translate('Total Role'); ?></h4>
                   </div>
                   <div class="card-body">
                      <?php echo e($totalRole); ?>

                   </div>
               </div>
           </div>
       </div>
       <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
           <div class="card card-statistic-1">
               <div class="card-icon bg-primary">
                <i class="far fa-user"></i>
               </div>
               <div class="card-wrap">
                   <div class="card-header">
                       <h4><?php echo translate('Total Staff'); ?></h4>
                   </div>
                   <div class="card-body">
                      <?php echo e($totalStaff); ?>

                   </div>
               </div>
           </div>
       </div>
      
       <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
           <div class="card card-statistic-1">
               <div class="card-icon bg-primary">
                <i class="fas fa-gift"></i>
               </div>
               <div class="card-wrap">
                   <div class="card-header">
                       <h4><?php echo translate('Total Offer'); ?></h4>
                   </div>
                   <div class="card-body">
                    <?php echo e($totalOffer); ?>

                   </div>
               </div>
           </div>
       </div>
       <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
           <div class="card card-statistic-1">
               <div class="card-icon bg-primary">
                <i class="fas fa-bars"></i>
               </div>
               <div class="card-wrap">
                   <div class="card-header">
                       <h4><?php echo translate('Total Trade'); ?></h4>
                   </div>
                   <div class="card-body">
                    <?php echo e($totalTrade); ?>

                   </div>
               </div>
           </div>
       </div>
   </div>

    <div class="row">
        <div class="col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?php echo app('translator')->get('Total Deposit Graph'); ?></h5>
                </div>
                <div class="card-body">
                    <div id="deposit"> </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?php echo app('translator')->get('Total Withdraw Graph'); ?></h5>
                </div>
                <div class="card-body">
                    <div id="withdraw"> </div>
                </div>
            </div>
        </div>

    </div>
   <?php endif; ?>

   <div class="row">
       <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4><?php echo translate('Recent Offers'); ?></h4>
                <a href="<?php echo e(route('admin.trades.all')); ?>" class="btn btn-primary btn-sm"><?php echo translate('See All'); ?> <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="card-body text-center">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th><?php echo translate('Time'); ?></th>
                            <th><?php echo translate('Offer Type'); ?></th>
                            <th><?php echo translate('User'); ?></th>
                            <th><?php echo translate('Trade Duration'); ?></th>
                            <th><?php echo translate('Price Type'); ?></th>
                            <th><?php echo translate('Status'); ?></th>
                            
                        </tr>
                        <?php $__empty_1 = true; $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                 <td data-label="<?php echo translate('Time'); ?>">
                                   <?php echo e($offer->created_at->diffForHumans()); ?>

                                 </td>

                                 <td data-label="<?php echo translate('Offer Type'); ?>"><span class="badge <?php echo e($offer->type == 'buy' ? 'badge-success':'badge-primary'); ?>"><?php echo e(ucfirst($offer->type)); ?></span> <span class="badge badge-info m-1"><?php echo e($offer->crypto->code); ?></span></td>

                                 <td data-label="<?php echo translate('User'); ?>">
                                    <span><?php echo e($offer->user->name); ?></span><br>
                                    <a href="<?php echo e(route('admin.user.details',$offer->user_id)); ?>"><?php echo e($offer->user->email); ?></a>
                                </td>

                                 <td data-label="<?php echo translate('Trade Duration'); ?>"><?php echo e($offer->duration->duration); ?> <?php echo translate('Minutes'); ?></td>

                                 <td data-label="<?php echo translate('Price Type'); ?>">
                                    <?php if($offer->price_type == 1): ?>
                                        <?php if($offer->neg_margin == 1): ?>
                                         <span class="badge badge-info" data-toggle="tooltip" title="<?php echo translate('Buyer/Seller will pay  '.numformat($offer->margin).'% less than market price.'); ?>"><i class="fas fa-arrow-down"></i> <?php echo e(numformat($offer->margin).'% margin'); ?></span>
                                        <?php else: ?>
                                          <span class="badge badge-info"  data-toggle="tooltip" title="<?php echo translate('Buyer/Seller will pay  '); ?><?php echo e(numformat($offer->margin)); ?> <?php echo translate('% more than market price.'); ?>)"><i class="fas fa-arrow-up"></i> <?php echo e(numformat($offer->margin).'% margin'); ?></span>
                                        <?php endif; ?> 
                                    <?php else: ?>
                                         <span class="badge badge-primary"><?php echo e(numformat($offer->fixed_rate)); ?> <?php echo e($offer->fiat->code); ?> <?php echo translate(' (fixed)'); ?></span>
                                    <?php endif; ?>
                                 </td>
                                 <td data-label="<?php echo translate('Status'); ?>">
                                    <?php if($offer->status == 1): ?>
                                        <span class="badge  badge-success"><?php echo translate('Active'); ?></span>
                                     <?php else: ?>
                                        <span class="badge badge-warning"><?php echo translate('Inactive'); ?></span>
                                    <?php endif; ?>
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
           
        </div>
       </div>
       
   </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
   <script src="<?php echo e(asset('assets/admin/js/apexcharts.min.js')); ?>"></script>
    <script>
        'use strict';
        var options = {
                series: [{
                    name: '<?php echo translate('Total Deposit'); ?>',
                    data: <?php echo json_encode($depositAmount, 15, 512) ?>
                },],
                chart: {
                    type: 'bar',
                    height: 400,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '50%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: true
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories:<?php echo json_encode($curr, 15, 512) ?>,
                },
                yaxis: {
                    title: {
                        text: "",
                        style: {
                            color: '#00e396'
                        }
                    }
                },
                grid: {
                    xaxis: {
                        lines: {
                            show: false
                        }
                    },
                    yaxis: {
                        lines: {
                            show: false
                        }
                    },
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return "" + val + " "
                        }
                    }
                }
            };
            var chart = new ApexCharts(document.querySelector("#deposit"), options);
            chart.render();
    </script>
    <script>
        'use strict';
        var options = {
                series: [{
                    name: 'Total Withdraw',
                    data: <?php echo json_encode($withdrawAmount, 15, 512) ?>
                },],
                chart: {
                    type: 'bar',
                    height: 400,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '50%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: true
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories:<?php echo json_encode($curr, 15, 512) ?>,
                },
                yaxis: {
                    title: {
                        text: "",
                        style: {
                            color: '#E83A14'
                        }
                    }
                },
                grid: {
                    xaxis: {
                        lines: {
                            show: false
                        }
                    },
                    yaxis: {
                        lines: {
                            show: false
                        }
                    },
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return "" + val + " "
                        }
                    }
                }
            };
            var chart = new ApexCharts(document.querySelector("#withdraw"), options);
            chart.render();
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>
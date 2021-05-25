@extends('layouts.admin')
@section('title')
    @langg('Admin Dashboard')
@endsection
@section('breadcrumb')
<section class="section">
    <div class="section-header">
        <h1>@langg('Dashboard')</h1>
    </div>
</section>
@endsection
@section('content')
    
    @if (access('dashboard info'))
    <div class="row">
       <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
           <div class="card card-statistic-1">
               <div class="card-icon bg-primary">
                   <i class="far fa-user"></i>
               </div>
               <div class="card-wrap">
                   <div class="card-header">
                       <h4>@langg('Total User')</h4>
                   </div>
                   <div class="card-body">
                      {{$totalUser}}
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
                       <h4>@langg('Total Crypto Currency')</h4>
                   </div>
                   <div class="card-body">
                      {{$totalCrypto}}
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
                       <h4>@langg('Total Fiat Currency')</h4>
                   </div>
                   <div class="card-body">
                      {{$totalFiat}}
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
                       <h4>@langg('Total Country')</h4>
                   </div>
                   <div class="card-body">
                      {{$totalCountry}}
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
                       <h4>@langg('Total Role')</h4>
                   </div>
                   <div class="card-body">
                      {{$totalRole}}
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
                       <h4>@langg('Total Staff')</h4>
                   </div>
                   <div class="card-body">
                      {{$totalStaff}}
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
                       <h4>@langg('Total Offer')</h4>
                   </div>
                   <div class="card-body">
                    {{$totalOffer}}
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
                       <h4>@langg('Total Trade')</h4>
                   </div>
                   <div class="card-body">
                    {{$totalTrade}}
                   </div>
               </div>
           </div>
       </div>
   </div>

    <div class="row">
        <div class="col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">@lang('Total Deposit Graph')</h5>
                </div>
                <div class="card-body">
                    <div id="deposit"> </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">@lang('Total Withdraw Graph')</h5>
                </div>
                <div class="card-body">
                    <div id="withdraw"> </div>
                </div>
            </div>
        </div>

    </div>
   @endif

   <div class="row">
       <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>@langg('Recent Offers')</h4>
                <a href="{{route('admin.trades.all')}}" class="btn btn-primary btn-sm">@langg('See All') <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="card-body text-center">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>@langg('Time')</th>
                            <th>@langg('Offer Type')</th>
                            <th>@langg('User')</th>
                            <th>@langg('Trade Duration')</th>
                            <th>@langg('Price Type')</th>
                            <th>@langg('Status')</th>
                            
                        </tr>
                        @forelse ($offers as $offer)
                            <tr>
                                 <td data-label="@langg('Time')">
                                   {{$offer->created_at->diffForHumans()}}
                                 </td>

                                 <td data-label="@langg('Offer Type')"><span class="badge {{$offer->type == 'buy' ? 'badge-success':'badge-primary'}}">{{ucfirst($offer->type)}}</span> <span class="badge badge-info m-1">{{$offer->crypto->code}}</span></td>

                                 <td data-label="@langg('User')">
                                    <span>{{$offer->user->name}}</span><br>
                                    <a href="{{route('admin.user.details',$offer->user_id)}}">{{$offer->user->email}}</a>
                                </td>

                                 <td data-label="@langg('Trade Duration')">{{$offer->duration->duration}} @langg('Minutes')</td>

                                 <td data-label="@langg('Price Type')">
                                    @if($offer->price_type == 1)
                                        @if ($offer->neg_margin == 1)
                                         <span class="badge badge-info" data-toggle="tooltip" title="@langg('Buyer/Seller will pay  '.numformat($offer->margin).'% less than market price.')"><i class="fas fa-arrow-down"></i> {{numformat($offer->margin).'% margin'}}</span>
                                        @else
                                          <span class="badge badge-info"  data-toggle="tooltip" title="@langg('Buyer/Seller will pay  '){{numformat($offer->margin)}} @langg('% more than market price.'))"><i class="fas fa-arrow-up"></i> {{numformat($offer->margin).'% margin'}}</span>
                                        @endif 
                                    @else
                                         <span class="badge badge-primary">{{numformat($offer->fixed_rate)}} {{$offer->fiat->code}} @langg(' (fixed)')</span>
                                    @endif
                                 </td>
                                 <td data-label="@langg('Status')">
                                    @if($offer->status == 1)
                                        <span class="badge  badge-success">@langg('Active')</span>
                                     @else
                                        <span class="badge badge-warning">@langg('Inactive')</span>
                                    @endif
                                 </td>
                               
                               
                            </tr>
                         @empty

                            <tr>
                                <td class="text-center" colspan="100%">@langg('No Data Found')</td>
                            </tr>

                        @endforelse
                    </table>
                </div>
            </div>
           
        </div>
       </div>
       
   </div>

@endsection

@push('script')
   <script src="{{asset('assets/admin/js/apexcharts.min.js')}}"></script>
    <script>
        'use strict';
        var options = {
                series: [{
                    name: '@langg('Total Deposit')',
                    data: @json($depositAmount)
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
                    categories:@json($curr),
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
                    data: @json($withdrawAmount)
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
                    categories:@json($curr),
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
@endpush
@extends('layouts.admin')
@section('title')
    @if (request()->routeIs('admin.withdraw.pending'))
         @langg('Pending Withdraws')
    @elseif (request()->routeIs('admin.withdraw.accepted'))
          @langg('Accepted Withdraws')
    @else
          @langg('Rejected Withdraws')
    @endif
@endsection
@section('breadcrumb')
 <section class="section">
        <div class="section-header">
            @if (request()->routeIs('admin.withdraw.pending'))
            <h1>@langg('Pending Withdraws')</h1>
            @elseif (request()->routeIs('admin.withdraw.accepted'))
            <h1>@langg('Accepted Withdraws')</h1>
            @else
                <h1>@langg('Rejected Withdraws')</h1>
            @endif
        </div>
</section>
@endsection
@section('content')

    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
               
                <div class="card-body text-center">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>@langg('Sl')</th>
                                <th>@langg('User')</th>
                                <th>@langg('Withdraw Amount')</th>
                                <th>@langg('Charge')</th>
                                <th>@langg('status')</th>
                                <th>@langg('Action')</th>
                            </tr>
                            @forelse ($withdrawlogs as $key => $withdrawlog)
                                <tr>
                                    <td data-label="@langg('Sl')">{{$key + $withdrawlogs->firstItem()}}</td>
                        
                                    <td data-label="@langg('User')">
                                        {{$withdrawlog->user ? $withdrawlog->user->email.'(user)' : $withdrawlog->merchant->email.' (merchant)'}}
                                     </td>
                                    <td data-label="@langg('Withdraw Amount')">{{ __(amount($withdrawlog->amount,$withdrawlog->currency->type,2).' '.$withdrawlog->currency->code) }}</td>
                               
                                    <td data-label="@langg('Charge')">
                                       {{amount($withdrawlog->charge,$withdrawlog->currency->type,2)}}
                                    </td> 
                                

                                    <td data-label="@langg('status')">

                                        @if($withdrawlog->status == 1)
                                            <span class="badge badge-success">@langg('Accepted')</span>
                                        @elseif($withdrawlog->status == 2)
                                             <span class="badge badge-danger">@langg('Rejected')</span>
                                        @else
                                            <span class="badge badge-warning">@langg('Pending')</span>
                                        @endif
                                    </td>

                                    <td data-label="@langg('Action')">
                                    
                                        <div class="d-flex flex-wrap align-items-center justify-content-end justify-content-lg-center">
                                            <button class="btn btn-info details m-1"  
                                                data-transaction="{{$withdrawlog->trx}}" 
                                                data-provider="{{$withdrawlog->user->email }}"  
                                                data-date = "{{ __($withdrawlog->created_at->format('d F Y')) }}"
                                                data-amount = {{numFormat($withdrawlog->amount,8)}}
                                                data-charge = {{numFormat($withdrawlog->charge,8)}}
                                                data-total = {{numFormat($withdrawlog->charge,8)}}
                                                data-wallet_address = {{$withdrawlog->wallet_address}}
                                                data-curr = {{$withdrawlog->currency->code}}
                                            
                                            >
                                            @langg('Details')</button>

                                            @if($withdrawlog->status == 0)
                                                <button class="btn btn-primary accept m-1" data-url="{{route('admin.withdraw.accept', $withdrawlog)}}" >@langg('Accept')</button>
                                            
                                                <button class="btn btn-danger reject m-1" data-url="{{route('admin.withdraw.reject',$withdrawlog)}}">@langg('Reject')</button>
                                            @endif
                                        </div>
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
                @if ($withdrawlogs->hasPages())
                <div class="card-footer">
                    {{ $withdrawlogs->links('admin.partials.paginate') }}
                </div>
                @endif
            </div>
        </div>
    </div>


    
    <!-- Modal -->
    <div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

           
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">@langg('Withdraw Details')</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                    </div>
                <div class="modal-body">
                    <div class="container-fluid withdraw-details">
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">@langg('Close')</button>
                    
                </div>
            </div>
           
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="accept" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">

           <form action="" method="post">
           @csrf
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">@langg('Withdraw Accept')</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <p>@langg('Are you sure to Accept this withdraw request')?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">@langg('Close')</button>
                    <button type="submit" class="btn btn-primary" >@langg('Accept')</button>
                    
                </div>
            </div>
           </form>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

           <form action="" method="post">
           @csrf
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">@langg('Withdraw Reject')</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group col-md-12">

                            <label for="">@langg('Reason Of Reject')</label>
                            <textarea name="reason_of_reject" id="" cols="30" rows="10" class="form-control"> </textarea>
                        
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">@langg('Close')</button>
                    <button type="submit" class="btn btn-danger" >@langg('Reject')</button>
                    
                </div>
            </div>
           </form>
        </div>
    </div>
    


@endsection


@push('script')

    <script>
    
        $(function(){
            'use strict';

            $('.details').on('click',function(){
                const modal = $('#details');

                let html = `
                
                    <ul class="list-group">
                           
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @langg('Transaction Id')
                                <span>${$(this).data('transaction')}</span>
                            </li>  
                            
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @langg('User Name')
                                <span>${$(this).data('provider')}</span>
                            </li> 
                            
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @langg('Wallet Address :')
                                <span>${$(this).data('wallet_address')}</span>
                            </li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @langg('Amount')
                                <span>${$(this).data('amount')} ${$(this).data('curr')}</span>
                            </li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @langg('Charge')
                                <span>${$(this).data('charge')} ${$(this).data('curr')}</span>
                            </li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @langg('Final Amount(- charge)')
                                <span>${$(this).data('total')} ${$(this).data('curr')}</span>
                            </li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @langg('Withdraw Date')
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
    
@endpush


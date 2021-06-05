@extends('layouts.user')

@section('title')
   @langg('Withdraw History')
@endsection

@section('content')

        <div class="dashboard--content-item">
       
             
            <div class="table-responsive table--mobile-lg">
                <table class="table crypto-offer-table bg--body">
                    <thead>
                        <tr>
                            <th>@langg('Transaction ID')</th>
                            <th>@langg('Amount')</th>
                            <th>@langg('Fees')</th>
                            <th>@langg('Total Amount')</th>
                            <th>@langg('Withdraw Address')</th>
                            <th>@langg('Status')</th>
                            <th>@langg('Date')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($withdrawals as $item)
                        <tr>
                            <td data-label="@langg('Transaction')"><div>{{$item->trx}}</div></td>
                            <td data-label="@langg('Amount')"><div>{{numFormat($item->amount,8)}} {{$item->currency->code}}</div></td>
                            <td data-label="@langg('Charge')"><div>{{numFormat($item->charge,8)}} {{$item->currency->code}}</div></td>
                            <td data-label="@langg('Total Amount')"><div>
                                {{numFormat($item->total_amount,8)}} {{$item->currency->code}}</div></td>
                            <td data-label="@langg('Withdraw Address')"><div>{{$item->wallet_address}}</div></td>
                            <td data-label="@langg('Status')">

                                @if($item->status == 1)
                                    <span class="badge bg-success">@langg('Accepted')</span>
                                @elseif($item->status == 2)
                                     <span class="badge bg-danger">@langg('Rejected')</span>
                                     <button class="badge bg-secondary reason" data-bs-toggle="modal" data-bs-target="#modal-team" data-reason="{{$item->reject_reason}}"><i class="fas fa-info"></i></button>
                                @else
                                    <span class="badge bg-warning">@langg('Pending')</span>

                                @endif
                            </td>
                            <td data-label="@langg('Date')"><div>{{dateFormat($item->created_at)}}</div></td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="12">@langg('No data found!')</td>
                        </tr>
                     @endforelse
                    </tbody>
                </table>
            </div>
            {{$withdrawals->links()}}
        </div>


    <div class="modal modal-blur fade" id="modal-team" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">@langg('Reject Reason')</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div>
                <textarea class="form-control reject-reason" rows="5" disabled></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn ms-auto" data-bs-dismiss="modal">@langg('Close')</button>
             
            </div>
          </div>
        </div>
      </div>
@endsection

@push('script')
    <script>
        'use strict';
        $('.reason').on('click',function() { 
            $('#modal-team').find('.reject-reason').val($(this).data('reason'))
            $('#modal-team').modal('show')
        })
    </script>
@endpush
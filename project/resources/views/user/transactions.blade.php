@extends('layouts.user')

@section('title')
   @langg('Transactions')
@endsection


@section('content')
    <div class="dashboard--content-item">
      <form action="" class="d-flex justify-content-end mb-3">
        <div class="form-group">
          <div class="input-group">
              <input type="text" class="form-control shadow-none" value="{{$search ?? ''}}" name="search" placeholder="@langg('Transaction ID')">
                  <button class="input-group-text btn btn-primary text-white" id="my-addon"><i class="fas fa-search"></i>
                  </button>
          </div>
        </div>
     </form>
      <div class="table-responsive table--mobile-lg">
        <table class="table crypto-offer-table bg--body">
            <thead>
              <tr>
                <th>@langg('Date')</th>
                <th>@langg('Transaction ID')</th>
                <th>@langg('Remark')</th>
                <th>@langg('Amount')</th>
                <th>@langg('Details')</th>
              </tr>
            </thead>
            <tbody>
              @forelse($transactions as $item)
                <tr>
                  <td data-label="@langg('Date')"><div>{{dateFormat($item->created_at,'d-M-Y')}}</div></td>
                  <td data-label="@langg('Transaction ID')">
                    <div>{{translate($item->trnx)}}</div>
                  </td>
                  <td data-label="@langg('Remark')">
                    <span class="badge bg-dark">{{ucwords(str_replace('_',' ',$item->remark))}}</span>
                  </td>
                  <td data-label="@langg('Amount')">
                      <span class="{{$item->type == '+' ? 'text-success':'text-danger'}}">{{$item->type}} {{numFormat($item->amount,8)}} {{$item->currency->code}}</span> 
                  </td>
                  <td data-label="@langg('Details')">
                      <div><button class="btn btn--success btn-sm details" data-data="{{$item}}">@langg('Details')</button></div>
                  </td>
                </tr>
              @empty
              <tr><td class="text-center" colspan="12">@langg('No data found!')</td></tr>
              @endforelse
            </tbody>
          </table>
      </div>
        @if ($transactions->hasPages())
            
          {{$transactions->links()}}
           
        @endif
    </div>

    <div class="modal modal-blur fade" id="modal-success" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center py-4">
              <i  class="fas fa-info-circle fa-3x mb-2"></i>
              <h5 class="mb-2">@langg('Transaction Details')</h5>
              <p class="trx_details"></p>
              <ul class="list-group mt-2">
                
              </ul>
            </div>
            <div class="modal-footer">
            <div class="w-100">
                <div class="row">
                <div class="col"><a href="#" class="btn btn--base w-100" data-bs-dismiss="modal">
                    @langg('Close')
                    </a></div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
      'use strict';
   
      $('.details').on('click',function () { 
        var url = "{{url('user/transaction/details/')}}"+'/'+$(this).data('data').id
        $('.trx_details').text($(this).data('data').details)
        $.get(url,function (res) { 
          if(res == 'empty'){
            $('.list-group').html('<p>@langg('No details found!')</p>')
          }else{
            $('.list-group').html(res)
          }
          $('#modal-success').modal('show')
        })
      })
    </script>
@endpush
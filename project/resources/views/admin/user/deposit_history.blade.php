@extends('layouts.admin')

@section('title')
   @langg('Deposit History')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header">
        <h1>@langg('Deposit History : ') {{$user->name}}</h1>
    </div>
</section>
@endsection

@section('content')
        
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-end">
                <form action="" class="d-flex flex-wrap justify-content-end align-items-center">
                     <div class="form-group m-1 flex-grow-1">
                         <div class="input-group">
                             <input type="text" class="form-control" name="search" value="{{$search ?? ''}}" placeholder="@langg('Transaction ID')">
                             <div class="input-group-append">
                                 <button class="input-group-text btn btn-primary text-white" id="my-addon"><i class="fas fa-search"></i></button>
                             </div>
                         </div>
                     </div>
                </form>
            </div>
            <div class="card-body text-center">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>@langg('Transaction ID')</th>
                            <th>@langg('User')</th>
                            <th>@langg('Amount(With Charge)')</th>
                            <th>@langg('Charge')</th>
                            <th>@langg('Coinpayment Txn')</th>
                            <th>@langg('Date')</th>
                           
                        </tr>
                        @forelse ($deposits as $info)
                            <tr>

                                 <td data-label="@langg('Transaction ID')">
                                   {{$info->tnx}}
                                 </td>
                                 <td data-label="@langg('User')">{{$info->user->email}}</td>

                                 <td data-label="@langg('Charge')">{{numFormat($info->charge,8)}} {{$info->currency->code}}</td>

                                 <td data-label="@langg('Amount')">{{numFormat($info->total_amount,8)}} {{$info->currency->code}}</td>
                                 
                                 <td data-label="@langg('Coinpayment Txn')">
                                   {{$info->coinpayment_tnx}}
                                   
                                 </td>
                                 <td data-label="@langg('Date')">
                                   {{dateFormat($info->created_at)}}
                                   
                                 </td>

                                
                            </tr>
                         @empty

                            <tr>
                                <td class="text-center" colspan="100%">@langg('No Data Found')</td>
                            </tr>

                        @endforelse
                    </table>
                </div>
                @if($deposits->hasPages())
                <div class="card-footer">
                    {{ $deposits->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>


@endsection

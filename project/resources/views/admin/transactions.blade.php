@extends('layouts.admin')

@section('title')
   @langg('Transactions')
@endsection

@section('breadcrumb')
<section class="section">
    <div class="section-header">
        <h1> @langg('Transactions')</h1>
    </div>
</section>
 
@endsection

@section('content')
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header d-flex justify-content-end">
                    <form action="" class="d-flex flex-wrap justify-content-end">
                        <div class="form-group m-1 flex-grow-1">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="@langg('Transaction ID')">
                                <div class="input-group-append">
                                    <button class="input-group-text btn btn-primary text-white" id="my-addon"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                       </form>
                  </div>
                 
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>@langg('Date')</th>
                          <th>@langg('Transaction ID')</th>
                          <th>@langg('Description')</th>
                          <th>@langg('Remark')</th>
                          <th>@langg('Amount')</th>
                          <th>@langg('Charge')</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($transactions as $item)
                          <tr>
                            <td data-label="@langg('Date')">{{dateFormat($item->created_at,'d-M-Y')}}</td>
                            <td data-label="@langg('Transaction ID')">
                              {{translate($item->trnx)}}
                            </td>
                            <td data-label="@langg('Description')">
                              {{translate($item->details)}}
                            </td>
                            <td data-label="@langg('Remark')">
                              <span class="badge badge-dark">{{ucwords(str_replace('_',' ',$item->remark))}}</span>
                            </td>
                            <td data-label="@langg('Amount')">
                                <span class="{{$item->type == '+' ? 'text-success':'text-danger'}}">{{$item->type}} {{amount($item->amount,$item->currency->type,2)}} {{$item->currency->code}}</span> 
                            </td>
                           <td data-label="@langg('Charge')">
                            {{amount($item->charge,$item->currency->type,2)}} {{$item->currency->code}}
                           </td>
                          </tr>
                        @empty
                        <tr><td class="text-center" colspan="12">@langg('No data found!')</td></tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                  @if ($transactions->hasPages())
                      <div class="card-footer">
                          {{$transactions->links('admin.partials.paginate')}}
                      </div>
                  @endif
                </div>
            </div>
        </div>
    </div>

   
@endsection

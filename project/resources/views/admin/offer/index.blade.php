@extends('layouts.admin')

@section('title')
   @langg('Manage Offers')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header justify-content-between">
        <h1> @langg('Manage Offers')</h1>
        <form action="">
            <select class="form-control" id="" onChange="window.location.href=this.value">
                <option value="{{url('admin/manage-offers/'.'?type=')}}" {{request('type') == 'all'?'selected':''}}>@langg('All')</option>
                <option value="{{url('admin/manage-offers/'.'?type=buy')}}" {{request('type') == 'buy'?'selected':''}}>@langg('Buy')</option>
                <option value="{{url('admin/manage-offers/'.'?type=sell')}}" {{request('type') == 'sell'?'selected':''}}>@langg('Sell')</option>
            </select>
          </form>
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
                            <th>@langg('Time')</th>
                            <th>@langg('Offer Type')</th>
                            <th>@langg('User')</th>
                            <th>@langg('Trade Duration')</th>
                            <th>@langg('Price Type')</th>
                            <th>@langg('Status')</th>
                            <th>@langg('Action')</th>
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
                               
                                 <td data-label="@langg('Action')">
                                     <a class="btn btn-primary btn-sm details m-1" data-id="{{$offer->id}}" href="javascript:void(0)">@langg('Details')</a>
                                    @if ($offer->status == 1)
                                    <a class="btn btn-danger btn-sm status m-1" data-id="{{$offer->id}}" href="javascript:void(0)">@langg('Inactive')</a>
                                    @else
                                    <a class="btn btn-success btn-sm status m-1" data-id="{{$offer->id}}" href="javascript:void(0)">@langg('Active')</a>
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
            @if ($offers->hasPages())
                {{ $offers->links('admin.partials.paginate') }}
            @endif
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="modal-success" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
     <div class="modal-content">
        <div class="modal-header bg-primary border-bottom">
            <h4 class="modal-title text-white">@langg('Offer Details')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
         </div>
        <div class="modal-body text-center py-4">
            <ul class="list-group mt-2"></ul>
        </div>
          
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="status" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('admin.manage.offer.status')}}" method="POST">
            @csrf
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-body text-center py-4">
                   <h5 class="msg">@langg('Are you sure to change status?')</h5>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">@langg('Close')</button>
                    <button type="submit" class="btn btn-primary">@langg('Confirm')</button>
                </div>
            </div>
        </form>
    </div>
</div>



@endsection

@push('script')
    <script>
      'use strict';
   
      $('.details').on('click',function () { 
        var url = "{{url('admin/offer/details/')}}"+'/'+$(this).data('id')
        $.get(url,function (res) { 
          if(res == 'empty'){
            $('.list-group').html('<p>@langg('No details found!')</p>')
          }else{
            $('.list-group').html(res)
          }
          $('#modal-success').modal('show')
        })
      })
      $('.status').on('click',function () { 
         const id = $(this).data('id')
        $('#status').find('input[name=id]').val(id)
        $('#status').modal('show')
         
      })
    </script>
@endpush
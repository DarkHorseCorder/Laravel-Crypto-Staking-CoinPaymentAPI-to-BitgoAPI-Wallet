@extends('layouts.admin')

@section('title')
   @lang('Trade Details')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header">
        <h1>@lang('Trade Details : ') {{$trade->trade_code}}</h1>
    </div>
</section>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between flex-wrap">
                    <h6>@langg('Trade Details')</h6>
                    <div class="d-flex justify-content-between">
                        @if ($trade->status != 3)
                        <a href="javascript:void(0)" data-trade_code="{{$trade->trade_code}}" data-route="{{route('admin.trade.release')}}" class="btn btn-success btn-sm m-1 action">@langg('Release') {{$trade->crypto->code}}</a>
                        @endif

                        @if ($trade->status != 3 && $trade->status != 5)
                        <a href="javascript:void(0)" data-trade_code="{{$trade->trade_code}}" data-route="{{route('admin.trade.refund')}}" class="btn btn-primary btn-sm m-1 action">@langg('Refund') {{$trade->crypto->code}}</a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">@langg('Offer Type :')<span class="badge badge-success">{{ucfirst($trade->offer->type)}}</span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">@langg('Status')
                            @if ($trade->status == 0)
                            <span class="badge badge-warning text-white">
                                @langg('Trade Escrowed')
                            </span>
                            @elseif($trade->status == 1)
                            <span class="badge badge-primary">
                                @langg('Paid')
                            </span>
                            @elseif($trade->status == 2)
                            <span class="badge badge-danger">
                                @langg('Canceled')
                            </span>
                            @elseif($trade->status == 3)
                            <span class="badge badge-success">
                                @langg('Compleled/Released')
                            </span>
                            @elseif($trade->status == 4)
                            <span class="badge badge-info">
                                @langg('Disputed')
                            </span>
                            @endif
                        
                        </li>

                        <li class="list-group-item d-flex justify-content-between">@langg('Offer Owner :')<span>{{$trade->offerOwner->name}}</span></li>
                        <li class="list-group-item d-flex justify-content-between">@langg('Requested By :')<span>{{$trade->trader->name}}</span></li>
                        <li class="list-group-item d-flex justify-content-between">@langg('Crypto Amount :')<span>{{numFormat($trade->crypto_amount,8)}} {{$trade->crypto->code}}</span></li>
                        <li class="list-group-item d-flex justify-content-between">@langg('Fiat Amount :')<span>{{amount($trade->fiat_amount)}} {{$trade->fiat->code}}</span></li>
                        <li class="list-group-item d-flex justify-content-between">@langg('Trade Duration')<span>{{$trade->trade_duration}} @langg('Minutes')</span></li>
                    </ul>
                   
                    <hr>

                    <p class="text-right">
                        <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#offer-terms" aria-expanded="false" aria-controls="collapseExample">
                            @langg('Offer Terms')
                        </button>

                        <button class="btn btn-info collapsed" type="button" data-toggle="collapse" data-target="#trade-ins" aria-expanded="false" aria-controls="collapseExample">
                            @langg('Trade Instructions')
                        </button>
                    </p>
                    <div class="collapse" id="offer-terms" style="">
                        <p>
                            {{$trade->offer->offer_terms}}
                        </p>
                    </div>
                    <hr>
                    <div class="collapse" id="trade-ins" style="">
                        <p>
                            {{$trade->offer->trade_instructions}}
                        </p>
                    </div>
                      
                      
                </div>

            </div>
            
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show fade active" id="c1">
                            <div class="chat__msg">
                                <div class="chat__msg-header">
                                    <div class="post__creator align-items-center">
                                        <div class="post__creator-content">
                                            <h5 class="name d-inline-block">@langg('Trade Chat') </h5>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="chat__msg-body">
                                    <ul class="msg__wrapper mt-3">
                                            @forelse ($messages as $item)
                                                @if ($item->admin_id == null)
                                                <li class="incoming__msg">
                                                    <div class="msg__item">
                                                        <div class="post__creator">
                                                            <div class="post__creator-content">
                                                                
                                                                @if ($item->message)
                                                                 <p><small class="font-weight-bold text-primary">{{$item->user->name}} : </small> <br> {{$item->message}}</p>
                                                                @endif
                                                                @if ($item->file)
                                                                    <div class="text-start">
                                                                        <a href="{{asset('assets/ticket/'.$item->file)}}" download="">{{$item->file}}</a>
                                                                    </div>
                                                                    @endif
                                                                <span class="comment-date text--secondary">{{diffTime($item->created_at)}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                @else
                                                <li class="outgoing__msg">
                                                    <div class="msg__item">
                                                        <div class="post__creator">
                                                            <div class="post__creator-content">
                                                               
                                                                @if ($item->message)
                                                                 <p class="out__msg">{{$item->message}}</p>
                                                                @endif
                                                                @if ($item->file)
                                                                    <div class="text-end ms-auto">
                                                                        <a href="{{asset('assets/ticket/'.$item->file)}}" download="">{{$item->file}}</a>
                                                                    </div>
                                                                @endif
                                                                <span class="comment-date text--secondary">{{diffTime($item->created_at)}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endif
                                            @empty
                                            <li class="incoming__msg">
                                                <div class="msg__item">
                                                    <div class="post__creator">
                                                        <div class="post__creator-content">
                                                            <h6 class="text-center">@langg('No messages yet!!')</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforelse
                                       
                                    </ul>
                                </div>
                                @if ($trade->status != 3 && $trade->status != 2)
                                    <div class="chat__msg-footer">
                                        <form action="{{route('admin.trade.submit.chat')}}" class="send__msg" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="trade_id" value="{{$trade->id}}">
                                            <div class="input-group">
                                                <input id="upload-file" type="file" name="file" class="form-control d-none">
                                                <label class="-formlabel upload-file" for="upload-file"><i class="fas fa-paperclip"></i>
                                            </div>
                                            <div class="input-group">
                                                <textarea class="form-control form--control" name="message"></textarea>
                                                <button class="border-0 outline-0 send-btn" type="submit"><i class="fab fa-telegram-plane"></i></button>
                                            </div>
                                        </form>
                                        <small class="files mt-2 text-primary"></small>
                                    </div>
                                @endif
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>


    <div class="modal fade" id="actionModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="POST">
                @csrf
                <input type="hidden" name="trade_code">
                <div class="modal-content">
                    <div class="modal-body p-4">
                       <h5 class="text-center">@langg('Are you sure about this action ?')</h5>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">@langg('Cancel')</button>
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
        $("#upload-file").on('change', function () {
             $('.files').text('File : '+this.files[0].name) ;
        });

        $('.action').on('click',function () { 
            const code = $(this).data('trade_code')
            const route = $(this).data('route')

            $('#actionModal').find('input[name=trade_code]').val(code)
            $('#actionModal').find('form').attr('action',route)
            $('#actionModal').modal('show')
        })
    </script>
@endpush
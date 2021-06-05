<div class="col-xl-6 col-xxl-7">
    <div class="chat-wrapper bg--body">
        <div class="chat-wrapper-header d-flex align-items-center justify-content-between">
            @if ($trade->trader_id == auth()->id())
                <a href="javascript:void(0)" class="table-buyer ms-0 user_info" data-img="{{getPhoto($trade->offerOwner->photo)}}" data-trade_count="{{$trade->offerOwner->completedTrade()}}" data-info="{{$trade->offerOwner}}">
                    <img src="{{getPhoto($trade->offerOwner->photo)}}" alt="clients">
                    <h6 class="m-0 subtitle text--white">{{$trade->offerOwner->username}}</h6>
                    <small class="badge badge--base badge-sm ms-2"><i class="fas fa-info"></i></small>
                </a>
            @else
                <a href="javascript:void(0)" class="table-buyer ms-0 user_info" data-img="{{getPhoto($trade->trader->photo)}}" data-trade_count="{{$trade->trader->completedTrade()}}" data-info="{{$trade->trader}}">
                    <img src="{{getPhoto($trade->trader->photo)}}" alt="clients">
                    <h6 class="m-0 subtitle text--white">{{$trade->trader->username}}</h6>
                    <small class="badge badge--base badge-sm ms-2"><i class="fas fa-info"></i></small>
                </a>
            @endif
            @if($trade->status != 2 && $trade->status != 3) 
            <a href="javascript:void(0)" class="btn btn--success me-1 reload btn-sm">@langg('Reload Chat')</a>
            @endif

            @php
                $lastTime = Carbon\Carbon::parse($trade->created_at)->addMinutes($trade->trade_duration);
            @endphp
            
            @if($trade->offer->type == 'sell')
                @if ($trade->trader_id == auth()->id())
                    @if($trade->status == 1 && $trade->status != 4) 
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#disputeModal"  class="btn btn--base btn-sm">@langg('Start Dispute')</a>
                    @else
                        <a href="javascript:void(0)" class="btn btn--base disabled btn-sm">@langg('Start Dispute')</a>
                    @endif
                @elseif($trade->offer_user_id == auth()->id())
                   @if ($lastTime <= Carbon\Carbon::now() && $trade->status != 4)
                     <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#disputeModal"  class="btn btn--base btn-sm">@langg('Start Dispute')</a>
                    @else
                     <a href="javascript:void(0)" class="btn btn--base disabled btn-sm">@langg('Start Dispute')</a>
                   @endif
                @endif
            @endif


          
        </div>
        <div class="chat-wrapper-body border-bottom-0" id="load">
            <ul class="create-chat-context" id="messages">
                @foreach ($messages as $message)
                 @if ($message->user_id && $message->user_id != auth()->id())
                     <li>
                         <div class="incoming__msg">
                             <div class="opponent__img">
                                 <img src="{{getPhoto($message->user->photo)}}" alt="client">
                             </div>
                             <div class="message__content">
                                 <p>
                                 {{$message->message}}
                                 </p>
                                 @if ($message->file)
                                     <a href="{{asset('assets/images/'.$message->file)}}" class="attachments--img m-1"
                                         data-lightbox>
                                         <img src="{{getPhoto($message->file)}}" alt="clients">
                                     </a>
                                 @endif
                                 <small class="mt-2">{{diffTime($message->created_at)}}</small>
                             </div>
                         </div>
                     </li>
                 @endif

                 @if ($message->user_id && $message->user_id == auth()->id())
                     <li>
                         <div class="outgoing__msg">
                             <div class="opponent__img">
                                 <img src="{{getPhoto($message->user->photo)}}" alt="client">
                             </div>
                             <div class="message__content">
                                 <p>
                                     {{$message->message}}
                                 </p>
                                 @if ($message->file)
                                     <a href="{{asset('assets/images/'.$message->file)}}" class="attachments--img m-1"
                                         data-lightbox>
                                         <img src="{{getPhoto($message->file)}}" alt="clients">
                                     </a>
                                 @endif
                                 <small class="mt-2">{{diffTime($message->created_at)}}</small>
                             </div>
                         </div>
                     </li>
                  @endif
                 
                    @if ($message->admin_id)
                    <li>
                        <div class="incoming__msg">
                            <div class="opponent__img">
                                <img src="{{getPhoto($message->admin->photo)}}" alt="client">
                            </div>
                            <div class="message__content">
                                <b>@langg('Moderator : ')</b>
                                <p>
                                {{$message->message}}
                                </p>
                                @if ($message->file)
                                    <a href="{{asset('assets/images/'.$message->file)}}" class="attachments--img p-2"
                                        data-lightbox>
                                        <img src="{{getPhoto($message->file)}}" alt="clients">
                                    </a>
                                @endif
                                <small class="mt-2">{{diffTime($message->created_at)}}</small>
                            </div>
                        </div>
                    </li>
                    @endif
                @endforeach
             </ul>
           </div>
           <div class="chat-wrapper-body pt-0">
                @if ($trade->status != 2 && $trade->status != 3)
                <form action="{{route('user.submit.trade.chat')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="trade_id" value="{{$trade->id}}">
                    <div class="position-relative">
                        <textarea class="form-control pb-5" name="message" placeholder="@lang('Write Message')"></textarea>
                        <label class="message--file">
                            <i class="fas fa-paperclip"></i>
                            <input type="file" name="file" class="imageUpload" accept="image/*" hidden>
                        </label>
                        
                        <button type="submit" class="btn btn--base send--btn"><i class="fas fa-paper-plane"></i></button>
                    </div>
                    <small class="files mt-2 text--base"></small>
                </form>
                @endif
           </div>
        </div>
</div>

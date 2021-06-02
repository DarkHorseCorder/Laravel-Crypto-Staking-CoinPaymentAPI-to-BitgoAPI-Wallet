@extends('layouts.user')

@section('title')
   @langg('Site Support')
@endsection

@section('breadcrumb')

@langg('Site Support')
 
@endsection

@section('content')
     <div class="dashboard--content-item">
        <div class="row justify-content-center pb-5">
            <div class="col-lg-4">
               <div class="card default--card h-100">
                   <div class="card-body">
                    <div class="chatbox__list__wrapper">
                        <div class="d-flex justify-content-between py-4 border-bottom border--dark">
                            <h4 class="mt-2"><a href="javascript:void(0)">@langg('Report WebSite Problems Only No Disputes')</a></h4>
                            <button class="btn btn--base btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#modelId"><i class="fas fa-plus me-2"></i> @langg('Create New Ticket')</button>
                        </div>
         
                        <ul class="chat__list nav-tab nav border-0">
                            @forelse ($tickets as $item)
                            <li>
                                <a class="chat__item {{request('messages') == $item->ticket_num ? 'active':''}}" href="{{filter('messages',$item->ticket_num)}}">
                                    <div class="item__inner">
                                        <div class="post__creator">
                                            <div class="post__creator-thumb d-flex justify-content-between">
                                                <span class="username"> {{dateFormat($item->created_at,'M d Y')}}</span>
                                                @if ($item->status == 1)
                                                <small class="badge bg-danger">!</small>
                                                @endif
                                            </div>
                                            <div class="post__creator-content">
                                                <h4 class="name d-inline-block">{{$item->subject}} </h4>
                                            </div>
                                        </div>
                        
                                        <ul class="chat__meta d-flex justify-content-between">
                                            <li><span class="last-msg"></span></li>
                                            <li><span class="last-chat-time"></span></li>
                                        </ul>
                                    </div>
                                </a>
                            </li>
                            @empty
                            <li>
                                <a class="chat__item">
                                    <div class="item__inner">
                                        <div class="post__creator text-center">
                                            @langg('No Active Tickets')
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endforelse
                        </ul>
                    </div>
                   </div>
                   @if ($tickets->hasPages())
                   <div class="card-footer">
                       {{$tickets->links()}}
                   </div>
                   @endif
               </div>
            </div>
            <div class="col-lg-8">
                <div class="card default--card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane show fade active" id="c1">
                                <div class="chat__msg">
                                    <div class="chat__msg-header py-2 border-bottom">
                                        <div class="post__creator align-items-center">
                                            
                                            <div class="post__creator-content">
                                                <h4 class="name d-inline-block">@langg('Support Ticket Number: ') {{request('messages')}}</h4>
                                            </div>
                                            <a class="profile-link" href="javascript:void(0)"></a>
                                        </div>
                                    </div>
                                    
                                    <div class="chat__msg-body">
                                        <ul class="msg__wrapper mt-3">
                                            @if (request('messages'))
                                                @forelse ($messages as $item)
                                                    @if ($item->admin_id == null)
                                                    <li class="outgoing__msg">
                                                        <div class="msg__item">
                                                            <div class="post__creator ">
                                                                <div class="post__creator-content">
                                                                    @if ($item->message)
                                                                    <p class="out__msg">{{$item->message}}</p>
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
                                                    <li class="incoming__msg">
                                                        <div class="msg__item">
                                                            <div class="post__creator">
                                                                <div class="post__creator-content">
                                                                    @if ($item->message)
                                                                    <p>{{$item->message}}</p>
                                                                    @endif
                                                                    @if ($item->file)
                                                                        <div class="ms-auto">
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
                                            @else
                                            <li>
                                                <div class="msg__item">
                                                    <div class="post__creator">
                                                        <div class="post__creator-content">
                                                           <h6 class="text-center">@langg('No messages yet')</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                    @if (request('messages'))
                                    <div class="chat__msg-footer">
                                        <form action="{{route('user.ticket.reply',request('messages'))}}" class="send__msg" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="input-group">
                                                <input id="upload-file" type="file" name="file" class="form-control d-none">
                                                <label class="-formlabel upload-file" for="upload-file"><i class="fas fa-paperclip"></i>
                                            </div>
                                            <div class="input-group">
                                                <textarea class="form-control form--control shadow-none" name="message"></textarea>
                                                <button class="border-0 outline-0 send-btn" type="submit"><i class="fab fa-telegram-plane"></i></button>
                                            </div>
                                          
                                            
                                        </form>
                                        <small class="files mt-2 text--base"></small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>

        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <form action="{{route('user.ticket.open')}}" method="POST">
                @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">@langg('Open A New Ticket')</h5> 
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="mb-2">@langg('Problem: For Example: Offer Page Not Loading')</label>
                                <input class="form-control shadow-none " type="text" name="subject" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">@langg('Cancel')</button>
                            <button type="submit" class="btn btn--base">@langg('Submit')</button>
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
    </script>
@endpush
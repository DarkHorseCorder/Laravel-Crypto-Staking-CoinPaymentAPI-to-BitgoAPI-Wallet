@extends('layouts.admin')

@section('title')
   @langg('Support tickets')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header">
        <h1>@langg('Support tickets')</h1>
    </div>
</section>
@endsection

@section('content')

        <div class="row justify-content-center pb-5">
            <div class="col-lg-5 col-xl-4">
               <div class="card">
                   <div class="card-body">
                    <div class="chatbox__list__wrapper">
                        <div class="d-flex flex-wrap justify-content-between mb-3 pb-3 border-bottom border--dark">
                            <h5 class="my-2"><a href="javascript:void(0)">@langg('Tickets')<i class="fas fa-arrow-right"></i></a></h5>
                            <form action="" class="my-2">
                                <div class="form-group mb-0">
                                    <div class="input-group">
                                        <input class="form-control" name="search" value="{{$search}}" type="text" placeholder="@langg('Search Ticket')">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary input-group-text text-white"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                       
                        <ul class="chat__list nav-tab nav border-0">
                            @forelse ($tickets as $item)
                            <li>
                                <a class="chat__item {{request('messages') == $item->ticket_num ? 'active':''}}" href="{{filter('messages',$item->ticket_num)}}" data-bs-toggle="tab">
                                    <div class="item__inner">
                                        <div class="post__creator">
                                            <div class="post__creator-thumb d-flex justify-content-between">
                                               <div>
                                                <span class="username">{{$item->ticket_num}} </span>
                                                <small>{{$item->user->email}}</small>
                                               </div>
                                                @if ($item->status == 0)
                                                 <small class="badge badge-danger">!</small>
                                                @endif
                                            </div>
                                            <div class="post__creator-content">
                                                <h6 class="name d-inline-block">{{$item->subject}}</h6>
                                            </div>
                                        </div>
                                        <ul class="chat__meta d-flex justify-content-between">
                                            <li><span class="last-msg"></span></li>
                                            <li><span class="last-chat-time">{{dateFormat($item->created_at,'d M Y')}}</span></li>
                                        </ul>
                                    </div>
                                </a>
                            </li>
                            @empty
                            <li>
                                <a class="chat__item">
                                    <div class="item__inner">
                                        <div class="post__creator">
                                            @langg('No Tickets Available')
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
                       {{$tickets->links('admin.partials.paginate')}}
                   </div>
                   @endif
               </div>
            </div>
            <div class="col-xl-8 col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane show fade active" id="c1">
                                <div class="chat__msg">
                                    <div class="chat__msg-header py-2">
                                        <div class="post__creator align-items-center">
                                            
                                            <div class="post__creator-content">
                                                <h5 class="name d-inline-block">@langg('Ticket Number : #'){{request('messages')}}</h5>
                                                
                                            </div>
                                            <a class="profile-link" href="javascript:void(0)"></a>
                                        </div>
                                    </div>
                                    
                                    <div class="chat__msg-body">
                                        <ul class="msg__wrapper mt-3">
                                            @if (request('messages'))
                                                @forelse ($messages as $item)
                                                    @if ($item->admin_id == null)
                                                    <li class="incoming__msg">
                                                        <div class="msg__item">
                                                            <div class="post__creator">
                                                                <div class="post__creator-content">
                                                                    @if ($item->message)
                                                                    <p>{{$item->message}}</p>
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
                                            @else
                                            <li>
                                                <div class="msg__item">
                                                    <div class="post__creator ">
                                                        <div class="post__creator-content ">
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
                                        <form action="{{route('admin.ticket.reply',request('messages'))}}" class="send__msg" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="input-group">
                                                <input id="upload-file" type="file" name="file" class="form-control d-none">
                                                <label class="-formlabel upload-file" for="upload-file"><i class="fas fa-paperclip"></i>
                                            </div>
                                            <div class="input-group">
                                                <textarea class="form-control form--control" name="message"></textarea>
                                                <button class="border-0 outline-0 send-btn" type="submit"><i class="fab fa-telegram-plane"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('style')
    <style>
        .badge{
            padding: 8px 9px;
            border-radius: 15px;
        }
    </style>
@endpush
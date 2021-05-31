@extends('layouts.frontend')

@section('title')
    @langg('Blog Details')
@endsection

@section('content')
        <!-- Blog -->
        <section class="blog-section pt-100 pb-100">
            <div class="container">
                <div class="row gy-5">
                    <div class="col-lg-8">
                        <div class="blog__item blog__item-details">
                            <div class="blog__item-img">
                                <img src="{{getPhoto($blog->photo)}}">
                            </div>
                            <div class="blog__item-cont">
                                <div class="blog__author mb-4 mt-3">
                                    <div class="author w-auto">
                                        <h6>by Admin</h6>
                                    </div>
                                    <a href="#0" class="text--base">{{dateFormat($blog->created_at,'d M Y')}}</a>
                                </div>
                                <h5 class="blog__item-content-title">
                                    @lang($blog->title)
                                </h5>
                                <div class="blog__details">
                                    <p>
                                        @php
                                            echo  $blog->description;
                                        @endphp
                                    </p>
                                    <div class="d-flex align-items-center flex-wrap">
                                        <h6 class="m-0 me-2 align-items-center">Share Now</h6>
                                        <ul class="social-icons social-icons-dark">
                                            <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{urlencode(url()->current()) }}"><i class="fab fa-facebook-f"></i></a></li>
                       
                                            <li><a target="_blank" href="http://pinterest.com/pin/create/button/?url={{urlencode(url()->current()) }}&description={{ __($blog->title) }}&media={{ getPhoto($blog->photo) }}"><i class="fab fa-pinterest"></i></a></li>
                                           
                                            <li><a target="_blank" href="https://twitter.com/intent/tweet?text={{ __($blog->title) }}&amp;url={{urlencode(url()->current()) }}"><i class="fab fa-twitter"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <aside class="blog-sidebar ps-xxl-5">
                            <div class="widget">
                                <div class="widget-header text-center">
                                    <h5 class="m-0 text-white">@langg('Latest Blog Posts')</h5>
                                </div>
                                <div class="widget-body">
                                    <ul class="latest-posts">
                                        @foreach ($latests as $item)
                                        <li>
                                            <a href="{{route('blog.details',[$item->id,$item->slug])}}">
                                                <div class="img">
                                                    <img src="{{getPhoto($item->photo)}}" alt="blog">
                                                </div>
                                                <div class="cont">
                                                    <h5 class="subtitle">@lang($item->title)</h5>
                                                    <span class="date">{{dateFormat($item->created_at,'d M Y')}}</span>
                                                </div>
                                            </a>
                                        </li>
                                            
                                        @endforeach
                                        
                                    </ul>
                                </div>
                            </div>
                            <div class="widget">
                                <div class="widget-header text-center">
                                    <h5 class="m-0 text-white">@langg('Category')</h5>
                                </div>
                                <div class="widget-body">
                                    <ul class="archive-links">
                                        @foreach ($categories as $item)
                                        <li>
                                            <a href="{{route('blogs',['category'=> $item->slug])}}">
                                                <span>@lang($item->name)</span>
                                                <span>({{$item->blogs_count}})</span>
                                            </a>
                                        </li>
                                        @endforeach
                                        
                                    </ul>
                                </div>
                            </div>
                            
                        </aside>
                    </div>
                </div>
            </div>
        </section>
        <!-- Blog -->
@stop

@push('style')
    <style>
       .blog__details img{
            width: 800px!important
        }
    </style>
@endpush
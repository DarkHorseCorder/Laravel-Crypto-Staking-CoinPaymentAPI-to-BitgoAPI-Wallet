@extends('layouts.frontend')

@section('title')
    @langg('Blogs')
@endsection

@section('content')

<section class="blog-section pt-100 pb-100 bg--section">
    <div class="container">
        <div class="row g-4 g-lg-3 g-xl-4 justify-content-center">
            @forelse ($blogs as $item)
            <div class="col-lg-4 col-md-6 col-sm-10">
                <div class="blog__item">
                    <a href="{{route('blog.details',[$item->id,$item->slug])}}" class="blog-link">&nbsp;</a>
                    <div class="blog__item-img">
                        <img src="{{getPhoto($item->photo)}}" alt="blog">
                        <span class="date">
                            <span>{{dateFormat($item->created_at,'M')}}</span>
                            <span>{{dateFormat($item->created_at,'d')}}</span>
                        </span>
                    </div>
                    <div class="blog__item-cont">
                        <h5 class="blog__item-cont-title line--2">
                            {{Str::limit($item->title,30)}}
                        </h5>
                        <p class="line--3">
                            {{Str::limit(strip_tags($item->description),130)}}
                        </p>
                        <div class="blog__author">
                            <div class="author">
                               
                                <h6>By Admin</h6>
                            </div>
                            <span class="read--more">@langg('Read More')</span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-lg-4 col-md-6 col-sm-10">
                <div class="blog__item">
                    <h5>@langg('No blogs found!')</h5>
                </div>
            </div>
            @endforelse
            @if ($blogs->hasPages())
            <div class="col-lg-12 col-md-12 col-sm-12">
                {{$blogs->links()}}
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
@extends('layouts.frontend')

@section('title')
    @lang(@$content->title)
@endsection

@section('content')
    <!-- Blog -->
    <section class="blog__details blog-section pt-100 pb-100">
        <div class="container">
            <div class="row justify-content-center gy-4">
                @php
                    echo $content->description;
                @endphp
            </div>
        </div>
    </section>
    <!-- Blog -->
@endsection
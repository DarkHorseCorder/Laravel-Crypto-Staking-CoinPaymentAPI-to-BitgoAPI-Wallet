@extends('layouts.frontend')

@section('title')
    @lang(@$page->title)
@endsection

@section('content')
    <section class="pt-50 pb-100 position-relative overflow-hidden">
        <div class="container">
            <div class="blog__details">
                <p>
                    @php
                        echo $page->details;
                    @endphp
                </p>          
            </div>
        </div>
        <span class="banner-elem elem1">&nbsp;</span>
        <span class="banner-elem elem3">&nbsp;</span>
        <span class="banner-elem elem5">&nbsp;</span>
        <span class="banner-elem elem6">&nbsp;</span>
    </section>
 
@endsection
@extends('layouts.frontend')

@section('title')
    @lang(@$page->title ?? 'About')
@endsection

@section('content')
  
   @if ($page)
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
  
   </section>
   @endif
@endsection
@php
   $seo = App\Models\SeoSetting::first();
@endphp

<meta name="title" Content="{{ $gs->title }}">
<meta name="description" content="{{ $seo->meta_description }}">
<meta name="keywords" content="{{ $seo->meta_tag }}">


<link rel="apple-touch-icon" href="{{getPhoto($gs->header_logo)}}">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-title" content="@yield('title')">

<meta itemprop="name" content="@yield('title')">
<meta itemprop="description" content="{{ $seo->meta_description }}">
<meta itemprop="image" content="{{ getPhoto($seo->meta_image) }}">

<meta property="og:type" content="website">
<meta property="og:title" content="{{ $seo->title }}">
<meta property="og:description" content="{{ $seo->meta_description }}">
<meta property="og:image" content="{{getPhoto($seo->meta_image) }}"/>
<meta property="og:image:type" content="image/{{ pathinfo(getPhoto($seo->meta_image))['extension'] }}" />

<meta property="og:url" content="{{ url()->current() }}">

<meta name="twitter:card" content="summary_large_image">
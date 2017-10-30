<?php use Carbon\Carbon; ?>
@extends(config('front.template').'layouts.app')
@section('content')
    <article class="single-post" itemscope itemtype="http://schema.org/NewsArticle">
        <meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="https://google.com/article"/>
    <section class="single-post-header">
        <header class="single-post-header__meta">
            <h2 class="single-post__title" itemprop="headline">{!!($article->title) !!}</h2></header>
            <div class="row author">
                <div class="col-xs-2 col-md-1">
                    {!! ($article->author)?avatar($article->author,'x30',['class'=>'img-circle avatar']):'' !!}
                </div>
               <div class="col-xs-6 col-md-4 name" itemprop="author" itemscope itemtype="https://schema.org/Person">
                  <span itemprop="name">{!! ($article->writer)?$article->writer:($article->author)?($article->author->name):'' !!}</span>
                   <time class="timeago" title="{!!($article->created_at) !!} +0800" datetime="{!!($article->created_at) !!} +0800">{!! Carbon::createFromTimeStamp(strtotime($article->created_at))->diffForHumans() !!}</time>

               </div>
            </div>
        <div class="summary motive bg-info" itemprop="description">
            {!!($article->content_heading) !!}
        </div>
    </section>
    <section class="image">
        <div itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
            {!!  article_image($article,'x520') !!}
            <meta itemprop="url" content="{{ url('/uploads/images/').'/'.str_replace('/uploads/resize/240x/','',$article->image) }}">
            <meta itemprop="width" content="800">
            <meta itemprop="height" content="800">
        </div>
        <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
            <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                <img src="{{ asset('assets/images/logo.png') }}"/>
                <meta itemprop="url" content="{{ asset('assets/images/logo.png') }}">
                <meta itemprop="width" content="130">
                <meta itemprop="height" content="34">
            </div>
            <meta itemprop="name" content="{{ config('front.site_name') }}">
        </div>
    </section>
    <section class="article">
        {!!($article->content) !!}
    </section>
     <section class="section-space">
         <meta itemprop="datePublished" content="{!!($article->created_at) !!}"/>
         <meta itemprop="dateModified" content="{!!($article->updated_at) !!}"/>
     </section>
        <section class="comments">
            @include(config('front.template').'comment_list')
        </section>
        <section class="comment_form">
            @if(Auth::check() && Auth::user()->comment_in)
            {!! $comment_form !!}
            @else
                @include(config('front.template').'layouts.partials.please_login',['for'=>'comment'])
            @endif
        </section>
    </article>
@endsection
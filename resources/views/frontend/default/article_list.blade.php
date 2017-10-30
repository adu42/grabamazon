<?php use Carbon\Carbon; ?>
@extends(config('front.template').'layouts.app')
@section('content')
    <div class="news-list">
    <div class="article-list">
    <div class="articles">
    @if($articles)
    @foreach($articles as $article)
    <article>
        <div class="row">
        <div class="col-md-3">
            {!! image_link_to(route('article.show',['uri'=>$article->url_key]),image_to($article->image,'',$article->title,['class'=>"img-thumbnail"])) !!}
        </div>
        <div class="col-md-9">
            <h3 class="title">{!! link_to_route('article.show',$article->title,['uri'=>$article->url_key]) !!}</h3>
            <div class="author">
                <span>
                    {!! ($article->author)?avatar($article->author,'x30',['class'=>'img-circle avatar']):'' !!}
                </span>
                <span class="name">
                    {!! ($article->writer)?:($article->author)?($article->author->name):'' !!}
                </span>
                <span class="time">&nbsp;•&nbsp;<time class="timeago" title="{!!($article->created_at) !!} +0800" datetime="{!!($article->created_at) !!} +0800">{!! Carbon::createFromTimeStamp(strtotime($article->created_at))->diffForHumans() !!}</time></span>
            </div>
            <div class="description">
                {!!($article->content_heading) !!}
            </div>
        </div></div>
    </article>
        @endforeach
        <div class="pager">
            {!! $articles->render() !!}
        </div>
        @endif
    </div>
    </div>
 </div>
@endsection
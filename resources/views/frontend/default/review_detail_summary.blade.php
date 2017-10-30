@extends(config('front.template').'layouts.app')
@section('content')
    <article class="single-post">
    <section class="single-post-header">
        <header class="single-post-header__meta">
            <h2 class="single-post__title">{!! $evaluate->domain !!}</h2>
        </header><div class="summary motive bg-info" itemprop="description">
            {!! $evaluate->summary !!}
        </div>
    </section>
    <section class="article">
        {!!($evaluate->content) !!}
    </section>
    </article>
@endsection
@extends(config('front.template').'layouts.page')
@section('content')
    <article class="single-post">
    <section class="single-post-header">
        <header class="single-post-header__meta">
            <h2 class="single-post__title">{!!($page->title) !!}</h2>
        </header>
    </section>
    <section class="article">
        {!!($page->capacity) !!}
    </section>
    </article>
@endsection
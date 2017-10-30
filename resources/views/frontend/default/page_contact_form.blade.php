@extends(config('front.template').'layouts.app')
@section('content')
    <article class="single-post">
    <section class="article">
        {!! $edit !!}
    </section>
    </article>
@endsection
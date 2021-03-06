@extends(config('front.template').'layouts.review')
@section('content')
<div class="write_review">
    {!! $form->header !!}
    {!! $form->message !!}
    @if(!$form->message)
        <div class="row">
            <div class="col-sm-12">
                {!! $form->render('domain') !!}
                {!! $form->render('rating') !!}
                <span class="review_more_btn"><a class="btn btn-default btn-sm" role="button" data-toggle="collapse" href="#collapse-rating-more" aria-expanded="false" aria-controls="collapse-rating-more">{{ trans('review.rating_more') }}</a>
                <div class="review_much collapse" id="collapse-rating-more">
                    {!! $form->render('service') !!}
                    {!! $form->render('value') !!}
                    {!! $form->render('shipping') !!}
                    {!! $form->render('returns') !!}
                    {!! $form->render('quality') !!}
                </div></span>
                <br>
                {!! $form->render('title') !!}
                {!! $form->render('review') !!}
                {{ Widget::Imageform(3) }}
                {!! $form->render('ip') !!}
                {!! $form->render('cash_back_order_number') !!}
                {!! $form->render('cash_back_in') !!}
            </div>
        </div>
    @endif
    <br />
    {!! $form->footer !!}
</div>
@endsection
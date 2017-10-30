<div>
    {!! $form->header !!}
    {!! $form->message !!}
    @if(!$form->message)
        <div class="row">
            <div class="col-sm-12">
                {!! $form->render('article_id') !!}
                {!! $form->render('quote_id') !!}
                {!! $form->render('comment') !!}
            </div>
        </div>
    @endif
    <br />
    {!! $form->footer !!}
</div>

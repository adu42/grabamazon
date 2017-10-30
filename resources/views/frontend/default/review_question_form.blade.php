<div class="container-fluid">
    {!! $form->header !!}
    {!! $form->message !!}
    @if(!$form->message)
    <div class="row">
        <div class="col-sm-12">
            {!! $form->render('question') !!}
            {!! $form->render('evaluate_id') !!}
            {!! $form->render('user_id') !!}
        </div>
    </div>
    @endif
    {!! $form->footer !!}
</div>

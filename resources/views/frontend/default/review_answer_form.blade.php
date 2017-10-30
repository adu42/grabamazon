<div class="container-fluid">
    {!! $form->header !!}
    {!! $form->message !!}
    @if(!$form->message)
    <div class="row">
        <div class="col-sm-12">
            {!! $form->render('answer') !!}
            {!! $form->render('question_id') !!}
            {!! $form->render('user_id') !!}
        </div>
    </div>
    @endif
    {!! $form->footer !!}
</div>

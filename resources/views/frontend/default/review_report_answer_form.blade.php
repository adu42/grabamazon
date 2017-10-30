<div class="container-fluid">
    {!! $form->header !!}
    {!! $form->message !!}
    @if(!$form->message)
    <div class="row">
        <div class="col-sm-12">
            {!! $form->render('report') !!}
            {!! $form->render('answer_id') !!}
            {!! $form->render('report_user_id') !!}
        </div>
    </div>
    @endif
    {!! $form->footer !!}
</div>

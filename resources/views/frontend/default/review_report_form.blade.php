<div class="container-fluid">
    {!! $form->header !!}
    {!! $form->message !!}
    @if(!$form->message)
    <div class="row">
        <div class="col-sm-12">
            {!! $form->render('explain') !!}
            {!! str_replace('&nbsp;','',$form->render('affiliated'))  !!}
        </div>
    </div>
    @endif
    {!! $form->footer !!}
</div>

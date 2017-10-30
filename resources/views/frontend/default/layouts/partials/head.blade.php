<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-7-14
 * Time: 上午1:17
 */
?>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
@if(isset($document))
{!! $document->getHead() !!}
@endif
<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/js/app.js') }}" type="text/javascript"></script>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
{!! Rapyd::head() !!}

<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
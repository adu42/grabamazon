<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-7-14
 * Time: 上午1:17
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/talk.js') }}" type="text/javascript"></script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <link href="{{ asset('assets/css/talk.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-10  content-wrapper">
            <div class="row">
                <div class="col-md-12">

                </div>
            </div>
            @yield('content')
        </div></div>
</div>
</body>
</html>
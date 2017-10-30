@extends(config('front.template').'layouts.2column-left')
@section('content')
@if($coupons)
    <div class="row coupon-label">
        <div class="col-md-12">
        <h3>{!! trans('coupon.list_label') !!}</h3>
        </div>
    </div>
    @foreach($coupons as $coupon)
    <div class="row coupon-wrapper">
        <div class="col-md-4 col-sm-6 col-xs-6 col-image">
            <div class="coupon-image">{!!  image_link_to($coupon->site,image_to($coupon->background,'x240120'))  !!}</div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="row">
                <div class="coupon-code">{{ $coupon->coupon }}</div>
            </div>
            <div class="row">
                <div class="coupon-discount">{{  $coupon->offPrice }}</div>
            </div>
        </div>
        <div class="col-md-4  col-sm-12 col-xs-12">
            <div class="row">
                <div class="coupon-expire">{{  $coupon->expire }}</div>
                </div>
            <div class="row">
                <div class="coupon-get">{{ link_to_route('front.goto',trans('coupon.open_website'),['link'=>route_urlencode($coupon->site)]) }}</div>
                </div>
        </div>
    </div>
    @endforeach
    <div class="row">
        <div class="col-md-12">
            <div class="pager">
                {!! $coupons->render() !!}
            </div>
        </div>
    </div>
@endif
@endsection
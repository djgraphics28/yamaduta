@extends($activeTemplate.'layouts.frontend')
@section('content')

<div class="row">
    <div class="@if($hotDealProducts->count()) col-xl-9 @else col-xl-12 @endif">
        @include($activeTemplate.'partials.banner')
        @if($featuredProducts->count())
            <section class="products-section">
                <h3 class="section-title">@lang('Feature Products')</h3>
                <div class="row g-2">
                    @foreach($featuredProducts as $item)
                        <div class="col-lg-4 col-sm-6">
                            <div class="product-item">
                                <div class="thumb">
                                    <img src="{{getImage(imagePath()['product']['path'].'/'.$item->image,imagePath()['product']['size'])}}" alt="products">

                                    @if(!$item->stock)
                                        <span class="stock-status badge bg--danger">@lang("Stock Out")</span>
                                    @endif
                                </div>
                                <div class="content">
                                    <h5 class="product-name"><a href="{{route('product.details',[$item->id,$item->slug])}}">@lang($item->name)</a></h5>
                                    @if ($item->discount > 0)
                                        <div class="d-flex justify-content-between">
                                            <span class="price">{{$general->cur_sym}}{{afterDiscount($item->price,$item->discount)}}</span>
                                            <del class="discounted">{{$general->cur_sym}}{{getAmount($item->price)}}</del>
                                        </div>
                                    @else
                                    <span class="price">{{$general->cur_sym}}{{getAmount($item->price)}}</span>
                                    @endif

                                    <div class="button-wrapper">
                                        <a href="{{route('checkout',[$item->id,$item->slug])}}" class="cmn--btn btn--md bg--primary">@lang('Order Now')</a>
                                        <a href="{{route('product.details',[$item->id,$item->slug])}}" class="cmn--btn btn--md bg--base">@lang('View Details')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if($latestProducts->count())
            <section class="products-section">
                <h3 class="section-title">@lang('Latest Products')</h3>
                <div class="row g-2">
                    @foreach ($latestProducts as $product)
                    <div class="col-lg-4 col-sm-6">
                        <div class="product-item">
                            <div class="thumb">
                                <img src="{{getImage(imagePath()['product']['path'].'/'.$product->image,imagePath()['product']['size'])}}" alt="products">
                                @if(!$product->stock)
                                    <span class="stock-status badge bg--danger">@lang("Stock Out")</span>
                                @endif
                            </div>
                            <div class="content">
                            <h5 class="product-name"><a href="{{route('product.details',[$product->id,$product->slug])}}">@lang($product->name)</a></h5>
                            @if ($product->discount > 0)
                            <div class="d-flex justify-content-between">
                                <span class="price">{{$general->cur_sym}}{{afterDiscount($product->price,$item->discount)}}</span>
                                <del class="discounted">{{$general->cur_sym}}{{getAmount($product->price)}}</del>
                            </div>
                            @else
                            <span class="price">{{$general->cur_sym}}{{getAmount($product->price)}}</span>
                            @endif
                                <div class="button-wrapper">
                                    <a href="{{route('checkout',[$product->id,$product->slug])}}" class="cmn--btn btn--md bg--primary">@lang('Order Now')</a>
                                    <a href="{{route('product.details',[$product->id,$product->slug])}}" class="cmn--btn btn--md bg--base">@lang('View Details')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </section>
        @endif
    </div>

    @if($hotDealProducts->count())
        <div class="col-xl-3">
            <div class="hot-product-sidebar">
                <h3 class="title">@lang('Hot Deals')</h3>
                <div class="row g-4">
                    @foreach($hotDealProducts as $deal)
                        <div class="col-md-6 col-lg-3 col-xl-12 col-sm-6">
                            <div class="hot-item m-0">
                                <div class="thumb">
                                    @if(!$deal->stock)
                                        <span class="stock-status badge bg--danger">@lang("Stock Out")</span>
                                    @endif
                                    <img src="{{getImage(imagePath()['product']['path'].'/'.$deal->image,imagePath()['product']['size'])}}" alt="products">

                                    <div class="discount-wrapper">
                                        <div class="left">
                                            <p class="count">{{getAmount($general->hot_deal_discount)}}% @lang('Off')</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="content">
                                    <h6 class="product-name mt-3">@lang($deal->name)</h6>

                                    <div class="price-wrapper">
                                        <div class="current-price">{{$general->cur_sym}}{{getAmount(afterDiscount($deal->price,$general->hot_deal_discount))}}</div>
                                        <div class="past-price">{{$general->cur_sym}}{{getAmount($deal->price)}}</div>
                                    </div>


                                    <div class="button-wrapper">
                                        <a href="{{route('checkout',[$deal->slug,$deal->id])}}" class="cmn--btn btn--md bg--primary">@lang('Order Now')</a>
                                        <a href="{{route('product.details',[$deal->id,$deal->slug])}}" class="cmn--btn btn--md bg--base">@lang('View Details')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>


@php
    $rows = getContent('overview.element', false, null, true);
@endphp

<section class="overview-section pt-50 pb-50">
    <div class="row justify-content-center g-4">
        @foreach($rows as $row)
            <div class ="col-lg-4 col-md-8 col-sm-10">
                <div class="overview-item h-100">

                    <div class="thumb">
                        <img src="{{ getImage('assets/images/frontend/overview/' .@$row->data_values->image, '128x128') }}" alt="icon">
                    </div>

                    <div class="content">
                        <h4 class="title">{{ __($row->data_values->heading) }}</h4>
                        <p>{{ __($row->data_values->sub_heading) }}</p>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</section>

@endsection

@extends($activeTemplate.'layouts.frontend')

@section('content')
<div class="row p-0">
    <div class="col-lg-3">
        <div class="product-sidebar">
            <div class="product-sidebar-close">
                <i class="las la-times"></i>
            </div>
            <div class="sidebar-item">
                <h4 class="title ms-2">@lang('Product Categories')</h4>
                <ul class="product-cate">
                    <li>
                        <select  class="form-control shadow-none outline-0 cat-with" onChange="window.location.href=this.value">
                            <option value="{{queryBuild('category','')}}">@lang('All')</option>
                            @foreach ($categories as $cat)
                                <option value="{{queryBuild('category',$cat->slug)}}" {{request('category') == $cat->slug ? 'selected':''}}>{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </li>
                </ul>
            </div>
            <div class="sidebar-item">
                <h4 class="title ms-2">@lang('Product Brands')</h4>
                <ul class="product-cate">
                    <li>
                        <select  class="form-control shadow-none outline-0 cat-with" onChange="window.location.href=this.value">
                            <option value="{{queryBuild('brand','')}}">@lang('All')</option>
                            @foreach ($brands as $brand)
                              <option value="{{queryBuild('brand',$brand->slug)}}" {{request('brand') == $brand->slug ? 'selected':''}}>{{$brand->name}}</option>
                            @endforeach
                        </select>
                    </li>
                </ul>
            </div>
            <div class="sidebar-item">
                <h4 class="title ms-2">@lang('Product Attribute')</h4>
                <ul class="product-cate">
                    <li>
                        <a href="{{queryBuild('attribute','hot-deal')}}" class="custom--checkbox">
                            <input id="7" type="checkbox" class="form--control" name="attribute" value="{{queryBuild('attribute','hot-deal')}}" {{request('attribute')=='hot-deal'?'checked':''}}>
                            <label for="7">@lang('Hot Deal')</label>
                        </a>
                    </li>
                    <li>
                        <a href="{{queryBuild('attribute','discounted')}}" class="custom--checkbox">
                            <input id="8" type="checkbox" class="form--control" name="attribute" value="{{queryBuild('attribute','discounted')}}" {{request('attribute')=='discounted'?'checked':''}}>
                            <label for="8">@lang('Discount')</label>
                        </a>
                    </li>
                    <li>
                        <a href="{{queryBuild('attribute','featured')}}" class="custom--checkbox">
                            <input id="9" type="checkbox" class="form--control" name="attribute" value="{{queryBuild('attribute','featured')}}" {{request('attribute')=='featured'?'checked':''}}>
                            <label for="9">@lang('Featured')</label>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
    <div class="col-lg-9">
        <div class="main-content">



            <!-- Feature Products Section Starts Here -->
            <section class="products-section">
                <h3 class="section-title d-flex justify-content-between">
                    <span>@lang($pageTitle)</span>
                    <span class="sidebar-active d-lg-none">
                        <i class="las la-bars"></i>
                    </span>
                </h3>

                <div class="row g-2">
                    @forelse ($products as $item)
                    <div class="col-md-4 col-sm-6">
                        <div class="product-item">
                            <div class="thumb"><img src="{{getImage(imagePath()['product']['path'].'/'.$item->image,imagePath()['product']['size'])}}" alt="products">
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
                                    <a href="{{route('checkout',[$item->id,$item->slug])}}" class="cmn--btn bg--primary btn--md">@lang('Order Now')</a>
                                    <a href="{{route('product.details',[$item->id,$item->slug])}}" class="cmn--btn bg--base btn--md">@lang('View Details')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="text-center mt-5">
                            <h4>@lang('No products found')</h4>
                        </div>
                    @endforelse
                </div>
            </section>

            <div class="my-4">
                {{paginateLinks($products,'')}}
            </div>

        </div>
    </div>
</div>
@endsection

@push('style')
    <style>
        .cat-with{
            width: 90%!important;
        }
    </style>
@endpush
@php
    $searchUrl =  http_build_query(request()->except('search'));
    $searchUrl =   str_replace("amp%3B","",$searchUrl);
    $queryStrings = json_encode(request()->query());
@endphp
@push('script')
     <script>
            'use strict';
            (function ($) {

                $('input[name=attribute]').on('change',function () {
                    if(!$(this).prop('checked')){
                         var url = '{{url()->current()}}?{{http_build_query(request()->except('attribute'))}}';
                         window.location.href = url.replace('amp;','')
                         return false
                    }
                    window.location.href = $(this).val()
                 })


            })(jQuery);
     </script>
@endpush

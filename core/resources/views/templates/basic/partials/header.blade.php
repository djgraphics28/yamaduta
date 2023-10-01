@php
    $header = getContent('header.content', true);
@endphp
<!-- Header Section Starts Here -->
<div class="header-top">
    <div class="header-top-area">
        <div class="logo d-none d-md-block"><a href="{{ route('home') }}"><img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="@lang('logo')"></a></div>
        <div class="rolling-headline"><marquee scrollamount="4">{{ __(@$header->data_values->notice) }}</marquee></div>
        <div class="header-contacts">
            <p>{{ __(@$header->data_values->heading) }}</p>
            <a href="tel:{{ @$header->data_values->phone }}">{{ @$header->data_values->phone }}</a>
        </div>
    </div>
</div>


<div class="header-bottom">
    <div class="header-bottom-area justify-content-between align-items-center justify-content-lg-between">
        <div class="menu-wrapper w-100">
            <ul class="menu">

                <li class="close-trigger d-md-none text-end">
                    <span class="close-menu-trigger">
                        <i class="las la-times"></i>
                    </span>
                </li>

                <li>
                    <a href="{{ route('home') }}">@lang('Home')</a>
                </li>

                <li>
                    <a href="{{ route('products') }}">@lang('Products')</a>
                </li>

                @if($categories->count())
                <li>
                    <a href="#0">@lang('Category')</a>
                    <ul class="sub-menu">
                        @foreach ($categories as $cat)
                        <li>
                            <a href="{{route('products',['category'=>$cat->slug])}}">@lang($cat->name)</a>
                        </li>
                        @endforeach

                    </ul>
                </li>
                @endif
                @guest
                    <li>
                        <a href="{{ route('blogs') }}">@lang('Blog')</a>
                    </li>

                    <li>
                        <a href="{{ route('about') }}">@lang('About')</a>
                    </li>

                    <li>
                        <a href="{{ route('contact') }}">@lang('Contact')</a>
                    </li>

                    <li>
                        <a href="{{ route('user.login') }}">@lang('Login')</a>
                    </li>
                @endguest

                @auth
                    <li>
                        <a href="{{ route('ticket') }}">@lang('Support')</a>
                    </li>
                    <li>
                        <a href="{{ route('user.home') }}">@lang('Dashboard')</a>
                    </li>
                @endauth

                <li class="ms-auto search-toggler-btn d-md-block d-none">
                    <div class="search-toggler">
                        <div class="search-icon">
                            @if(request()->search)
                            <i class="las la-times"></i>
                            @else
                            <i class="las la-search"></i>
                            @endif
                        </div>
                    </div>
                </li>
            </ul>   <!-- Menu End -->

            <div class="header-search-bar @if(request()->search) show @endif">
                <form  class="search-form pt-md-3 pb-3 pb-md-0" action="{{route('products')}}" id="searchForm">
                    <input type="text" class="form-control form--control" name="search" placeholder="@lang('Search products by keywords')" value="{{request('search')}}">
                    <button class="search--button bg--primary" type="submit"><i class="las la-search"></i></button>
                </form>
            </div>
        </div>
        <div class="logo d-md-none me-auto"><a href="{{ route('home') }}"><img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="@lang('logo')"></a></div>

        <div class="header-trigger-wrapper d-flex d-md-none align-items-center me-0">
            <div class="header-trigger d-block d-lg-none">
                <span></span>
            </div>
        </div>  <!-- Trigger End-->
        <div class="search-toggler d-md-none">
            <div class="search-icon text-dark">
                <i class="las la-search"></i>
            </div>
        </div>


    </div>
</div>
<!-- Header Section Ends Here -->

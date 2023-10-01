<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('partials.seo')
    <title>{{ $general->sitename(__($pageTitle)) }}</title>
    @include($activeTemplate.'layouts.partials.css')
</head>
<body>
    @stack('fbComment')
    <div class="overlay"></div>
    <div class="container main-container">
        @include($activeTemplate.'partials.header')
        <div class="main-wrapper mt-2 p-0">
            <div class="main-content">
                @yield('content')
            </div>
        </div>
        @include($activeTemplate.'partials.footer')
    </div>

    @guest
        @php $cookie = App\Models\Frontend::where('data_keys','cookie.data')->first(); @endphp
        <div class="cookie__wrapper @if(@$cookie->data_values->status && !session('cookie_accepted')) active @endif">
            <div class="container">
                <p class="mb-3">
                    @php echo @$cookie->data_values->description @endphp <a class="text--secondary" href="{{ @$cookie->data_values->link }}" target="_blank">@lang('Read Policy')</a>
                </p>

                <div class="mt-3">
                    <a href="{{ route('cookie.accept') }}" class="cmn--btn btn--base btn--sm">@lang('Accept')</a>
                </div>
            </div>
        </div>
    @endguest

    <a href="#0" class="scrollToTop active"><i class="las la-chevron-up"></i></a>
    @include($activeTemplate.'layouts.partials.js')
</body>
</html>

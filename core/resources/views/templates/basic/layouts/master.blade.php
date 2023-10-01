<!doctype html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('partials.seo')
    <title> {{ $general->sitename(__($pageTitle)) }}</title>
    @include($activeTemplate.'layouts.partials.css')

    @stack('style')
</head>
<body>
    <div class="container main-container">
        @include($activeTemplate.'partials.header')
        <section class="user-dashboard pt-3 pt-xl-5 pb-50">
            <div class="container">
                <div class="row">
                    @include($activeTemplate.'partials.sidebar')


                    <div class="user-toggler-wrapper d-flex d-xl-none">
                        <div class="user-toggler">
                            <i class="las la-sliders-h"></i>
                        </div>
                    </div>
                    @yield('content')
                </div>
            </div>
        </section>
        @include($activeTemplate.'partials.footer')
    </div>


<a href="#0" class="scrollToTop active"><i class="las la-chevron-up"></i></a>

@include($activeTemplate.'layouts.partials.js')

<script>
    (function($){
        "use strict";


        $('form').on('submit',function () {
          if ($(this).valid()) {
            $(':submit', this).attr('disabled', 'disabled');
          }
        });

    })(jQuery);

</script>

</body>
</html>

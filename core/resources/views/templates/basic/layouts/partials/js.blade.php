<script src="{{ asset('assets/global/js/jquery-3.6.0.min.js') }}"></script>

@stack('script-lib')
<script src="{{ asset($activeTemplateTrue .'js/bootstrap.min.js') }}"></script>
<script src="{{ asset($activeTemplateTrue .'js/owl.min.js') }}"></script>
<script src="{{ asset($activeTemplateTrue .'js/jquery.zoom.min.js') }}"></script>
<script src="{{ asset($activeTemplateTrue .'js/main.js') }}"></script>

@stack('script-lib')

@include('partials.notify')

@include('partials.plugins')


@stack('script')

<script>

    (function ($) {
        "use strict";
        $(".langSel").on("change", function() {
            window.location.href = "{{route('home')}}/change/"+$(this).val() ;
        });

    })(jQuery);

</script>

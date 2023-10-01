<!-- BootStrap Link -->
<link rel="stylesheet" href="{{ asset($activeTemplateTrue. 'css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset($activeTemplateTrue. 'css/animate.css') }}">
<!-- fontawesome 5  -->
<link rel="stylesheet" href="{{ asset('assets/global/css/all.min.css') }}">
<!-- line-awesome webfont -->
<link rel="stylesheet" href="{{ asset('assets/global/css/line-awesome.min.css') }}">
<!-- Plugings Link -->
<link rel="stylesheet" href="{{ asset($activeTemplateTrue. 'css/owl.css') }}">
<!-- Custom Link -->
<link rel="stylesheet" href="{{ asset($activeTemplateTrue. 'css/main.css') }}">

<link rel="stylesheet" href="{{ asset($activeTemplateTrue. 'css/color.php?color='.$general->base_color.'&secondColor='.$general->secondary_color) }}">

<link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/custom.css')}}">


@stack('style-lib')
@stack('style')

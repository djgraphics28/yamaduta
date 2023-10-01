@extends($activeTemplate.'layouts.auth_master')

@php
    $bgImage = getContent('auth.content', true);
@endphp

@section('content')
<!-- Account Section Starts Here -->
<section class="account-section bg_img d-flex" style="background: url({{ getImage('assets/images/frontend/auth/' .@$bgImage->data_values->image, '1920x1280') }}) right;">
    <div class="account-wrapper">
        <div class="logo mb-4">
            <a href="{{ route('home') }}">
                <img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="@lang('logo')">
            </a>
        </div>
        <h3 class="title mb-5">@lang('Login to your Account')</h3>
        <form class="account-form" action="{{ route('user.login')}}" onsubmit="return submitUserForm();" method="post">
            @csrf
            <div class="form--group">
                <input type="text" name="username" value="{{ old('username') }}" placeholder="@lang('Username or Email')" class="form--control" required>
            </div>
            <div class="form--group">
                <input id="password" type="password" placeholder="@lang('Password')" class="form--control" name="password" required >
            </div>

            <div class="form--group">
                @php echo loadReCaptcha() @endphp
            </div>

            @include($activeTemplate.'partials.custom_captcha')

            <div class="row mb-2">

                <div class="col-xl-12 text-end">
                    <p><a class="text--base" href="{{route('user.password.request')}}">@lang('Forgot Password')?</a></p>
                </div>
            </div>
            <div class="form--group">
                <button type="submit" class="login">@lang('Sign in')</button>
            </div>
        </form>
        <h5>@lang('Already Account Here')?
            <a class="text--base" href="{{ route('user.register') }}">@lang('Sign Up')</a>
        </h5>
    </div>
</section>
<!-- Account Section Ends Here -->

@endsection

@push('script')
    <script>
        "use strict";
        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML = '<span class="text-danger">@lang("Captcha field is required.")</span>';
                return false;
            }
            return true;
        }
    </script>
@endpush

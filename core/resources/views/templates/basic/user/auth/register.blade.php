@extends($activeTemplate.'layouts.auth_master')

@php
    $bgImage = getContent('auth.content', true);
    $policyPages = getContent('policy_pages.element');
@endphp

@section('content')
<!-- Account Section Starts Here -->
<section class="account-section bg_img d-flex " style="background: url({{ getImage('assets/images/frontend/auth/' .@$bgImage->data_values->image, '1920x1280') }}) right;">
    <div class="account-wrapper">
        <div class="logo mb-3">
            <a href="{{ route('home') }}"><img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="logo"></a>
        </div>
        <h3 class="title mb-4">@lang('Sign Up your Account')</h3>
        <form class="account-form" action="{{ route('user.register') }}" method="POST" onsubmit="return submitUserForm();">
            @csrf

            @if(session()->get('reference') != null)
                <div class="form--group">
                    <input type="text" name="referBy" id="referenceBy" class="form--control" value="{{session()->get('reference')}}" readonly>
                </div>
            @endif

            <div class="form--group">
                <input id="firstname" type="text" class="form--control" name="firstname" value="{{ old('firstname') }}" placeholder="@lang('First Name')" required>
            </div>
            <div class="form--group">
                <input id="lastname" type="text" class="form--control" name="lastname" value="{{ old('lastname') }}" placeholder="@lang('Last Name')" required>
            </div>
            <div class="form--group">
                <select name="country" id="country" class="form--control">
                    @foreach($countries as $key => $country)
                        <option data-mobile_code="{{ $country->dial_code }}" value="{{ $country->country }}" data-code="{{ $key }}">{{ __($country->country) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form--group">
                <div class="input-group mb-3">
                    <input type="hidden" name="mobile_code">
                    <input type="hidden" name="country_code">

                    <div class="d-flex w-100">
                        <span class="input-group-text mobile-code"></span>
                        <input type="number" id="mobile" name="mobile" value="{{ old('mobile') }}" class="form--control w-100 checkUser" placeholder="@lang('Mobile')" aria-label="@lang('Mobile')" aria-describedby="basic-addon1">
                    </div>
                </div>
                <small class="text-danger mobileExist"></small>
            </div>
            <div class="form--group">
                <input id="username" type="text" class="form--control checkUser" name="username" value="{{ old('username') }}" placeholder="@lang('Username')" required>
                <small class="text-danger usernameExist"></small>
            </div>
            <div class="form--group">
                <input id="email" type="email" class="form--control checkUser" name="email" value="{{ old('email') }}" placeholder="@lang('Email')" required>
            </div>
            <div class="form--group hover-input-popup">
                <input id="password" type="password" class="form--control" name="password" required placeholder="@lang('Password')">
                @if($general->secure_password)
                    <div class="input-popup">
                      <p class="error lower">@lang('1 small letter minimum')</p>
                      <p class="error capital">@lang('1 capital letter minimum')</p>
                      <p class="error number">@lang('1 number minimum')</p>
                      <p class="error special">@lang('1 special character minimum')</p>
                      <p class="error minimum">@lang('6 character password')</p>
                    </div>
                @endif
            </div>
            <div class="form--group">
                <input id="password-confirm" type="password" class="form--control" name="password_confirmation" required autocomplete="new-password" placeholder="@lang('Confirm Password')">
            </div>
            <div class="form--group">
                @php echo loadReCaptcha() @endphp
            </div>

            @include($activeTemplate.'partials.custom_captcha')

            @if($general->agree)
                <div class="form--group">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="custom--checkbox">
                                <input type="checkbox" id="agree" name="agree">
                                <label for="agree" class="px-1">@lang('I agree with')</label>
                                @foreach($policyPages as $singlePolicy)
                                    <a class="text--base" href="{{ route('policy.details', ['policy'=>slug($singlePolicy->data_values->title), 'id'=>$singlePolicy->id]) }}" target="_blank">{{ __($singlePolicy->data_values->title) }}</a>
                                    @if(!$loop->last) , &nbsp; @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="form--group">
                <button type="submit" class="login">@lang('Sign Up')</button>
            </div>

        </form>
        <h5>@lang('Already Account Here')?
            <a class="text--base" href="{{ route('user.login') }}">@lang('Log In')</a>
        </h5>
    </div>
</section>
<!-- Account Section Ends Here -->

<div class="modal fade" id="existModalCenter" tabindex="-1" role="dialog" aria-labelledby="existModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="existModalLongTitle">@lang('You are with us')</h5>
      </div>
      <div class="modal-body">
        <h6 class="text-center">@lang('You already have an account please Sign in ')</h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Close')</button>
        <a href="{{ route('user.login') }}" class="btn btn--primary">@lang('Login')</a>
      </div>
    </div>
  </div>
</div>
@endsection
@push('style')
<style>
    .country-code .input-group-prepend .input-group-text{
        background: #fff !important;
    }
    .country-code select{
        border: none;
    }
    .country-code select:focus{
        border: none;
        outline: none;
    }
    .hover-input-popup {
        position: relative;
    }
    .hover-input-popup:hover .input-popup {
        opacity: 1;
        visibility: visible;
    }
    .input-popup {
        position: absolute;
        bottom: 130%;
        left: 50%;
        width: 280px;
        background-color: #1a1a1a;
        color: #fff;
        padding: 20px;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        -ms-border-radius: 5px;
        -o-border-radius: 5px;
        -webkit-transform: translateX(-50%);
        -ms-transform: translateX(-50%);
        transform: translateX(-50%);
        opacity: 0;
        visibility: hidden;
        -webkit-transition: all 0.3s;
        -o-transition: all 0.3s;
        transition: all 0.3s;
    }
    .input-popup::after {
        position: absolute;
        content: '';
        bottom: -19px;
        left: 50%;
        margin-left: -5px;
        border-width: 10px 10px 10px 10px;
        border-style: solid;
        border-color: transparent transparent #1a1a1a transparent;
        -webkit-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        transform: rotate(180deg);
    }
    .input-popup p {
        padding-left: 20px;
        position: relative;
    }
    .input-popup p::before {
        position: absolute;
        content: '';
        font-family: 'Line Awesome Free';
        font-weight: 900;
        left: 0;
        top: 4px;
        line-height: 1;
        font-size: 18px;
    }
    .input-popup p.error {
        text-decoration: line-through;
    }
    .input-popup p.error::before {
        content: "\f057";
        color: #ea5455;
    }
    .input-popup p.success::before {
        content: "\f058";
        color: #28c76f;
    }
    .checkUser{
        border-radius: 0 5px 5px 0
    }
    .mobile-code{
        border-radius: 5px 0px 0px 5px;
        background: #115eec;
        color: #fff
    }
</style>
@endpush
@push('script-lib')
<script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
@endpush
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
        (function ($) {
            @if($mobile_code)
            $(`option[data-code={{ $mobile_code }}]`).attr('selected','');
            @endif

            $('select[name=country]').change(function(){
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+'+$('select[name=country] :selected').data('mobile_code'));
            });
            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+'+$('select[name=country] :selected').data('mobile_code'));
            @if($general->secure_password)
                $('input[name=password]').on('input',function(){
                    secure_password($(this));
                });
            @endif

            $('.checkUser').on('focusout',function(e){
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';
                if ($(this).attr('name') == 'mobile') {
                    var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                    var data = {mobile:mobile,_token:token}
                }
                if ($(this).attr('name') == 'email') {
                    var data = {email:value,_token:token}
                }
                if ($(this).attr('name') == 'username') {
                    var data = {username:value,_token:token}
                }
                $.post(url,data,function(response) {
                  if (response['data'] && response['type'] == 'email') {
                    $('#existModalCenter').modal('show');
                  }else if(response['data'] != null){
                    $(`.${response['type']}Exist`).text(`${response['type']} already exist`);
                  }else{
                    $(`.${response['type']}Exist`).text('');
                  }
                });
            });

        })(jQuery);

    </script>
@endpush

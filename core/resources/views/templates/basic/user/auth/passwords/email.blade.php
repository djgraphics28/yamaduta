@extends($activeTemplate.'layouts.auth_master')

@section('content')

@php
    $bgImage = getContent('auth.content', true);
@endphp

<section class="account-section bg_img d-flex" style="background: url({{ getImage('assets/images/frontend/auth/' .@$bgImage->data_values->image, '1920x1280') }}) right;">
    <div class="account-wrapper">
        <div class="logo mb-4">
            <a href="{{ route('home') }}">
                <img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="@lang('logo')">
            </a>
        </div>
        <h3 class="title mb-5">@lang('Reset Password')</h3>
        <form class="account-form" action="{{ route('user.password.email') }}"  method="post">
            @csrf
            <div class="form--group">
                <select class="form-control form--control" name="type">
                    <option value="email">@lang('E-Mail Address')</option>
                    <option value="username">@lang('Username')</option>
                </select>
            </div>
            <div class="form--group">
                <input type="text" class="form--control" name="value" value="{{ old('value') }}" required autofocus="off">
            </div>

          
            <div class="form--group">
                <button type="submit" class="bg--primary w-100">@lang('Send Verification Code')</button>
            </div>
        </form>
       
    </div>
</section>
@endsection
@push('script')
<script>

    (function($){
        "use strict";
        
        myVal();
        $('select[name=type]').on('change',function(){
            myVal();
        });
        function myVal(){
            $('.my_value').text($('select[name=type] :selected').text());
        }
    })(jQuery)
</script>
@endpush
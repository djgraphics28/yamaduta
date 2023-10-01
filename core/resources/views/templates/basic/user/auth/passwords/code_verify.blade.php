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
        <h3 class="title mb-5">@lang('Verify Code')</h3>
        <form class="account-form" action="{{ route('user.password.verify.code') }}"  method="post">
            @csrf
           
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="form-group">
                <label>@lang('Verification Code')</label>
                <input type="text" name="code" id="code" class="form--control">
            </div>
            <div class="form--group mt-3">
                <button type="submit" class="bg--primary w-100">@lang('Verify')</button>
            </div>
            <div class="form-group">
                 <small> @lang('Please check including your Junk/Spam Folder. if not found, you can ') <a class="text--base" href="{{ route('user.password.request') }}">@lang('Try to send again')</a></small>
                 
            </div>
        </form>
    </div>
</section>
@endsection
@push('script')
<script>
    (function($){
        "use strict";
        $('#code').on('input change', function () {
          var xx = document.getElementById('code').value;
          $(this).val(function (index, value) {
             value = value.substr(0,7);
              return value.replace(/\W/gi, '').replace(/(.{3})/g, '$1 ');
          });
      });
    })(jQuery)
</script>
@endpush
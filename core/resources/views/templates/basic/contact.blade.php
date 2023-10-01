@extends($activeTemplate.'layouts.frontend')
@php
    $contact = getContent('contact_us.content', true);

@endphp
@section('content')
<!-- Contact Section Starts Here -->
<section class="contact-section pt-50 pb-50">
    <div class="row gy-4">
        <div class="col-lg-7">
            <div class="contact-form-wrapper" method="post" action="">
                <h4 class="title">{{ __(@$contact->data_values->heading) }}</h4>
                <form class="contact-form" method="post" action="">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form--group">
                                <input name="name" type="text" class="form--control" value="{{ Auth::user() ? auth()->user()->fullname : old('name') }}" placeholder="@lang('Name')" {{ Auth::user() ? 'readonly' : 'required' }}>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form--group">
                                <input name="email" type="email" class="form--control" value="{{ Auth::user() ? auth()->user()->email : old('email') }}" placeholder="@lang('Email')" {{ Auth::user() ? 'readonly' : 'required' }}>
                            </div>
                        </div>
                    </div>
                    <div class="form--group">
                        <input name="subject" type="text" placeholder="@lang('Write your subject')" class="form--control" value="{{old('subject')}}" required>
                    </div>
                    <div class="form--group">
                        <textarea name="message" wrap="off" placeholder="@lang('Write your message')" class="form--control" required>{{old('message')}}</textarea>
                    </div>
                    <div class="form--group">
                        <button class="contact--btn">@lang('Send Us Message')</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="contact-info-wrapper">
                <h4 class="title">@lang('Hotline'):</h4>
                <ul class="contact-list">
                   
                        <li><a href="tel:{{ $contact->data_values->phone }}"><i class="las la-phone-volume"></i> {{ __($contact->data_values->phone) }}</a></li>
                   
                </ul>
                <h4 class="title">@lang('Email'):</h4>
                <ul class="contact-list">
                  
                        <li><a href="mailto:{{ $contact->data_values->email }}"><i class="las la-envelope"></i> {{ __($contact->data_values->email) }}</a></li>
                 
                </ul>
                <h4 class="title">@lang('Address')</h4>
                <p class="address">
                    <i class="las la-map"></i> {{ __(@$contact->data_values->address) }}
                </p>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section Ends Here -->

<!-- Map Section Starts Here -->
<div class="gmaps-area">
    <iframe src = "https://maps.google.com/maps?q={{ @$contact->data_values->map_latitude }},{{ @$contact->data_values->map_longitude }}&hl=es;z=14&amp;output=embed"></iframe>
</div>
@endsection


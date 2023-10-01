@extends($activeTemplate.'layouts.frontend')
@section('content')
    <div class="container pt-50 pb-50">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <img src="{{$deposit->gatewayCurrency()->methodImage()}}" class="card-img-top" alt="@lang('Image')" class="w-100">
                    </div>
                    <div class="col-md-8 d-flex justify-content-center align-items-center">
                        <form action="{{$data->url}}" method="{{$data->method}}">
                            <h4 class="text-center text-uppercase">@lang('Please Pay') {{showAmount($deposit->final_amo)}} {{__($deposit->method_currency)}}</h4>
                            <h4 class="my-3 text-center text-uppercase">@lang('To Get') {{showAmount($deposit->amount)}}  {{__($general->cur_text)}}</h4>
                            <script src="{{$data->src}}"
                                class="stripe-button"
                                @foreach($data->val as $key=> $value)
                                data-{{$key}}="{{$value}}"
                                @endforeach
                            >
                            </script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        (function ($) {
            "use strict";
            $('button[type="submit"]').addClass("btn btn--primary w-100");
        })(jQuery);
    </script>
@endpush

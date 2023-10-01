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
                         <div>
                            <h4 class="text-center text-uppercase">@lang('Please Pay') {{showAmount($deposit->final_amo)}} {{$deposit->method_currency}}</h4>
                            <h4 class="my-3 text-center text-uppercase">@lang('To Get') {{showAmount($deposit->amount)}}  {{__($general->cur_text)}}</h4>
                            <form action="{{$data->url}}" method="{{$data->method}}">
                                <input type="hidden" custom="{{$data->custom}}" name="hidden">
                                <script src="{{$data->checkout_js}}"
                                        @foreach($data->val as $key=>$value)
                                        data-{{$key}}="{{$value}}"
                                    @endforeach >
                                </script>
                            </form>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        (function ($) {
            "use strict";
            $('input[type="submit"]').addClass("btn btn--primary mt-4 btn-lg text-center");
        })(jQuery);
    </script>
@endpush

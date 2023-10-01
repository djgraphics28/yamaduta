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
                        <form action="{{ route('ipn.'.$deposit->gateway->alias) }}" method="POST" class="text-center">
                            @csrf
                            <h4 class="text-uppercase">@lang('Please Pay') {{showAmount($deposit->final_amo)}} {{__($deposit->method_currency)}}</h4>
                            <h4 class="my-3 text-uppercase">@lang('To Get') {{showAmount($deposit->amount)}}  {{__($general->cur_text)}}</h4>
                            <button type="button" class=" mt-2 btn btn--primary w-100" id="btn-confirm">@lang('Pay Now')</button>
                            <script
                                src="//js.paystack.co/v1/inline.js"
                                data-key="{{ $data->key }}"
                                data-email="{{ $data->email }}"
                                data-amount="{{$data->amount}}"
                                data-currency="{{$data->currency}}"
                                data-ref="{{ $data->ref }}"
                                data-custom-button="btn-confirm"
                            >
                            </script>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

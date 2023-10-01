@extends($activeTemplate.'layouts.frontend')


@section('content')
<section class="user-dashboard pt-50 pb-50">
    <div class="container">
        <div class="row">
            @foreach($gatewayCurrency as $data)
                <div class="col-lg-3 col-md-3 mb-4">
                    <div class="card">
                        <h5 class="card-header text-center bg--primary text-white">{{__($data->name)}}
                        </h5>
                        <div class="card-body card-body-deposit">
                            <img src="{{$data->methodImage()}}" class="card-img-top" alt="{{__($data->name)}}" class="w-100">
                        </div>
                        <div class="card-footer">
                            <form action="{{route('user.deposit.insert')}}" method="POST" class="payment-form">
                                @csrf
                                <input type="hidden" name="currency"  value="{{$data->currency}}">
                                <input type="hidden" name="method_code" value="{{$data->method_code}}">
                                <button class="btn btn--primary text-white  w-100 prevent-double-click">@lang('Pay Now')</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection



@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.prevent-double-click').on('click',function(){
                $(this).attr('disabled',true);
                $(this).html('<i class="fas fa-spinner fa-spin"></i> @lang('Processing')...');
                $(this).parents('.payment-form').submit()
            });
        })(jQuery);
    </script>
@endpush



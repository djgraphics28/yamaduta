@extends($activeTemplate.'layouts.frontend')
@section('content')
<section class="user-dashboard pt-50 pb-50">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                       <img src="{{ $data->gatewayCurrency()->methodImage() }}" alt="@lang('Image')" class="w-100" />
                    </div>
                    <div class="col-md-8 mt-5 mt-md-0">
                      
                        <ul class="list-group text-center">
                            <p class="list-group-item">
                                @lang('Amount'):
                                <strong>{{showAmount($data->amount)}} </strong> {{__($general->cur_text)}}
                            </p>
                            <p class="list-group-item"> 
                                @lang('Charge'):
                                <strong>{{showAmount($data->charge)}}</strong> {{__($general->cur_text)}}
                            </p>
                            <p class="list-group-item">
                                @lang('Payable'): <strong> {{showAmount($data->amount + $data->charge)}}</strong> {{__($general->cur_text)}}
                            </p>
                            <p class="list-group-item">
                                @lang('Conversion Rate'): <strong>1 {{__($general->cur_text)}} = {{showAmount($data->rate)}}  {{__($data->baseCurrency())}}</strong>
                            </p>
                            <p class="list-group-item">
                                @lang('In') {{$data->baseCurrency()}}:
                                <strong>{{showAmount($data->final_amo)}}</strong>
                            </p>
    
    
                            @if($data->gateway->crypto==1)
                                <p class="list-group-item">
                                    @lang('Conversion with')
                                    <b> {{ __($data->method_currency) }}</b> @lang('and final value will Show on next step')
                                </p>
                            @endif
                        
    
                            @if( 1000 >$data->method_code)
                         
                                <a href="{{route('user.deposit.confirm')}}" class="btn btn--primary btn-lg w-100 mt-3 ">@lang('Pay Now')</a>
                           
                            @else
                      
                                <a href="{{route('user.deposit.manual.confirm')}}" class="btn btn--primary  btn-lg w-100 mt-3 ">@lang('Pay Now')</a>
                         
                            @endif
                        </ul>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection



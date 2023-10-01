@extends($activeTemplate.'layouts.frontend')

@section('content')
    <div class="pt-50 pb-50">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card box__shadow">
                    <div class="card-body">
                        <form action="{{ route('user.deposit.manual.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <p class="text-center">@lang('You have requested') <b class="text--success">{{ showAmount($data['amount'])  }} {{__($general->cur_text)}}</b> , @lang('Please pay')
                                <b class="text--success">{{showAmount($data['final_amo']) .' '.$data['method_currency'] }} </b> @lang('for successful payment')
                            </p>
                            <h4 class="text-center mb-4">@lang('Please follow the instruction below')</h4><hr>
                            <p class="my-4 text-center">@php echo  $data->gateway->description @endphp</p>
                            @if($method->gateway_parameter)
                                @foreach(json_decode($method->gateway_parameter) as $k => $v)
                                    @if($v->type == "text")
                                        <div class="mb-3">

                                            <label class="fw-bold">
                                                {{__(inputTitle($v->field_level))}}
                                                @if($v->validation == 'required')
                                                <span class="text-danger">*</span>
                                                @endif
                                            </label>

                                            <input type="text" class="form-control form-control-lg" name="{{$k}}" value="{{old($k)}}" placeholder="{{__($v->field_level)}}">
                                        </div>
                                    @elseif($v->type == "textarea")
                                        <div class="mb-3">
                                            <label class="fw-bold"><strong>{{__(inputTitle($v->field_level))}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                            <textarea name="{{$k}}"  class="form-control"  placeholder="{{__($v->field_level)}}" rows="3">{{old($k)}}</textarea>
                                        </div>
                                    @elseif($v->type == "file")
                                        <div class="mb-3">
                                            <label class="fw-bold"><strong>{{__($v->field_level)}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                            <br>

                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail withdraw-thumbnail" data-trigger="fileinput">
                                                    <img src="{{ asset(getImage('/')) }}" alt="@lang('Image')" class="w-100">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail wh-200-150 w-auto"></div>

                                                <div class="img-input-div">
                                                    <span class="btn btn--primary btn-file">
                                                        <span class="fileinput-new "> @lang('Select') {{__($v->field_level)}}</span>
                                                        <span class="fileinput-exists text-white"> @lang('Change')</span>
                                                        <input type="file" name="{{$k}}" accept="image/*" >
                                                    </span>
                                                    <a href="#" class="btn btn-danger fileinput-exists"
                                                    data-dismiss="fileinput"> @lang('Remove')</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                            <button type="submit" class="btn btn--primary w-100 mt-2 text-center">@lang('Pay Now')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('style')
<style>
    .fileinput-preview img{
        max-width: 100%;
        max-height: 220px
    }
</style>
@endpush
@push('script-lib')
<script src="{{asset($activeTemplateTrue.'/js/bootstrap-fileinput.js')}}"></script>
@endpush
@push('style-lib')
<link rel="stylesheet" href="{{asset($activeTemplateTrue.'/css/bootstrap-fileinput.css')}}">
@endpush

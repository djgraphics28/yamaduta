@extends($activeTemplate.'layouts.master')
@section('content')

<div class="col-xl-9">
        <div class="row justify-content-end mb-3">
            <div class="col-lg-5">
                <form action="">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control shadow-none outline-0 border--primary" placeholder="@lang('Order ID')" value="{{$search??''}}">
                        <button type="submit" class="input-group-text bg--primary  text-white border--primary"><i class="las la-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <table class="transection-table-2 box__shadow w-100">
            <thead>
                <tr>
                    <th>@lang('Date')</th>
                    <th>@lang('Order ID')</th>
                    <th>@lang('Product')</th>
                    <th>@lang('Payment')</th>
                    <th>@lang('Status')</th>
                    <th>@lang('Qty')</th>
                    <th>@lang('Amount')</th>
                    <th>@lang('Action')</th>

                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                <tr>
                    <td class="date" data-label="@lang('Date')">
                        {{showDateTime($order->created_at,'d M Y')}}
                    </td>

                    <td class="trx-id" data-label="@lang('Order ID')">{{$order->order_track}}</td>

                    <td  data-label="@lang('Product Name')"><a target="_blank" href="{{route('product.details',[$order->product->id,$order->product->slug])}}">{{shortDescription(@$order->product->name,20)}}</a></td>

                    <td  data-label="@lang('Payment Type')">
                        @if($order->payment_type == 1)
                            @lang('Direct')
                        @else
                            <span title="@lang('Cash On Delivery')">@lang('COD')</span>
                        @endif
                    </td>

                    <td  data-label="@lang('Order Status')">
                        @if(!$order->status)
                            <span class="badge bg--warning badge--md">@lang('Pending')</span>
                        @elseif($order->status == 1)
                            <span class="badge bg--success badge--md">@lang('Delivered')</span>
                        @elseif($order->status == 2)
                            <span class="badge bg--info badge--md">@lang('Processing')</span>
                        @elseif($order->status == 3)
                             <span class="badge bg--danger badge--md">@lang('Cancelled')</span>
                        @endif
                    </td>

                    <td class="amount" data-label="@lang('Qty')">
                        {{$order->qty}}
                    </td>

                    <td class="amount" data-label="@lang('Total Amount')">
                        {{$general->cur_sym}}{{getAmount($order->total_amount)}}
                    </td>

                    <td>
                        @if($order->pay_status != 1 && $order->status == 0)
                            <button class="icon--btn btn--danger cancel" data-id="{{$order->id}}" data-route="{{route('user.cancel.order')}}">
                                <i class="fa fa-times-circle"></i>
                            </button>
                        @else
                            <button class="icon--btn btn--danger disabled"><i class="fa fa-times-circle"></i></button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="text-muted text-center" colspan="100%">@lang('No order found')</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{paginateLinks($orders,'')}}
   </div>

    <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body text-center">
                        <i class="las la-exclamation-circle text-danger display-2 mb-15"></i>
                        <h4 class="text--dark mb-15">@lang('Are you sure want to cancel this order?')</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn--dark h-auto" data-bs-dismiss="modal">@lang('No')</button>
                        <button type="submit"  class="btn--danger  h-auto del">@lang('Yes')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@push('style')
    <style>
        .cancel{
            cursor: pointer;
        }
    </style>
@endpush

@push('script')
     <script>
            'use strict';
            (function ($) {
                $('.cancel').on('click',function(){
                    var route = $(this).data('route')
                    var modal = $('#cancelModal');
                    modal.find('input[name=id]').val($(this).data('id'))
                    modal.find('form').attr('action',route)
                    modal.modal('show');
                })
            })(jQuery);
     </script>
@endpush

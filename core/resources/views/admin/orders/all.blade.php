@extends('admin.layouts.app')

@section('panel')

    <div class="row">

        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('SL')</th>
                                    <th>@lang('Time')</th>
                                    <th>@lang('Order ID') | @lang('User')</th>
                                    <th>@lang('Product')</th>
                                    <th>@lang('Qty')</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Payment')</th>
                                    <th>@lang('Order Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($orders as $order)
                                <td data-label="@lang('SL')">
                                    {{ $orders->firstItem() + $loop->index }}
                                </td>

                                <td class="date" data-label="@lang('Order Date')">
                                    <div>
                                        {{showDateTime($order->created_at,'d M, Y')}}
                                    </div>

                                    {{showDateTime($order->created_at,'h:i A')}}
                                </td>

                                <td class="trx-id" data-label="@lang('Order ID') | @lang('User')">
                                    <div>{{$order->order_track}}</div>
                                    <a target="_blank" href="{{route('admin.users.detail',$order->user_id)}}" >{{@$order->user->username}}</a>
                                </td>

                                <td  data-label="@lang('Product Name')">
                                    <a target="_blank" href="{{route('product.details',[$order->product->id,$order->product->slug])}}">
                                    {{shortDescription(@$order->product->name,20)}}({{$order->product->sku}})</a>
                                </td>

                                <td class="amount" data-label="@lang('Qty')">
                                    <span class="badge badge--primary font-weight-bold">{{$order->qty}}</span>
                                </td>

                                <td class="amount" data-label="@lang('Total Amount/Qty')">
                                    {{$general->cur_sym}}{{getAmount($order->total_amount)}}
                                </td>

                                <td data-label="@lang('Payment')">
                                    @if ($order->payment_type == 1)

                                        <span data-toggle="tooltip" title="@lang('Direct Payment')">@lang('DP')</span>
                                    @else
                                    <span data-toggle="tooltip" title="@lang('Cash On Delivery')">@lang('COD')</span>
                                    @endif
                                </td>

                                <td  data-label="@lang('Order Status')">
                                    @if ($order->status == 0)
                                        <span class="badge badge--warning">@lang('Pending')</span>
                                    @elseif($order->status == 1)
                                        <span class="badge badge--success">@lang('Delivered')</span>
                                    @elseif($order->status == 2)
                                        <span class="badge badge--primary">@lang('Processing')</span>
                                    @elseif($order->status == 3)
                                        <span class="badge badge--danger">@lang('Cancelled')</span>
                                    @endif
                                </td>


                                <td data-label="@lang('Action')">

                                    <a href="{{route('admin.orders.details',$order->id)}}" class="icon-btn" data-toggle="tooltip" title="" data-original-title="@lang('Order Details')">
                                        <i class="las la-desktop text--shadow"></i>
                                    </a>

                                    @if($order->status == 0)
                                        <button data-route="{{route('admin.order.process',$order->id)}}" class="icon-btn btn--info ml-1 process" data-toggle="tooltip" data-original-title="@lang('Mark as Processing')">
                                            <i class="las la-spinner"></i>
                                        </button>
                                    @elseif($order->status == 2)
                                        <button data-route="{{route('admin.order.deliver',$order->id)}}" class="icon-btn btn--success delivered  ml-1" data-toggle="tooltip"  data-original-title="@lang('Mark as Delivered')">
                                            <i class="lar la-check-circle"></i>
                                        </button>
                                    @else
                                        <button class="icon-btn btn--success  ml-1 disabled">
                                            <i class="lar la-check-circle"></i>
                                        </button>
                                    @endif

                                    @if($order->status == 0 && $order->pay_status == 0)
                                        <button type="button" class="icon-btn bg--danger ml-1 cancel"  data-toggle="tooltip" title="@lang('Cancel Order')" data-id="{{$order->id}}" data-route="{{route('admin.order.cancel')}}"><i class="las la-ban"></i>
                                        </button>
                                    @else
                                        <button type="button" class="icon-btn bg--danger ml-1" disabled data-toggle="tooltip" data-id="{{$order->id}}" data-route="{{route('admin.order.cancel')}}"><i class="las la-ban"></i>
                                    @endif
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">@lang('No order found')</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{paginateLinks($orders)}}
                </div>
            </div><!-- card end -->
        </div>


    </div>
    {{-- cancel --}}
    <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="text-center">
                            <i class="las la-exclamation-circle text--danger display-2 mb-15"></i>
                        </div>
                        <h4 class="text--dark mb-15">@lang('Are you sure to cancel this order?')</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('No')</button>
                        <button type="submit"  class="btn btn--danger  del">@lang('Yes')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- processing --}}
    <div class="modal fade" id="processModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="text-center">
                            <i class="las la-exclamation-circle text--danger display-2 mb-15"></i>
                        </div>
                        <h4 class="text--dark mb-15">@lang('Are you sure to mark this as processing?')</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('No')</button>
                        <button type="submit"  class="btn btn--info del">@lang('Yes')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- deliveredModal --}}
    <div class="modal fade" id="deliveredModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="text-center">
                            <i class="las la-exclamation-circle text--danger display-2 mb-15"></i>
                        </div>

                        <h4 class="text--dark mb-15">@lang('Are you sure this order has been delivered?')</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('No')</button>
                        <button type="submit"  class="btn btn--success del">@lang('Yes')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection



@push('breadcrumb-plugins')
    <form action="" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="@lang('Order ID')" value="{{$search ?? ''}}" autocomplete="off">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
@endpush

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
                $('.process').on('click',function(){
                    var route = $(this).data('route')
                    var modal = $('#processModal');
                    modal.find('form').attr('action',route)
                    modal.modal('show');
                })
                $('.delivered').on('click',function(){
                    var route = $(this).data('route')
                    var modal = $('#deliveredModal');
                    modal.find('form').attr('action',route)
                    modal.modal('show');
                })
            })(jQuery);
     </script>
@endpush

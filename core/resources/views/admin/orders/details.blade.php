@extends('admin.layouts.app')

@section('panel')

<div class="invoice-wrapper" id="printarea">
    <div class="invoice-header row justify-content-between pb-4">
        <div class="col-2"><div class="logo"><img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt=""></div></div>
        <div class="col-lg-10">

        </div>
    </div>
    <h2 class="title text-center mb-4 pb-2 border-bottom text--dark">@lang('Invoice')</h2>
    <div class="invoice-body">
        <div class="invoice-info row justify-content-between">
            <div class="col-3">
                <ul class="invoice-info">
                    <li><h6 class="title mb-2">@lang('Bill Form'):</h6></li>
                    <li>{{$general->sitename}}</li>
                    <li>{{$contact->data_values->email}}</li>
                     <li>{{$contact->data_values->phone}}</li>
                </ul>
            </div>
            <div class="col-3">
                <ul class="invoice-info">
                    <li><h6 class="title mb-2">@lang('Bill To'):</h6></li>
                    <li>{{$order->shipping->name}}</li>
                    <li>{{@$order->shipping->address}}</li>
                    <li>{{$order->shipping->email}}</li>
                    <li>{{$order->shipping->phone}}</li>
                </ul>
            </div>
            <div class="col-4">
                <ul class="invoice-details">
                    <li>
                        <h6 class="title">@lang('INVOICE DATE') #</h6>
                        <span class="value">{{now()->format('d M Y')}}</span>
                    </li>

                    <li>
                        <h6 class="title">@lang('PAYMENT') #</h6>
                        <span class="value">{{$order->payment_type == 1 ? 'Direct Payment':'Cash On Delivery'}}</span>
                    </li>

                    <li>
                        <h6 class="title">@lang('ORDER ID') #</h6>
                        <span class="value">{{$order->order_track}}</span>
                    </li>
                </ul>
            </div>
        </div>
        <table class="invoice-product-table">
            <thead>
                <tr>
                    <th>@lang('Product')</th>
                    <th>@lang('Quantity')</th>
                    <th>@lang('Price')</th>
                    <th>@lang('Total')</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="item">
                            <h6 class="name mb-1">{{$order->product->name}}</h6>
                        </div>
                    </td>
                    <td>{{$order->qty}}</td>
                    <td>{{$general->cur_sym}}{{getAmount($order->product_price)}}</td>
                    <td>{{$general->cur_sym}}{{getAmount($order->total_amount)}}</td>
                </tr>

            </tbody>
        </table>
        <ul class="invoice-amount-wrapper">

            <li class="total-amount py-2">
                <h6 class="title">@lang('Total')</h6>
                <span class="value">{{$general->cur_sym}}{{getAmount($order->total_amount)}}</span>
            </li>
        </ul>


        <div class="invoice-footer">
            <ul class="d-flex justify-content-center">
               @lang('For more products visit : '.url('/'))
            </ul>
        </div>
    </div>
</div>

<div class="row justify-content-center mt-4">
    <div class="col-md-3 text-center">
        <button class="btn btn--primary w-100 mb-2" id="print">@lang('Print')</button>

    </div>
    <div class="col-md-3 text-center">
        <button class="btn btn--dark w-100" id="pdf">@lang('Downlaod')</button>

    </div>
</div>
@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{asset('assets/admin/css/dev_custom.css')}}">
@endpush

@push('script')

<script src="{{asset('assets/global/js/html2pdf.bundle.min.js')}}"></script>
<script>
    "use strict";

    const options = {
    margin: 0.3,
    filename: '{{$order->order_track}}',
    image: {
        type: 'jpeg',
        quality: 1.00
    },
    html2canvas: {
        scale: 4
    },
    jsPDF: {
        unit: 'in',
        format: 'letter',
        orientation: 'landscape'
    }
    }
    var objstr = document.getElementById('printarea').innerHTML;
    var strr = objstr;
    $(document).on('click','#pdf',function(e){
        e.preventDefault();
        var element = document.getElementById('pdf');
        html2pdf().from(strr).set(options).save();
    });

    $('#print').on('click', function () {
            window.print()
        });
</script>
@endpush

@push('breadcrumb-plugins')
    <a href="{{route('admin.orders')}}" class="btn btn--dark">@lang('Go Back')</a>
@endpush

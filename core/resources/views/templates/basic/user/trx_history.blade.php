@extends($activeTemplate.'layouts.master')
@section('content')

<div class="col-xl-9">
        <table class="transection-table-2 box__shadow w-100">
            <thead>
                <tr>
                    <th>@lang('Date')</th>
                    <th>@lang('Transaction ID')</th>
                    <th>@lang('Details')</th>
                    <th>@lang('Amount')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $trx)
                <tr>
                    <td class="date" data-label="@lang('Date')">
                        {{showDateTime($trx->created_at,'d M Y')}}
                    </td>
                    <td class="trx-id" data-label="@lang('Transaction ID')">{{$trx->trx}}</td>
                    <td  data-label="@lang('Details')">@lang($trx->details)</td>
                    <td  data-label="@lang('Amount')">{{$general->cur_sym}}{{showAmount($trx->amount)}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{paginateLinks($transactions,'')}}

</div>

@stop

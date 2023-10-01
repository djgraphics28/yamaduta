@extends($activeTemplate.'layouts.master')

@section('content')
    <div class="container col-lg-9">
        <div class="row pb-3">
            <div class="col-md-4">
                <a href="{{route('ticket.open')}}" class="btn btn--primary">@lang('Open New Ticket')</a>
            </div>
        </div>
            <table class="transection-table-2 w-100">
                <thead class="thead-dark">
                <tr>
                    <th>@lang('Subject')</th>
                    <th>@lang('Status')</th>
                    <th>@lang('Priority')</th>
                    <th>@lang('Last Reply')</th>
                    <th>@lang('Action')</th>
                </tr>
                </thead>
                <tbody>
                    @forelse($supports as $key => $support)
                        <tr>
                            <td data-label="@lang('Subject')"> <a href="{{ route('ticket.view', $support->ticket) }}" class="font-weight-bold"> [@lang('Ticket')#{{ $support->ticket }}] {{ __($support->subject) }} </a></td>
                            <td data-label="@lang('Status')">
                                @if($support->status == 0)
                                    <span class="badge bg--success py-2 px-3">@lang('Open')</span>
                                @elseif($support->status == 1)
                                    <span class="badge bg--primary py-2 px-3">@lang('Answered')</span>
                                @elseif($support->status == 2)
                                    <span class="badge bg--warning py-2 px-3">@lang('Customer Reply')</span>
                                @elseif($support->status == 3)
                                    <span class="badge bg--dark py-2 px-3">@lang('Closed')</span>
                                @endif
                            </td>
                            <td data-label="@lang('Priority')">
                                @if($support->priority == 1)
                                    <span class="badge bg--dark py-2 px-3">@lang('Low')</span>
                                @elseif($support->priority == 2)
                                    <span class="badge bg--success py-2 px-3">@lang('Medium')</span>
                                @elseif($support->priority == 3)
                                    <span class="badge bg--primary py-2 px-3">@lang('High')</span>
                                @endif
                            </td>
                            <td data-label="@lang('Last Reply')">{{ \Carbon\Carbon::parse($support->last_reply)->diffForHumans() }} </td>

                            <td data-label="@lang('Action')">
                                <a href="{{ route('ticket.view', $support->ticket) }}" class="btn btn--primary btn-sm">
                                    <i class="fa fa-desktop"></i>
                                </a>
                            </td>
                        </tr>

                    @empty
                    <tr><td colspan="100%" class="text-muted text-center">@lang('No ticket yet')</td></tr>
                    @endforelse
                </tbody>
            </table>

        {{$supports->links()}}

    </div>
@endsection

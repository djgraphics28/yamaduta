
@php
    if (auth()->user()) {
        $extends = 'layouts.master';
        $col = 'col-lg-9';
    } else{
        $extends = 'layouts.frontend';
        $col = 'col-lg-12';
    }
@endphp
@extends($activeTemplate.$extends)

@section('content')
 
    <div class="{{$col}}">
        <div class="ticket__box">
            <div class="ticket__box__header">
             
                    <h5 class="title">
                        [@lang('Ticket')#{{ $my_ticket->ticket }}] {{ $my_ticket->subject }} <br>
                        @if($my_ticket->status == 0)
                            <span class="badge bg--success py-2 px-3 mt-2">@lang('Open')</span>
                        @elseif($my_ticket->status == 1)
                            <span class="badge bg--primary py-2 px-3 mt-2">@lang('Answered')</span>
                        @elseif($my_ticket->status == 2)
                            <span class="badge bg--warning py-2 px-3 mt-2">@lang('Replied')</span>
                        @elseif($my_ticket->status == 3)
                            <span class="badge bg--dark py-2 px-3 mt-2">@lang('Closed')</span>
                        @endif
                    </h5>
                    <button href="#0" class="cmn--btn btn--sm bg--danger text--white close-button" data-bs-toggle="modal" data-bs-target="#DelModal"><span><i class="fa fa-lg fa-times-circle"></i></span></button>
                </div>
            <div class="ticket__box__body">
                
                @if($my_ticket->status != 4)
                    <form method="post" class="ticket__box__form row" action="{{ route('ticket.reply', $my_ticket->id) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="replayTicket" value="1">
                        <div class="form--group col-sm-12">
                            <textarea class="form-control form--control" name="message"></textarea>
                        </div>
                        <div class="form--group col-sm-12">
                            <div class="d-flex">
                                <div class="left-group col p-0">
                                    <label for="file" class="form--label">@lang('Attachments')</label>
                                    <input type="file" class="overflow-hidden form-control form--control ms-0 mb-2" name="attachments[]" id="file">

                                    <div id="fileUploadsContainer"></div>

                                    <span class="info fs--14 mt-2">@lang('Allowed File Extensions'): @lang('.jpg, .jpeg, .png, .pdf, .doc, .docx')</span>
                                </div>
                                <div class="add-area">
                                    <label class="form--label d-block">&nbsp;</label>
                                    <button class="ms-3 bg--primary addFile" type="button"><i class="las la-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form--group col-sm-12 mt-sm-2 mb-0">
                            <button type="submit" class="bg--primary w-100">@lang('Send Message')</button>
                        </div>
                    </form>
                @endif
                            
                    <hr>
                
                <div class="row">
                    <div class="col-md-12">
                        @foreach($messages as $message)
                            @if($message->admin_id == 0)
                                <div class="row border border-primary border-radius-3 my-3 py-3 mx-2">
                                    <div class="col-md-3 border-right text-right">
                                        <h5 class="my-3">{{ $message->ticket->name }}</h5>
                                    </div>
                                    <div class="col-md-9">
                                        <p class="text-muted font-weight-bold my-3">
                                            @lang('Posted on') {{ $message->created_at->format('l, dS F Y @ H:i') }}</p>
                                        <p>{{$message->message}}</p>
                                        @if($message->attachments()->count() > 0)
                                            <div class="mt-2">
                                                @foreach($message->attachments as $k=> $image)
                                                    <a href="{{route('ticket.download',encrypt($image->id))}}" class="mr-3"><i class="fa fa-file"></i>  @lang('Attachment') {{++$k}} </a>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="row border border-warning border-radius-3 my-3 py-3 mx-2" style="background-color: #ffd96729">
                                    <div class="col-md-3 border-right text-right">
                                        <h5 class="my-3">{{ $message->admin->name }}</h5>
                                        <p class="lead text-muted">@lang('Staff')</p>
                                    </div>
                                    <div class="col-md-9">
                                        <p class="text-muted font-weight-bold my-3">
                                            @lang('Posted on') {{ $message->created_at->format('l, dS F Y @ H:i') }}</p>
                                        <p>{{$message->message}}</p>
                                        @if($message->attachments()->count() > 0)
                                            <div class="mt-2">
                                                @foreach($message->attachments as $k=> $image)
                                                    <a href="{{route('ticket.download',encrypt($image->id))}}" class="mr-3"><i class="fa fa-file"></i>  @lang('Attachment') {{++$k}} </a>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('ticket.reply', $my_ticket->id) }}">
                    @csrf
                    <input type="hidden" name="replayTicket" value="2">
                    <div class="modal-header">
                        <h5 class="modal-title"> @lang('Confirmation')!</h5>
                    </div>
                    <div class="modal-body">
                        <strong class="text-dark">@lang('Are you sure you want to close this support ticket')?</strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark btn-sm h-auto" data-bs-dismiss="modal"><i class="fa fa-times"></i>
                            @lang('Close')
                        </button>
                        <button type="submit" class="btn btn--primary btn-sm h-auto"><i class="fa fa-check"></i> @lang("Confirm")
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.delete-message').on('click', function (e) {
                $('.message_id').val($(this).data('id'));
            });
            $('.addFile').on('click',function(){
                $("#fileUploadsContainer").append(
                    `<div class="input-group mt-3">
                        <input type="file" name="attachments[]" class="overflow-hidden form-control form--control ms-0" required />
                        <button class="input-group-text btn btn--danger remove-btn">x</button>
                    </div>`
                )
            });
            $(document).on('click','.remove-btn',function(){
                $(this).closest('.input-group').remove();
            });
        })(jQuery);

    </script>
@endpush

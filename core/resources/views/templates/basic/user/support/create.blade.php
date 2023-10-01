@extends($activeTemplate.'layouts.master')
@section('content')

    <div class="col-lg-9">
        
        <div class="create__ticket">
            <div class="create__ticket__header">
                <h5 class="title">@lang('Create New Ticket')</h5>
                <a href="{{route('ticket')}}" class="cmn--btn btn--sm bg--primary text--white"><span>@lang('All Tickets')</span></a>
            </div>
            <div class="create__ticket__body">
                <form class="create__ticket__form row"  action="{{route('ticket.store')}}"  method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form--group col-sm-6">
                        <label for="name" class="form--label">@lang('Your Name')</label>
                        <input type="text" id="name" name="name" class="form-control form--control" value="{{auth()->user()->fullname}}" required>
                    </div>
                    <div class="form--group col-sm-6">
                        <label for="email" class="form--label">@lang('Your Email')</label>
                        <input type="text" id="email" name="email" class="form-control form--control" value="{{auth()->user()->email}}" required>
                    </div>
                    <div class="form--group col-sm-12">
                        <label for="subject" class="form--label">@lang('Your Subject')</label>
                        <input type="text" id="subject" name="subject" class="form-control form--control" required>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="priority">@lang('Priority')</label>
                        <select name="priority" class="form-control form--control">
                            <option value="3">@lang('High')</option>
                            <option value="2">@lang('Medium')</option>
                            <option value="1">@lang('Low')</option>
                        </select>
                    </div>
                    <div class="form--group col-sm-12">
                        <label for="message" class="form--label">@lang('Your Message')</label>
                        <textarea id="message" class="form-control form--control" name="message" required></textarea>
                    </div>
                    <div class="form--group col-sm-12">
                        <div class="d-flex">
                            <div class="left-group col p-0">
                                <label for="file2" class="form--label">@lang('Attachments')</label>
                                <input type="file" class="overflow-hidden form-control form--control mb-2 ms-0" name="attachments[]" id="file2">
                                <div id="fileUploadsContainer" class="mb-2"></div>
                                <span class="info fs--14">@lang('Allowed File Extensions'): .@lang('jpg'), .@lang('jpeg'), .@lang('png'), .@lang('pdf'), .@lang('doc'), .@lang('docx')</span>
                            </div>
                            <div class="add-area">
                                <label class="form--label d-block">&nbsp;</label>
                                <button class="ms-3  bg--primary addFile" type="button"><i class="las la-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form--group col-sm-12 mb-0">
                        <button class="mt-sm-2 bg--primary" type="submit">@lang('Create Ticket')</button>
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
            $('.addFile').on('click',function(){
                $("#fileUploadsContainer").append(`
                    <div class="input-group mt-3">
                        <input type="file" class="overflow-hidden form-control form--control ms-0" name="attachments[]" id="file2">
                        <button class="input-group-text btn btn--danger remove-btn">x</button>
                        
                    </div>
                `)
            });
            $(document).on('click','.remove-btn',function(){
                $(this).closest('.input-group').remove();
            });
        })(jQuery);
    </script>
@endpush

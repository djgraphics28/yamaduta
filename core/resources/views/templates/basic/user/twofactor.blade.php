@extends($activeTemplate.'layouts.master')
@section('content')
    <div class="col-xl-9">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6">
                @if(Auth::user()->ts)
                    <div class="card">
                        <div class="card-header bg--primary">
                            <h5 class="card-title text-white">@lang('Two Factor Authenticator')</h5>
                        </div>
                        <div class="card-body">
                            <div class="form--group mx-auto text-center">
                                <a href="#0"  class="btn btn-block btn-lg btn-danger" data-bs-toggle="modal" data-bs-target="#disableModal">
                                    @lang('Disable Two Factor Authenticator')</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-header bg--primary">
                            <h5 class="card-title text-white">@lang('Two Factor Authenticator')</h5>
                        </div>
                        <div class="card-body">
                            <div class="form--group">
                                <div class="input-group">
                                    <input type="text" name="key" value="{{$secret}}" class="form-control form--control" id="copyText" readonly>
                                    <span class="input-group-text copytext" id="copyBoard"> <i class="fa fa-copy"></i> </span>
                                </div>
                            </div>
                            <div class="form--group mx-auto text-center mt-3">
                                <img class="mx-auto" src="{{$qrCodeUrl}}">
                            </div>
                            <div class="form-group mx-auto text-center mt-4">
                                <a href="#0" class="btn btn--primary btn-lg" data-bs-toggle="modal" data-bs-target="#enableModal">@lang('Enable Two Factor Authenticator')</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-header bg--primary">
                        <h5 class="card-title text-white">@lang('Google Authenticator')</h5>
                    </div>
                    <div class="card-body">
                        <p>@lang('Google Authenticator is a multifactor app for mobile devices. It generates timed codes used during the 2-step verification process. To use Google Authenticator, install the Google Authenticator application on your mobile device.')</p>
                        <a class="btn btn--primary  mt-3" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en" target="_blank">@lang('DOWNLOAD APP')</a>
                    </div>
                </div><!-- //. single service item -->
            </div>
        </div>
    </div>



    <!--Enable Modal -->
    <div id="enableModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <!-- Modal content-->
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Verify Your Otp')</h4>

                </div>
                <form action="{{route('user.twofactor.enable')}}" method="POST">
                    @csrf
                    <div class="modal-body ">
                        <div class="form-group">
                            <input type="hidden" name="key" value="{{$secret}}">
                            <input type="text" class="form--control" name="code" placeholder="@lang('Enter Google Authenticator Code')">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark h-auto" data-bs-dismiss="modal">@lang('Cancel')</button>
                        <button type="submit" class="btn btn--primary h-auto">@lang('Enable')</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!--Disable Modal -->
    <div id="disableModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Verify Your Otp Disable')</h4>

                </div>
                <form action="{{route('user.twofactor.disable')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form--control" name="code" placeholder="@lang('Enter Google Authenticator Code')">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark h-auto" data-bs-dismiss="modal">@lang('Cancel')</button>
                        <button type="submit" class="btn btn--primary h-auto">@lang('Didable')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        (function($){
            "use strict";

            $('.copytext').on('click',function(){
                var copyText = document.getElementById("copyText");
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                document.execCommand("copy");
                iziToast.success({message: "Copied: " + copyText.value, position: "topRight"});
            });
        })(jQuery);
    </script>
@endpush



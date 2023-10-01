<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('partials.seo')
    <title> {{ $general->sitename(__($pageTitle)) }}</title>
    @include($activeTemplate.'layouts.partials.css')
</head>

<body>
    <div class="overlay"></div>
        @yield('content')
    </div>

    @php
        $cookie = App\Models\Frontend::where('data_keys','cookie.data')->first();
    @endphp

    <!-- Modal -->
    <div class="modal fade" id="cookieModal" tabindex="-1" role="dialog" aria-labelledby="cookieModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cookieModalLabel">@lang('Cookie Policy')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @php echo @$cookie->data_values->description @endphp
                <a href="{{ @$cookie->data_values->link }}" target="_blank">@lang('Read Policy')</a>
            </div>
            <div class="modal-footer">
                <a href="{{ route('cookie.accept') }}" class="btn btn-primary">@lang('Accept')</a>
            </div>
            </div>
        </div>
    </div>

    @include($activeTemplate.'layouts.partials.js')

</body>
</html>

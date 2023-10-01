@extends($activeTemplate.'layouts.frontend')

@section('content')
<!-- Policy Section Starts Here -->
<section class="policy-section pt-50 pb-50">
    <div class="policy-wrapper">
        <h3 class="section-title">{{ __($pageTitle) }}</h3>
        <p>
            @php
                echo $content->data_values->details;
            @endphp
        </p>
    </div>
</section>
<!-- Policy Section Ends Here -->
@endsection

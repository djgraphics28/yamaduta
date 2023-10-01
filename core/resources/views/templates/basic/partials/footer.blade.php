 @php
     $footer        = getContent('footer.content', true);
     $links         = getContent('social_icon.element', false,  null, true);
     $policyPages   = getContent('policy_pages.element', false,  null, true);
 @endphp

<div class="container p-0">
    <footer class="footer-section">
        <div class="footer-wrapper">
            <ul class="footer-links">

                <li><a href="{{ route('about') }}">@lang('About')</a></li>
                <li>
                    <a href="{{ route('blogs') }}">@lang('Blog')</a>
                </li>

                <li><a href="{{ route('faq') }}">@lang('Faq')</a></li>

                @foreach($policyPages as $singlePolicy)
                    <li>
                        <a href="{{ route('policy.details', ['policy'=>slug($singlePolicy->data_values->title), 'id'=>$singlePolicy->id]) }}">
                            {{ __($singlePolicy->data_values->title) }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <ul class="social-links">
                @foreach($links as $socialLink)
                    <li>
                        <a href="{{ $socialLink->data_values->url }}" target="_blank">
                            @php
                                echo $socialLink->data_values->social_icon;
                            @endphp
                        </a>
                    </li>
                @endforeach
            </ul>
            <p class="copy-rights">@lang('Copyright') &copy; {{ date('Y') }} {{ __($general->sitename) }} @lang('All Rights Reserved')</p>
        </div>
    </footer>
</div>


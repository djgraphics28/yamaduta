@extends($activeTemplate.'layouts.frontend')
@section('content')
<!-- Blog Details Section Starts Here -->
<section class="blog-details pt-50 pb-50">
    <div class="row gy-sm-5 gy-4">
        <div class="col-lg-8">
            <div class="post-item">
                <div class="post-thumb"><img src="{{ getImage('assets/images/frontend/blog/' .@$blog->data_values->image, '800x510') }}" alt="blog"></div>
                <div class="post-content">
                    <ul class="meta-post">
                        <li><i class="las la-calendar-check"></i>{{ showDateTime($blog->created_at, 'd M, Y') }}</li>
                    </ul>
                    <h4 class="title">{{ __($blog->data_values->title) }}</h4>
                    <p>
                        @php echo $blog->data_values->description; @endphp
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="blog-sidebar">
                <div class="sidebar-item">
                    <h5 class="title">@lang('Latest Blogs')</h5>
                    <div class="recent-post-wrapper">
                        @forelse($latestBlogs as $singleBlog)
                            <div class="recent-post-item">
                                <div class="thumb"><img src="{{ getImage('assets/images/frontend/blog/' .@$singleBlog->data_values->image, '800x510') }}" alt="blog"></div>
                                <div class="content">
                                    <h6 class="title hover-line">
                                        <a href="{{ route('blog.details', ['slug'=>slug($singleBlog->data_values->title), 'id'=>$singleBlog->id]) }}">
                                            {{ shortDescription($singleBlog->data_values->title, 50) }}
                                        </a>
                                    </h6>
                                    <span class="date"><i class="las la-calendar-check"></i>{{ showDateTime($singleBlog->created_at, 'd M, Y') }}</span>
                                </div>
                            </div>
                        @empty

                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Section Ends Here -->
<div class="fb-comments" data-href="{{ route('blog.details', ['slug'=>slug($singleBlog->data_values->title), 'id'=>$singleBlog->id]) }}" data-numposts="5"></div>

@endsection
@push('fbComment')
	@php echo loadFbComment() @endphp
@endpush

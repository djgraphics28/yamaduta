@extends($activeTemplate.'layouts.frontend')
@section('content')

    <!-- Blod Section Starts Here -->
<section class="blog-section pt-50 pb-50">
    <div class="row g-3 justify-content-center">
        @foreach($blogs as $blog)
            <div class="col-lg-4 col-xl-3 col-md-6 col-sm-10">
                <div class="post-item">

                    <div class="post-thumb">
                        <img src="{{ getImage('assets/images/frontend/blog/' .@$blog->data_values->image, '800x510') }}" alt="Blog">
                    </div>

                    <div class="post-content">
                        <span class="meta-date">{{ showDateTime($blog->created_at, 'd M, Y') }}</span>
                        <h4 class="title">
                            <a href="{{ route('blog.details', ['slug'=>slug($blog->data_values->title), 'id'=>$blog->id]) }}">
                                {{ shortDescription($blog->data_values->title, 45) }}
                            </a>
                        </h4>
                    </div>

                </div>
            </div>
        @endforeach
    </div>

    {{ $blogs->links() }}

</section>

@endsection

@push('fbComment')
	@php echo loadFbComment() @endphp
@endpush

<div>
    <ul class="product-preview">
        @forelse ($records as $item)
            <li>
                <a href="#">
                    <div class="picture">
                        <figure class="liquid">

                            <img src="{{ asset('storage/' . $item->main_image) }}" alt="product1">
                        </figure>
                    </div>
                </a>
                <a href="#">
                    <p class="highlighted category">{{ $item->category->name }}</p>
                </a>
                <a href="#">
                    <h6>{{ $item->name }}</h6>
                </a>
                <!-- RATING -->
                <ul class="rating">
                    <li class="filled">
                        <!-- SVG STAR -->
                        <svg class="svg-star">
                            <use xlink:href="#svg-star"></use>
                        </svg>
                        <!-- /SVG STAR -->
                    </li>
                    <li class="filled">
                        <!-- SVG STAR -->
                        <svg class="svg-star">
                            <use xlink:href="#svg-star"></use>
                        </svg>
                        <!-- /SVG STAR -->
                    </li>
                    <li class="filled">
                        <!-- SVG STAR -->
                        <svg class="svg-star">
                            <use xlink:href="#svg-star"></use>
                        </svg>
                        <!-- /SVG STAR -->
                    </li>
                    <li class="filled">
                        <!-- SVG STAR -->
                        <svg class="svg-star">
                            <use xlink:href="#svg-star"></use>
                        </svg>
                        <!-- /SVG STAR -->
                    </li>
                    <li>
                        <!-- SVG STAR -->
                        <svg class="svg-star">
                            <use xlink:href="#svg-star"></use>
                        </svg>
                        <!-- /SVG STAR -->
                    </li>
                </ul>
                <!-- /RATING -->
                <p class="highlighted current">Php {{ $item->price }}</p>
            </li>
        @empty
            <p>No Data Found</p>
        @endforelse

    </ul>
</div>

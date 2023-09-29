<div>
    <div class="shop-products">
        <h3 class="title">Shop</h3>
        <figure class="section-banner">
            <img src="{{ asset('images/clothes/banner_1.jpg') }}" alt="men-banner">
        </figure>
        <!-- FILTERS -->


        <!-- PRODUCT LIST -->
        <ul class="product-list grid-v2">
            @forelse ($records as $item)
                <!-- PRODUCT -->
                <a href="{{ url('/shop/showproducts/' . $item->id) }}">
                    <li class="list-item">

                        <!-- ACTIONS -->
                        <div class="actions">
                            <figure class="liquid">
                                <img src="{{ asset('uploads/products/' . $item->main_image) }}" alt="image">
                            </figure>
                        </div>
                        <!-- /ACTIONS -->

                        <!-- DESCRIPTION -->
                        <div class="description">
                            <div class="clearfix">
                                <a href="#">
                                    <p class="highlighted category"> {{ $item->category->name }}</p>
                                </a>
                                <!-- RATING -->
                                <ul class="rating big">
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
                            </div>
                            <div class="clearfix">
                                <a href="#">
                                    <h6>{{ $item->name }}</h6>
                                </a>
                            </div>
                            <div class="clearfix">
                                {{-- <p class="long-description">{{ $item->description }}</p> --}}
                                <p class="highlighted current"> Php {{ $item->price }}</p>
                            </div>


                        </div>
                        <!-- /DESCRIPTION -->
                    </li>
                    <!-- /PRODUCT -->
                </a>


            @empty
            <p>No Product found</p>
            @endforelse
        </ul>
        <!-- /PRODUCT LIST -->
        {{ $records->links() }}
    </div>
</div>

<div>
    <!-- SLIDE CONTROLS -->
    <ul class="slide-controls">
        <!-- LEFT CONTROL -->
        <li>
            <a href="#" class="button prev">
                <!-- SVG ARROW -->
                <svg class="svg-arrow">
                    <use xlink:href="#svg-arrow"></use>
                </svg>
                <!-- /SVG ARROW -->
            </a>
        </li>
        <!-- /LEFT CONTROL -->

        <!-- RIGHT CONTROL -->
        <li>
            <a href="#" class="button next">
                <!-- SVG ARROW -->
                <svg class="svg-arrow">
                    <use xlink:href="#svg-arrow"></use>
                </svg>
                <!-- /SVG ARROW -->
            </a>
        </li>
        <!-- /RIGHT CONTROL -->
    </ul>
    <!-- /SLIDE CONTROLS -->


    <!-- PRODUCT LIST -->

    <ul id="owl-f-products" class="product-list grid owl-carousel">

        @forelse ($records as $item)
            <!-- PRODUCT -->
            <li class="list-item">
                <!-- ACTIONS -->
                <div class="actions">
                    <figure class="liquid">
                        <img src="{{ asset('storage/' . $item->main_image) }}" alt="product1">
                    </figure>
                    <div>
                        <a href="#qv-p{{ $item->id }}" class="button quick-view" data-effect="mfp-3d-unfold">
                            <!-- SVG QUICKVIEW -->
                            <svg class="svg-quickview">
                                <use xlink:href="#svg-quickview"></use>
                            </svg>
                            <!-- /SVG QUICKVIEW -->
                        </a>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <center>
                            <button class="btn-warning">
                                Add to cart
                            </button>
                        </center>

                        <!-- QUICK VIEW POPUP -->
                        <div id="qv-p{{ $item->id }}" class="product-quick-view mfp-with-anim mfp-hide">
                            <!-- PRODUCT PICTURES -->
                            <div class="product-pictures">
                                <div class="product-photo">
                                    <figure class="liquid">
                                        <img src="{{ asset('storage/' . $item->main_image) }}" alt="product-image">
                                    </figure>
                                </div>
                                <ul class="picture-views">
                                    @forelse ($item->child_products as $child)
                                        <!-- VIEW -->
                                        <li class="selected">
                                            <figure class="liquid">
                                                <img src="{{ asset('storage/' . $child->image) }}" alt="picture-view">
                                            </figure>
                                        </li>
                                        <!-- /VIEW -->
                                    @empty
                                    @endforelse
                            </div>
                            <!-- /PRODUCT PICTURES -->

                            <!-- PRODUCT DESCRIPTION -->
                            <div class="product-description">
                                <a href="#">
                                    <p class="highlighted category">{{ $item->category->name }}</p>
                                </a>
                                <a href="#">
                                    <h6>{{ $item->name }}</h6>
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
                                <p>Hustle Tee available now, with free vinyl Yamaduta sticker.
                                    Available in white and red colorway.
                                    Send us Message for orders.
                                    Availble for walk-in at Barangay Pinagbuhatan Pasig city, COD around Metro Manila.
                                    Shipping nation wide
                                </p>
                                <p class="highlighted current">Php {{ $item->price }}</p>
                                @if ($item->old_price)
                                    <p class="highlighted previous">Php {{ $item->old_price }}</p>
                                @endif

                                <h5 class="stock">Availability:
                                    <!-- SVG CHECK -->
                                    <svg class="svg-check">
                                        <use xlink:href="#svg-check"></use>
                                    </svg>
                                    <!-- /SVG CHECK -->

                                    @if ($item->total_stock > 0)
                                        <span class="available">
                                            In Stocks
                                        </span>
                                    @endif

                                </h5>
                                <h5>Available Size:</h5>
                                <form class="thirdy-form">
                                    @php
                                        $colors = [];
                                    @endphp
                                    @forelse ($item->child_products as $child)
                                        @php
                                            $colors[] = $child->color;
                                        @endphp
                                        <input id="{{ $child->size }}" type="radio" name="size"
                                            value="{{ $child->size }}">
                                        <label for="{{ $child->size }}"><span
                                                class="radio"><span></span></span>{{ $child->size }}</label>
                                    @empty
                                    @endforelse


                                    {{-- <input id="medium1" type="radio" name="size" value="medium">
                                    <label for="medium1"><span class="radio"><span></span></span>Medium</label>

                                    <input id="large1" type="radio" name="size" value="large" checked>
                                    <label for="large1"><span class="radio"><span></span></span>Large</label>

                                    <input id="extralarge1" type="radio" name="size" value="extralarge">
                                    <label for="extralarge1"><span class="radio"><span></span></span>Extra
                                        Large</label> --}}
                                </form>
                                <div class="color-selection">
                                    <h5> Available Color:</h5>
                                    <!-- COLORPICKER -->
                                    <ul class="colorpicker">
                                        @php
                                            if (!empty($colors)) {
                                                $colorData = array_unique($colors);
                                            }
                                        @endphp

                                        @forelse ($colorData as $color)
                                            @php
                                                switch ($color) {
                                                    case 'BLUE':
                                                        $hexcode = '#0000FF';
                                                        break;
                                                    case 'RED':
                                                        $hexcode = '#FF0000';
                                                        break;
                                                    case 'BLACK':
                                                        $hexcode = '#000000';
                                                        break;
                                                    case 'GREEN':
                                                        $hexcode = '#008000';
                                                        break;
                                                    case 'WHITE':
                                                        $hexcode = '#FFFFF';
                                                        break;

                                                    default:
                                                        $hexcode = '#FFFFF';
                                                        break;
                                                }
                                            @endphp
                                            <li><span data-color="{{ $hexcode }}"></span></li>
                                        @empty
                                        @endforelse

                                        {{-- <li class="selected"><span data-color="#FF0000"></span></li> --}}

                                    </ul>
                                    <!-- /COLORPICKER -->
                                </div>

                            </div>
                            <!-- /PRODUCT DESCRIPTION -->
                        </div>
                        <!-- /QUICK VIEW POPUP -->



                    </div>
                </div>
                <!-- /ACTIONS -->

                <!-- DESCRIPTION -->
                <div class="description">
                    <div class="clearfix">
                        <a href="#">
                            <p class="highlighted category">{{ $item->category->name }}</p>
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
                    </div>
                    <div class="clearfix">
                        <a href="#">
                            <h6>{{ $item->name }}</h6>
                        </a>
                    </div>
                    <div class="clearfix">
                        <p>{{ $item->description }}</p>
                        <p class="highlighted current">Php {{ $item->price }}</p>
                    </div>

                    <!-- /DESCRIPTION -->
            </li>
            <!-- /PRODUCT -->
        @empty
            <p>No Data Found</p>
        @endforelse

    </ul>
    <!-- /PRODUCT LIST -->
</div>

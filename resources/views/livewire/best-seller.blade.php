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
    <ul id="owl-bs-products" class="product-list grid owl-carousel">

        <!-- PRODUCT 1a -->
        @forelse ($records as $item)
            <!-- PRODUCT -->
            <li class="list-item">
                <!-- ACTIONS -->
                <div class="actions">
                    <figure class="liquid">
                        <img src="{{ asset('images/clothes/1.jpg') }}" alt="product1">
                    </figure>
                    <div>
                        <a href="#qv-p1" class="button quick-view" data-effect="mfp-3d-unfold">
                            <!-- SVG QUICKVIEW -->
                            <svg class="svg-quickview">
                                <use xlink:href="#svg-quickview"></use>
                            </svg>
                            <!-- /SVG QUICKVIEW -->
                        </a>
                        <!-- QUICK VIEW POPUP -->
                        <div id="qv-p1" class="product-quick-view mfp-with-anim mfp-hide">
                            <!-- PRODUCT PICTURES -->
                            <div class="product-pictures">
                                <div class="product-photo">
                                    <figure class="liquid">
                                        <img src="images/clothes/1.jpg" alt="product-image">
                                    </figure>
                                </div>
                                <ul class="picture-views">
                                    <!-- VIEW -->
                                    <li class="selected">
                                        <figure class="liquid">
                                            <img src="images/clothes/1.jpg" alt="picture-view">
                                        </figure>
                                    </li>
                                    <!-- /VIEW -->

                                    <!-- VIEW -->
                                    <li>
                                        <figure class="liquid">
                                            <img src="images/clothes/2.jpg" alt="picture-view">
                                        </figure>
                                    </li>
                                    <!-- /VIEW -->
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
                                <p class="highlighted current">Php 450.00</p>
                                <p class="highlighted previous">Php 990.25</p>
                                <h5 class="stock">Availability:
                                    <!-- SVG CHECK -->
                                    <svg class="svg-check">
                                        <use xlink:href="#svg-check"></use>
                                    </svg>
                                    <!-- /SVG CHECK -->
                                    <span class="available">In Stock</span>
                                </h5>
                                <h5>Available Size:</h5>
                                <form class="thirdy-form">

                                    {{-- @php
                                    $sizeData = [];

                                    $sizes = App\Models\Size::all();

                                    foreach($sizes as $data) {
                                        $sizeData[] = $data
                                    }

                                @endphp

                                @forelse ($item->size as $size)


                                <input id="{{ $size[''] }}" type="radio" name="size" value="small">
                                <label for="small1"><span class="radio"><span></span></span>Small</label>
                                @empty

                                @endforelse --}}
                                    <input id="small1" type="radio" name="size" value="small">
                                    <label for="small1"><span class="radio"><span></span></span>Small</label>

                                    <input id="medium1" type="radio" name="size" value="medium">
                                    <label for="medium1"><span class="radio"><span></span></span>Medium</label>

                                    <input id="large1" type="radio" name="size" value="large" checked>
                                    <label for="large1"><span class="radio"><span></span></span>Large</label>

                                    <input id="extralarge1" type="radio" name="size" value="extralarge">
                                    <label for="extralarge1"><span class="radio"><span></span></span>Extra
                                        Large</label>
                                </form>
                                <div class="color-selection">
                                    <h5> Available Color:</h5>
                                    <!-- COLORPICKER -->
                                    <ul class="colorpicker">
                                        <li><span data-color="#FFFFF"></span></li>
                                        <li class="selected"><span data-color="#FF0000"></span></li>

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

                    <button class="btn-warning">
                        Add to cart
                    </button>
                    <!-- /DESCRIPTION -->
            </li>
            <!-- /PRODUCT -->
        @empty
            <p>No Data Found</p>
        @endforelse


        <!-- /PRODUCT -->
    </ul>
</div>

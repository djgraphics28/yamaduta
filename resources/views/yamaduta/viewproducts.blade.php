@extends('yamaduta.frontend')
@section('content')
    <!-- SHOP -->
    <div id="shop-wrap">

        <section id="shop" class="right expandible-sidebar">

            <!-- FULL VIEW -->
            <div class="product-quick-view full view">
                <!-- PRODUCT PICTURES -->
                <div class="product-pictures">
                    <div class="product-photo">
                        <figure class="liquid">
                            <img src="{{ asset('storage/' . $product->main_image) }}" alt="product-image">
                        </figure>
                    </div>

                </div>
                <!-- /PRODUCT PICTURES -->

                <!-- PRODUCT DESCRIPTION -->
                <div class="product-description">
                    <a href="#">
                        <p class="highlighted category"></p>
                    </a>
                    <a href="#">
                        <h6>{{ $product->name }}</h6>
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
                    <p>{{ $product->description }}</p>
                    <p class="highlighted current">Php {{ $product->price }}</p>

                    <h5> Size:
                        {{-- @forelse ($product->child_products as $child)
                            {{ $child->size }}
                        @empty
                        @endforelse --}}

                        @php
                            $colors = [];
                        @endphp
                        @forelse ($product->child_products as $child)
                            @php
                                $colors[] = $child->color;
                            @endphp
                            <input id="{{ $child->size }}" type="radio" name="size" value="{{ $child->size }}">
                            <label for="{{ $child->size }}"><span
                                    class="radio"><span></span></span>{{ $child->size }}</label>
                        @empty
                        @endforelse
                    </h5>
                    <br>
                    <div class="color-selection">

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
                        {{-- <h5>Color: {{ $product->color }}</h5> --}}

                    </div>


                </div>
                <!-- /PRODUCT DESCRIPTION -->
            </div>
            <!-- /FULL VIEW -->

    </div>
    <!-- /RATE -->
@endsection

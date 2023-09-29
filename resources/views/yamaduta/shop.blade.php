@extends('yamaduta.frontend')
@section('content')

<!-- SHOP -->
<div id="shop-wrap">
    <section id="shop" class="right expandible-sidebar">
        <!-- SIDEBAR CONTROL -->
        <div class="sidebar-control">
            <!-- SVG GEAR -->
            <svg class="svg-gear">
                <use xlink:href="#svg-gear"></use>
            </svg>
            <!-- /SVG GEAR -->
        </div>
        <!-- /SIDEBAR CONTROL -->

        <!-- SHOP SIDEBAR -->
        <aside class="shop-sidebar">
            <!-- SIDEBAR CONTROL -->
            <svg class="svg-plus sidebar-control">
                <use xlink:href="#svg-plus"></use>
            </svg>
            <!-- /SIDEBAR CONTROL -->

            <h3 class="title">Featured Items</h3>

            <!-- PRODUCT PREVIEW -->
                 @livewire('featured-products')
            <!-- /PRODUCT PREVIEW -->

        </aside>
        <!-- /SHOP SIDEBAR -->

        <!-- SHOP PRODUCTS -->
        @livewire('shop-products')
        <!-- /SHOP PRODUCTS -->
        <div class="clearfix"></div>
    </section>
</div>
<!-- /SHOP -->


@endsection

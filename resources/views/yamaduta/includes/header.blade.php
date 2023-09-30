<style>
    /* Styling for the sticky navigation container */
    .sticky-nav {
        position: sticky;
        top: 0;
        background-color: #fff;
        /* Set your desired background color */
        z-index: 100;
        /* Adjust the z-index as needed */
    }

    /* Styling for the navigation menu */
    #main-menu {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 50px;
    }

    #main-menu ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
    }

    #main-menu li {
        margin-right: 20px;
    }

    #main-menu a {
        text-decoration: none;
        color: #333;
        /* Set your desired text color */
    }

    /* Add any additional styles as needed */
</style>
<!-- MOBILE MENU COVER -->
<div class="mobile-menu-cover"></div>
<!-- /MOBILE MENU COVER -->

<!-- MOBILE MENU -->
<nav class="mobile-menu">
    <img src="images/yamaduta_text.png" alt="logo">
    <!-- SVG PLUS -->
    <svg class="svg-plus pull-nav">
        <use xlink:href="#svg-plus"></use>
    </svg>
    <!-- /SVG PLUS -->

    <!-- MENU LIST -->
    <ul>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/shop') }}">SHOP</a></li>
        <li><a href="{{ url('/about') }}">About us</a></li>
        <li><a href="{{ url('/contact') }}">Contact</a></li>

        <!--	<li><a href="#">CART</a></li> -->


    </ul>
    </ul>
    <!-- /MENU LIST -->
</nav>
<!-- /MOBILE MENU -->


<!-- MAIN MENU -->
<div class="sticky-nav">
    <nav id="main-menu">
        <img class="pull-nav" src="images/icons/pull-icon.png" alt="pull-icon">
        <ul>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ route('shop') }}">Shop</a></li>
            <li><a href="{{ route('aboutUs') }}">About us</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
            <li><a href="{{ route('cart.list') }}">Cart</a></li>
            @guest
                @if (Route::has('login'))
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endif

                @if (Route::has('register'))
                    <li><a href="{{ route('register') }}">Sign Up</a></li>
                @endif
            @else
                <li><a href="#">{{ Auth::user()->name }}</a></li>
                <li><a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                     {{ __('Logout') }}
                 </a>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                </li>

            @endguest


        </ul>
    </nav>
</div>
<!-- /MAIN MENU -->
<!-- /WRAPPER -->

<!-- JS Global -->

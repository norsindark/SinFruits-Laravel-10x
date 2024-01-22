<div class="row">
    <div class="col-lg-12 col-custom">
        <div class="row align-items-center">
            <div class="col-lg-2 col-xl-2 col-sm-6 col-6 col-custom">
                <div class="header-logo d-flex align-items-center">
                    <a href="{{ url('/') }}">
                        <img class="img-full" src="{{  asset('assets/images/logo/logo.png')}}" alt="Header Logo" />
                    </a>
                </div>
            </div>
            <div class="col-lg-8 col-xl-7 position-static d-none d-lg-block col-custom">
                <nav class="main-nav d-flex justify-content-center">
                    <ul class="nav">
                        <li>
                            <a href="{{ url('/') }}">
                                <span class="menu-text"> Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('client.categories.index') }}">
                                <span class="menu-text">Categories</span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <div class="mega-menu dropdown-hover">
                                <div class="menu-colum">
                                    <ul>
                                        <li><span class="mega-menu-text">Categories</span></li>
                                        @foreach ($categories as $category)
                                            <li><a
                                                    href="{{ url('category.show', $category->id) }}">{{ $category->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </li>

                        <li>
                            <a href="about-us.html">
                                <span class="menu-text"> About</span>
                            </a>
                        </li>
                        <li>
                            <a href="contact-us.html">
                                <span class="menu-text">Contact</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-2 col-xl-3 col-sm-6 col-6 col-custom">
                <div class="header-right-area main-nav">
                    <ul class="nav">
                        <li class="login-register-wrap d-none d-xl-flex">
                            @auth
                                <span
                                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                    <a href="#">{{ Auth::user()->name }}</a>
                                    <ul class="dropdown-submenu dropdown-hover">
                                        <li>
                                            <a href="{{ url('profile.show') }}">My Profile</a>
                                        </li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <x-responsive-nav-link :href="route('logout')"
                                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                                    {{ __('Log Out') }}
                                                </x-responsive-nav-link>
                                            </form>
                                        </li>
                                    </ul>
                                </span>
                            @else
                                @if (Route::has('login'))
                                    <span>
                                        <a href="{{ url('/sign-in') }}"
                                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                                            in
                                        </a>
                                    </span>
                                @endif

                                @if (Route::has('register'))
                                    <span>
                                        <a href="{{ url('/sign-up') }}"
                                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register
                                        </a>
                                    </span>
                                @endif
                            @endauth
                        </li>

                        <li class="login-register-wrap d-none d-xl-flex">
                            @auth
                                <span
                                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                    @if (Auth::user()->role == 1)
                                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                                    @endif
                                </span>
                            @endauth
                        </li>


                        <li class="minicart-wrap">
                            <a href="#" class="minicart-btn toolbar-btn">
                                <i class="ion-bag"></i>
                                <span class="cart-item_count">3</span>
                            </a>
                            <div class="cart-item-wrapper dropdown-sidemenu dropdown-hover-2">
                                <div class="single-cart-item">
                                    <div class="cart-img">
                                        <a href="cart.html"><img src="assets/images/cart/1.jpg" alt="" /></a>
                                    </div>
                                    <div class="cart-text">
                                        <h5 class="title">
                                            <a href="cart.html">11. Product with video - navy</a>
                                        </h5>
                                        <div class="cart-text-btn">
                                            <div class="cart-qty">
                                                <span>1×</span>
                                                <span class="cart-price">$98.00</span>
                                            </div>
                                            <button type="button"><i class="ion-trash-b"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-cart-item">
                                    <div class="cart-img">
                                        <a href="cart.html"><img src="assets/images/cart/2.jpg" alt="" /></a>
                                    </div>
                                    <div class="cart-text">
                                        <h5 class="title">
                                            <a href="cart.html"
                                                title="10. This is the large title for testing large title and there is an image for testing - white">10.
                                                This is the large title for testing...</a>
                                        </h5>
                                        <div class="cart-text-btn">
                                            <div class="cart-qty">
                                                <span>1×</span>
                                                <span class="cart-price">$98.00</span>
                                            </div>
                                            <button type="button"><i class="ion-trash-b"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-cart-item">
                                    <div class="cart-img">
                                        <a href="cart.html"><img src="assets/images/cart/3.jpg" alt="" /></a>
                                    </div>
                                    <div class="cart-text">
                                        <h5 class="title">
                                            <a href="cart.html">1. New and sale badge product - s / red</a>
                                        </h5>
                                        <div class="cart-text-btn">
                                            <div class="cart-qty">
                                                <span>1×</span>
                                                <span class="cart-price">$98.00</span>
                                            </div>
                                            <button type="button"><i class="ion-trash-b"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="cart-price-total d-flex justify-content-between">
                                    <h5>Total :</h5>
                                    <h5>$166.00</h5>
                                </div>
                                <div class="cart-links d-flex justify-content-center">
                                    <a class="obrien-button white-btn" href="cart.html">View cart</a>
                                    <a class="obrien-button white-btn" href="checkout.html">Checkout</a>
                                </div>
                            </div>
                        </li>
                        <li class="mobile-menu-btn d-lg-none">
                            <a class="off-canvas-btn" href="#">
                                <i class="fa fa-bars"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

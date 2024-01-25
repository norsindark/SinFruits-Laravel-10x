<div class="row">
    <div class="col-lg-12 col-custom">
        <div class="row align-items-center">

            {{-- logo  --}}
            <div class="col-lg-2 col-xl-2 col-sm-6 col-6 col-custom">
                <div class="header-logo d-flex align-items-center">
                    <a href="{{ url('/') }}">
                        <img class="img-full" src="{{ asset('assets/images/logo/logo.png') }}" alt="Header Logo" />
                    </a>
                </div>
            </div>


            {{-- Drop down  --}}
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
                                        {{-- @foreach ($categories as $category)
                                            <li><a
                                                    href="{{ url('category.show', $category->id) }}">{{ $category->name }}</a>
                                            </li>
                                        @endforeach --}}
                                        @foreach ($categories as $category)
                                            <li>
                                                <a
                                                    href="{{ route('client.products.showByCategory', $category->slug) }}">
                                                    {{ $category->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </li>

                        @auth
                            <li>
                                <a href="{{ route('client.cart.index') }}">
                                    <span class="menu-text"> Cart</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('client.user.index') }}" onclick="setActiveTab('orders')">
                                    <span class="menu-text">Your Orders</span>
                                </a>
                            </li>
                        @endauth

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


            {{-- Auth --}}
            <div class="col-lg-2 col-xl-3 col-sm-6 col-6 col-custom">
                <div class="header-right-area main-nav">
                    <ul class="nav">
                        <li class="login-register-wrap d-none d-xl-flex">


                            {{-- User -> Auth  --}}
                            @auth
                            <div class="col-auto" style="max-width: 50px; max-height: 50px">
                                <div class="avatar avatar-xl position-relative">
                                    <img src="{{ asset('storage/profile-images/' . auth()->user()->profile_image) }}" alt="Profile Image" style="border-radius: 12px;">
                                </div>
                            </div>
                            
                                {{-- User  --}}
                                <span
                                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                    <a href="{{ route('client.user.index') }}">{{ Auth::user()->name }}</a>
                                    <ul class="dropdown-submenu dropdown-hover">
                                        <li>
                                            <x-responsive-nav-link : href="{{ route('client.user.index') }}">
                                                <Strong>MY PROFILE</Strong>
                                            </x-responsive-nav-link>
                                        </li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <x-responsive-nav-link :href="route('logout')"
                                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                                    <i class="fa fa-sign-out"></i> LOGOUT
                                                </x-responsive-nav-link>
                                            </form>
                                        </li>
                                    </ul>
                                </span>

                                {{-- guest --}}
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


                        {{-- dashboard --}}
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


                        {{-- Mini Cart  --}}
                        @auth
                            <li class="minicart-wrap">
                                <a href="{{ url('/cart') }}" class="minicart-btn toolbar-btn">
                                    <i class="ion-bag"></i>
                                    <span class="cart-item_count">{{ $count }}</span>
                                </a>
                                {{-- @php
                                $totalPrice = 0;
                            @endphp --}}


                                {{-- products  --}}
                                <div class="cart-item-wrapper dropdown-sidemenu dropdown-hover-2">


                                    {{-- Cart items  --}}
                                    @foreach ($cartItems as $item)
                                        <div class="single-cart-item">


                                            {{-- image --}}
                                            <div class="cart-img">
                                                <a href="{{ route('client.product.details', $item->title) }}">
                                                    @php
                                                        $imagePath = $item->productImages->isNotEmpty() ? asset($item->productImages->first()->image_path) : asset('path_to_default_image/default_image.jpg');
                                                    @endphp
                                                    <img src="{{ $imagePath }}" alt="Product Image">
                                                </a>
                                            </div>


                                            {{-- title --}}
                                            <div class="cart-text">
                                                <h5 class="title">
                                                    <a href="{{ route('client.product.details', $item->title) }}">
                                                        {{ $item->name }}
                                                    </a>
                                                </h5>


                                                {{-- quantit x pice --}}
                                                <div class="cart-text-btn">

                                                    {{-- quantit x pice --}}
                                                    <div class="cart-qty">
                                                        <span>
                                                            {{ $item->pivot->quantity }} x
                                                        </span>
                                                        <span class="cart-price">
                                                            {{ number_format($item->product_details->price) }} VNĐ
                                                        </span>
                                                    </div>


                                                    {{-- remove product  --}}
                                                    <button type="button">
                                                        <a href="javascript:void(0);" class="remove-from-cart"
                                                            data-product-id="{{ $item->id }}">
                                                            <i class="ion-trash-b"></i>
                                                        </a>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                    {{-- total price  --}}
                                    <div class="cart-price-total d-flex justify-content-between">
                                        <h5>Total :</h5>
                                        <h5> {{ number_format($subTotal, 0, '.', '.') }} VNĐ</h5>
                                    </div>


                                    {{-- Action  --}}
                                    @if ($cartItems->count() > 0)
                                        <div class="cart-links d-flex justify-content-center">
                                            <a class="obrien-button white-btn" href="{{ route('client.cart.index') }}">View
                                                cart</a>
                                            <a class="obrien-button white-btn"
                                                href="{{ route('client.checkout.index') }}">Checkout</a>
                                        </div>
                                    @endif



                                </div>
                            </li>
                        @endauth

                        {{-- mobile  --}}
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

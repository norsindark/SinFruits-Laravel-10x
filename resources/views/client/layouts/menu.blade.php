<header class="main-header-area">
    <!-- Header Top Area Start Here -->
    <div class="header-top-area">
        <div class="container container-default-2 custom-area">
            <div class="row">
                <div class="col-12 col-custom header-top-wrapper text-center">
                    <div class="short-desc text-white">
                        <p>Get 35% off for new product</p>
                    </div>
                    <div class="header-top-button">
                        <a href="shop-fullwidth.html">Shop Now</a>
                    </div>
                    <span class="top-close-button">X</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Top Area End Here -->
    <!-- Main Header Area Start -->
    <div class="main-header">
        <div class="container container-default custom-area">
            
            {{-- navbar  --}}
            @include('client.layouts.navbar')

        </div>
    </div>
    <!-- Main Header Area End -->

    <!-- Sticky Header Start Here-->
    <div class="main-header header-sticky">
        <div class="container container-default custom-area">
            
            {{-- navbar  --}}
            @include('client.layouts.navbar')

        </div>
    </div>

    <!-- off-canvas menu start -->
    @include('client.layouts.mobile')
    
</header>

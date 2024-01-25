@extends('client.layouts.master')

@section('content')

    <body>

        <div class="shop-wrapper">

            <!-- Breadcrumb Area Start Here -->
            <div class="breadcrumbs-area position-relative">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="breadcrumb-content position-relative section-content">
                                <h3 class="title-3">Shop Sidebar</h3>
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li>Categories</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Shop Main Area Start Here -->
            <div class="shop-main-area">
                <div class="container container-default custom-area">
                    <div class="row flex-row-reverse">
                        <div class="col-lg-9 col-12 col-custom widget-mt">


                            <!--shop toolbar start-->
                            <div class="shop_toolbar_wrapper">


                                {{-- toolbar  --}}
                                <div class="shop_toolbar_btn">
                                    <button data-role="grid_list" type="button" class="active btn-list"
                                        data-bs-toggle="tooltip" title="List">
                                        <i class="fa fa-th-list"></i>
                                    </button>
                                    <button data-role="grid_3" type="button" class="btn-grid-3" data-bs-toggle="tooltip"
                                        title="3">
                                        <i class="fa fa-th"></i>
                                    </button>
                                </div>



                                {{-- sort products --}}
                                <div class="shop-select">
                                    <form class="d-flex flex-column w-100" action="{{ route('client.products.sorted') }}"
                                        method="get" id="sortForm">
                                        @csrf
                                        <div class="form-group">
                                            <select class="form-control nice-select w-100" name="sort_by" id="sortSelect">
                                                <option selected value="1">Alphabetically, A-Z</option>
                                                <option value="2">Sort by rating</option>
                                                <option value="3">Sort by latest</option>
                                                <option value="4">Sort by price: low to high</option>
                                                <option value="5">Sort by price: high to low</option>
                                            </select>
                                        </div>
                                        <button type="submit" id="sortButton">
                                            <i class="fa-solid fa-check-to-slot"></i> sort
                                        </button>
                                    </form>
                                </div>

                            </div>


                            <!-- Shop Wrapper Start -->
                            <div class="row shop_wrapper grid_list">

                                {{-- products  --}}
                                @foreach ($products as $product)
                                    <div class="col-12 col-custom product-area">
                                        <div class="single-product position-relative">

                                            {{-- Image --}}
                                            <div class="product-image">
                                                <a class="d-block"
                                                    href="{{ route('client.product.details', $product->title) }}">
                                                    @php
                                                        $imagePath = $product->productImages->isNotEmpty() ? asset($product->productImages->first()->image_path) : asset('path_to_default_image/default_image.jpg');
                                                    @endphp
                                                    <img src="{{ $imagePath }}" alt="Product Image"
                                                        class="product-image-1 w-100 img-fluid"
                                                        style="max-width: 175px; max-height: 175px; min-width: 175px; min-height: 175px;">
                                                </a>
                                            </div>

                                            {{-- Product Content --}}
                                            <div class="product-content">

                                                {{-- Rating --}}
                                                <div class="product-rating">
                                                    @php
                                                        $averageRating = $product->reviews->avg('rating');
                                                    @endphp

                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $averageRating)
                                                            <i class="fa fa-star"></i>
                                                        @elseif ($i - $averageRating < 0.5)
                                                            <i class="fa fa-star-half-o"></i>
                                                        @else
                                                            <i class="fa fa-star-o"></i>
                                                        @endif
                                                    @endfor
                                                </div>

                                                {{-- Title --}}
                                                <div class="product-title">
                                                    <h4 class="title-2"><a
                                                            href="{{ route('client.product.details', $product->title) }}">{{ $product->name }}</a>
                                                    </h4>
                                                </div>

                                                {{-- Price --}}
                                                <div class="price-box">
                                                    <span
                                                        class="regular-price">${{ $product->product_details->price }}</span>
                                                </div>
                                            </div>

                                            {{-- Add Action --}}
                                            <div class="add-action d-flex position-absolute">
                                                {{-- <form id="addToCartForm" action="{{ route('client.cart.add') }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <input type="hidden" name="quantity" value="1">

                                                    <div class="add-to_cart">
                                                        <button type="submit" id="addToCartButton"></button>
                                                    </div>
                                                </form>

                                                <a href="javascript:;" title="Add To cart" id="addToCartLink"><i
                                                        class="ion-bag"></i></a> --}}
                                                <a href="{{ route('client.product.details', $product->title) }}"
                                                    title="Details"><i class="fa-solid fa-circle-info"></i></a>
                                            </div>

                                            {{-- Product Content Listview --}}
                                            <div class="product-content-listview">

                                                {{-- Rating --}}
                                                <div class="product-rating">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $averageRating)
                                                            <i class="fa fa-star"></i>
                                                        @elseif ($i - $averageRating < 0.5)
                                                            <i class="fa fa-star-half-o"></i>
                                                        @else
                                                            <i class="fa fa-star-o"></i>
                                                        @endif
                                                    @endfor
                                                </div>

                                                {{-- Title --}}
                                                <div class="product-title">
                                                    <h4 class="title-2"><a
                                                            href="{{ route('client.product.details', $product->title) }}">{{ $product->name }}</a>
                                                    </h4>
                                                </div>

                                                {{-- Price --}}
                                                <div class="price-box">
                                                    <span
                                                        class="regular-price">${{ $product->product_details->price }}</span>
                                                </div>

                                                {{-- Action --}}
                                                <div class="add-action-listview d-flex">
                                                    <a href="{{ route('client.product.details', $product->title) }}"
                                                        title="Details"><i class="fa-solid fa-circle-info"></i></a>
                                                </div>

                                                {{-- Description --}}
                                                <p class="desc-content">{{ $product->product_details->description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                                {{-- end products  --}}
                            </div>


                            {{-- Pagination --}}
                            <div class="row">
                                <div class="col-sm-12 col-custom">
                                    <div class="toolbar-bottom mt-30">
                                        <nav class="pagination pagination-wrap mb-10 mb-sm-0">
                                            <ul class="pagination">
                                                {{-- Previous Page Link --}}
                                                @if ($products->onFirstPage())
                                                    <li class="disabled prev">
                                                        <i class="ion-ios-arrow-thin-left"></i>
                                                    </li>
                                                @else
                                                    <li class="prev">
                                                        <a href="{{ $products->previousPageUrl() }}" rel="prev"
                                                            title="Previous >>">
                                                            <i class="ion-ios-arrow-thin-left"></i>
                                                        </a>
                                                    </li>
                                                @endif

                                                {{-- Pagination Elements --}}
                                                @foreach ($products as $page => $url)
                                                    @if ($page == $products->currentPage())
                                                        <li class="active"><a>{{ $page }}</a></li>
                                                    @else
                                                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                                                    @endif
                                                @endforeach

                                                {{-- Next Page Link --}}
                                                @if ($products->hasMorePages())
                                                    <li class="next">
                                                        <a href="{{ $products->nextPageUrl() }}" rel="next"
                                                            title="Next >>">
                                                            <i class="ion-ios-arrow-thin-right"></i>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li class="disabled next">
                                                        <i class="ion-ios-arrow-thin-right"></i>
                                                    </li>
                                                @endif
                                            </ul>
                                        </nav>
                                        <p class="desc-content text-center text-sm-right">
                                            Showing {{ $products->firstItem() }} - {{ $products->lastItem() }} of
                                            {{ $products->total() }} results
                                        </p>
                                    </div>
                                </div>
                            </div>



                        </div>


                        {{-- sidebar  --}}
                        <div class="col-lg-3 col-12 col-custom">


                            <!-- Sidebar Widget Start -->
                            <aside class="sidebar_widget widget-mt">
                                <div class="widget_inner">

                                    {{-- Search Box --}}
                                    @include('client.pages.products.search')


                                    {{-- Menu Categories --}}
                                    @include('client.pages.categories.menu')


                                    {{-- Recent Products --}}
                                    @include('client.pages.products.recent')


                                </div>
                            </aside>
                            <!-- Sidebar Widget End -->
                        </div>


                    </div>
                </div>
            </div>



        </div>

        <!-- Modal Area Start Here -->
        @include('client.components.modal')
        <!-- Modal Area End Here -->


        {{-- info icon --}}
        <script>
            document.getElementById('addToCartLink').addEventListener('click', function() {
                document.getElementById('addToCartForm').submit();
            });
        </script>


        {{-- sort --}}


    </body>
@endsection

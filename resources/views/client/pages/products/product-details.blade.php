@extends('client.layouts.master')

@section('content')

    <body>

        <div class="shop-wrapper">

            <!-- Single Product Main Area Start -->
            <div class="single-product-main-area">
                <div class="container container-default custom-area">

                    {{-- details top  --}}
                    <div class="row">

                        {{-- image  --}}
                        <div class="col-lg-5 col-custom">
                            <div class="product-details-img horizontal-tab">
                                {{-- <div class="product-slider popup-gallery product-details_slider"
                                    data-slick-options='{
                                            "slidesToShow": 1,
                                            "arrows": false,
                                            "fade": true,
                                            "draggable": false,
                                            "swipe": false,
                                            "asNavFor": ".pd-slider-nav"
                                            }'>
                                    @foreach ($product->productImages as $productImage)
                                        <div class="single-image border"
                                            style="max-width: 585.4px; max-height: 585.4px; min-width: 585.4px; min-height: 585.4px;">
                                            <a href="{{ $productImage->image_path }}">
                                                <img src="{{ asset($productImage->image_path) }}" alt="Product">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="pd-slider-nav product-slider"
                                    data-slick-options='{
                                            "slidesToShow": 4,
                                            "asNavFor": ".product-details_slider",
                                            "focusOnSelect": true,
                                            "arrows" : false,
                                            "spaceBetween": 30,
                                            "vertical" : false
                                            }'
                                    data-slick-responsive='[
                                                {"breakpoint":1501, "settings": {"slidesToShow": 4}},
                                                {"breakpoint":1200, "settings": {"slidesToShow": 4}},
                                                {"breakpoint":992, "settings": {"slidesToShow": 4}},
                                                {"breakpoint":575, "settings": {"slidesToShow": 3}}
                                            ]'>
                                    @foreach ($product->productImages as $productImage)
                                        <div class="single-thumb border"
                                            style="max-width: 138.4px; max-height: 138.4px; min-width: 138.4px; min-height: 138.4px;">
                                            <img src="{{ asset($productImage->image_path) }}" alt="Product Thumbnail">
                                        </div>
                                    @endforeach
                                </div> --}}
                            </div>
                        </div>
                        {{-- image  --}}


                        {{-- product details  --}}
                        <div class="col-lg-7 col-custom">
                            <div class="product-summery position-relative">

                                {{-- title  --}}
                                <div class="product-head mb-3">
                                    <h2 class="product-title">{{ $product->name }}</h2>
                                </div>


                                {{-- price  --}}
                                <div class="price-box mb-2">
                                    <span class="regular-price">{{ number_format($product->product_details->price) }}
                                        VNĐ</span>
                                </div>


                                {{-- Rating --}}
                                @if ($product->productReviews && $product->productReviews->isNotEmpty())
                                    <div class="product-rating mb-3">
                                        @php
                                            $averageRating = $product->productReviews->avg('rating');
                                            $roundedRating = round($averageRating, 1);
                                            $fullStars = floor($averageRating);
                                            $hasHalfStar = $averageRating - $fullStars >= 0.5;
                                        @endphp

                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $fullStars)
                                                <i class="fa-solid fa-star"></i>
                                            @elseif ($hasHalfStar)
                                                <i class="fa-solid fa-star-half-stroke"></i>
                                                @php $hasHalfStar = false; @endphp
                                            @else
                                                <i class="fa-regular fa-star"></i>
                                            @endif
                                        @endfor
                                        <span>( {{ $roundedRating }} ) </span>
                                    </div>
                                @else
                                    <div class="product-rating mb-3">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa-regular fa-star"></i>
                                        @endfor
                                    </div>
                                @endif



                                {{-- ID  --}}
                                <div class="sku mb-3">
                                    <span>SKU: {{ $product->id }}</span>
                                </div>


                                {{-- description --}}
                                <p class="desc-content mb-5">
                                    {{ $product->product_details->description }}
                                </p>


                                {{-- In stocks  --}}
                                <div class="sku mb-3">
                                    <span>Stocks: {{ $product->quantity->quantity }} </span>
                                </div>



                                {{-- add quantity to cart --}}
                                <div class="quantity-with_btn mb-4">
                                    {{-- quantity  --}}
                                    <div class="quantity">
                                        <form action="{{ route('client.cart.add') }}" method="POST">
                                            @csrf
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" name="quantity" value="1"
                                                    type="text">
                                                <div class="dec qtybutton">-</div>
                                                <div class="inc qtybutton">+</div>
                                            </div>
                                            <input type="hidden" name="product_id" value="{{ $product->id }}"> <br>
                                            {{-- add to cart  --}}
                                            <div class="add-to_cart">
                                                <button type="submit" class="btn obrien-button primary-btn">
                                                    Add to cart
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                {{-- @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif --}}


                                {{-- buy  --}}
                                <div class="buy-button mb-5">
                                    <a href="#" class="btn obrien-button-3 black-button">Buy it now</a>
                                </div>


                                {{-- contact  --}}
                                <div class="social-share mb-4">
                                    <span>Share :</span>
                                    <a href="#"><i class="fa fa-facebook-square facebook-color"></i></a>
                                    <a href="#"><i class="fa fa-twitter-square twitter-color"></i></a>
                                    <a href="#"><i class="fa fa-linkedin-square linkedin-color"></i></a>
                                    <a href="#"><i class="fa fa-pinterest-square pinterest-color"></i></a>
                                </div>


                                {{-- payment  --}}
                                <div class="payment">
                                    <a href="#"><img class="border" src="assets/images/payment/img-payment.png"
                                            alt="Payment"></a>
                                </div>
                            </div>
                        </div>
                    </div>




                    {{-- detail mid  --}}
                    <div class="row mt-no-text">
                        <div class="col-lg-12">

                            {{-- nav menu  --}}
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active text-uppercase" id="home-tab" data-bs-toggle="tab"
                                        href="#connect-1" role="tab" aria-selected="true">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-uppercase" id="profile-tab" data-bs-toggle="tab"
                                        href="#connect-2" role="tab" aria-selected="false">Reviews</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-uppercase" id="contact-tab" data-bs-toggle="tab"
                                        href="#connect-3" role="tab" aria-selected="false">Shipping Policy</a>
                                </li>
                            </ul>


                            {{-- content  --}}
                            <div class="tab-content mb-text" id="myTabContent">


                                {{-- tab description  --}}
                                <div class="tab-pane fade show active" id="connect-1" role="tabpanel"
                                    aria-labelledby="home-tab">


                                    {{-- description  --}}
                                    <div class="desc-content">
                                        <p class="mb-3">
                                            {{ $product->product_details->description }}
                                        </p>
                                    </div>
                                </div>



                                {{-- tab reviews  --}}
                                <div class="tab-pane fade" id="connect-2" role="tabpanel" aria-labelledby="profile-tab">
                                    <!-- Start Single Content -->
                                    <div class="product_tab_content  border p-3">
                                        <div class="review_address_inner">

                                            {{-- User Reviews --}}
                                            @if ($reviews->isNotEmpty())
                                                @foreach ($reviews as $review)
                                                    @include('client.pages.products.components.review', [
                                                        'review' => $review,
                                                        'product' => $product,
                                                    ])
                                                @endforeach

                                                {{-- Pagination --}}
                                                <div class="row">
                                                    <div class="col-sm-12 col-custom">
                                                        <div class="toolbar-bottom mt-30">
                                                            <nav class="pagination pagination-wrap mb-10 mb-sm-0">
                                                                <ul class="pagination">
                                                                    {{ $reviews->links('vendor.pagination.bootstrap-5') }}
                                                                </ul>
                                                            </nav>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <p>No reviews available for this product.</p>
                                            @endif



                                        </div>

                                        {{-- !Auth  --}}
                                        @auth
                                            <div class="comments-area comments-reply-area">
                                                <div class="row">
                                                    <div class="col-lg-12 col-custom">
                                                        <form action="{{ route('client.comments.store') }}"
                                                            class="comment-form-area" method="POST">
                                                            @csrf
                                                            <div class="shop-select">
                                                                <h6 class="rating-title-2 mb-2">Your Rating</h6>
                                                                <div class="form-group">
                                                                    <div class="review_info">
                                                                        <select class="form-control nice-select w-100"
                                                                            name="rating" id="rating" required>
                                                                            <option value="1">1 Star</option>
                                                                            <option value="2">2 Stars</option>
                                                                            <option value="3">3 Stars</option>
                                                                            <option value="4">4 Stars</option>
                                                                            <option value="5">5 Stars</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="comment-form-comment mb-3">
                                                                <label for="comment">Comment</label>
                                                                <textarea id="comment" name="comment" class="comment-notes" required="required"></textarea>
                                                            </div>
                                                            <input type="hidden" name="product_id"
                                                                value="{{ $product->id }}">

                                                            <div class="comment-form-submit">

                                                                <button value="Submit"
                                                                    class="comment-submit btn obrien-button primary-btn"
                                                                    type="submit">Submit Comment</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        @endauth
                                    </div>
                                </div>



                                {{-- Shipping Policy --}}
                                <div class="tab-pane fade" id="connect-3" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="shipping-policy">
                                        <h4 class="title-3 mb-4">Shipping policy for our store</h4>
                                        <p class="desc-content mb-2">Lorem ipsum dolor sit amet, consectetuer adipiscing
                                            elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam
                                            erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                                            ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis
                                            autem vel eum iriure dolor in hendrerit in vulputate</p>
                                        <ul class="policy-list mb-2">
                                            <li>1-2 business days (Typically by end of day)</li>
                                            <li><a href="#">30 days money back guaranty</a></li>
                                            <li>24/7 live support</li>
                                            <li>odio dignissim qui blandit praesent</li>
                                            <li>luptatum zzril delenit augue duis dolore</li>
                                            <li>te feugait nulla facilisi.</li>
                                        </ul>
                                        <p class="desc-content mb-2">Nam liber tempor cum soluta nobis eleifend option
                                            congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi
                                            non habent claritatem insitam; est usus legentis in iis qui facit eorum</p>
                                        <p class="desc-content mb-2">claritatem. Investigationes demonstraverunt lectores
                                            legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus,
                                            qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera
                                            gothica, quam nunc putamus parum claram, anteposuerit litterarum formas
                                            humanitatis per</p>
                                        <p class="desc-content mb-2">seacula quarta decima et quinta decima. Eodem modo
                                            typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- RELATED PRODUCT --}}
            <div class="product-area mb-text">
                <div class="container container-default custom-area">
                    <div class="row">
                        <div class="col-lg-5 m-auto text-center col-custom">
                            <div class="section-content">
                                <h2 class="title-1 text-uppercase">Related Product</h2>
                                <div class="desc-content">
                                    <p>You can check the related product for your shopping collection.</p>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-lg-12 product-wrapper col-custom">
                            <div class="product-slider"
                                data-slick-options='{
                        "slidesToShow": 4,
                        "slidesToScroll": 1,
                        "infinite": true,
                        "arrows": false,
                        "dots": false
                        }'
                                data-slick-responsive='[
                        {"breakpoint": 1200, "settings": {
                        "slidesToShow": 3
                        }},
                        {"breakpoint": 992, "settings": {
                        "slidesToShow": 2
                        }},
                        {"breakpoint": 576, "settings": {
                        "slidesToShow": 1
                        }}
                        ]'>


                                {{-- product --}}
                                @foreach ($ascProducts as $item)
                                    <div class="single-item">
                                        <div class="single-product position-relative">
                                            <div class="product-image">

                                                <a class="d-block"
                                                    style="min-height: 340px; min-weight:340px ;max-height: 340px; max-weight:340px"
                                                    href="{{ route('client.product.details', $item->title) }}">
                                                    @php
                                                        $imagePath = $item->productImages->isNotEmpty() ? asset($item->productImages->first()->image_path) : asset('path_to_default_image/default_image.jpg');
                                                    @endphp
                                                    <img src="{{ $imagePath }}" alt="Product Image"
                                                        class="img-fluid">
                                                </a>
                                            </div>

                                            {{-- content --}}
                                            <div class="product-content">


                                                {{-- rating  --}}
                                                @include('client.pages.products.rating')



                                                {{-- title --}}
                                                <div class="product-title">
                                                    <h4 class="title-2"> <a
                                                            href="{{ route('client.product.details', $item->title) }}">{{ $item->name }}</a>
                                                    </h4>
                                                </div>


                                                {{-- price  --}}
                                                <div class="price-box mb-2">
                                                    <span
                                                        class="regular-price">{{ number_format($item->product_details->price) }}
                                                        VNĐ</span>
                                                </div>

                                            </div>

                                            {{-- icon --}}
                                            <div class="add-action d-flex position-absolute">
                                                <a href="{{ route('client.product.details', $item->title) }}"
                                                    title="Details"><i class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- YOU MAY ALSO LIKE --}}
            <div class="product-area mb-no-text">
                <div class="container container-default custom-area">
                    <div class="row">
                        <div class="col-lg-5 m-auto text-center col-custom">
                            <div class="section-content">
                                <h2 class="title-1 text-uppercase">You May Also Like</h2>
                                <div class="desc-content">
                                    <p>Most of the customers choose our products. You may also like our product.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 product-wrapper col-custom">
                            <div class="product-slider"
                                data-slick-options='{
                        "slidesToShow": 4,
                        "slidesToScroll": 1,
                        "infinite": true,
                        "arrows": false,
                        "dots": false
                        }'
                                data-slick-responsive='[
                        {"breakpoint": 1200, "settings": {
                        "slidesToShow": 3
                        }},
                        {"breakpoint": 992, "settings": {
                        "slidesToShow": 2
                        }},
                        {"breakpoint": 576, "settings": {
                        "slidesToShow": 1
                        }}
                        ]'>

                                {{-- product --}}
                                @foreach ($products as $item)
                                    <div class="single-item">
                                        <div class="single-product position-relative">
                                            <div class="product-image">

                                                <a class="d-block" style="min-height: 340px; min-weight:340px"
                                                    href="{{ route('client.product.details', $item->title) }}">
                                                    @php
                                                        $imagePath = $item->productImages->isNotEmpty() ? asset($item->productImages->first()->image_path) : asset('path_to_default_image/default_image.jpg');
                                                    @endphp
                                                    <img src="{{ $imagePath }}" alt="Product Image"
                                                        class="img-fluid">
                                                </a>
                                            </div>

                                            {{-- content --}}
                                            <div class="product-content">


                                                {{-- rating  --}}
                                                @include('client.pages.products.rating')


                                                {{-- title --}}
                                                <div class="product-title">
                                                    <h4 class="title-2"> <a
                                                            {{ route('client.product.details', $item->title) }}>{{ $item->name }}</a>
                                                    </h4>
                                                </div>


                                                {{-- price  --}}
                                                <div class="price-box mb-2">
                                                    <span
                                                        class="regular-price">{{ number_format($item->product_details->price) }}
                                                        VNĐ</span>
                                                </div>

                                            </div>

                                            {{-- icon --}}
                                            <div class="add-action d-flex position-absolute">
                                                <a href="{{ route('client.product.details', $item->title) }}"
                                                    title="Details"><i class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>

        <!-- Modal Area Start Here -->
        @include('client.components.modal')
        <!-- Modal Area End Here -->

        <!-- Scroll to Top Start -->
        <a class="scroll-to-top" href="#">
            <i class="ion-chevron-up"></i>
        </a>

        {{-- add to cart  --}}
        <script>
            $(document).ready(function() {
                // Increment and decrement quantity
                $('.qtybutton').on('click', function() {
                    var $button = $(this);
                    var oldValue = $('#quantity-input').val();

                    if ($button.hasClass('inc')) {
                        var newVal = parseFloat(oldValue) + 1;
                    } else {
                        // Don't allow decrementing below 1
                        var newVal = parseFloat(oldValue) - 1;
                        newVal = newVal <= 1 ? 1 : newVal;
                    }

                    $('#quantity-input').val(newVal);
                });

                // Add to cart button click
                $('#add-to-cart-btn').on('click', function(e) {
                    e.preventDefault();

                    // Get product ID and quantity
                    var productId = "{{ $product->id }}";
                    var quantity = $('#quantity-input').val();

                    // Send an AJAX request to add the product to the cart
                    $.ajax({
                        type: 'POST',
                        url: 'dashboard/cart/add',
                        data: {
                            productId: productId,
                            quantity: quantity
                        },
                        success: function(response) {
                            // Handle success, update UI or show a notification
                            alert('Product added to the cart!');
                        },
                        error: function(error) {
                            // Handle error, show an error message
                            alert('Error adding product to the cart.');
                        }
                    });
                });
            });
        </script>


        {{-- reply form --}}
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                let replyButtons = document.querySelectorAll('.showReplyFormBtn, .showReplyFormBtnNew');
        
                replyButtons.forEach(function (button) {
                    button.addEventListener('click', function () {
                        // Lấy ID của review từ thuộc tính data-review-id
                        let reviewId = this.getAttribute('data-review-id');
        
                        // Tìm form tương ứng với reviewId
                        let form = document.querySelector('.replyForm[data-review-id="' + reviewId + '"]');
        
                        if (form.style.display === 'none' || form.style.display === '') {
                            form.style.display = 'block';
                        } else {
                            form.style.display = 'none';
                        }
                    });
                });
            });
        </script>




    </body>
@endsection

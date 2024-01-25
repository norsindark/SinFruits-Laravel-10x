<div class="widget-list widget-mb-4">

    <h3 class="widget-title">Recent Products</h3>
    <div class="sidebar-body">

        @foreach ($recentProducts as $recentProduct)
            <div class="sidebar-product align-items-center">

                {{-- Image --}}
                <a href="{{ route('client.product.details', $recentProduct->title) }}" class="image">
                    @php
                        $imagePath = $recentProduct->productImages->isNotEmpty() ? asset($recentProduct->productImages->first()->image_path) : asset('path_to_default_image/default_image.jpg');
                    @endphp
                    <img src="{{ $imagePath }}" alt="{{ $recentProduct->title }}">
                </a>

                {{-- Content --}}
                <div class="product-content">

                    {{-- Title --}}
                    <div class="product-title">
                        <h4 class="title-2">
                            <a href="{{ route('client.product.details', $recentProduct->title) }}">
                                {{ $recentProduct->name }}
                            </a>
                        </h4>
                    </div>

                    {{-- Price --}}
                    <div class="price-box">
                        <span class="regular-price">${{ $recentProduct->product_details->price }}</span>
                    </div>

                    {{-- Rating --}}
                    @if ($recentProduct->productReviews && $recentProduct->productReviews->isNotEmpty())
                        <div class="product-rating mb-3">
                            @php
                                $averageRating = $recentProduct->productReviews->avg('rating');
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
                        </div>
                    @else
                        <div class="product-rating mb-3">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa-regular fa-star"></i>
                            @endfor
                        </div>
                    @endif


                </div>
            </div>
        @endforeach

    </div>
</div>

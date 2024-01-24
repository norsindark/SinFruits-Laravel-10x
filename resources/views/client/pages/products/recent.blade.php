<div class="widget-list widget-mb-4">

    <h3 class="widget-title">Recent Products</h3>
    <div class="sidebar-body">

        @foreach ($recentProducts as $recentProduct)
            <div class="sidebar-product align-items-center">

                {{-- Image --}}
                <a href="#" class="image">
                    @php
                        $imagePath = $recentProduct->productImages->isNotEmpty() ? asset($recentProduct->productImages->first()->image_path) : asset('path_to_default_image/default_image.jpg');
                    @endphp
                    <img src="{{ $imagePath }}" alt="Product Image">
                </a>

                {{-- Content --}}
                <div class="product-content">

                    {{-- Title --}}
                    <div class="product-title">
                        <h4 class="title-2">
                            <a
                                href="{{ url('product.details', $recentProduct->id) }}">
                                {{ $recentProduct->name }}
                            </a>
                        </h4>
                    </div>

                    {{-- Price --}}
                    <div class="price-box">
                        <span
                            class="regular-price">${{ $recentProduct->product_details->price }}</span>
                    </div>

                    {{-- Rating --}}
                    <div class="product-rating">
                        @php
                            $averageRating = $recentProduct->reviews->avg('rating');
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

                </div>
            </div>
        @endforeach

    </div>
</div>
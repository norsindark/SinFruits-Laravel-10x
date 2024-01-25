@if ($item->productReviews && $item->productReviews->isNotEmpty())
    <div class="product-rating mb-3">
        @php
            $averageRating = $item->productReviews->avg('rating');
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

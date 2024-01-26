@if ($review->parent == null)
    @if ($review->status == 0)
        <div class="pro_review mb-5">
            <div class="review_thumb" style="max-width: 75px; max-height: 75px">
                @if ($review->user->profile_image)
                    <img alt="{{ $review->user->name }}"
                        src="{{ asset('storage/profile-images/' . $review->user->profile_image) }}">
                @else
                    <i class="fa fa-user" style="font-size: 50px; width: 50px; height: 50px;"></i>
                @endif
            </div>

            <div class="review_details">
                <div class="review_info mb-2">
                    <div class="product-rating mb-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fa-{{ $i <= $review->rating ? 'solid' : 'regular' }} fa-star"></i>
                        @endfor
                    </div>
                    <h5>{{ $review->user->name }}
                        <span>{{ $review->created_at->diffForHumans() }}</span>
                    </h5>
                </div>
                <p>{{ $review->comment }}</p>
            </div>
            <button class="btn obrien-button primary-btn showReplyFormBtnNew" data-review-id="{{ $review->id }}"
                style="margin-top: auto; border_radius: 25%;"><i class="fa-regular fa-comment-dots"></i></button>

        </div>
    @else
        <div class="pro_review mb-5">
            <div class="review_thumb" style="max-width: 75px; max-height: 75px">
                @if ($review->user->profile_image)
                    <img alt="{{ $review->user->name }}"
                        src="{{ asset('storage/profile-images/' . $review->user->profile_image) }}">
                @else
                    <i class="fa fa-user" style="font-size: 50px; width: 50px; height: 50px;"></i>
                @endif
            </div>

            <div class="review_details">
                <div class="review_info mb-2">
                    <div class="product-rating mb-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fa-{{ $i <= $review->rating ? 'solid' : 'regular' }} fa-star"></i>
                        @endfor
                    </div>
                    <h5>{{ $review->user->name }}
                        <span>{{ $review->created_at->diffForHumans() }}</span>
                    </h5>
                </div>
                <p>This comment has been removed due to a violation of community standards!!!</p>
            </div>
            @if ($review->status == 0)
                <button class="btn obrien-button primary-btn showReplyFormBtnNew" data-review-id="{{ $review->id }}"
                    style="margin-top: auto;"><i class="fa-regular fa-comment-dots"></i></i></button>
            @endif
        </div>
    @endif
@endif

<!-- Form replies -->
@auth
    @if (auth()->user()->role == 1)
        <button hidden class="btn obrien-button primary-btn showReplyFormBtn"
            style=" margin-left: auto; margin-bottom: 24px; margin-top: -54px; padding: 0 12px">
        </button>
        @include('client.pages.products.components.reply-form', [
            'reviewId' => $review->id,
            'productId' => $product->id,
        ])
    @endif
@endauth

<!-- Show replies -->
@if ($review->replies->isNotEmpty())
    @foreach ($review->replies as $reply)
        @include('client.pages.products.components.reply', [
            'reviewId' => $review->id,
            'productId' => $product->id,
        ])
    @endforeach
@endif

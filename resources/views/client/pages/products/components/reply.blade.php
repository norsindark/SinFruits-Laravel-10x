<div class="pro_review mb-5" style="margin-left: 100px;">
    <div class="review_thumb" style="max-width: 40px; max-height: 40px; min-width: 40px !important;">
        @if ($reply->user->profile_image)
            <img alt="{{ $reply->user->name }}"
                src="{{ asset('storage/profile-images/' . $reply->user->profile_image) }}">
        @else
            <i class="fa fa-user" style="font-size: 50px; width: 50px; height: 50px;"></i>
        @endif
    </div>

    <div class="review_details">
        <div class="review_info mb-2">
            <h5>{{ $reply->user->name }} replied {{ $review->user->name}}
                <span>{{ $reply->created_at->diffForHumans() }}</span>
            </h5>
        </div>
        <p>{{ $reply->comment }}</p>
    </div>
</div>

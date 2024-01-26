<form class="comment-form-area ml-4 replyForm" action="{{ route('client.products.storeReply') }}" method="POST"
    style="display: none; margin-left: 100px; margin-bottom: 24px; margin-top: auto;"  data-review-id="{{ $review->id }}">
    @csrf
    <input type="hidden" name="parent_id" value="{{ $review->id }}">
    <div class="comment-form-comment mb-3" >
        <textarea id="comment" name="comment" class="comment-notes" required="required" rows="4" cols="50"></textarea>
        
    </div>
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <button type="submit" class="btn obrien-button primary-btn">Submit</button>
</form>

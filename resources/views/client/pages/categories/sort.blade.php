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
        <button type="submit">
            <i class="fa-solid fa-check-to-slot"></i> sort
        </button>
    </form>
</div>
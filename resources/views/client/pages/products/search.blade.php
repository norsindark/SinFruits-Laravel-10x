<div class="widget-list widget-mb-1">
    <h3 class="widget-title">Search</h3>
    <div class="search-box">
        <form action="{{ route('client.products.search') }}" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" name="keyword"
                    placeholder="Search Our Store" aria-label="Search Our Store">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
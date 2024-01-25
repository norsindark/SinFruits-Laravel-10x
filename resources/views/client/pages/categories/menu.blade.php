<div class="widget-list widget-mb-1">
    <h3 class="widget-title">Menu Categories</h3>
    <nav>
        <ul class="mobile-menu p-0 m-0">
            @foreach ($categories as $category)
                <li class="menu-item-has-children">
                    <a href="{{ route('client.products.showByCategory', $category->slug) }}">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
</div>

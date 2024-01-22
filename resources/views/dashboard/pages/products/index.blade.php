@extends('dashboard.layouts.master')


@section('content')

    <body class="g-sidenav-show  bg-gray-100">
        <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6>Products Table:
                                        <a href="{{ route('dashboard.products.create') }}">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </h6>

                                    <a href="javascript:;"  onclick="confirmCrawl()">
                                        <i class="fa fa-plus"></i>
                                        Product
                                    </a>
                                    <a href="javascript:;"  onclick="confirmCrawlDetails()">
                                        <i class="fa fa-plus"></i>
                                        Details
                                    </a>
                                </div>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    @if ($products && count($products) > 0)
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        ID
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Name
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Price
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Category
                                                    </th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Actions
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($products as $product)
                                                    <tr>
                                                        <td>{{ $product->id }}</td>
                                                        <td>{{ $product->name }}</td>
                                                        <td>{{ $product->product_details ? $product->product_details->price : 'N/A' }}
                                                        </td>
                                                        <td>{{ $product->category->name }}</td>
                                                        <td class="text-center">
                                                            <a class="btn btn-link text-dark px-3 mb-0"
                                                                href="{{ route('dashboard.products.show', $product->id) }}">
                                                                <i class="fas fa-eye text-dark me-2"></i>View
                                                            </a>

                                                            <a class="btn btn-link text-dark px-3 mb-0"
                                                                href="{{ route('dashboard.products.edit', $product->id) }}">
                                                                <i class="fas fa-pencil-alt text-dark me-2"
                                                                    aria-hidden="true">
                                                                </i>Edit
                                                            </a>

                                                            <a href="javascript:;"
                                                                class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                                onclick="confirmDelete({{ $product->id }})">
                                                                <i class="far fa-trash-alt me-2"></i>Delete
                                                            </a>

                                                            <form id="deleteForm{{ $product->id }}"
                                                                action="{{ route('dashboard.products.destroy', $product->id) }}"
                                                                method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p>No products found.</p>
                                    @endif

                                    {{-- pagination --}}
                                    <div style="padding: 0px 120px;">
                                        {{ $products->links('vendor.pagination.bootstrap-5') }}
                                    </div>
                                    {{-- pagination --}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- footer --}}
                @include('dashboard.layouts.footer')
                {{-- footer --}}

            </div>
        </div>
        <script>
            function confirmDelete(productId) {
                if (confirm('Are you sure you want to delete this category?')) {
                    document.getElementById('deleteForm' + productId).submit();
                }
            }
        </script>
        <script>
            function confirmCrawl() {
                if (confirm('Are you sure you want to crawl data?')) {
                    window.location.href = "{{ url('/crawl') }}";
                }
            }
        </script>
        <script>
            function confirmCrawlDetails() {
                if (confirm('Are you sure you want to crawl data?')) {
                    window.location.href = "{{ url('/crawl-details') }}";
                }
            }
        </script>
        <script>
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
                var options = {
                    damping: '0.5'
                }
                Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
        </script>
    </body>
@endsection

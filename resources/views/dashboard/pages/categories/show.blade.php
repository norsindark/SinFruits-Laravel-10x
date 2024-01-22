@extends('dashboard.layouts.master')


@section('content')

    <body class="g-sidenav-show  bg-gray-100">
        <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <h6>Category Details</h6>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <p><strong>ID:</strong> {{ $category->id }}</p>
                                <p><strong>Name:</strong> {{ $category->name }}</p>
                                <a href="{{ route('dashboard.categories.index') }}" class="btn btn-secondary">Back to
                                    Categories</a>
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

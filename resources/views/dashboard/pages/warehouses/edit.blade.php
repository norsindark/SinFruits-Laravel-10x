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
                                    <h6>Edit Warehouse</h6>
                                    <a href="{{ route('dashboard.warehouses.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                                </div>                                
                            </div>
                            <div class="card-body">
                                <form action="{{ route('dashboard.warehouses.update', $warehouse->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Warehouse Name:</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $warehouse->name }}" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Warehouse</button>
                                </form>
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
            function confirmDelete(categoryId) {
                if (confirm('Are you sure you want to delete this category?')) {
                    document.getElementById('deleteForm' + categoryId).submit();
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

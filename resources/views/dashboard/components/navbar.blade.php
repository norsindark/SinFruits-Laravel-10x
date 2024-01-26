<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Dashboard</h6>
        </nav>


        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">

            {{-- sreach --}}
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                {{-- <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Type here...">
                </div> --}}
            </div>

            {{-- auth --}}
            <ul class="navbar-nav  justify-content-end">

                {{-- name --}}
                <li class="nav-item d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">{{ Auth::user()->name }}</span>
                    </a>
                </li>

                @if (Route::has('login'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                        @auth
                            <a href="{{ url('/') }}" class="nav-link text-body font-weight-bold px-0"><i
                                    class="fa-solid fa-laptop"></i>
                                <span class="d-sm-inline d-none"> Client</span> </a>
                        @endauth
                    </div>
                @endif

                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>


                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li>



                {{-- notification --}}
                <li class="nav-item dropdown pe-2 d-flex align-items-center">


                    {{-- icon --}}
                    <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer"></i>
                        @php $count = 0; @endphp
                        @foreach ($notifications as $item)
                            @if ($item->quantity < 100)
                                @php $count++; @endphp
                            @endif
                        @endforeach
                        <span>{{ $count }} new</span>
                    </a>


                    {{-- content --}}
                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                        aria-labelledby="dropdownMenuButton">
                        @if ($notifications)

                            @foreach ($notifications as $item)
                                @if ($item->quantity < 100)
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md" href="javascript:;">
                                            <div class="d-flex py-1">
                                                <div class="my-auto">
                                                    <div class="avatar avatar-xl position-relative"
                                                        style="max-width: 40px; max-height: 40px; min-width: 40px !important;">
                                                        @php
                                                            $imagePath = $item->productImages->isNotEmpty() ? asset($item->productImages->first()->image_path) : asset('path_to_default_image/default_image.jpg');
                                                        @endphp
                                                        <img src="{{ $imagePath }}" alt="Product Image"
                                                            class="img-fluid">
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                        <span class="font-weight-bold">{{$item->product->name}}: {{ $item->quantity }}Kg
                                                            in stocks</span>
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0 ">
                                                        <i class="fa fa-clock me-1"></i>
                                                        {{ $item->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif

                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

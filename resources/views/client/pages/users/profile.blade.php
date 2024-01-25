@extends('client.layouts.master')
@section('content')

    <body>

        <div class="contact-wrapper">
            <!-- Breadcrumb Area Start Here -->
            <div class="breadcrumbs-area position-relative">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="breadcrumb-content position-relative section-content">
                                <h3 class="title-3">My Account</h3>
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li>My Account</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- Profile --}}
            <div class="my-account-wrapper mt-no-text mb-no-text">
                <div class="container container-default-2 custom-area">
                    <div class="row">
                        <div class="col-lg-12 col-custom">
                            <div class="myaccount-page-wrapper">


                                {{-- Profile --}}
                                <div class="row">


                                    {{-- Menu --}}
                                    <div class="col-lg-3 col-md-4 col-custom">
                                        <div class="myaccount-tab-menu nav" role="tablist">
                                            <a href="#dashboard" class="nav-link active" data-toggle="tab"><i
                                                    class="fa fa-dashboard"></i> Dashboard</a>
                                            <a href="#orders" class="nav-link" data-toggle="tab"><i
                                                    class="fa fa-cart-arrow-down"></i> Orders</a>
                                            <a href="#download" class="nav-link" data-toggle="tab"><i
                                                    class="fa fa-cloud-download"></i> Download</a>
                                            <a href="#payment-method" class="nav-link" data-toggle="tab"><i
                                                    class="fa fa-credit-card"></i> Payment Method</a>
                                            <a href="#account-info" class="nav-link" data-toggle="tab"><i
                                                    class="fa fa-user"></i> Account Details</a>
                                            <a href="#" class="nav-link"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out"></i> LOGOUT
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>


                                        </div>
                                    </div>



                                    {{-- Contents --}}
                                    <div class="col-lg-9 col-md-8 col-custom">
                                        <div class="tab-content" id="myaccountContent">

                                            {{-- notification --}}
                                            @if (session('success'))
                                                <div class="alert alert-success">
                                                    {{ session('success') }}
                                                </div>
                                            @endif

                                            <div id="cancelOrderSuccess" class="alert alert-success" style="display: none;">
                                            </div>

                                            <div id="cancelOrderError" class="alert alert-danger" style="display: none;">
                                            </div>


                                            {{-- Dashboard --}}
                                            <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                                <div class="myaccount-content">
                                                    <h3>Dashboard</h3>
                                                    <div class="welcome">
                                                        <p>Hello, <strong
                                                                style="text-transform: uppercase">{{ Auth::user()->name }}</strong>
                                                        </p>
                                                    </div>
                                                    <p class="mb-0">Welcome to your account dashboard! From here, you have
                                                        access to various features and information that make managing your
                                                        account easier.</p>

                                                    <h5 style="margin-top:24px ">Your Dashboard Features:</h4>

                                                        <div class="dashboard-features" style="margin-top:12px ">
                                                            <ul>
                                                                <li style="margin-top:12px "><strong>Recent Orders:</strong>
                                                                    View a list of your recent
                                                                    orders, including order status, items, and total amount.
                                                                </li>
                                                                <li style="margin-top:12px "><strong>Manage
                                                                        Addresses:</strong> Easily add, edit, or
                                                                    delete your shipping and billing addresses. This ensures
                                                                    a
                                                                    smooth checkout process for your future orders.</li>
                                                                <li style="margin-top:12px "><strong>Edit Account
                                                                        Details:</strong> Update your personal
                                                                    information, such as name, email, and password. Keep
                                                                    your
                                                                    account details accurate and secure.</li>
                                                                <li style="margin-top:12px "><strong>Change
                                                                        Password:</strong> Enhance the security of
                                                                    your account by updating your password regularly.</li>
                                                            </ul>
                                                        </div>

                                                        <p class="mb-0">Feel free to explore the options in the menu and
                                                            manage your account based on your preferences. If you have any
                                                            questions or need assistance, don't hesitate to reach out to our
                                                            support team.</p>
                                                </div>
                                            </div>


                                            {{-- Orders --}}
                                            @include('client.pages.orders.index')


                                            {{-- Downloads --}}
                                            <div class="tab-pane fade" id="download" role="tabpanel">
                                                <div class="myaccount-content">
                                                    <h3>Downloads</h3>
                                                    <div class="myaccount-table table-responsive text-center">
                                                        <table class="table table-bordered">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>Product</th>
                                                                    <th>Date</th>
                                                                    <th>Expire</th>
                                                                    <th>Download</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Haven - Free Real Estate PSD Template</td>
                                                                    <td>Aug 22, 2018</td>
                                                                    <td>Yes</td>
                                                                    <td><a href="#"
                                                                            class="btn obrien-button-2 primary-color rounded-0"><i
                                                                                class="fa fa-cloud-download mr-2"></i>Download
                                                                            File</a></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>


                                            {{-- Payment --}}
                                            <div class="tab-pane fade" id="payment-method" role="tabpanel">
                                                <div class="myaccount-content">
                                                    <h3>Payment Method</h3>
                                                    <p class="saved-message">You Can't Saved Your Payment Method yet.
                                                    </p>
                                                </div>
                                            </div>


                                            {{-- Address --}}
                                            <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                                <div class="myaccount-content">
                                                    <h3>Billing Address</h3>
                                                    <address>
                                                        <p><strong
                                                                style="text-transform: capitalize">{{ Auth::user()->name }}</strong>
                                                        </p>
                                                        <p>{{ Auth::user()->address }}</p>
                                                        <p>Mobile: {{ Auth::user()->phone }}</p>
                                                    </address>
                                                    <a href="#" class="btn obrien-button-2 primary-color rounded-0"><i
                                                            class="fa fa-edit mr-2"></i>Edit Address</a>
                                                </div>
                                            </div>



                                            {{-- Account Details --}}
                                            <div class="tab-pane fade" id="account-info" role="tabpanel">
                                                <div class="myaccount-content">
                                                    <h3>Account Details Change</h3>
                                                    <div class="account-details-form">


                                                        {{-- Form New --}}
                                                        <form method="post" action="{{ route('client.profile.update') }}"
                                                            class="mt-6 space-y-6">
                                                            @csrf
                                                            @method('patch')

                                                            {{-- Full name --}}
                                                            <div class="single-input-item mb-3">
                                                                <label for="display-name" class="required mb-1">Full
                                                                    Name</label>
                                                                <input type="text" id="display-name" name="name"
                                                                    placeholder="Full Name"
                                                                    value="{{ old('name', Auth::user()->name) }}" />
                                                                <x-input-error class="alert alert-danger"
                                                                    :messages="$errors->get('name')" />

                                                            </div>


                                                            {{-- Email --}}
                                                            <div class="single-input-item mb-3">
                                                                <label for="email" class="required mb-1">Email
                                                                    Address</label>
                                                                <input type="email" id="email" name="email"
                                                                    placeholder="Email Address"
                                                                    value="{{ old('email', Auth::user()->email) }}" />
                                                                <x-input-error class="alert alert-danger"
                                                                    :messages="$errors->get('email')" />
                                                            </div>



                                                            {{-- Button Save --}}
                                                            <div class="single-input-item single-item-button">
                                                                <button class="btn obrien-button primary-btn">Save
                                                                    Changes</button>
                                                            </div>
                                                        </form>



                                                        {{-- New Form Change Address - Phone --}}
                                                        <form method="post"
                                                            action="{{ route('client.password.updateAddress') }}"
                                                            class="mt-6 space-y-6">
                                                            @csrf
                                                            @method('put')

                                                            <fieldset>
                                                                <legend>Address - Phone change</legend>

                                                                {{-- Address --}}
                                                                <div class="single-input-item mb-3">
                                                                    <label for="display-name"
                                                                        class="required mb-1">Address</label>
                                                                    <input type="text" id="display-name"
                                                                        name="address" placeholder="Address"
                                                                        value="{{ old('address', Auth::user()->address) }}" />
                                                                    <x-input-error class="alert alert-danger"
                                                                        :messages="$errors->get('address')" />
                                                                </div>


                                                                {{-- Phone --}}
                                                                <div class="single-input-item mb-3">
                                                                    <label for="display-name"
                                                                        class="required mb-1">Phone</label>
                                                                    <input type="text" id="display-name"
                                                                        name="phone" placeholder="phone"
                                                                        value="{{ old('phone', Auth::user()->phone) }}" />
                                                                    <x-input-error class="alert alert-danger"
                                                                        :messages="$errors->get('phone')" />
                                                                </div>

                                                                {{-- Button Save --}}
                                                                <div class="single-input-item single-item-button">
                                                                    <button class="btn obrien-button primary-btn">Save
                                                                        Changes</button>
                                                                </div>
                                                            </fieldset>
                                                        </form>


                                                        {{-- New Form Change Password --}}
                                                        <form method="post"
                                                            action="{{ route('client.password.updatePassword') }}"
                                                            class="mt-6 space-y-6">
                                                            @csrf
                                                            @method('put')

                                                            <fieldset>
                                                                <legend>Password change</legend>

                                                                {{-- Current Password --}}
                                                                <div class="single-input-item mb-3">
                                                                    <label for="current-pwd" class="required mb-1">Current
                                                                        Password</label>
                                                                    <input type="password" id="current-pwd"
                                                                        name="current_password"
                                                                        placeholder="Current Password" />
                                                                    <x-input-error :messages="$errors->updatePassword->get(
                                                                        'current_password',
                                                                    )"
                                                                        class="alert alert-danger" />
                                                                </div>

                                                                {{-- New Password --}}
                                                                <div class="row">


                                                                    {{-- New Password --}}
                                                                    <div class="col-lg-6 col-custom">
                                                                        <div class="single-input-item mb-3">
                                                                            <label for="new-pwd"
                                                                                class="required mb-1">New
                                                                                Password</label>
                                                                            <input type="password" id="new-pwd"
                                                                                name="password"
                                                                                placeholder="New Password" />
                                                                            <x-input-error :messages="$errors->updatePassword->get(
                                                                                'password',
                                                                            )"
                                                                                class="alert alert-danger" />
                                                                        </div>
                                                                    </div>


                                                                    {{-- Confirm Password --}}
                                                                    <div class="col-lg-6 col-custom">
                                                                        <div class="single-input-item mb-3">
                                                                            <label for="confirm-pwd"
                                                                                class="required mb-1">Confirm
                                                                                Password</label>
                                                                            <input type="password" id="confirm-pwd"
                                                                                name="password_confirmation"
                                                                                placeholder="Confirm Password" />
                                                                            <x-input-error :messages="$errors->updatePassword->get(
                                                                                'password_confirmation',
                                                                            )"
                                                                                class="alert alert-danger" />
                                                                        </div>
                                                                    </div>


                                                                </div>

                                                                {{-- Button save --}}
                                                                <div class="single-input-item single-item-button">
                                                                    <button class="btn obrien-button primary-btn">Save
                                                                        Changes</button>
                                                                    @if (session('status') === 'password-updated')
                                                                        <p x-data="{ show: true }" x-show="show"
                                                                            x-transition x-init="setTimeout(() => show = false, 2000)"
                                                                            class="text-sm text-gray-600 dark:text-gray-400">
                                                                            {{ __('Saved.') }}</p>
                                                                    @endif
                                                                </div>


                                                            </fieldset>
                                                        </form>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        {{-- active tab --}}
        <script>
            $(document).ready(function() {
                function setActiveTab(tabId) {
                    localStorage.setItem('activeTab', tabId);
                }

                var activeTab = localStorage.getItem('activeTab');
                if (activeTab) {
                    $('.myaccount-tab-menu a[href="#' + activeTab + '"]').tab('show');
                }

                $('.myaccount-tab-menu a').on('shown.bs.tab', function(e) {
                    setActiveTab($(e.target).attr('href').substring(1));
                });

                $('.myaccount-tab-menu a').on('click', function(e) {
                    setActiveTab($(this).attr('href').substring(1));
                });
            });
        </script>


        {{-- Order details --}}
        <script>
            $(document).ready(function() {
                $('.view-btn').click(function() {
                    var orderId = $(this).data('order-id');
                    var orderItemsRow = $('#order-items-' + orderId);

                    orderItemsRow.toggle();

                    $('.order-items-row').not(orderItemsRow).hide();
                });
            });
        </script>


        {{-- cancel drop down --}}

        <script>
            function toggleCancelReasonSection(orderId) {
                $('#cancelReasonSection' + orderId).slideToggle();
            }

            function confirmCancellation(orderId) {
                if (confirm('You can only refund 90% of the order value! Are you sure you want to cancel this order?')) {
                    confirmCancelOrder(orderId);
                }
            }

            function confirmCancelOrder(orderId) {
                var cancelReason = $('#cancelReason' + orderId).val();

                $.ajax({
                    url: '/order/cancel',
                    type: 'POST',
                    data: {
                        order_id: orderId,
                        cancel_reason: cancelReason,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        console.log(response);
                        $('#cancelReasonSection' + orderId).slideUp();
                        $('#cancelOrderSuccess').text('Order canceled successfully.').show();
                        $('#cancelOrderError').text('').hide();
                        setTimeout(function() {
                            location.reload();
                        }, 5000);
                    },
                    error: function(error) {
                        console.error(error);
                        var errorMessage = error.responseJSON.error ||
                            'An error occurred while canceling the order.';
                        $('#cancelOrderError').text(errorMessage).show();
                    }
                });
            }
        </script>


    </body>
@endsection

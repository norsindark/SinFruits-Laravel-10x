<aside class="off-canvas-wrapper" id="mobileMenu">
    <div class="off-canvas-overlay"></div>
    <div class="off-canvas-inner-content">
        <div class="btn-close-off-canvas">
            <i class="fa fa-times"></i>
        </div>
        <div class="off-canvas-inner">
            <div class="search-box-offcanvas">
                <form>
                    <input type="text" placeholder="Search product..." />
                    <button class="search-btn"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <!-- mobile menu start -->
            <div class="mobile-navigation">
                <!-- mobile menu navigation start -->
                <nav>
                    <ul class="mobile-menu">
                        <li class="menu-item-has-children">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="{{ route('client.categories.index') }}">Categories</a>
                            <ul class="megamenu dropdown">
                                @foreach ($categories as $category)
                                    <li><a
                                            href="{{ url('category.show', $category->id) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="menu-item-has-children ">
                            <a href="#">Blog</a>
                            <ul class="dropdown">
                                <li><a href="blog.html">Blog Left Sidebar</a></li>
                                <li><a href="blog-list-right-sidebar.html">Blog List Right Sidebar</a></li>
                                <li><a href="blog-list-fullwidth.html">Blog List Fullwidth</a></li>
                                <li><a href="blog-grid.html">Blog Grid Page</a></li>
                                <li><a href="blog-grid-right-sidebar.html">Blog Grid Right Sidebar</a></li>
                                <li><a href="blog-grid-fullwidth.html">Blog Grid Fullwidth</a></li>
                                <li><a href="blog-details-sidebar.html">Blog Details Sidebar Page</a></li>
                                <li>
                                    <a href="blog-details-fullwidth.html">Blog Details Fullwidth Page</a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children ">
                            <a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="frequently-questions.html">FAQ</a></li>
                                <li><a href="my-account.html">My Account</a></li>
                                <li><a href="login-register.html">login &amp; register</a></li>
                            </ul>
                        </li>
                        <li><a href="about-us.html">About Us</a></li>
                        <li><a href="contact-us.html">Contact</a></li>
                    </ul>
                </nav>
                <!-- mobile menu navigation end -->
            </div>
            <!-- mobile menu end -->
            <div class="header-top-settings offcanvas-curreny-lang-support">
                <!-- mobile menu navigation start -->
                <nav>
                    <ul class="mobile-menu">
                        <li class="menu-item-has-children">
                            <a href="#">My Account</a>
                            <ul class="dropdown">
                                <li><a href="login.html">Login</a></li>
                                <li><a href="Register-2.html">Register</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">Currency:USD</a>
                            <ul class="dropdown">
                                <li><a href="#">USD - US Dollar</a></li>
                                <li><a href="#">EUR - Euro</a></li>
                                <li><a href="#">GBP - British Pound</a></li>
                                <li><a href="#">INR - Indian Rupee</a></li>
                                <li><a href="#">BDT - Bangladesh Taka</a></li>
                                <li><a href="#">JPY - Japan Yen</a></li>
                                <li><a href="#">CAD - Canada Dollar</a></li>
                                <li><a href="#">AUD - Australian Dollar</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- mobile menu navigation end -->
            </div>
            <!-- offcanvas widget area start -->
            <div class="offcanvas-widget-area">
                <div class="top-info-wrap text-left text-black">
                    <ul>
                        <li>
                            <i class="fa fa-phone"></i>
                            <a href="info%40yourdomain.html">(1245) 2456 012</a>
                        </li>
                        <li>
                            <i class="fa fa-envelope"></i>
                            <a href="info%40yourdomain.html">info@yourdomain.com</a>
                        </li>
                    </ul>
                </div>
                <div class="off-canvas-widget-social">
                    <a title="Facebook-f" href="#"><i class="fa fa-facebook-f"></i></a>
                    <a title="Twitter" href="#"><i class="fa fa-twitter"></i></a>
                    <a title="Linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                    <a title="Youtube" href="#"><i class="fa fa-youtube"></i></a>
                    <a title="Vimeo" href="#"><i class="fa fa-vimeo"></i></a>
                </div>
            </div>
            <!-- offcanvas widget area end -->
        </div>
    </div>
</aside>
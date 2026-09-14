<div class="section-menu-left">
    <div class="box-logo">
        <a href="{{ route('home.admin') }}" id="site-logo-inner">
            <img id="logo_header_1" alt="Logo" src="{{ asset('admin/assets/images/logo/logo.png') }}"
                data-light="{{ asset('admin/assets/images/logo/logo.png') }}"
                data-dark="{{ asset('admin/assets/images/logo/logo.png') }}">
        </a>
        <div class="button-show-hide">
            <i class="icon-menu-left"></i>
        </div>
    </div>
    <div class="center">
        <div class="center-item">
            <div class="center-heading">Main Home</div>
            <ul class="menu-list">
                <li class="menu-item">
                    <a href="{{route('home.admin')}}" class="">
                        <div class="icon"><i class="icon-grid"></i></div>
                        <div class="text">Dashboard</div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="center-item">
            <ul class="menu-list">
                <li class="menu-item has-children">
                    <a href="javascript:void(0);" class="menu-item-button">
                        <div class="icon"><i class="icon-shopping-cart"></i></div>
                        <div class="text">Products</div>
                    </a>
                    <ul class="sub-menu">
                        <li class="sub-menu-item">
                            <a href="add-product.html" class="">
                                <div class="text">Add Product</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="{{route('Products.index')}}" class="">
                                <div class="text">Products</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item has-children">
                    <a href="javascript:void(0);" class="menu-item-button">
                        <div class="icon"><i class="icon-layers"></i></div>
                        <div class="text">Brand</div>
                    </a>
                    <ul class="sub-menu">
                        <li class="sub-menu-item">
                            <a href="add-brand.html" class="">
                                <div class="text">New Brand</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="{{ route('brands.index') }}" class="">
                                <div class="text">Brands</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item has-children">
                    <a href="javascript:void(0);" class="menu-item-button">
                        <div class="icon"><i class="icon-layers"></i></div>
                        <div class="text">Category</div>
                    </a>
                    <ul class="sub-menu">
                        <li class="sub-menu-item">
                            <a href="add-category.html" class="">
                                <div class="text">New Category</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="{{ route('Categories.index') }}" class="">
                                <div class="text">Categories</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item has-children">
                    <a href="javascript:void(0);" class="menu-item-button">
                        <div class="icon"><i class="icon-file-plus"></i></div>
                        <div class="text">Order</div>
                    </a>
                    <ul class="sub-menu">
                        <li class="sub-menu-item">
                            <a href="{{ route('orders.index') }}" class="">
                                <div class="text">Orders</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="order-tracking.html" class="">
                                <div class="text">Order tracking</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.settings.index') }}" class="">
                        <div class="icon"><i class="fa-solid fa-percent"></i></div>
                        <div class="text">Vat</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('sliders.index')}}" class="">
                        <div class="icon"><i class="icon-image"></i></div>
                        <div class="text">Slider</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('coupons.index')}}" class="">
                        <div class="icon"><i class="fa-solid fa-ticket-simple"></i></div>
                        <div class="text">Coupns</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('admin.contact.index') }}" class="">
                        <div class="icon"><i class="icon-mail"></i></div>
                        <div class="text">Messages</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="users.html" class="">
                        <div class="icon"><i class="icon-user"></i></div>
                        <div class="text">User</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('myAccount.index') }}" class="">
                        <div class="icon"><i class="fa-solid fa-circle-user"></i></div>
                        <div class="text">Account</div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
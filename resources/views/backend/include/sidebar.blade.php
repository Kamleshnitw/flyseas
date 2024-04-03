<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <img src="{{ asset('public/image/white-logo.png') }}" alt="Flyseas Logo" class="brand-image" style="width: 100%;">
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link @if(Route::currentRouteName() == 'home') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                
                @canany(['bakery-category-index', 'bakery-attribute-index', 'bakery-product-index'])
                    <li class="nav-item @if(Route::currentRouteName() == 'categories.index' || Route::currentRouteName() == 'categories.create' || Route::currentRouteName() == 'categories.edit'|| Route::currentRouteName() == 'variations.index' || Route::currentRouteName() == 'variations.create' || Route::currentRouteName() == 'variations.delete' || Route::currentRouteName() == 'products.index' || Route::currentRouteName() == 'products.create' || Route::currentRouteName() == 'products.edit' || Route::currentRouteName() == 'subcategories.index' || Route::currentRouteName() == 'subcategories.create' || Route::currentRouteName() == 'subcategories.edit' ) menu-is-opening menu-open @endif">
                        <a href="#" class="nav-link @if(Route::currentRouteName() == 'categories.index' || Route::currentRouteName() == 'categories.create' || Route::currentRouteName() == 'categories.edit'|| Route::currentRouteName() == 'variations.create' || Route::currentRouteName() == 'variations.edit' || Route::currentRouteName() == 'variations.index' || Route::currentRouteName() == 'products.index' || Route::currentRouteName() == 'products.create' || Route::currentRouteName() == 'products.edit' || Route::currentRouteName() == 'subcategories.index' || Route::currentRouteName() == 'subcategories.create' || Route::currentRouteName() == 'subcategories.edit' ) active @endif">
                            <i class="nav-icon fas fa-bread-slice" aria-hidden="true"></i>
                            <p>Bakery
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('bakery-category-index')
                                <li class="nav-item">
                                    <a href="{{route('categories.index')}}" class="nav-link @if(Route::currentRouteName() == 'categories.index' || Route::currentRouteName() == 'categories.create' || Route::currentRouteName() == 'categories.edit') active @endif">
                                        <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                        <p>Category</p>
                                    </a>
                                </li>
                            @endcan
                                <li class="nav-item">
                                    <a href="{{route('subcategories.index')}}" class="nav-link @if(Route::currentRouteName() == 'subcategories.index' || Route::currentRouteName() == 'subcategories.create' || Route::currentRouteName() == 'subcategories.edit') active @endif">
                                        <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                        <p>Sub Category</p>
                                    </a>
                                </li>
                            @can('bakery-attribute-index')
                                <li class="nav-item">
                                    <a href="{{route('variations.index')}}" class="nav-link @if(Route::currentRouteName() == 'variations.index' || Route::currentRouteName() == 'variations.create' || Route::currentRouteName() == 'variations.edit') active @endif">
                                        <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                        <p>Variation</p>
                                    </a>
                                </li>
                            @endcan
                            @can('bakery-product-index')
                                <li class="nav-item">
                                    <a href="{{route('products.index')}}" class="nav-link @if(Route::currentRouteName() == 'products.index' || Route::currentRouteName() == 'products.create' || Route::currentRouteName() == 'products.edit') active @endif">
                                        <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                        <p>Product</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany(['city-index'])
                    <li class="nav-item @if(Route::currentRouteName() == 'city.index' || Route::currentRouteName() == 'city.create' || Route::currentRouteName() == 'city.edit' ) menu-is-opening menu-open @endif">
                        <a href="#" class="nav-link @if(Route::currentRouteName() == 'city.index' || Route::currentRouteName() == 'city.create' || Route::currentRouteName() == 'city.edit') active @endif">
                            <i class="nav-icon fas fa-cogs" aria-hidden="true"></i>
                            <p>Setting
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('city-index')
                                <li class="nav-item">
                                    <a href="{{route('city.index')}}" class="nav-link @if(Route::currentRouteName() == 'city.index' || Route::currentRouteName() == 'city.create' || Route::currentRouteName() == 'city.edit') active @endif">
                                        <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                        <p>City</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany(['vendor-product-index'])
                    <li class="nav-item @if(Route::currentRouteName() == 'vendor.products.index' || Route::currentRouteName() == 'vendor.products.create' || Route::currentRouteName() == 'vendor.products.edit' ) menu-is-opening menu-open @endif">
                        <a href="#" class="nav-link @if(Route::currentRouteName() == 'vendor.products.index' || Route::currentRouteName() == 'vendor.products.create' || Route::currentRouteName() == 'vendor.products.edit') active @endif">
                            <i class="nav-icon fas fa-user" aria-hidden="true"></i>
                            <p>Manage Products
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('vendor-product-index')
                                <li class="nav-item">
                                    <a href="{{route('vendor.products.index')}}" class="nav-link @if(Route::currentRouteName() == 'vendor.products.index' || Route::currentRouteName() == 'vendor.products.create' || Route::currentRouteName() == 'vendor.products.edit') active @endif">
                                        <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                        <p>Products List</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany(['vendor-slider-index', 'vendor-banner-index'])
                    <li class="nav-item @if(Route::currentRouteName() == 'vendor.slider.index' || Route::currentRouteName() == 'vendor.banner.index' || Route::currentRouteName() == 'vendor.offer.index' || Route::currentRouteName() == 'vendor.offer.create' || Route::currentRouteName() == 'vendor.offer.edit' || Route::currentRouteName() == 'vendor.coupon.index' || Route::currentRouteName() == 'vendor.coupon.create' || Route::currentRouteName() == 'vendor.coupon.edit' || Route::currentRouteName() == 'vendor.group-product.index' || Route::currentRouteName() == 'vendor.group-product.create' || Route::currentRouteName() == 'vendor.group-product.edit') menu-is-opening menu-open @endif">
                        <a href="#" class="nav-link @if(Route::currentRouteName() == 'vendor.slider.index' || Route::currentRouteName() == 'vendor.banner.index' || Route::currentRouteName() == 'vendor.offer.index' || Route::currentRouteName() == 'vendor.offer.create' || Route::currentRouteName() == 'vendor.offer.edit' || Route::currentRouteName() == 'vendor.coupon.index' || Route::currentRouteName() == 'vendor.coupon.create' || Route::currentRouteName() == 'vendor.coupon.edit' || Route::currentRouteName() == 'vendor.group-product.index' || Route::currentRouteName() == 'vendor.group-product.create' || Route::currentRouteName() == 'vendor.group-product.edit') active @endif">
                            <i class="nav-icon fas fa-cog" aria-hidden="true"></i>
                            <p>Vendor Settings
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('vendor-slider-index')
                                <li class="nav-item">
                                    <a href="{{route('vendor.slider.index')}}" class="nav-link @if(Route::currentRouteName() == 'vendor.slider.index') active @endif">
                                        <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                        <p>Sliders</p>
                                    </a>
                                </li>
                            @endcan
                            @can('vendor-banner-index')
                                <li class="nav-item">
                                    <a href="{{route('vendor.banner.index')}}" class="nav-link @if(Route::currentRouteName() == 'vendor.banner.index') active @endif">
                                        <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                        <p>Banners</p>
                                    </a>
                                </li>
                            @endcan
                                
                            <li class="nav-item">
                                <a href="{{route('vendor.offer.index')}}" class="nav-link @if(Route::currentRouteName() == 'vendor.offer.index' || Route::currentRouteName() == 'vendor.offer.create' || Route::currentRouteName() == 'vendor.offer.edit') active @endif">
                                    <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                    <p>Offers & Sale</p>
                                </a>
                            </li>
                               
                            <li class="nav-item">
                                <a href="{{route('vendor.coupon.index')}}" class="nav-link @if(Route::currentRouteName() == 'vendor.coupon.index' || Route::currentRouteName() == 'vendor.coupon.create' || Route::currentRouteName() == 'vendor.coupon.edit') active @endif">
                                    <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                    <p>Coupons</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('vendor.group-product.index')}}" class="nav-link @if(Route::currentRouteName() == 'vendor.group-product.index' || Route::currentRouteName() == 'vendor.group-product.create' || Route::currentRouteName() == 'vendor.group-product.edit') active @endif">
                                    <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                    <p>Group Products</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcanany
                @can('retailers-index')
                    <li class="nav-item">
                        <a href="{{route('vendor.retailer-kyc.index')}}" class="nav-link @if(Route::currentRouteName() == 'vendor.retailer-kyc.index' || Route::currentRouteName() == 'vendor.retailer-kyc.create' || Route::currentRouteName() == 'vendor.retailer-kyc.edit') active @endif">
                            <i class="nav-icon fas fa-id-card"></i>
                            <p>Pending KYC</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('vendor.retailers.index')}}" class="nav-link @if(Route::currentRouteName() == 'vendor.retailers.index' || Route::currentRouteName() == 'vendor.retailers.create' || Route::currentRouteName() == 'vendor.retailers.show' || Route::currentRouteName() == 'vendor.retailers.edit') active @endif">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Retailers</p>
                        </a>
                    </li>
                @endcan
                @can('orders-index')
                    <li class="nav-item">
                        <a href="{{route('vendor.orders.index')}}" class="nav-link @if(Route::currentRouteName() == 'vendor.orders.index' || Route::currentRouteName() == 'vendor.orders.create' || Route::currentRouteName() == 'vendor.orders.show' || Route::currentRouteName() == 'vendor.orders.edit') active @endif">
                            <i class="nav-icon fa fa-list-alt"></i>
                            <p>Orders</p>
                        </a>
                    </li>
                @endcan
                @canany(['user-index','role-index'])
                    <li class="nav-item @if(Route::currentRouteName() == 'users.index' || Route::currentRouteName() == 'users.create' || Route::currentRouteName() == 'users.edit' || Route::currentRouteName() == 'users.show' || Route::currentRouteName() == 'roles.index' || Route::currentRouteName() == 'roles.create' || Route::currentRouteName() == 'roles.edit' || Route::currentRouteName() == 'roles.show' || Route::currentRouteName() == 'vendor.index' || Route::currentRouteName() == 'vendor.create' || Route::currentRouteName() == 'vendor.edit' || Route::currentRouteName() == 'vendor.show') menu-is-opening menu-open @endif">
                        <a href="#" class="nav-link @if(Route::currentRouteName() == 'users.index' || Route::currentRouteName() == 'users.create' || Route::currentRouteName() == 'users.edit' || Route::currentRouteName() == 'users.show' || Route::currentRouteName() == 'roles.index' || Route::currentRouteName() == 'roles.create' || Route::currentRouteName() == 'roles.edit' || Route::currentRouteName() == 'roles.show' || Route::currentRouteName() == 'vendor.index' || Route::currentRouteName() == 'vendor.create' || Route::currentRouteName() == 'vendor.edit' || Route::currentRouteName() == 'vendor.show') active @endif">
                            <i class="nav-icon fa fa-user-plus" aria-hidden="true"></i>
                            <p>Staff Management
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('user-index')
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}" class="nav-link @if(Route::currentRouteName() == 'users.index' || Route::currentRouteName() == 'users.create' || Route::currentRouteName() == 'users.edit' || Route::currentRouteName() == 'users.show') active @endif">
                                        <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                        <p>Manage Users</p>
                                    </a>
                                </li>
                            @endcan
                            @can('role-index')
                                <li class="nav-item" >
                                    <a href="{{ route('roles.index') }}" class="nav-link @if(Route::currentRouteName() == 'roles.index' || Route::currentRouteName() == 'roles.create' || Route::currentRouteName() == 'roles.edit' || Route::currentRouteName() == 'roles.show') active @endif">
                                        <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                        <p>Manage Roles</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
            </ul>
        </nav>
    </div>
</aside>

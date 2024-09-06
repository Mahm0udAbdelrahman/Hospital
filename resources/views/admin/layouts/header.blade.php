<!-- Start::main-header-container -->
<div class="main-header-container container-fluid">
<style>
    .header-link {
    color: #333;
    font-weight: bold;
}

.flag-icon {
    border-radius: 50%;
}

.dropdown-item:hover {
    background-color: #f8f9fa;
    color: #007bff;
}

.main-header-dropdown {
    background-color: #ffffff;
    border: 1px solid #ddd;
}
.flag-icon {
    border-radius: 50%;
    object-fit: cover;
}

</style>
    <!-- Start::header-content-left -->
    <div class="header-content-left">

        <!-- Start::header-element -->
        <div class="header-element">
            <div class="horizontal-logo">
                <a href="index.html" class="header-logo">
                    <img src="{{ asset('dashboard/assets/images/brand-logos/desktop-logo.png')}}" alt="logo" class="desktop-logo">
                    <img src="{{ asset('dashboard/assets/images/brand-logos/toggle-logo.png')}}" alt="logo" class="toggle-logo">
                    <img src="{{ asset('dashboard/assets/images/brand-logos/desktop-dark.png')}}" alt="logo" class="desktop-dark">
                    <img src="{{ asset('dashboard/assets/images/brand-logos/toggle-dark.png')}}" alt="logo" class="toggle-dark">
                    <img src="{{ asset('dashboard/assets/images/brand-logos/desktop-white.png')}}" alt="logo" class="desktop-white">
                    <img src="{{ asset('dashboard/assets/images/brand-logos/toggle-white.png')}}" alt="logo" class="toggle-white">
                </a>
            </div>
        </div>
        <!-- End::header-element -->

        <!-- Start::header-element -->
        <div class="header-element">
            <!-- Start::header-link -->
            <a aria-label="Hide Sidebar" class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle" data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
            <!-- End::header-link -->
        </div>
        <!-- End::header-element -->

        <!-- Start::header-element -->
        <div class="main-header-center d-none d-lg-block  header-link">
            <div class="input-group">
                <div class="input-group-btn search-panel">
                    <select class="js-example-basic-single" name="state" data-trigger>
                        <option value="s-1">Choose one</option>
                        <option value="s-2">T-Projects...</option>
                        <option value="s-3">Microsoft Project</option>
                        <option value="s-4">Risk Management</option>
                        <option value="s-5">Team Building</option>
                    </select>
                </div>
                <input type="text" class="form-control" id="typehead" placeholder="Search for results..." autocomplete="off">
                <button class="btn btn-primary"><i class="fe fe-search" aria-hidden="true"></i></button>
            </div>
            <div id="headersearch" class="header-search">
                <div class="p-3">
                    <div class="">
                        <p class="fw-semibold text-muted mb-2 fs-13">Recent Searches</p>
                        <div class="ps-2">
                            <a href="javascript:void(0)" class="search-tags"><i class="fe fe-search me-2"></i>People<span></span></a>
                            <a href="javascript:void(0)" class="search-tags"><i class="fe fe-search me-2"></i>Pages<span></span></a>
                            <a href="javascript:void(0)" class="search-tags"><i class="fe fe-search me-2"></i>Articles<span></span></a>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="fw-semibold text-muted mb-2 fs-13">Apps and pages</p>
                        <ul class="ps-2 list-unstyled">
                            <li class="p-1 d-flex align-items-center text-muted mb-2 search-app">
                                <a href="full-calendar.html"><span><i class='bx bx-calendar me-2 fs-14 bg-primary-transparent p-2 rounded-circle '></i>Calendar</span></a>
                            </li>
                            <li class="p-1 d-flex align-items-center text-muted mb-2 search-app">
                                <a href="mail-inbox.html"><span><i class='bx bx-envelope me-2 fs-14 bg-primary-transparent p-2 rounded-circle'></i>Mail</span></a>
                            </li>
                            <li class="p-1 d-flex align-items-center text-muted mb-2 search-app">
                                <a href="buttons.html"><span><i class='bx bx-dice-1 me-2 fs-14 bg-primary-transparent p-2 rounded-circle '></i>Buttons</span></a>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-3">
                        <p class="fw-semibold text-muted mb-2 fs-13">Links</p>
                        <ul class="ps-2 list-unstyled">
                            <li class="p-1 align-items-center text-muted mb-1 search-app">
                                <a href="javascript:void(0)" class="text-primary"><u>http://spruko/html/spruko.com</u></a>
                            </li>
                            <li class="p-1 align-items-center text-muted mb-1 search-app">
                                <a href="javascript:void(0)" class="text-primary"><u>http://spruko/demo/spruko.com</u></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="py-3 border-top px-0">
                    <div class="text-center">
                        <a href="javascript:void(0)" class="text-primary text-decoration-underline fs-15">View all</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End::header-element -->

    </div>
    <!-- End::header-content-left -->

    <!-- Start::header-content-right -->
    <div class="header-content-right">

        <!-- Start::header-element -->
        <div class="header-element header-theme-mode">
            <!-- Start::header-link|layout-setting -->
            <a href="javascript:void(0);" class="header-link layout-setting">
                <span class="light-layout">
                    <!-- Start::header-link-icon -->
                    <i class="fe fe-moon header-link-icon lh-2"></i>
                    <!-- End::header-link-icon -->
                </span>
                <span class="dark-layout">
                    <!-- Start::header-link-icon -->
                    <i class="fe fe-sun header-link-icon lh-2"></i>
                    <!-- End::header-link-icon -->
                </span>
            </a>
            <!-- End::header-link|layout-setting -->
        </div>
        <!-- End::header-element -->

        <!-- Start::header-element -->
     


        <div class="header-element country-selector">
            <!-- Start::header-link|dropdown-toggle -->
            <a href="javascript:void(0);" class="header-link dropdown-toggle country-Flag" data-bs-auto-close="outside" data-bs-toggle="dropdown">
                <span class="d-flex align-items-center">
                    @foreach ($languages as $language)
                    @if(Session::get('locale') == $language->abbreviations)
                    <img src="{{ $language->media->first()->getUrl() }}" alt="{{ $language->name }} Flag" class="flag-icon me-2" style="width: 20px; height: 20px;">
                    <span>{{ $language->name }}</span>
                    @endif
                    @endforeach
                </span>
            </a>
            <!-- End::header-link|dropdown-toggle -->
        
            <ul class="main-header-dropdown dropdown-menu dropdown-menu-end" style="min-width: 200px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li>
                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="dropdown-item d-flex align-items-center py-2">
                        
                        {{ $properties['native'] }}
                    </a>
                </li>
                
                @endforeach
            </ul>
        </div>
        








        <!-- End::header-element -->

        <!-- Start::header-element -->
        <div class="header-element header-fullscreen  d-xl-flex d-none">
            <!-- Start::header-link -->
            <a onclick="openFullscreen();" href="javascript:void(0);" class="header-link">
                <i class="fe fe-maximize full-screen-open header-link-icon"></i>
                <i class="fe fe-minimize full-screen-close header-link-icon d-none"></i>
            </a>
            <!-- End::header-link -->
        </div>
        <!-- End::header-element -->

        <!-- Start::header-element -->
        <div class="header-element cart-dropdown d-xl-flex d-none">
            <!-- Start::header-link|dropdown-toggle -->
            <a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-auto-close="outside" data-bs-toggle="dropdown">
                <i class="fe fe-shopping-cart header-link-icon"></i>
                <span class="badge bg-primary header-icon-badge" id="cart-icon-badge">5</span>
            </a>
            <!-- End::header-link|dropdown-toggle -->
            <!-- Start::main-header-dropdown -->
            <div class="main-header-dropdown dropdown-menu dropdown-menu-end" data-popper-placement="none">
                <div class="p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0 fs-17 fw-semibold">Cart Items</p>
                        <span class="badge bg-primary rounded-pill" id="cart-data">5 Items</span>
                    </div>
                </div>
                <div>
                    <hr class="dropdown-divider">
                </div>
                <ul class="list-unstyled mb-0" id="header-cart-items-scroll">
                    <li class="dropdown-item">
                        <div class="d-flex align-items-center cart-dropdown-item">
                            <img src="{{ asset('dashboard/assets/images/ecommerce/jpg/1.jpg')}}" alt="img" class="avatar avatar-sm br-5 me-3">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-start justify-content-between mb-0">
                                    <div class="mb-0 fs-13 text-dark fw-medium">
                                        <a href="ecommerce-cart.html" class="text-dark">Smart Watch</a>
                                    </div>
                                    <div>
                                        <span class="text-black mb-1 fw-medium">$1,299.00</span>
                                    </div>
                                </div>
                                <div class="min-w-fit-content d-flex align-items-start justify-content-between">
                                    <ul class="header-product-item d-flex">
                                        <li>Qty: 1</li>
                                        <li>Status: <span class="text-success">In Stock</span></li>
                                    </ul>
                                    <div class="ms-auto">
                                        <a href="javascript:void(0);" class="header-cart-remove float-end dropdown-item-close"><i class="ri-delete-bin-2-line"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown-item">
                        <div class="d-flex align-items-center cart-dropdown-item">
                            <img src="{{ asset('dashboard/assets/images/ecommerce/jpg/3.jpg')}}" alt="img" class="avatar avatar-sm br-5 me-3">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-start justify-content-between mb-0">
                                    <div class="mb-0 fs-13 text-dark fw-medium">
                                        <a href="ecommerce-cart.html" class="text-dark">Flowers</a>
                                    </div>
                                    <div>
                                        <span class="text-black mb-1 fw-medium">$179.29</span>
                                    </div>
                                </div>
                                <div class="min-w-fit-content d-flex align-items-start justify-content-between">
                                    <ul class="header-product-item">
                                        <li>Qty: 2</li>
                                        <li><span class="badge bg-pink-transparent fs-10">Free shipping</span></li>
                                    </ul>
                                    <div class="ms-auto">
                                        <a href="javascript:void(0);" class="header-cart-remove float-end dropdown-item-close"><i class="ri-delete-bin-2-line"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown-item">
                        <div class="d-flex align-items-center cart-dropdown-item">
                            <img src="{{ asset('dashboard/assets/images/ecommerce/jpg/5.jpg')}}" alt="img" class="avatar avatar-sm br-5 me-3">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-start justify-content-between mb-0">
                                    <div class="mb-0 fs-13 text-dark fw-medium">
                                        <a href="ecommerce-cart.html" class="text-dark">Running Shoes</a>
                                    </div>
                                    <div>
                                        <span class="text-black mb-1 fw-medium">$29.00</span>
                                    </div>
                                </div>
                                <div class="min-w-fit-content d-flex align-items-start justify-content-between">
                                    <ul class="header-product-item d-flex">
                                        <li>Qty: 4</li>
                                        <li>Status: <span class="text-danger">Out Stock</span></li>
                                    </ul>
                                    <div class="ms-auto">
                                        <a href="javascript:void(0);" class="header-cart-remove float-end dropdown-item-close"><i class="ri-delete-bin-2-line"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown-item">
                        <div class="d-flex align-items-center cart-dropdown-item">
                            <img src="{{ asset('dashboard/assets/images/ecommerce/jpg/4.jpg')}}" alt="img" class="avatar avatar-sm br-5 me-3">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-start justify-content-between mb-0">
                                    <div class="mb-0 fs-13 text-dark fw-medium">
                                        <a href="ecommerce-cart.html" class="text-dark">Furniture</a>
                                    </div>
                                    <div>
                                        <span class="text-black mb-1 fw-medium">$4,999.00</span>
                                    </div>
                                </div>
                                <div class="min-w-fit-content d-flex align-items-start justify-content-between">
                                    <ul class="header-product-item d-flex">
                                        <li>Gray</li>
                                        <li>50LB</li>
                                    </ul>
                                    <div class="ms-auto">
                                        <a href="javascript:void(0);" class="header-cart-remove float-end dropdown-item-close"><i class="ri-delete-bin-2-line"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown-item">
                        <div class="d-flex align-items-center cart-dropdown-item">
                            <img src="{{ asset('dashboard/assets/images/ecommerce/jpg/6.jpg')}}" alt="img" class="avatar avatar-sm br-5 me-3">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-start justify-content-between mb-0">
                                    <div class="mb-0 fs-13 text-dark fw-medium">
                                        <a href="ecommerce-cart.html" class="text-dark">Tourist Bag</a>
                                    </div>
                                    <div>
                                        <span class="text-black mb-1 fw-medium">$129.00</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start justify-content-between">
                                    <ul class="header-product-item d-flex">
                                        <li>Qty: 1</li>
                                        <li>Status: <span class="text-success">In Stock</span></li>
                                    </ul>
                                    <div class="ms-auto">
                                        <a href="javascript:void(0);" class="header-cart-remove float-end dropdown-item-close"><i class="ri-delete-bin-2-line"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="p-3 empty-header-item border-top">
                    <div class="d-grid">
                        <a href="ecommerce-checkout.html" class="btn btn-primary">Proceed to checkout</a>
                    </div>
                </div>
                <div class="p-5 empty-item d-none">
                    <div class="text-center">
                        <span class="avatar avatar-xl avatar-rounded bg-warning-transparent">
                            <i class="ri-shopping-cart-2-line fs-2"></i>
                        </span>
                        <h6 class="fw-bold mb-1 mt-3">Your Cart is Empty</h6>
                        <span class="mb-3 fw-normal fs-13 d-block">Add some items to make me happy :)</span>
                        <a href="ecommerce-products.html" class="btn btn-primary btn-wave btn-sm m-1" data-abc="true">continue shopping <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
            <!-- End::main-header-dropdown -->
        </div>
        <!-- End::header-element -->

        <!-- Start::header-element -->
        <div class="header-element notifications-dropdown">
            <!-- Start::header-link|dropdown-toggle -->
            <a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" id="messageDropdown" aria-expanded="false">
                <i class="fe fe-bell header-link-icon"></i>
                <span class="badge bg-secondary header-icon-badge pulse pulse-secondary" id="notification-icon-badge">5</span>
            </a>
            <!-- End::header-link|dropdown-toggle -->
            <!-- Start::main-header-dropdown -->
            <div class="main-header-dropdown dropdown-menu dropdown-menu-end" data-popper-placement="none">
                <div class="p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0 fs-17 fw-semibold">Notifications</p>
                        <span class="badge bg-secondary rounded-pill" id="notifiation-data">5 Unread</span>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <ul class="list-unstyled mb-0" id="header-notification-scroll">
                    <li class="dropdown-item">
                        <div class="d-flex align-items-start">
                            <div class="pe-2">
                                <span class="avatar avatar-md online bg-primary-transparent br-5"><img alt="avatar" src="{{ asset('dashboard/assets/images/faces/5.jpg')}}"></span>
                            </div>
                            <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="mb-0"><a href="notifications-list.html" class="text-dark">Congratulate <strong>Olivia James</strong> for New template start</a></p>
                                    <span class="text-muted fw-normal fs-12 header-notification-text">Oct 15 12:32pm</span>
                                </div>
                                <div>
                                    <a href="javascript:void(0);" class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i class="ti ti-x fs-16"></i></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown-item">
                        <div class="d-flex align-items-start">
                            <div class="pe-2">
                                <span class="avatar avatar-md offline bg-secondary-transparent br-5"><img alt="avatar" src="{{ asset('dashboard/assets/images/faces/2.jpg')}}"></span>
                            </div>
                            <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="mb-0"><a href="notifications-list.html" class="text-dark"><strong>Joshua Gray</strong> New Message Received</a></p>
                                    <span class="text-muted fw-normal fs-12 header-notification-text">Oct 13 02:56am</span>
                                </div>
                                <div>
                                    <a href="javascript:void(0);" class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i class="ti ti-x fs-16"></i></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown-item">
                        <div class="d-flex align-items-start">
                            <div class="pe-2">
                                <span class="avatar avatar-md online bg-pink-transparent br-5"><img alt="avatar" src="{{ asset('dashboard/assets/images/faces/3.jpg')}}"></span>
                            </div>
                            <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="mb-0"><a href="notifications-list.html" class="text-dark"><strong>Elizabeth Lewis</strong> added new schedule realease</a></p>
                                    <span class="text-muted fw-normal fs-12 header-notification-text">Oct 12 10:40pm</span>
                                </div>
                                <div>
                                    <a href="javascript:void(0);" class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i class="ti ti-x fs-16"></i></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown-item">
                        <div class="d-flex align-items-start">
                            <div class="pe-2">
                                <span class="avatar avatar-md online bg-warning-transparent br-5"><img alt="avatar" src="{{ asset('dashboard/assets/images/faces/5.jpg')}}"></span>
                            </div>
                            <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="mb-0 fw-normal"><a href="notifications-list.html" class="text-dark">Delivered Successful to <strong>Micky</strong> </a></p>
                                    <span class="text-muted fw-normal fs-12 header-notification-text">Order <span class="text-warning">ID: #005428</span> had been placed</span>
                                </div>
                                <div>
                                    <a href="javascript:void(0);" class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i class="ti ti-x fs-16"></i></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown-item">
                        <div class="d-flex align-items-start">
                            <div class="pe-2">
                                <span class="avatar avatar-md offline bg-success-transparent br-5"><img alt="avatar" src="{{ asset('dashboard/assets/images/faces/1.jpg')}}"></span>
                            </div>
                            <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="mb-0 fw-normal"><a href="notifications-list.html" class="text-dark">You got 22 requests form <strong>Facebook</strong></a></p>
                                    <span class="text-muted fw-normal fs-12 header-notification-text">Today at 08:08pm</span>
                                </div>
                                <div>
                                    <a href="javascript:void(0);" class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i class="ti ti-x fs-16"></i></a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="p-3 empty-header-item1 border-top">
                    <div class="d-grid">
                        <a href="notifications-list.html" class="btn btn-primary">View All</a>
                    </div>
                </div>
                <div class="p-5 empty-item1 d-none">
                    <div class="text-center">
                        <span class="avatar avatar-xl avatar-rounded bg-secondary-transparent">
                            <i class="ri-notification-off-line fs-2"></i>
                        </span>
                        <h6 class="fw-semibold mt-3">No New Notifications</h6>
                    </div>
                </div>
            </div>
            <!-- End::main-header-dropdown -->
        </div>
        <!-- End::header-element -->

        <!-- Start::header-element -->
        <div class="header-element header-shortcuts-dropdown d-xl-flex d-none">
            <!-- Start::header-link|dropdown-toggle -->
            <a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" id="notificationDropdown" aria-expanded="false">
                <i class="fe fe-grid header-link-icon"></i>
            </a>
            <!-- End::header-link|dropdown-toggle -->
            <!-- Start::main-header-dropdown -->
            <div class="main-header-dropdown header-shortcuts-dropdown dropdown-menu pb-0 dropdown-menu-end" aria-labelledby="notificationDropdown">
                <div class="p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0 fs-17 fw-semibold">Related Apps</p>
                    </div>
                </div>
                <div class="dropdown-divider mb-0"></div>
                <div class="main-header-shortcuts p-2" id="header-shortcut-scroll">
                    <div class="row g-2">
                        <div class="col-4">
                            <a href="javascript:void(0);" class="text-dark">
                                <div class="text-center p-3 related-app">
                                    <span class="avatar avatar-sm rounded-2 p-1 bg-primary-transparent">
                                        <img src="{{ asset('dashboard/assets/images/apps/figma.png')}}" alt="">
                                    </span>
                                    <span class="d-block fs-12">Figma</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="javascript:void(0);" class="text-dark">
                                <div class="text-center p-3 related-app">
                                    <span class="avatar avatar-sm rounded-2 p-1 bg-primary-transparent">
                                        <img src="{{ asset('dashboard/assets/images/apps/microsoft-powerpoint.png')}}" alt="">
                                    </span>
                                    <span class="d-block fs-12">Power Point</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="javascript:void(0);" class="text-dark">
                                <div class="text-center p-3 related-app">
                                    <span class="avatar avatar-sm rounded-2 p-1 bg-primary-transparent">
                                        <img src="{{ asset('dashboard/assets/images/apps/microsoft-word.png')}}" alt="">
                                    </span>
                                    <span class="d-block fs-12">MS Word</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="javascript:void(0);" class="text-dark">
                                <div class="text-center p-3 related-app">
                                    <span class="avatar avatar-sm rounded-2 p-1 bg-primary-transparent">
                                        <img src="{{ asset('dashboard/assets/images/apps/calender.png')}}" alt="">
                                    </span>
                                    <span class="d-block fs-12">Calendar</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="javascript:void(0);" class="text-dark">
                                <div class="text-center p-3 related-app">
                                    <span class="avatar avatar-sm rounded-2 p-1 bg-primary-transparent">
                                        <img src="{{ asset('dashboard/assets/images/apps/sketch.png')}}" alt="">
                                    </span>
                                    <span class="d-block fs-12">Sketch</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="javascript:void(0);" class="text-dark">
                                <div class="text-center p-3 related-app">
                                    <span class="avatar avatar-sm rounded-2 p-1 bg-primary-transparent">
                                        <img src="{{ asset('dashboard/assets/images/apps/google-docs.png')}}" alt="">
                                    </span>
                                    <span class="d-block fs-12">Docs</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="javascript:void(0);" class="text-dark">
                                <div class="text-center p-3 related-app">
                                    <span class="avatar avatar-sm rounded-2 p-1 bg-primary-transparent">
                                        <img src="{{ asset('dashboard/assets/images/apps/google.png')}}" alt="">
                                    </span>
                                    <span class="d-block fs-12">Google</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="javascript:void(0);" class="text-dark">
                                <div class="text-center p-3 related-app">
                                    <span class="avatar avatar-sm rounded-2 p-1 bg-primary-transparent">
                                        <img src="{{ asset('dashboard/assets/images/apps/translate.png')}}" alt="">
                                    </span>
                                    <span class="d-block fs-12">Translate</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="javascript:void(0);" class="text-dark">
                                <div class="text-center p-3 related-app">
                                    <span class="avatar avatar-sm rounded-2 p-1 bg-primary-transparent">
                                        <img src="{{ asset('dashboard/assets/images/apps/google-sheets.png')}}" alt="">
                                    </span>
                                    <span class="d-block fs-12">Sheets</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="p-3 border-top">
                    <div class="d-grid">
                        <a href="javascript:void(0);" class="btn btn-primary">View All</a>
                    </div>
                </div>
            </div>
            <!-- End::main-header-dropdown -->
        </div>
        <!-- End::header-element -->

        <!-- Start::header-element -->
        <div class="header-element">
            <!-- Start::header-link|dropdown-toggle -->
            <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                <div class="d-flex align-items-center">
                    <div class="header-link-icon">
                        <img src="{{ asset('dashboard/assets/images/faces/1.jpg')}}" alt="img" width="32" height="32" class="rounded-circle">
                    </div>
                    <div class="d-none">
                        <p class="fw-semibold mb-0">Angelica</p>
                        <span class="op-7 fw-normal d-block fs-11">Web Designer</span>
                    </div>
                </div>
            </a>
            <!-- End::header-link|dropdown-toggle -->
            <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end" aria-labelledby="mainHeaderProfile">
                <Li>
                    <div class="header-navheading border-bottom">
                        <h6 class="main-notification-title">Sonia Taylor</h6>
                        <p class="main-notification-text mb-0">Web Designer</p>
                    </div>
                </Li>
                <li><a class="dropdown-item d-flex border-bottom" href="profile.html"><i class="fe fe-user fs-16 align-middle me-2"></i>Profile</a></li>
                <li><a class="dropdown-item d-flex border-bottom" href="mail-inbox.html"><i class="fe fe-inbox fs-16 align-middle me-2"></i>Inbox <span class="badge bg-success ms-auto">25</span></a></li>
                <li><a class="dropdown-item d-flex border-bottom border-block-end" href="notifications-list.html"><i class="fe fe-compass fs-16 align-middle me-2"></i>Activity</a></li>
                <li><a class="dropdown-item d-flex border-bottom" href="settings.html"><i class="fe fe-settings fs-16 align-middle me-2"></i>Settings</a></li>
                <li><a class="dropdown-item d-flex border-bottom" href="chat.html"><i class="fe fe-headphones fs-16 align-middle me-2"></i>Support</a></li>
                <form method="GET" action="{{ route('logout') }}">
                    @csrf
                    <li><button class="dropdown-item d-flex"><i class="fe fe-power fs-16 align-middle me-2"></i>Log Out</button></li>
                </form>

            </ul>
        </div>
        <!-- End::header-element -->

        <!-- Start::header-element -->
        <div class="header-element right-sidebar d-xl-flex d-none">
            <a href="javascript:void(0);" class="header-link right-sidebar" data-bs-toggle="offcanvas" data-bs-target="#right-sidebar-canvas">
                <i class="fe fe-align-right header-icons header-link-icon"></i>
            </a>
        </div>
        <!-- End::header-element -->

        <!-- Start::header-element -->
        <div class="header-element">
            <!-- Start::header-link|switcher-icon -->
            <a href="javascript:void(0);" class="header-link switcher-icon" data-bs-toggle="offcanvas" data-bs-target="#switcher-canvas">
                <i class="fe fe-settings header-link-icon"></i>
            </a>
            <!-- End::header-link|switcher-icon -->
        </div>
        <!-- End::header-element -->

    </div>
    <!-- End::header-content-right -->

</div>
<!-- End::main-header-container -->

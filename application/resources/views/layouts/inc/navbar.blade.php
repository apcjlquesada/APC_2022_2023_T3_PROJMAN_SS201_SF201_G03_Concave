@php
    $allData = App\Models\Product::orderBy('supplier_id', 'ASC')
        ->orderBy('category_id', 'ASC')
        ->orderBy('brand_id', 'ASC')
        ->get();
@endphp
@php
    $orders = App\Models\Order::latest()
        ->limit(5)
        ->get();
@endphp

<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
            <a class="navbar-brand brand-logo" href="{{ url('admin/dashboard') }}"><img style="width: 50px"
                    src="{{ asset('logo/tmlogo.png') }}" alt="logo" /> Torrecamps</a>
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{ asset('logo/tmlogo.png') }}"
                    alt="logo" /></a>
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-sort-variant"></span>
            </button>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown me-4">
                <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown"
                    id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                    <i class="mdi mdi-bell mx-0"></i>
                    <span class="count"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
                    <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                    @foreach ($allData as $item)
                        @if ($item->to_reorder > $item->quantity && $item->quantity != 0)
                            <a class="dropdown-item" href="{{ route('purchase') }}">
                                <div class="item-thumbnail">
                                    <div class="item-icon bg-warning">
                                        <i class="mdi mdi-alert mx-0"></i>
                                    </div>
                                </div>
                                <div class="item-content">
                                    <h6 class="font-weight-normal">{{ $item->product_name }} needs to Re-Order</h6>
                                </div>
                            </a>
                        @endif
                        @if ($item->quantity == '0')
                            <a class="dropdown-item" href="{{ route('purchase') }}">
                                <div class="item-thumbnail">
                                    <div class="item-icon bg-danger">
                                        <i class="mdi mdi-close-octagon mx-0"></i>
                                    </div>
                                </div>
                                <div class="item-content">
                                    <h6 class="font-weight-normal">{{ $item->product_name }} has no stock left</h6>
                                </div>
                            </a>
                        @endif
                    @endforeach
                    @foreach ($orders as $item)
                        <a class="dropdown-item" href="{{ route('purchase') }}">
                            <div class="item-thumbnail">
                                <div class="item-icon bg-success">
                                    <i class="mdi mdi-cart-arrow-down mx-0"></i>
                                </div>
                            </div>
                            <div class="item-content">
                                <h6 class="font-weight-normal">{{ $item->user->name }} Ordered!</h6>
                            </div>
                        </a>
                    @endforeach

                </div>
            </li>
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                    <span class="nav-profile-name">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-logout text-primary"></i>{{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>

<aside class="sidebar-panel d-flex flex-column">
    <div class="sidebar-brand">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
            <span class="brand-badge"><i class="bi bi-lightning-charge-fill"></i></span>
            <span class="brand-copy">
                <span class="brand-name">Mitra</span>
                <span class="brand-tagline">Point of Sale</span>
            </span>
        </a>
    </div>

    <nav class="sidebar-nav navbar-nav flex-column">
        <p class="sidebar-label">Workspace</p>
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }} rounded-3" href="{{ route('dashboard') }}">
            <span class="nav-icon"><i class="bi bi-grid-1x2-fill"></i></span>
            Dashboard
        </a>
        <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }} rounded-3" href="{{ route('categories.index') }}">
            <span class="nav-icon"><i class="bi bi-tags-fill"></i></span>
            Kategori
        </a>
        <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }} rounded-3" href="{{ route('products.index') }}">
            <span class="nav-icon"><i class="bi bi-box-seam-fill"></i></span>
            Produk
        </a>
        <a class="nav-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }} rounded-3" href="{{ route('suppliers.index') }}">
            <span class="nav-icon"><i class="bi bi-truck-front-fill"></i></span>
            Supplier
        </a>
        <a class="nav-link {{ request()->routeIs('customers.*') ? 'active' : '' }} rounded-3" href="{{ route('customers.index') }}">
            <span class="nav-icon"><i class="bi bi-people-fill"></i></span>
            Pelanggan
        </a>
        <a class="nav-link {{ request()->routeIs('sales.*') ? 'active' : '' }} rounded-3" href="{{ route('sales.create') }}">
            <span class="nav-icon"><i class="bi bi-cash-coin"></i></span>
            Penjualan
        </a>

        @if(Auth::user()->role === 'admin')
            <p class="sidebar-label sidebar-label-spaced">Management</p>
            <a class="nav-link {{ request()->routeIs('purchases.*') ? 'active' : '' }} rounded-3" href="{{ route('purchases.create') }}">
                <span class="nav-icon"><i class="bi bi-bag-check-fill"></i></span>
                Pembelian
            </a>
            <a class="nav-link {{ request()->routeIs('products.stock-report') ? 'active' : '' }} rounded-3" href="{{ route('products.stock-report') }}">
                <span class="nav-icon"><i class="bi bi-bar-chart-fill"></i></span>
                Laporan Stok
            </a>
            <a class="nav-link {{ request()->routeIs('sales.report') ? 'active' : '' }} rounded-3" href="{{ route('sales.report') }}">
                <span class="nav-icon"><i class="bi bi-file-earmark-text-fill"></i></span>
                Laporan
            </a>
            <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }} rounded-3" href="{{ route('users.index') }}">
                <span class="nav-icon"><i class="bi bi-person-gear"></i></span>
                User
            </a>
        @endif
    </nav>

    <div class="sidebar-footer mt-auto">
        <div class="store-status">
            <span class="status-dot"></span>
            <span>
                <strong>Sistem aktif</strong>
                <small>Semua layanan berjalan</small>
            </span>
        </div>
    </div>
</aside>

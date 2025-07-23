<aside class="main-sidebar sidebar-light-primary elevation-4 wrapper align-items-stretch left-0 top-0 h-full">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="partials/dist/img/laravel.png" alt="Laravel Store" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-bold">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
<<<<<<< HEAD
                <img src="{{ asset(auth()->user()->foto ?: 'partials/dist/img/avatar5.png') }}" class="img-circle elevation-2 image-profil" alt="User Image">
=======
                <img src="{{ url(auth()->user()->foto) }}" class="img-circle elevation-2 image-profil" alt="User Image">
>>>>>>> b69a3f4038e55c285e211cca2e2ec313d8bffb3b
            </div>
            <div class="info">
                <h5 class="d-block">{{ Auth::user()->name }}</h5>
                <a href="{{ route('user.profil') }}" class="d-block btn btn-sm btn-danger text-white">Edit Profil</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
<<<<<<< HEAD
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-compact" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
=======
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
>>>>>>> b69a3f4038e55c285e211cca2e2ec313d8bffb3b
                    </a>
                </li>

                @if (auth()->user()->level == 1)
                    <li class="nav-header">ADMIN</li>
                    <li class="nav-item">
<<<<<<< HEAD
                        <a href="{{ route('kategori.index') }}" class="nav-link">
=======
                        <a href="{{ route('kategori.index') }}"
                            class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
>>>>>>> b69a3f4038e55c285e211cca2e2ec313d8bffb3b
                            <i class="nav-icon fas fa-shopping-basket"></i>
                            <p>Kategori</p>
                        </a>
                    </li>
                    <li class="nav-item">
<<<<<<< HEAD
                        <a href="{{ route('produk.index') }}" class="nav-link">
=======
                        <a href="{{ route('produk.index') }}"
                            class="nav-link {{ request()->routeIs('produk.*') ? 'active' : '' }}">
>>>>>>> b69a3f4038e55c285e211cca2e2ec313d8bffb3b
                            <i class="nav-icon fas fa-gift"></i>
                            <p>Produk</p>
                        </a>
                    </li>
                    <li class="nav-item">
<<<<<<< HEAD
                        <a href="{{ route('member.index') }}" class="nav-link">
=======
                        <a href="{{ route('member.index') }}"
                            class="nav-link {{ request()->routeIs('member.*') ? 'active' : '' }}">
>>>>>>> b69a3f4038e55c285e211cca2e2ec313d8bffb3b
                            <i class="nav-icon fas fa-users"></i>
                            <p>Member</p>
                        </a>
                    </li>
                    <li class="nav-item">
<<<<<<< HEAD
                        <a href="{{ route('supplier.index') }}" class="nav-link">
=======
                        <a href="{{ route('supplier.index') }}"
                            class="nav-link {{ request()->routeIs('supplier.*') ? 'active' : '' }}">
>>>>>>> b69a3f4038e55c285e211cca2e2ec313d8bffb3b
                            <i class="nav-icon fas fa-warehouse"></i>
                            <p>Supplier</p>
                        </a>
                    </li>
                    <li class="nav-header">TRANSAKSI</li>
                    <li class="nav-item">
<<<<<<< HEAD
                        <a href="{{ route('pengeluaran.index') }}" class="nav-link">
=======
                        <a href="{{ route('pengeluaran.index') }}"
                            class="nav-link {{ request()->routeIs('pengeluaran.*') ? 'active' : '' }}">
>>>>>>> b69a3f4038e55c285e211cca2e2ec313d8bffb3b
                            <i class="nav-icon fas fa-donate"></i>
                            <p>Pengeluaran</p>
                        </a>
                    </li>
                    <li class="nav-item">
<<<<<<< HEAD
                        <a href="{{ route('pembelian.index') }}" class="nav-link">
=======
                        <a href="{{ route('pembelian.index') }}"
                            class="nav-link {{ request()->routeIs('pembelian.*') ? 'active' : '' }}">
>>>>>>> b69a3f4038e55c285e211cca2e2ec313d8bffb3b
                            <i class="nav-icon fas fa-money-check"></i>
                            <p>Daftar Pembelian</p>
                        </a>
                    </li>
                    <li class="nav-item">
<<<<<<< HEAD
                        <a href="{{ route('pembelian_detail.index') }}" class="nav-link">
=======
                        <a href="{{ route('pembelian_detail.index') }}"
                            class="nav-link {{ request()->routeIs('transaksi_pembelian.*') ? 'active' : '' }}">
>>>>>>> b69a3f4038e55c285e211cca2e2ec313d8bffb3b
                            <i class="nav-icon fas fa-handshake"></i>
                            <p>Transaksi Pembelian</p>
                        </a>
                    </li>
                    <li class="nav-item">
<<<<<<< HEAD
                        <a href="{{ route('penjualan.index') }}" class="nav-link">
=======
                        <a href="{{ route('penjualan.index') }}"
                            class="nav-link {{ request()->routeIs('penjualan.*') ? 'active' : '' }}">
>>>>>>> b69a3f4038e55c285e211cca2e2ec313d8bffb3b
                            <i class="nav-icon fas fa-hand-holding-usd"></i>
                            <p>Daftar Penjualan</p>
                        </a>
                    </li>
                    <li class="nav-item">
<<<<<<< HEAD
                        <a href="{{ route('transaksi.baru') }}" class="nav-link">
=======
                        <a href="{{ route('transaksi.baru') }}"
                            class="nav-link {{ request()->routeIs('transaksi.baru') ? 'active' : '' }}">
>>>>>>> b69a3f4038e55c285e211cca2e2ec313d8bffb3b
                            <i class="nav-icon fas fa-cash-register"></i>
                            <p>Buat Transaksi Penjualan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                    @empty(!@session('id_penjualan'))
<<<<<<< HEAD
                        <a href="{{ route('transaksi.index') }}" class="nav-link">
=======
                        <a href="{{ route('transaksi.index') }}"
                            class="nav-link {{ request()->routeIs('transaksi.*') ? 'active' : '' }}">
>>>>>>> b69a3f4038e55c285e211cca2e2ec313d8bffb3b
                            <i class="nav-icon fas fa-cash-register"></i>
                            <p>Transaksi Aktif Penjualan</p>
                        </a>
                    @endempty
<<<<<<< HEAD
                    </li>
                    <li class="nav-header">REPORT</li>
                    <li class="nav-item">
                        <a href="{{ route('laporan.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-clipboard"></i>
                            <p>Laporan</p>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('transaksi.baru') }}" class="nav-link">
                            <i class="nav-icon fas fa-cash-register"></i>
                            <p>Buat Transaksi Penjualan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                    @empty(!@session('id_penjualan'))
                        <a href="{{ route('transaksi.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-cash-register"></i>
                            <p>Transaksi Aktif Penjualan</p>
                        </a>
                    @endempty
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="post" id="logout-form">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-flat nav-link text-white rounded-sm w-full mt-1">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Keluar</p>
                            </button>
                        </form>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
=======
                </li>
                <li class="nav-header">REPORT</li>
                <li class="nav-item">
                    <a href="{{ route('laporan.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-clipboard"></i>
                        <p>Laporan</p>
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{ route('transaksi.baru') }}"
                        class="nav-link {{ request()->routeIs('transaksi.baru') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>Buat Transaksi Penjualan</p>
                    </a>
                </li>
                <li class="nav-item">
                @empty(!@session('id_penjualan'))
                    <a href="{{ route('transaksi.index') }}"
                        class="nav-link {{ request()->routeIs('transaksi.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>Transaksi Aktif Penjualan</p>
                    </a>
                @endempty
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="post" id="logout-form">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-flat nav-link text-white rounded-sm w-full mt-1">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Keluar</p>
                        </button>
                    </form>
                </li>
            @endif
    </ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>

>>>>>>> b69a3f4038e55c285e211cca2e2ec313d8bffb3b

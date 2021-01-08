<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('style-admin/dist/img/logo1.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Dropshiaaap</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('uploads/reseller/'. Session::get('image')) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Session::get('nama_lengkap') }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="{{ route('pusat.dashboard') }}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-header">TRANSAKSI</li>
                <li class="nav-item">
                    <a href="{{ route('reseller.order.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-cart-plus"></i>
                        <p>
                            Pesan sekarang
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tv"></i>
                        <p>
                            Riwayat pesanan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('reseller.riwayat.semua-pesanan') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Semua</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reseller.riwayat.belum-bayar') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Belum bayar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reseller.riwayat.dikemas') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dikemas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reseller.riwayat.dikirim') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dikirim</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reseller.riwayat.diterima') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Diterima</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
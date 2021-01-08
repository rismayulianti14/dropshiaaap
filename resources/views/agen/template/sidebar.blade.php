<aside class="main-sidebar sidebar-dark-orange elevation-4">
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('style-admin/dist/img/logo1.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><img src="{{ asset('style-admin/dist/img/logo2.png') }}" alt="" width="150px"></span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('uploads/agen/'. Session::get('image')) }}" class="img-circle elevation-2" alt="User Image">
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

                <li class="nav-header">DATA RESELLER</li>
                <li class="nav-item">
                    <a href="{{ route('agen.reseller.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Reseller
                        </p>
                    </a>
                </li>

                <li class="nav-header">TRANSAKSI</li>
                <li class="nav-item">
                    <a href="{{ route('agen.order.index') }}" class="nav-link">
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
                            <a href="{{ route('agen.riwayat.semua-pesanan') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Semua</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('agen.riwayat.belum-bayar') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Belum bayar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('agen.riwayat.dikemas') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dikemas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('agen.riwayat.dikirim') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dikirim</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('agen.riwayat.diterima') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Diterima</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!--<li class="nav-header">TRACKING</li>
                <li class="nav-item">
                    <a href="{{ route('agen.tracking') }}" class="nav-link">
                        <i class="nav-icon fas fa-truck-moving"></i>
                        <p>
                            Lacak pesanan
                        </p>
                    </a>
                </li>-->
            </ul>
        </nav>
    </div>
</aside>
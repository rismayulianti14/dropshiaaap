<aside class="main-sidebar sidebar-dark-orange elevation-4">
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('style-admin/dist/img/logo1.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><img src="{{ asset('style-admin/dist/img/logo2.png') }}" alt="" width="150px"></span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('uploads/petugas/'. Session::get('image')) }}" class="img-circle elevation-2" alt="User Image" style="width: 40px; height: 40px">
            </div>
            <div class="info">
                <a href="{{ route('pusat.profil') }}" class="d-block">{{ Session::get('username') }}</a>
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

                <li class="nav-header">DATA MASTER</li>
                <li class="nav-item">
                    <a href="{{ route('pusat.kategori.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Kategori
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-barcode"></i>
                        <p>
                            Produk
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('pusat.produk.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah data produk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pusat.jabodetabek.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jabodetabek</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pusat.pulau-jawa.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pulau Jawa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pusat.luar-jawa.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Luar Pulau Jawa</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pusat.petugas.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Petugas
                        </p>
                    </a>
                </li>

                <li class="nav-header">DATA AGEN</li>
                <li class="nav-item">
                    <a href="{{ route('pusat.agen.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Agen
                        </p>
                    </a>
                </li>

                <li class="nav-header">DATA RESELLER</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Reseller
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('pusat.reseller.semua') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Semua</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pusat.reseller.aktif') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Reseller aktif</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pusat.reseller.belum-dikonfirmasi') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Belum dikonfirmasi</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">TRANSAKSI</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Pesanan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('pusat.order.semua-pesanan') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Semua pesanan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pusat.order.belum-bayar') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Belum bayar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pusat.order.perlu-dikirim') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Perlu dikirim</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pusat.order.dikirim') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dikirim</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pusat.order.selesai') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Selesai</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!--<li class="nav-header">TRACKING</li>
                <li class="nav-item">
                    <a href="{{ route('pusat.tracking') }}" class="nav-link">
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
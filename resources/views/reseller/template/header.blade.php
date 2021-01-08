<nav class="main-header navbar navbar-expand-md navbar-dark navbar-black">
	<div class="container">
		<a href="" class="navbar-brand">
			<span class="brand-text font-weight-light"><img src="{{ asset('style-admin/dist/img/logo2.png') }}" alt="" width="150px"></span>
		</a>

		<button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse order-3" id="navbarCollapse">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="{{ route('reseller.dashboard') }}" class="nav-link">Beranda</a>
				</li>
                <li class="nav-item">
					<a href="{{ route('reseller.riwayat.semua-pesanan') }}" class="nav-link">Riwayat pesanan</a>
				</li>
				<!--<li class="nav-item dropdown">
					<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>
					<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
						<li><a href="#" class="dropdown-item">Some action </a></li>
						<li><a href="#" class="dropdown-item">Some other action</a></li>
                    </ul>
                </li>-->
	        </ul>

            <!--<form class="form-inline ml-0 ml-md-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>-->
	    </div>

	    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{ asset('uploads/reseller/'. Session::get('image')) }}" class="user-image img-circle elevation-2" alt="User Image">
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <li class="user-header bg-orange">
                    <img src="{{ asset('uploads/reseller/'. Session::get('image')) }}" class="img-circle elevation-2" alt="User Image">

                    <p class="text-white">
                    {{ Session::get('nama_lengkap') }} - Reseller
                    <small>{{ Session::get('email') }}</small>
                    <small>{{ Session::get('telepon') }}</small>
                    </p>
                </li>
                <li class="user-footer">
                    <a href="{{ route('reseller.profil') }}" class="btn btn-default btn-flat">
                        Edit profil
                    </a>
                    <a href="/reseller/logout"onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <button class="btn btn-default btn-flat float-right" >Keluar</button>
                    </a>

                    <form id="logout-form" action="/reseller/logout" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
            <!--<li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>-->
	    </ul>
    </div>
</nav>
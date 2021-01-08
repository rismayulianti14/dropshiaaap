<nav class="main-header navbar navbar-expand navbar-orange navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search" style="color: #f89520"></i>
                </button>
            </div>
        </div>
    </form>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{ asset('uploads/agen/'. Session::get('image')) }}" class="user-image img-circle elevation-2" alt="User Image">
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <li class="user-header bg-orange">
                    <img src="{{ asset('uploads/agen/'. Session::get('image')) }}" class="img-circle elevation-2" alt="User Image">

                    <p style="color: #fff">
                    {{ Session::get('nama_lengkap') }} - Agen
                    <small>{{ Session::get('email') }}</small>
                    <small>{{ Session::get('telepon') }}</small>
                    </p>
                </li>
                <li class="user-footer">
                    <a href="{{ route('agen.profil') }}" class="btn btn-default btn-flat">
                        Edit profil
                    </a>
                    <a href="/agen/logout"onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <button class="btn btn-default btn-flat float-right" >Keluar</button>
                    </a>

                    <form id="logout-form" action="/agen/logout" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt text-white"></i>
            </a>
        </li>
        <!--<li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large text-white"></i>
            </a>
        </li>-->
    </ul>
</nav>

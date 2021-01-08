@section('js')
<script type="text/javascript">

      function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#showgambar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image").change(function () {
        readURL(this);
    });

</script>
@stop

@extends('agen.template.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profil</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('agen.dashboard') }}" style="color: #f89520">Beranda</a></li>
						<li class="breadcrumb-item active">Profil</li>
                    </ol>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    @if($message = Session::get('success'))
    <div id="global-alert" class="alert alert-success alert-dismissible" style="margin: 15px 15px 15px 15px; opacity: 70%;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Berhasil</h4>
            <i style="margin-left: 42px;">{{ $message }}</i>
    </div>
    @endif

    <div id="alert">
    
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="callout callout-default">
                <h5><i class="fas fa-info"></i> Perhatian</h5>
                Keluar dari akun (logout) terlebih dahulu untuk melihat perubahan pada profil Anda
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-orange card-outline">
                        <div class="card-body box-profile">
                            <form action="{{ route('agen.profil.ubah-foto', Session::get('id')) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="text-center" style="margin-bottom: 20px">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('uploads/agen/'. Session::get('image')) }}"
                                        alt="User profile picture" style="width: 150px; height: 150px"
                                        id="showgambar" name="image">
                                        
                                    <center><input type="file" class="form-control" id="image" name="image" style="color: transparent; margin-top: 10px;width: 120px; border: 1px solid #fff"></center>
                                </div>
                                <button href="" type="submit" class="btn bg-orange btn-block"><span class="text-white">Ubah foto</span></button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card card-orange">
                        <div class="card-header">
                            <h3 class="card-title text-white">Tentang saya</h3>

                            <div id="btn_edit"> 
                                <button class="btn btn-md btn-default float-right" id="edit" data-id="{{ Session::get('id') }}">
                                    Edit
                                </button>
                            </div>
                        </div>
                        <form  method="post" action="{{ route('agen.profil.ubah-profil') }}" id="update">
                        @csrf
                        <div class="card-body">
                            <input type="hidden" name="id" value="{{ Session::get('id') }}">

                            <strong><i class="fas fa-id-card"></i> ID</strong>
                            <p class="text-muted" id="kode_id">
                                {{ Session::get('kode_id') }}
                            </p>
                            <hr>

                            <strong><i class="fas fa-user mr-1"></i> Nama lengkap</strong>
                            <p class="text-muted" id="nama_lengkap">
                                {{ Session::get('nama_lengkap') }}
                            </p>
                            <hr>

                            <strong><i class="fas fa-user mr-1"></i> Username</strong>
                            <p class="text-muted" id="username">
                                {{ Session::get('username') }}
                            </p>
                            <hr>

                            <strong><i class="fas fa-mobile-alt mr-1"></i> No.Telepon</strong>
                            <p class="text-muted" id="telepon">
                                {{ Session::get('telepon') }}
                            </p>
                            <hr>

                            <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                            <p class="text-muted" id="email">
                                {{ Session::get('email') }}
                            </p>
                            <hr>
                        </div>
                        <div class="card-footer" id="button">
                            
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
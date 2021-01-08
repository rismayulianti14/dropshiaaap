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

@extends('pusat.template.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah data petugas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('pusat.dashboard') }}" style="color: #f89520">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pusat.petugas.index') }}" style="color: #f89520">Data Petugas</a></li>
                        <li class="breadcrumb-item active">Tambah data</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12"> 
                    <div class="card card-primary">
                        <form id="form" method="POST" action="{{ route('pusat.petugas.store') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="kode_id">ID</label>
                                    <input type="text" class="form-control @error('kode_id') is-invalid @enderror" id="kode_id" name="kode_id" disabled value="{{ $kode_id }}">
                                    
                                    @error('kode_id')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nama_lengkap">Nama lengkap</label>
                                    <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkkan nama lengkap" value="{{ old('nama_lengkap') }}">
                                    
                                    @error('nama_lengkap')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Masukkkan username" value="{{ old('username') }}">
                                    
                                    @error('username')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="example@gmail.com" value="{{ old('email') }}">
                                    
                                    @error('email')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="telepon">Telepon</label>
                                    <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon" placeholder="Masukkkan nomor telepon" value="{{ old('telepon') }}">
                                    
                                    @error('telepon')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="posisi">Posisi</label>
                                    <input type="text" class="form-control @error('posisi') is-invalid @enderror" id="posisi" name="posisi" placeholder="Masukkkan posisi petugas" value="{{ old('posisi') }}">
                                    
                                    @error('posisi')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">Kata sandi</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkkan password (min. 6 karakter)" value="{{ old('password') }}">
                                    
                                    @error('password')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="image">Icon</label>
                                    <div style="width:150px; height:180px;border: 1px solid #c0c2ce;">
                                        <img src="/images/{{ Session::get('path') }}" id="showgambar" alt="" style="width: 100%; height: 100%;">
                                    </div>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image') }}">

                                    @error('image')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn bg-orange float-right"><span class="text-white">Simpan</span></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">

                </div>
            </div>
        </div>
    </section>
</div>
@endsection
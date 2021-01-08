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
                    <h1>Tambah data Reseller</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('agen.dashboard') }}" style="color: #f89520">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('agen.reseller.index') }}" style="color: #f89520">Data reseller</a></li>
                        <li class="breadcrumb-item active">Registrasi Reseller</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12"> 
                    <div class="card card-orange">
                        <div class="card-header">
                            <h3 class="card-title text-white">I). Data Akun</h3>
                        </div>
                        <form id="form" method="POST" action="{{ route('agen.reseller.store') }}" enctype="multipart/form-data">
                        @csrf

                            <input type="hidden" name="id_reseller" value="{{ $kode_id }}">
                            <input type="hidden" name="id_agen" value="{{ Session::get('id') }}">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="id_agen">ID</label>
                                    <input type="text" class="form-control" value="{{ $kode_id }}" disabled>
                                    <input type="hidden" id="kode_id" name="kode_id" value="{{ $kode_id }}">
                                </div>

                                <div class="form-group">
                                    <label for="nama_lengkap">Nama lengkap</label>
                                    <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkkan nama lengkap reseller" value="{{ old('nama_lengkap') }}">
                                    
                                    @error('nama_lengkap')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Masukkkan username reseller" value="{{ old('username') }}">
                                    
                                    @error('username')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Masukkkan email reseller" value="{{ old('email') }}">
                                    
                                    @error('email')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="telepon">Telepon</label>
                                    <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon" placeholder="Masukkkan nomor telepon reseller" value="{{ old('telepon') }}">
                                    
                                    @error('telepon')
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
                                    <label for="image">Foto</label>
                                    <div style="width:150px; height:180px;border: 1px solid #c0c2ce;">
                                        <img src="/images/{{ Session::get('path') }}" id="showgambar" alt="" style="width: 100%; height: 100%;">
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image') }}">
                                        <label class="custom-file-label" for="customFile">Pilih file ( .png | .jpg )</label>
                                    </div>

                                    @error('image')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                    </div>
                </div>

                <div class="col-md-12"> 
                    <div class="card card-orange">
                        <div class="card-header">
                            <h3 class="card-title text-white">I). Data Pribadi</h3>
                        </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="provinsi">Provinsi</label>
                                    <select class="form-control select2 @error('provinsi') is-invalid @enderror" name="provinsi" id="provinsi" style="width: 100%;">
                                        <option>Pilih Provinsi</option>
                                        @foreach($provinsi as $row)
                                        <option value="{{ $row['province_id'] }}">{{ $row['province'] }}</option>
                                        @endforeach
                                    </select>

                                    @error('provinsi')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="kota">Kota</label>
                                    <select class="form-control select2 @error('kota') is-invalid @enderror" name="kota" id="kota" style="width: 100%;">
                                        <option>Pilih kota</option>
                                    </select>
                                    @error('kota')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="kecamatan">Kecamatan</label>
                                    <select class="form-control select2 @error('kecamatan') is-invalid @enderror" name="kecamatan" id="kecamatan" style="width: 100%;">
                                        <option>Pilih kecamatan</option>
                                    </select>
                                    @error('kecamatan')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="kode_pos">Kode pos</label>
                                    <input type="text" class="form-control @error('kode_pos') is-invalid @enderror" id="kode_pos" name="kode_pos" placeholder="Masukkan nama produk">
                                    
                                    @error('kode_pos')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="alamat_detail">Alamat detail</label>
                                    <input type="text" class="form-control @error('alamat_detail') is-invalid @enderror" id="alamat_detail" name="alamat_detail" placeholder="Contoh : Jl.Contoh RT.00/00 No.0">
                                    
                                    @error('alamat_detail')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="pekerjaan">Pekerjaan</label>
                                    <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan" name="pekerjaan" placeholder="Masukkan pekerjaan reseller">
                                    
                                    @error('pekerjaan')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Tempat, tanggal lahir</label>
                                    <div class="row">
                                        <div class="col-5">
                                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan tempat lahir reseller">
                                        
                                            @error('tempat_lahir')
                                                <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-7">
                                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" placeholder="Masukkan tanggal lahir reseller">
                                        
                                            @error('tanggal_lahir')
                                                <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tgl_lahir">Jenis kelamin</label>
                                    <div class="form-group clearfix">
                                        <div class="icheck-orange d-inline" style="margin-right: 100px">
                                            <input type="radio" id="radioPrimary1" name="jenis_kelamin" class="@error('jenis_kelamin') is-invalid @enderror" value="Laki-laki">
                                            <label for="radioPrimary1">
                                                Laki-laki
                                            </label>
                                        </div>
                                        <div class="icheck-orange d-inline">
                                            <input type="radio" id="radioPrimary2" name="jenis_kelamin" class="@error('jenis_kelamin') is-invalid @enderror" value="Perempuan">
                                            <label for="radioPrimary2">
                                                Perempuan
                                            </label>
                                        </div>
                                    </div>

                                    @error('jenis_kelamin')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn bg-orange float-right"><span class="text-white">Simpan</span></button>
                            </div>
                        </form>
                    </div>
                
                <div class="col-md-6">

                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.js"
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>
    <script>
    $(document).ready(function(){
        $('select[name="provinsi"]').on('change', function(){
            let provinceid = $(this).val();
            if(provinceid){
                jQuery.ajax({
                    url:"/pusat/agen/get-kota/"+provinceid,
                    type:'GET',
                    dataType:'json',
                    success:function(data){
                        console.log(data);

                        $('select[name="kota"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="kota"]').append('<option value="'+ value.city_id +'">' + value.city_name + '</option>');
                        });
                    }
                });
            }
        });
        
        $('select[name="kota"]').on('change', function(){
            let provinceid = $(this).val();
            if(provinceid){
                jQuery.ajax({
                    url:"/pusat/agen/get-kecamatan/"+provinceid,
                    type:'GET',
                    dataType:'json',
                    success:function(data){
                        console.log(data);

                        $('select[name="kecamatan"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="kecamatan"]').append('<option value="'+ value.subdistrict_id +'">' + value.subdistrict_name + '</option>');
                            
                        });
                    }
                });
            }
        });
    });
</script>
@endsection
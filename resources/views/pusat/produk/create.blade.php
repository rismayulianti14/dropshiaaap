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
                    <h1>Tambah data produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('pusat.dashboard') }}" style="color: #f89520">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pusat.kategori.index') }}"  style="color: #f89520">Data produk</a></li>
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
                        <form id="form" method="POST" action="{{ route('pusat.produk.store') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama produk">Nama produk</label>
                                    <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" id="nama_produk" name="nama_produk" placeholder="Masukkan nama produk" value="{{ old('nama_produk') }}">
                                    
                                    @error('nama_produk')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="id_kategori">Kategori produk</label>
                                    <select class="form-control select2 @error('id_kategori') is-invalid @enderror" name="id_kategori" id="id_kategori" style="width: 100%;" value="{{ old('id_produk') }}">
                                        <option>Pilih kategori</option>
                                        @foreach($kategori as $row)
                                        <option value="{{ $row->id }}">{{ $row->kategori }}</option>
                                        @endforeach
                                    </select>

                                    @error('id_kategori')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi produk</label>
                                    <textarea id="summernote" class=" @error('deskripsi') is-invalid @enderror" name="deskripsi">{{ old('deskripsi') }}</textarea>

                                    @error('deskripsi')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="berat">Berat <i>( gram )</i></label>
                                    <input type="text" class="form-control @error('berat') is-invalid @enderror" id="berat" name="berat" placeholder="Masukkan berat produk dalam satuan gram" value="{{ old('berat') }}">
                                    
                                    @error('berat')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="stok">Stok tersedia</label>
                                    <input type="text" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" placeholder="Masukkan stok tersedia" value="{{ old('stok') }}">
                                    
                                    @error('stok')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <label for="stok">Harga</label>
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <th></th>
                                        <th>Jabodetabek</th>
                                        <th>Pulau Jawa</th>
                                        <th>Luar Pulau Jawa</th>                                
                                    </tr>
                                    <tr>
                                        <td align="center" valign="center">Harga Agen</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control @error('harga_agen_jabodetabek') is-invalid @enderror" id="harga_agen_jabodetabek" name="harga_agen_jabodetabek" placeholder="Rp." value="{{ old('harga_agen_jabodetabek') }}">
                                                    
                                                @error('harga_agen_jabodetabek')
                                                    <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control @error('harga_agen_pjawa') is-invalid @enderror" id="harga_agen_pjawa" name="harga_agen_pjawa" placeholder="Rp." value="{{ old('harga_agen_pjawa') }}">
                                                    
                                                @error('harga_agen_pjawa')
                                                    <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control @error('harga_agen_lpjawa') is-invalid @enderror" id="harga_agen_lpjawa" name="harga_agen_lpjawa" placeholder="Rp." value="{{ old('harga_agen_lpjawa') }}">
                                                    
                                                @error('harga_agen_lpjawa')
                                                    <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </td>                                
                                    </tr>
                                    <tr>
                                        <td align="center" valign="center">Harga Reseller</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control @error('harga_reseller_jabodetabek') is-invalid @enderror" id="harga_reseller_jabodetabek" name="harga_reseller_jabodetabek" placeholder="Rp." value="{{ old('harga_reseller_jabodetabek') }}">
                                                    
                                                @error('harga_reseller_jabodetabek')
                                                    <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control @error('harga_reseller_pjawa') is-invalid @enderror" id="harga_reseller_pjawa" name="harga_reseller_pjawa" placeholder="Rp." value="{{ old('harga_reseller_pjawa') }}">
                                                    
                                                @error('harga_reseller_pjawa')
                                                    <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control @error('harga_reseller_lpjawa') is-invalid @enderror" id="harga_reseller_lpjawa" name="harga_reseller_lpjawa" placeholder="Rp." value="{{ old('harga_reseller_lpjawa') }}">
                                                    
                                                @error('harga_reseller_lpjawa')
                                                    <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </td>                                
                                    </tr>
                                </table>
                                <div class="form-group control-group increment" style="margin-top: 10px;">
                                    <label for="exampleInputFile">Foto produk</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image[]" value="{{ old('image') }}">
                                        </div>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-success add"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>

                                    @error('image')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="clone hide">
                                    <div class="form-group control-group">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="form-control" id="image2" name="image[]"  value="{{ old('image') }}">
                                            </div>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-danger remove"><i class="fas fa-minus-circle"></i></button>
                                            </div>
                                        </div>
                                    </div>    
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
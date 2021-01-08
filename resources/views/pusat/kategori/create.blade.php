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
                    <h1>Tambah data kategori</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('pusat.dashboard') }}" style="color: #f89520">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pusat.kategori.index') }}" style="color: #f89520">Data Kategori</a></li>
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
                        <form id="form" method="POST" action="{{ route('pusat.kategori.store') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <input type="text" class="form-control @error('kategori') is-invalid @enderror" id="kategori" name="kategori" placeholder="Masukkan nama kategori" value="{{ old('kategori') }}">
                                    
                                    @error('kategori')
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
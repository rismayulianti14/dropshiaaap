@extends('agen.template.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">    
                    <sub class="right badge bg-orange" style="font-size: 13px;"><span class="text-white">{{ $data->nama_produk }}</span></sub>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('agen.dashboard') }}" style="color: #f89520">Beranda</a></li>
                        <li class="breadcrumb-item active">Detail produk</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card card-solid">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <h3 class="d-inline-block d-sm-none">{{ $data->nama_produk }}</h3>
                        <div class="col-12">
                            <img src="{{ asset('uploads/produk/'. $data->foto_produk->image) }}" class="product-image" alt="Product Image">
                        </div>
                        <div class="col-12 product-image-thumbs">
                            @foreach($foto_produk as $row)
                                @if($data->id == $row->id_produk)
                                    <div class="product-image-thumb active"><img src="{{ asset('uploads/produk/'. $data->foto_produk->image) }}"></div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h3 class="my-3">{{ $data->nama_produk }}</h3>
                        <input type="hidden" name="id_produk" id="id_produk" value="{{ $data->id }}">
                        
                            @if($detail_agen->provinsi == 9 || $detail_agen->provinsi == 10 || $detail_agen->provinsi == 11)

                                <span style="font-size: 35px; color: #f89520">Rp.{{ number_format( $data->pulau_jawa->harga_agen_pjawa, 0 ,'' , '.' ) }}</span>
                                <input type="hidden" name="harga" id="harga" value="{{ $data->pulau_jawa->harga_agen_pjawa }}">

                            @elseif($detail_agen->kota == 151 || $detail_agen->kota == 152 || $detail_agen->kota == 153 || $detail_agen->kota == 154 || $detail_agen->kota == 155 ||
                            $detail_agen->kota == 78 || $detail_agen->kota == 79 || $detail_agen->kota == 54 || $detail_agen->kota == 55 || $detail_agen->kota == 115 ||
                            $detail_agen->kota == 455 || $detail_agen->kota == 456 || $detail_agen->kota == 457)

                                <span style="font-size: 35px; color: #f89520">Rp.{{ number_format( $data->jabodetabek->harga_agen_jabodetabek, 0 ,'' , '.' ) }}</span>
                                <input type="hidden" name="harga" id="harga" value="{{ $data->jabodetabek->harga_agen_jabodetabek }}">

                            @else
                                <span style="font-size: 35px; color: #f89520">Rp.{{ number_format( $data->luar_pulau_jawa->harga_agen_lpjawa, 0 ,'' , '.' ) }}</span>
                                <input type="hidden" name="harga" id="harga" value="{{ $data->luar_pulau_jawa->harga_agen_lpjawa }}">
                            @endif

                            <hr>

                            <h5>Deskripsi :</h5>
                            <p>{!!  $data->deskripsi !!}</p>
                    </div>
                </div>
            </div>
        </section>
  </div>
@endsection
@extends('reseller.template.app')

@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">
					Detail 
					<span class="right badge bg-orange" style="font-size: 13px;"><b class="text-white">{{ $data->nama_produk }}</b></span>
				</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('reseller.dashboard') }}" style="color: #f89520">Beranda</a></li>
						<li class="breadcrumb-item active">Detail produk</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	<div class="content">
		<div class="container">
			<div class="card">
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
                            @if($detail_reseller->kota == 151 || $detail_reseller->kota == 152 || $detail_reseller->kota == 153 || $detail_reseller->kota == 154 || $detail_reseller->kota == 155 ||
								$detail_reseller->kota == 78 || $detail_reseller->kota == 79 || $detail_reseller->kota == 54 || $detail_reseller->kota == 55 || $detail_reseller->kota == 115 ||
								$detail_reseller->kota == 455 || $detail_reseller->kota == 456 || $detail_reseller->kota == 457)

                                <span style="font-size: 35px; color: orange">Rp.{{ number_format( $data->jabodetabek->harga_reseller_jabodetabek, 0 ,'' , '.' ) }}</span>
                                <input type="hidden" name="harga" id="harga" value="{{ $data->jabodetabek->harga_reseller_jabodetabek }}">
												
							@elseif($detail_reseller->provinsi == 9 || $detail_reseller->provinsi == 10 || $detail_reseller->provinsi == 11 || $detail_reseller->provinsi == 5 || $detail_reseller->provinsi == 3)

                                <span style="font-size: 35px; color: orange">Rp.{{ number_format( $data->pulau_jawa->harga_reseller_pjawa, 0 ,'' , '.' ) }}</span>
                                <input type="hidden" name="harga" id="harga" value="{{ $data->pulau_jawa->harga_reseller_pjawa }}">
											
							@else

                                <span style="font-size: 35px; color: orange">Rp.{{ number_format( $data->luar_pulau_jawa->harga_reseller_lpjawa, 0 ,'' , '.' ) }}</span>
                                <input type="hidden" name="harga" id="harga" value="{{ $data->luar_pulau_jawa->harga_reseller_lpjawa }}">
												
							@endif
                    
                            <hr>

                            <h5>Deskripsi :</h5>
                            <p>{!!  $data->deskripsi !!}</p>
                    </div>
                </div>
                </div>
			</div>
        </div>
	</div>

	<aside class="control-sidebar control-sidebar-dark">
		<div class="p-3">
			<h5>Title</h5>
			<p>Sidebar content</p>
		</div>
	</aside>
</div>
@endsection
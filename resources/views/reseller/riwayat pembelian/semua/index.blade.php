@extends('reseller.template.app')

@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">
						Riwayat pesanan
					</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="{{ route('reseller.dashboard') }}" style="color: #f89520">Beranda</a></li>
						<li class="breadcrumb-item active">Riwayat pesanan</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	<div class="content">
		<div class="container">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card card-orange card-outline card-tabs">
                        <div class="card-header p-0 pt-1 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active text-orange" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">
                                        Semua
                                        <sup class="right badge bg-orange" style="font-size: 11px;"><span class="text-white">{{ $count }}</span></sup>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-orange" id="custom-tabs-three-profile-tab" href="{{ route('reseller.riwayat.belum-bayar') }}">Belum dibayar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-orange" id="custom-tabs-three-messages-tab" href="{{ route('reseller.riwayat.dikemas') }}">Dikemas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-orange" id="custom-tabs-three-settings-tab" href="{{ route('reseller.riwayat.dikirim') }}">Dikirim</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-orange" id="custom-tabs-three-settings-tab" href="{{ route('reseller.riwayat.diterima') }}">Selesai</a>
                                </li>
                            </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                    <table id="table" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="5%" align="center">#</th>
                                        <th>Pesanan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($head_transaksi as $key=>$row)
                                    <tr class='clickable-row' data-href="{{ route('reseller.order.semua-pesanan.detail', $row->no_pesanan) }}">
                                        <td align="center" rowspan="2">{{ $key+1 }}</td>
                                        <td colspan="5">
                                                <b><span style="color: #777">Ashiaaap.id</span></b>
                                                <b><span class="float-right" style="color: #777">No.pesanan : {{ $row->no_pesanan }}</span></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td width="30%" style="color: #777">Produk</td>
                                                    <td width="12%" style="color: #777">Subtotal</td>
                                                    <td width="13%" style="vertical-align: middle; text-align: center;  font-size: 14px" rowspan="{{ $detail_transaksi->count('id') }}">
                                                        <span style="color: #777">Total bayar :</span><br>
                                                        <b>Rp.{{ number_format( $row->grand_total, 0 ,'' , '.' ) }}</b>
                                                    </td>
                                                    <td width="14%" style="vertical-align: middle; text-align: center;  font-size: 14px" rowspan="{{ $detail_transaksi->count('id') }}">
                                                        <span style="color: #777">Jasa kirim :</span><br>
                                                        <b style="text-transform: uppercase;">{{ $row->kurir }}</b> - {{ $row->layanan }}
                                                    </td>
                                                    <td style="vertical-align: middle; text-align: center; font-size: 14px" rowspan="{{ $detail_transaksi->count('id') }}">
                                                        {{ $row->status }}<br>
                                                        @if($row->status == 'Dikirim')
                                                            <a href="{{ route('reseller.riwayat.dikirim.tracking', $row->no_pesanan) }}" class="text-orange" id="cek">
                                                                <i class="fa fa-truck"></i> Lacak pesanan
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td width="16%" style="vertical-align: middle; text-align: center" rowspan="{{ $detail_transaksi->count('id') }}">
                                                        @if($row->status == 'Menunggu pembayaran')
                                                            <a href="{{ route('reseller.order.bayar', $row->no_pesanan) }}" type="button" class="btn btn-block bg-orange btn-sm">
                                                                <span class="text-white">
                                                                    Bayar sekarang
                                                                </span>
                                                            </a>
                                                        @elseif($row->status == 'Dikemas')
                                                            <a href="https://api.whatsapp.com/send?phone=6281211168886" type="button" class="btn btn-block bg-orange btn-sm">
                                                                <span class="text-white">
                                                                    Hubungi admin
                                                                </span>
                                                            </a>
                                                        @elseif($row->status == 'Dikirim')
                                                            <form method="POST" action="{{ route('reseller.riwayat.dikirim.diterima', $row->no_pesanan) }}">
                                                            @csrf
                                                                <button type="submit" class="btn btn-block bg-orange btn-sm">
                                                                    <span class="text-white">
                                                                        Pesanan diterima
                                                                    </span>
                                                                </button>
                                                            </form>
                                                        @elseif($row->status == 'Diterima')
                                                            <a href="{{ route('reseller.riwayat.diterima.detail', $row->no_pesanan) }}" type="button" class="btn btn-block bg-orange btn-sm">
                                                                <span class="text-white">
                                                                    Lihat rincian
                                                                </span>
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @foreach($detail_transaksi as $det)
                                                    @if($det->id_head == $row->id)
                                                    <tr>
                                                        <td style="font-size: 14px;">{{ isset($det->produk->nama_produk) ? $det->produk->nama_produk : 'Data produk tidak tersedia'  }}<span style="font-size: 13px; color: #777">( x {{ $det->qty }} )</span></td>
                                                        <td align="center" style="font-size: 14px;">Rp.{{ number_format( $det->subtotal, 0 ,'' , '.' ) }}</td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            </table>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                        Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                        Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-settings" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                        Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                    </div>
                    </div>
                </div>
                <!-- /.card -->
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
    
<script src="https://code.jquery.com/jquery-3.4.1.js"
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>

    <script>
    $(document).ready(function(){
        $('#cek').on('click', function(){
            let waybill = $('#no_resi').val();
            let courier = $('#kurir').val();
            //alert(courier);

            if(courier){
                jQuery.ajax({
                    url:"/reseller/lacak-pesanan/waybill="+waybill+"&courier="+courier,
                    type:'GET',
                    dataType:'json',
                    success:function(data){
                        console.log(data);

                        $('#hasil_lacak').empty();
                        $.each(data, function(key, value){
                            $('#hasil_lacak').append('<span><b>"'+ value.date +'"</b></span><br> <span>"'+ value.desc +'"</span><br><hr>');
                            
                        });
                    },
                });
            }
        });
    });
</script>
@endsection
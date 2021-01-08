@extends('agen.template.app')

@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">
                        Belum bayar
                        <sup><span class="right badge badge-info" style="font-size: 13px">{{ $count }}</span></sup>
                    </h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="{{ route('pusat.dashboard') }}">Beranda</a></li>
						<li class="breadcrumb-item active">Pesanan belum dibayar</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

    @if($message = Session::get('success'))
    <div id="global-alert" class="alert alert-success alert-dismissible" style="margin: 15px 15px 15px 15px; opacity: 70%;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Berhasil</h4>
            <i style="margin-left: 42px;">{{ $message }}</i>
    </div>
    @endif

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="table" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="5%" align="center">#</th>
                                        <th>Pesanan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($head_transaksi as $key=>$row)
                                    <tr class='clickable-row' data-href="{{ route('agen.riwayat.belum-bayar.detail', $row->no_pesanan) }}">
                                        <td align="center" rowspan="2">{{ $key+1 }}</td>
                                        <td colspan="5">
                                            @if($row->id_reseller != null)
                                                <b><span style="color: #777">{{ !empty($row->reseller) ? $row->reseller->nama_lengkap:'' }}</span><span style="font-size: 12px; color: #777"> ( Reseller )</span></b>
                                                <b><span class="float-right" style="color: #777">No.pesanan : {{ $row->no_pesanan }}</span></b>
                                            @else
                                                Dari : <b><span style="color: #777">Ashiaaap.id</span></b>
                                                <b><span class="float-right" style="color: #777">No.pesanan : {{ $row->no_pesanan }}</span></b>
                                            @endif
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
                                                    <td style="vertical-align: middle; text-align: center; font-size: 14px" rowspan="{{ $detail_transaksi->count('id') }}">{{ $row->status }}</td>
                                                    <td width="16%" style="vertical-align: middle; text-align: center" rowspan="{{ $detail_transaksi->count('id') }}">
                                                        <a href="{{ route('agen.order.bayar', $row->no_pesanan) }}" type="button" class="btn btn-block btn-warning btn-sm">
                                                            Bayar sekarang
                                                        </a>
                                                    </td>
                                                </tr>
                                                @foreach($detail_transaksi as $det)
                                                    @if($det->id_head == $row->id)
                                                    <tr>
                                                        <td style="font-size: 14px;">{{ isset($det->produk->nama_produk) ? $det->produk->nama_produk : 'Data produk tidak tersedia'  }}  <span style="font-size: 13px; color: #777">( x {{ $det->qty }} )</span></td>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
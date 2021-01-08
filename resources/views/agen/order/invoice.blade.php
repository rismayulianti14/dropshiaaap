@extends('agen.template.app')

@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Invoice</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('agen.dashboard') }}" style="color: #f89520">Beranda</a></li>
						<li class="breadcrumb-item active">Pesanan baru</li>
					</ol>
				</div>
			</div>
		</div>
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!--
                    <div class="callout callout-info">
                        <h5><i class="fas fa-info"></i> Note:</h5>
                        This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                    </div>-->

                    <div class="invoice p-3 mb-3">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> Dropshiaaap
                                    <small class="float-right">No.pesanan : <b>{{ $head_transaksi->no_pesanan }}</b></small>
                                </h4>
                            </div>
                        </div>
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                            Dari :
                            <address>
                                <strong>Ashiaaap.id</strong><br>
                                Jl.Kamarung RT.02/05,
                                Citeureup, Cimahi Utara
                                Kota Cimahi, Jawa Barat,
                                Indonesia, 40512<br>
                                Telp: (+62) 889-2715-313<br>
                                Email: ashiaaap2018@gmail.com
                            </address>
                            </div>

							<div class="col-sm-4 invoice-col"></div>

                            <div class="col-sm-4 invoice-col">
                            Tujuan :
                            <address>
                                <strong>{{ Session::get('nama_lengkap') }}</strong><br>
                                {{ $detail_agen->alamat_detail }}, {{$detail_agen->subdistrict_name}}, {{ $detail_agen->city_name }},
                                {{ $detail_agen->province_name }}, Indonesia, {{ $detail_agen->kode_pos }}<br>
                                Telp : {{ $detail_agen->telepon }}<br>
                                Email : {{ $detail_agen->email }}
                            </address>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										@foreach($detail_transaksi as $key=>$det)
											@if($det->id_head == $head_transaksi->id)
											<tr>
												<td>{{ $key+1 }}</td>
												<td>{{ $det->produk->nama_produk }}</td>
												<td>Rp.{{ number_format( $det->harga, 0 ,'' , '.' ) }}</td>
												<td>{{ $det->qty }}</td>
												<td>Rp.{{ number_format( $det->subtotal, 0 ,'' , '.' ) }}</td>
											</tr>
											@endif
										@endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal</th>
                        <td align="right"><b>Rp.{{ number_format( $head_transaksi->total_pembelian, 0 ,'' , '.' ) }}</b></td>
                      </tr>
                      <tr>
                        <th>Ongkos kirim</th>
                        <td align="right"><b>Rp.{{ number_format( $head_transaksi->ongkir, 0 ,'' , '.' ) }}</b></td>
                      </tr>
                      <tr>
                        <th>Total</th>
                        <td align="right"><b>Rp.{{ number_format( $head_transaksi->grand_total, 0 ,'' , '.' ) }}</b></td>
                      </tr>
                      <tr>
					  	<td colspan="2"><i style="font-size: 13px">*Catatan : {{ $head_transaksi->catatan }}</i></td>
					  </tr>
                    </table>
                  </div>
                </div>
              </div>

              <div class="row no-print">
                <div class="col-12">
                 <a href="{{ route('agen.order.bayar', $head_transaksi->no_pesanan) }}" type="button" class="btn bg-orange float-right" style="margin-bottom: 15px; margin-left: 5px; ">
					<span class="text-white">
						 <i class="far fa-credit-card"></i>
						Bayar sekarang
					</span>
                  </a>
                  <!--<button type="button" class="btn btn-primary float-right" style="width: 150px">
                    <i class="fas fa-download"></i> Unduh invoice
                  </button>-->
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
</div>
@endsection
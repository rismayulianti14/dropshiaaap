@extends('agen.template.app')

@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Bayar pesanan</h1>
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
                                    <small>No.pesanan : <b>{{ $head_transaksi->no_pesanan }}</b></small>
                                </h4>
                            </div>
                        </div>
                        <br>
                        <div class="row invoice-info">
                            <div class="col-sm-1 invoice-col"></div>

                            <div class="col-sm-5 invoice-col" style="margin-bottom: 50px; background-color: #ddd; padding: 30px 20px 30px 20px; border-radius: 5px">
                                <center>
                                    Pesanan akan diproses sebelum 2 x 24 jam. 
                                    Silahkan segera lakukan pembayaran sebesar
                                    <h2 style="margin: 15px 0 15px 0">Rp.{{ number_format( $head_transaksi->grand_total, 0 ,'' , '.' ) }}</h2>
                                    <img class="float-center" src="{{ asset('/style-admin/dist/img/credit/bca.png') }}" alt="" style="width: 150px"><br>
                                </center>
                            </div>

                            <div class="col-sm-1 invoice-col"></div>

                            <div class="col-sm-5 invoice-col" style="text-align: justify">
                                <b>Langkah pembayaran :</b><br>
                                <table border="0" width 100%>
                                    <tr>
                                        <td valign="top">1.</td>
                                        <td>Lakukan pembayaran sebesar nominal yang tertera ke No. rekening <b>1390283888 (Muhammad Hakim Delftian)</b></td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2" valign="top">2.</td>
                                        <td>- <b>screenshoot bukti transfer</b> Jika Anda melakukan transfer melalui m-banking.</td>
                                    </tr>
                                    <tr>
                                        <td>- <b>Foto bukti transfer</b> Jika Anda melakukan transfer bukan melalui m-banking.</td>
                                    </tr>
                                    <tr>
                                        <td valign="top">3.</td>
                                        <td>Setelah itu, tekan tombol <b>konfirmasi pembayaran</b> dibawah. Lalu upload foto bukti transfer ke dalam formulir yang sudah disediakan.</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        

                        <div class="row no-print">
                                <div class="col-12">
                                    <a href="{{ route('agen.order.konfirmasi-pembayaran', $head_transaksi->no_pesanan) }}" type="button" class="btn btn-md bg-orange float-right" style="width: 100%; margin: 30px 0 15px 5px"> 
                                        <span class="text-white">
                                            Konfirmasi pembayaran
                                        </span>
                                    </a>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
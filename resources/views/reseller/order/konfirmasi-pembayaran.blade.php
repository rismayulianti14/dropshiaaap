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

    $("#bukti_tf").change(function () {
        readURL(this);
    });

</script>
@stop

@extends('reseller.template.app')

@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">
						Bayar pesanan
					</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="{{ route('reseller.dashboard') }}" style="color: #f89520">Beranda</a></li>
						<li class="breadcrumb-item active">Pesanan baru</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	<div class="content">
		<div class="container">
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
                            <div class="col-sm-3 invoice-col"></div>

                            <div class="col-sm-6 invoice-col" style="margin-bottom: 50px">
                                <center>
                                <h3>Konfirmasi pembayaran pesanan anda</h3>
                                <p>Silahkan kirim bukti pembayaran pesanan Anda,<br>
                                dengan cara upload hasil foto bukti transfer melalui<br>
                                formulir dibawah agar pesanan segera diproses</p>
                                <br>

                                <form method="POST" action="{{ route('reseller.order.store-konfirmasi-pembayaran', $head_transaksi->no_pesanan) }}" enctype="multipart/form-data">
                                @csrf
                                    <center>
                                    <div class="form-group" style="width:150px;">
                                        <div style="width:150px; height:180px;border: 1px solid #c0c2ce;">
                                            <img id="showgambar" name="bukti_tf" alt="" style="width: 100%; height: 100%;">
                                        </div>
                                        <input type="file" class="form-control @error('bukti_tf') is-invalid @enderror" id="bukti_tf" name="bukti_tf" style="color: transparent;">

                                        @error('bukti_tf')
                                            <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    </center>

                                    <br>
                                </center>
                            </div>
							<div class="col-sm-3 invoice-col"></div>
                        </div>
                        

                        <div class="row no-print">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <button type="submit" class="btn btn-md bg-orange float-right" style="width: 100%; margin: 0px 0 15px 5px"> 
                                    <span class="text-white">
                                        Kirim
                                    </span>
                                </button>
                            </div>
                            <div class="col-1"></div>
                        </div>
                        </form>
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
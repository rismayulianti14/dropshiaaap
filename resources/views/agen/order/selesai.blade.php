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
                                    
                                </h4>
                            </div>
                        </div>
                        <br>
                        <div class="row invoice-info">
                            <div class="col-sm-3 invoice-col"></div>

                            <div class="col-sm-6 invoice-col" style="margin: 80px 0 80px 0">
                                <center>
                                <i class="fa fa-check-circle" style="color: green; font-size: 80px;margin-bottom:10px;"></i>
					            <h3>Berhasil !</h3>
                                <p>Pembayaran berhasil di konfirmasi. Pesanan Anda akan segera kami proses</p>
                                </center>
                                <br>
                            </div>
							<div class="col-sm-3 invoice-col"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
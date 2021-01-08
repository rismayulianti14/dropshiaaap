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

                            <div class="col-sm-6 invoice-col" style="padding: 70px 0 80px 0">
                                <center>
                                <i class="fa fa-check-circle" style="color: green; font-size: 80px;margin-bottom:10px;"></i>
					            <h3>Berhasil !</h3>
                                <p>Pembayaran berhasil di konfirmasi. Pesanan Anda akan segera kami proses</p>
                                </center>
                                <br>

                                <center><a href="{{ route('reseller.riwayat.semua-pesanan') }}" class="btn bg-orange btn-md"><span class="text-white">Lihat pesanan</span></a></center>
                            </div>
							<div class="col-sm-3 invoice-col"></div>
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
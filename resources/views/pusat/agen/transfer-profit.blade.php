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
                    <h1>
						Transfer profit
						<span class="right badge badge-warning" style="font-size: 13px;">{{ !empty($agen->nama_lengkap) ? $agen->nama_lengkap:'' }}</span>
					</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="{{ route('pusat.dashboard') }}" style="color: #f89520">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pusat.agen.index') }}" style="color: #f89520">Data Agen</a></li>
                        <li class="breadcrumb-item active">Transfer profit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

	<section class="content">
      	<div class="container-fluid">
        	<div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <form action="{{ route('pusat.agen.store-transfer-profit', $profit->id_agen) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <center>
                                            <h4>Silahkan masukkan bukti transfer</h4>
                                            Nominal transfer <b>Rp.{{ number_format( $profit->profit, 0 ,'' , '.' ) }}</b>
                                            <div style="width:150px; height:180px;border: 1px solid #c0c2ce; margin-top: 30px">
                                                <img src="/images/{{ Session::get('path') }}" id="showgambar" alt="" style="width: 100%; height: 100%;">
                                            </div>
                                            </center>

                                            <center><input type="file" class="form-control" id="image" name="image" style="color: transparent; margin-top: 10px;width: 120px; border: 1px solid #fff"></center>
                                   
                                            @error('image')
                                                <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <button class="btn btn-md bg-orange" style="width: 100%; margin-top: 20px" type="submit">
                                            <span class="text-white">
                                                Kirim
                                            </span>
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</section>
</div>
@endsection

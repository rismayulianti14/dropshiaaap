@section('js')
<script type="text/javascript">
    $('.konfirmasi').on('click', function (event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Hapus data',
            text: 'Anda yakin akan mengirimkan email kepada pengguna ini?',
            icon: 'warning',
            buttons: ["Batal", "Kirim"],
        }).then(function(value) {
            if (value) {
                window.location.href = url;
            }
        });
    });
</script>
@stop

@extends('pusat.template.app')

@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">
                        Semua pesanan
                        <sup class="right badge bg-orange" style="font-size: 13px;"><span class="text-white">{{ $count }}</span></sup>
                    </h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('pusat.dashboard') }}" style="color: #f89520">Beranda</a></li>
                        <li class="breadcrumb-item active">Semua pesanan</li>
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
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-2">
                                    <a href="{{ route('pusat.order.semua-pesanan.excel') }}" type="button" class="btn btn-block btn-default btn-md" style="margin-bottom: 5px">
                                        <i class="fas fa-table"> </i>
                                        Export Excel
                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('pusat.order.semua-pesanan.pdf') }}" type="button" class="btn btn-block btn-default btn-md" style="margin-bottom: 5px">
                                        <i class="fas fa-file-pdf"> </i>
                                        Export PDF
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%" align="center">#</th>
                                        <th>No.Resi</th>
                                        <th>Nama</th>                         
                                        <th>Total</th>
                                        <th>Ekspedisi</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($head_transaksi as $key=>$row)
                                    <tr class='clickable-row' data-href="{{ route('pusat.order.semua-pesanan.detail', $row->no_pesanan) }}">
                                        <td align="center" style="vertical-align: middle">{{ $key+1 }}</td>
                                        <td style="vertical-align: middle">{{ $row->no_resi }}</td>
                                        <td style="vertical-align: middle">
                                            @if($row->id_reseller != null)
                                                {{ !empty($row->reseller) ? $row->reseller->nama_lengkap:'' }}<br>
                                            @else
                                                {{ !empty($row->agen) ? $row->agen->nama_lengkap:'' }}<br>
                                            @endif
                                            <i style="font-size: 13px; color: #777">( {{ $row->no_pesanan }} )</i>
                                        </td>
                                        <td style="vertical-align: middle">Rp.{{ number_format( $row->grand_total, 0 ,'' , '.' ) }}</td>
                                        <td style="text-transform: uppercase; vertical-align: middle">{{ $row->kurir }} - {{ $row->layanan }}</td>
                                        <td style="vertical-align: middle"><span class="right badge badge-default" style="font-size: 13px;">{{ $row->status }}</span></td>
                                        <td style="vertical-align: middle">
                                            @if($row->status == 'Menunggu pembayaran')
                                                <a href="{{ route('pusat.order.kirim-email', $row->no_pesanan) }}" type="button" class="btn btn-block bg-orange btn-sm konfirmasi">
                                                    <span class="text-white">
                                                        Hubungi pembeli
                                                    </span>    
                                                </a>
                                            @elseif($row->status == 'Dikemas')
                                                <a href="{{ route('pusat.order.atur-pengiriman', $row->no_pesanan) }}" type="button" class="btn btn-block bg-orange btn-sm">
                                                    <span class="text-white">
                                                        Atur pengiriman
                                                    </span>  
                                                </a>
                                            @elseif($row->status == 'Dikirim')
                                                <a href="{{ route('pusat.order.tracking', $row->no_pesanan) }}" type="button" class="btn btn-block bg-orange btn-sm">
                                                    <span class="text-white">
                                                        Lacak pesanan
                                                    </span>  
                                                </a>
                                            @elseif($row->status == 'Diterima')
                                                <a href="{{ route('pusat.order.dikirim.detail', $row->no_pesanan) }}" type="button" class="btn btn-block bg-orange btn-sm">
                                                    <span class="text-white">
                                                        Lihat rincian
                                                    </span>  
                                                </a>
                                            @endif
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
@extends('agen.template.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
						Rekap transaksi
						<span class="right badge badge-warning" style="font-size: 13px;">{{ $nama_lengkap }}</span>
					</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

	<section class="content">
      	<div class="container-fluid">
        	<div class="row">
          		<div class="col-lg-3 col-6">
            		<div class="small-box bg-info">
						<div class="inner">
							<h3>Rp.{{ number_format( $transaksi_hari_ini, 0 ,'' , '.' ) }}</h3>

							<p>Transaksi hari ini</p>
						</div>
						<div class="icon">
							<i class="ion ion-bag"></i>
						</div>
					</div>
				</div>
				  
				<div class="col-lg-3 col-6">
					<div class="small-box bg-success">
						<div class="inner">
							<h3>Rp.0</h3>

							<p>Transaksi Minggu ini</p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-6">
					<div class="small-box bg-warning">
						<div class="inner">
							<h3>Rp.{{ number_format( $transaksi_bulan_ini, 0 ,'' , '.' ) }}</h3>

							<p>Transaksi bulan ini</p>
						</div>
						<div class="icon">
							<i class="ion ion-person-add"></i>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-6">
					<div class="small-box bg-danger">
						<div class="inner">
							<h3>Rp.{{ number_format( $transaksi_tahun_ini, 0 ,'' , '.' ) }}</h3>

							<p>Transaksi tahun ini</p>
						</div>
						<div class="icon">
							<i class="ion ion-pie-graph"></i>
						</div>
					</div>
				</div>
        	</div>
		
			<div class="card-footer">
				<div class="row">
					<div class="col-sm-6 col-6">
						<div class="description-block border-right">
							<span class="description-percentage text-orange"><i class="fas fa-caret-up"></i> </span>
								<h5 class="description-header">{{ $jumlah_transaksi }}</h5>
							<span class="description-text">JUMLAH TRANSAKSI</span>
						</div>
					</div>
					<div class="col-sm-6 col-6">
						<div class="description-block">
							<span class="description-percentage text-orange"><i class="fas fa-caret-up"></i> </span>
								<h5 class="description-header">Rp.{{ number_format( $total_transaksi, 0 ,'' , '.' ) }}</h5>
							<span class="description-text">TOTAL TRANSAKSI</span>
						</div>
					</div>
				</div>
			</div>

			<div class="row" style="margin-top: 20px">
				<section class="col-lg-5 connectedSortable">
					<div class="card">
						<div class="card-body">
							<div class="tab-content p-0">
								<div id="grafikPerbulan" style="position: relative; height: 400px;">
								</div>
							</div>
						</div>
					</div>
				</section>
					
				<section class="col-lg-7 connectedSortable">
				<div class="card">
						<div class="card-body">
							<div class="tab-content p-0">
								<div id="grafikPertahun" style="position: relative; height: 400px;">
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>

			<div class="row">
				<section class="col-lg-12 connectedSortable">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<div class="row">
											<div class="col-md-10">
												<h3>Data transaksi</h3>
											</div>
											<div class="col-md-2">
												<a href="{{ route('agen.reseller.pdf-rekap-transaksi', $id_reseller) }}" type="button" class="btn btn-block btn-default btn-md float-right" style="margin-bottom: 5px">
													<i class="fas fa-table"> </i>
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
													<th>No.Pesanan</th>                         
													<th>Total</th>
													<th>Ekspedisi</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
												@foreach($head_transaksi as $key=>$row)
												<tr>
													<td>{{ $key+1 }}</td>
													<td>{{ $row->no_resi }}</td>
													<td>
														<p style="font-size: 15px">#{{ $row->no_pesanan }}</p>
													</td>
													<td>Rp.{{ number_format( $row->grand_total, 0 ,'' , '.' ) }}</td>
													<td style="text-transform: uppercase">{{ $row->kurir }} - {{ $row->layanan }}<br></td>
													<td><span class="right badge badge-default" style="font-size: 13px;">{{ $row->status }}</span></td>
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
		</div>
	</section>
</div>
@endsection

@section('js')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
	Highcharts.chart('grafikPerbulan', {
    title: {
        text: 'Penjualan per-hari'
    },
    xAxis: {
        categories: {!!json_encode($tgl)!!}
    },
    yAxis: {
        min: 0,
        title : {
          text: 'Jumlah transaksi'
        }
    },
	colors: [
		'orange'
	],
    series: [{
        type: 'line',
        name: 'Jumlah transaksi',
        data: {!!json_encode($grafik_perbulan)!!},
        marker: {
            enabled: false
        },
        states: {
            hover: {
                lineWidth: 0
            }
        },
        enableMouseTracking: false
    }]
});
</script>

<script>
	Highcharts.chart('grafikPertahun', {
    title: {
        text: 'Penjualan per-bulan'
    },
    xAxis: {
        categories: {!!json_encode($bulan)!!}
    },
    yAxis: {
        min: 0,
        title : {
          text: 'Jumlah transaksi'
        }
    },
	colors: [
		'orange'
	],
    series: [{
        type: 'line',
        name: 'Jumlah transaksi',
        data: {!!json_encode($grafik_pertahun)!!} ,
        marker: {
            enabled: false
        },
        states: {
            hover: {
                lineWidth: 0
            }
        },
        enableMouseTracking: false
    }]
});
</script>
@stop
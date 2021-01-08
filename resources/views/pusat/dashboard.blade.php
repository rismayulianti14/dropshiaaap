@extends('pusat.template.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
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
							<h3>Rp.{{ number_format( $omzet_hari_ini, 0 ,'' , '.' ) }}</h3>

							<p>Omzet hari ini</p>
						</div>
						<div class="icon">
							<i class="ion ion-bag"></i>
						</div>
              			<a href="#" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            		</div>
				</div>
				  
				<div class="col-lg-3 col-6">
					<div class="small-box bg-success">
						<div class="inner">
							<h3>Rp.{{ number_format( $omzet_minggu_ini, 0 ,'' , '.' ) }}</h3>

							<p>Omzet Minggu ini</p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
						<a href="#" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>

				<div class="col-lg-3 col-6">
					<div class="small-box bg-warning">
						<div class="inner">
							<h3>Rp.{{ number_format( $omzet_bulan_ini->total, 0 ,'' , '.' ) }}</h3>

							<p>Omzet bulan ini</p>
						</div>
						<div class="icon">
							<i class="ion ion-person-add"></i>
						</div>
						<a href="#" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>

				<div class="col-lg-3 col-6">
					<div class="small-box bg-danger">
						<div class="inner">
							<h3>Rp.{{ number_format( $omzet_tahun_ini->total, 0 ,'' , '.' ) }}</h3>

							<p>Omzet tahun ini</p>
						</div>
						<div class="icon">
							<i class="ion ion-pie-graph"></i>
						</div>
						<a href="#" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
        	</div>
		
			<div class="card-footer">
				<div class="row">
					<div class="col-sm-3 col-6">
						<div class="description-block border-right">
							<span class="description-percentage text-warning"><i class="fas fa-caret-up"></i> </span>
								<h5 class="description-header">{{ $total_reseller_aktif }}</h5>
							<span class="description-text">RESELLER AKTIF</span>
						</div>
					</div>
					<div class="col-sm-3 col-6">
						<div class="description-block border-right">
							<span class="description-percentage text-warning"><i class="fas fa-caret-up"></i> </span>
								<h5 class="description-header">{{ $total_agen_aktif }}</h5>
							<span class="description-text">AGEN AKTIF</span>
						</div>
					</div>
					<div class="col-sm-3 col-6">
						<div class="description-block border-right">
							<span class="description-percentage text-warning"><i class="fas fa-caret-up"></i> </span>
								<h5 class="description-header">{{ $total_transaksi }}</h5>
							<span class="description-text">TRANSAKSI</span>
						</div>
					</div>
					<div class="col-sm-3 col-6">
						<div class="description-block">
							<span class="description-percentage text-warning"><i class="fas fa-caret-up"></i> </span>
								<h5 class="description-header">Rp.{{ number_format( $total_omzet, 0 ,'' , '.' ) }}</h5>
							<span class="description-text">TOTAL OMZET</span>
						</div>
					</div>
				</div>
			</div>

			<div class="row" style="margin-top: 20px">
				<section class="col-lg-12 connectedSortable">
					<div class="card">
						<div class="card-body">
							<div class="tab-content p-0">
								<div id="grafikPerbulan" style="position: relative; height: 400px;">

								</div>
							</div>
						</div>
					</div>
				</section>
			</div>

			<div class="row">
				<section class="col-lg-12 connectedSortable">
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
		</div>
	</section>
</div>
@endsection


@section('js')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
	var myData = {!! json_encode($grafik_perbulan) !!};

	Highcharts.chart('grafikPerbulan', {
    title: {
        text: 'Penjualan per-hari',
    },
    xAxis: {
        categories: {!!json_encode($tgl)!!}
    },
    yAxis: {
        min: 0,
        title : {
          text: 'Jumlah pesanan',
        }
    },
	colors: [
		'orange'
	],
    series: [{
        type: 'line',
        name: 'Jumlah pesanan',
        data: {!!json_encode($grafik_perbulan)!!},
        marker: {
            enabled: false
        },
        states: {
            hover: {
                lineWidth: 0
            }
        },
        enableMouseTracking: true
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
          text: 'Jumlah pesanan'
        }
    },
	colors: [
		'orange'
	],
    series: [{
        type: 'line',
        name: 'Jumlah pesanan',
        data: {!!json_encode($grafik_pertahun)!!} ,
        marker: {
            enabled: false
        },
        states: {
            hover: {
                lineWidth: 0
            }
        },
        enableMouseTracking: true
    }]
});
</script>
@stop
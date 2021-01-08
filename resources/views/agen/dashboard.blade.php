@extends('agen.template.app')

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
          		<div class="col-lg-4 col-6">
            		<div class="small-box bg-info">
						<div class="inner">
							<h3>Rp.{{ number_format( $profit->profit, 0 ,'' , '.' ) }}</h3>

							<p>Saldo profit</p>
						</div>
						<div class="icon">
							<i class="fas fa-dollar-sign"></i>
						</div>
            		</div>
				</div>
				  
				<div class="col-lg-4 col-6">
					<div class="small-box bg-success">
						<div class="inner">
							<h3>{{ $total_reseller }}</h3>

							<p>Reseller aktif</p>
						</div>
						<div class="icon">
							<i class="fas fa-user-check"></i>
						</div>
					</div>
				</div>

				<div class="col-lg-4 col-6">
					<div class="small-box bg-orange">
						<div class="inner">
							<h3>{{ $reseller_aktif }}</h3>

							<p>Total reseller</p>
						</div>
						<div class="icon">
							<i class="fas fa-users"></i>
						</div>
					</div>
				</div>
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
												<h3>Rangking reseller aktif</h3>
											</div>
										</div>
									</div>
									<div class="card-body">
										<table id="table" class="table table-bordered table-hover">
											<thead>
												<tr>
													<th width="5%" align="center">#</th>
													<th>Nama reseller</th>
													<th>Alamat</th>                         
													<th>Total transaksi</th>
												</tr>
											</thead>
											<tbody>
												
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
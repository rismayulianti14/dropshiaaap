@extends('pusat.template.app')

@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">
                        Daftar harga produk
                        <span class="right badge bg-orange" style="font-size: 13px;"><b class="text-white">Pulau jawa</b></span>
                    </h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="{{ route('pusat.dashboard') }}" style="color: #f89520">Beranda</a></li>
						<li class="breadcrumb-item active">Pulau Jawa</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%" align="center">#</th>
                                        <th align="center">Nama produk</th>
                                        <th align="center">Harga Agen</th>
                                        <th align="center">Harga Reseller</th>                                   
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $key=>$row)
                                    <tr>
                                        <td align="center">{{ $key+1 }}</td>
                                        <td>{{ $row->nama_produk }}</td>
                                        <td>Rp.{{ number_format( $row->pulau_jawa->harga_agen_pjawa, 0 ,'' , '.' ) }}</td>
                                        <td>Rp.{{ number_format( $row->pulau_jawa->harga_reseller_pjawa, 0 ,'' , '.' ) }}</td>
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
@section('js')
<script type="text/javascript">
    $('.hapus').on('click', function (event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Hapus data',
            text: 'Anda yakin akan menghapus data ini secara permanen?',
            icon: 'warning',
            buttons: ["Batal", "Hapus"],
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
					<h1 class="m-0">Data Kategori</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="{{ route('pusat.dashboard') }}" style="color: #f89520">Beranda</a></li>
						<li class="breadcrumb-item active">Data Kategori</li>
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
                                <div class="col-md-6"></div>
                                <div class="col-md-2">
                                    <a href="{{ route('pusat.kategori.export-excel') }}" type="button" class="btn btn-block btn-default btn-md" style="margin-bottom: 5px">
                                        <i class="fas fa-table"> </i>
                                        Export Excel
                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('pusat.kategori.export-pdf') }}" type="button" class="btn btn-block btn-default btn-md" style="margin-bottom: 5px">
                                        <i class="fas fa-file-pdf"> </i>
                                        Export PDF
                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('pusat.kategori.create') }}" type="button" class="btn btn-block bg-orange btn-md" style="margin-bottom: 5px;">
                                        <span class="text-white">
                                            <i class="fa fa-plus"> </i>
                                            Tambah data
                                        </span>    
                                    
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%" align="center">#</th>
                                        <th align="center">Kategori</th>
                                        <th align="center">Icon</th>
                                        <th width="15%"></th>                                   
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $key=>$row)
                                    <tr>
                                        <td align="center" style="vertical-align: middle">{{ $key+1 }}</td>
                                        <td style="vertical-align: middle">{{ $row->kategori }}</td>
                                        <td style="vertical-align: middle">
                                            <a href="{{ asset('uploads/icon kategori/'. $row->image) }}" data-lightbox="photos">  
                                                <img src="{{ asset('uploads/icon kategori/'. $row->image) }}" alt="" style="height: 35px">
                                            </a>
                                        </td>
                                        <td align="center" style="vertical-align: middle">
                                            <div class="row">
                                                <div class="col-md-2"></div>
                                                <div class="col-md-4">
                                                    <a href="{{ route('pusat.kategori.edit', $row->id) }}" type="button" class="btn btn-block btn-outline-warning btn-sm" style="margin-bottom: 5px;">
                                                        <i class="fa fa-pen"></i>
                                                    </a>
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="{{ route('pusat.kategori.hapus', $row->id) }}" type="button" class="btn btn-block btn-outline-danger btn-sm hapus">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                                <div class="col-md-2"></div>
                                            </div>
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
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
					<h1 class="m-0">Data Produk</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="{{ route('pusat.dashboard') }}" style="color: #f89520">Beranda</a></li>
						<li class="breadcrumb-item active">Data Produk</li>
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
                                    <a href="{{ route('pusat.produk.export-excel') }}" type="button" class="btn btn-block btn-default btn-md" style="margin-bottom: 5px">
                                        <i class="fas fa-table"> </i>
                                        Export Excel
                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('pusat.produk.export-pdf') }}" type="button" class="btn btn-block btn-default btn-md" style="margin-bottom: 5px">
                                        <i class="fas fa-file-pdf"> </i>
                                        Export PDF
                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('pusat.produk.create') }}" type="button" class="btn btn-block bg-orange btn-md" style="margin-bottom: 5px">
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
                                        <th width="10%" align="center">Foto</th>
                                        <th width="15%" align="center">Nama produk</th>
                                        <th width="37%">Deskripsi</th>
                                        <th width="8%">Berat</th>
                                        <th width="10%"></th>
                                        <th width="15%"></th>                                   
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $key=>$row)
                                    <tr>
                                        <td align="center" style="vertical-align: middle">{{ $key+1 }}</td>
                                        <td style="vertical-align: middle">
                                            @foreach($foto_produk as $foto)
                                                @if($foto->id_produk == $row->id)
                                                <a href="{{ asset('uploads/produk/'. $foto->image) }}" data-lightbox="photos" >  
                                                    <img src="{{ asset('uploads/produk/'. $foto->image) }}" alt="" style="height: 50px" style="margin-bottom: 5px;">
                                                </a>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td style="vertical-align: middle">{{ $row->nama_produk }}</td>
                                        <td style="vertical-align: middle">{!!  substr(strip_tags($row->deskripsi), 0, 150) !!}</td>
                                        <td align="center" style="vertical-align: middle">{{ $row->berat }}<br><i style="font-size: 12px">( gram )</i></td>
                                        <td style="vertical-align: middle">
                                            <a href="" id="updateStok" data-toggle="modal" data-target="#modalStok" data-id="{{ $row->id }}" class="btn btn-block btn-outline-success btn-sm">
                                                Cek stok
                                            </a>
                                        </td>
                                        <td style="vertical-align: middle">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <a href="" id="detailProduk" data-toggle="modal" data-target="#modalDetail" data-id="{{ $row->id }}" class="btn btn-block btn-outline-info btn-sm">
                                                        <i class="fa fa-info"></i>
                                                    </a>
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="{{ route('pusat.produk.edit', $row->id) }}" type="button" class="btn btn-block btn-outline-warning btn-sm" style="margin-bottom: 5px;">
                                                        <i class="fa fa-pen"></i>
                                                    </a>
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="{{ route('pusat.produk.hapus', $row->id) }}" type="button" class="btn btn-block btn-outline-danger btn-sm hapus">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
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

<div class="modal fade" id="modalStok">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div id="global-alert" class="alert alert-success alert-dismissible" style="opacity: 70%; width="100%">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                </div>
                <button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('pusat.produk.update-stok') }}" id="update">
                @csrf
                    <div class="form-group control">
                        <label for="">Stok tersedia : </label>
                    </div>
                    <div class="form-group control">
                        <div id="id">

                        </div>
                    </div>
                    <div class="form-group control">
                        <div id="stok">

                        </div>
                    </div>
                    <button type="button" type="submit" id="submit" class="btn bg-orange float-right"><span class="text-white">Perbaharui stok</span></button>
                </form> 
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDetail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail produk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table width="100%" border="0">
                    <tr>
                        <td width="50%" align="center">
                            <h4 id="nama_produk"></h4> ( <span id="berat"></span> gram )<br><br>   
                        </td>
                    </tr>
                    <tr>
                        <td width="40%" valign="top" align="center">
                            <img src="" alt="" id="image" style="height: 300px; margin-bottom: 15px">
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <table width="100%" border="1" style="margin-bottom: 20px">
                            <tr style="padding: 3px">
                                <td></td>
                                <td align="center"><b>Jabodetabek</b></td>
                                <td align="center"><b>Pulau Jawa</b></td>
                                <td align="center"><b>Luar Pulau Jawa</b></td>
                            </tr>
                            <tr style="padding: 3px">
                                <th style="padding-left: 10px">Harga agen</th>
                                <td align="center">Rp.<span id="harga_agen_jabodetabek"></span></td>
                                <td align="center">Rp.<span id="harga_agen_pjawa"></span></td>
                                <td align="center">Rp.<span id="harga_agen_lpjawa"></span></td>
                            </tr>
                            <tr style="padding: 3px">
                                <th style="padding-left: 10px">Harga reseller</th>
                                <td align="center">Rp.<span id="harga_reseller_jabodetabek"></span></td>
                                <td align="center">Rp.<span id="harga_reseller_pjawa"></span></td>
                                <td align="center">Rp.<span id="harga_reseller_lpjawa"></span></td>
                            </tr>
                        </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Deskripsi :</b><br>
                            <span id="deskripsi" style="text-align: justify"></span><br><br>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer justify-content-between">
                
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
$(document).ready(function () {

$.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});

$('body').on('click', '#updateStok', function (event) {

    event.preventDefault();
    var id = $(this).data('id');
    console.log(id)
    $('#id').val(id);
    
    $('#stok').html('');
    $('.alert-success').html();

    $.get('produk/cek-stok/' + id + '/get', function (data) {
        console.log(data);
        $.each(data, function(key, val){
            console.log(val);
            $('#id').append('<input type="hidden" class="form-control" id="id" name="id" value="'+ val.id +'">');
            $('#stok').append('<input type="text" class="form-control" id="stok" name="stok" value="'+ val.stok +'"><br>');
        });
     });
});

$('#close').on('click', function(event){
    $('#id').val();
    $('#id_size').html();
    $('#size').html();
    $('#subkategori').html('');
    $('#stok').html();
    $('.alert-success').html();
});

$('body').on('click', '#submit', function (event) {
    event.preventDefault();

    var form = $('#update');
    var url = $('#update').attr('action');
    var formData = $('#update').serializeArray();

    console.log(formData);

    $.ajax({
        type : 'post',
        url  : url,
        data : formData,
        success : function(data) {
            console.log(data);

            $(".alert-success").css("display", "block");
            $(".alert-success").append("Stok berhasil di update");
        }
      });
});

}); 
</script>

<script>
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('click', '#detailProduk', function (event) {

        event.preventDefault();
        var id = $(this).data('id');
        console.log(id)
        $('#id').val(id);

        $.get('produk/detail-produk/' + id + '/get', function (data) {
            console.log(data);
            $.each(data, function(key, val){
                console.log(val);
                $('#image').prop("src","{{asset('uploads/produk')}}"+'/'+val.foto_produk.image);
                $('#nama_produk').html(val.nama_produk);
                $('#berat').html(val.berat);
                $('#deskripsi').html(val.deskripsi);

                $('#harga_agen_jabodetabek').html(val.jabodetabek.harga_agen_jabodetabek);
                $('#harga_reseller_jabodetabek').html(val.jabodetabek.harga_reseller_jabodetabek);

                $('#harga_agen_pjawa').html(val.pulau_jawa.harga_agen_pjawa);
                $('#harga_reseller_pjawa').html(val.pulau_jawa.harga_reseller_pjawa);

                $('#harga_agen_lpjawa').html(val.luar_pulau_jawa.harga_agen_lpjawa);
                $('#harga_reseller_lpjawa').html(val.luar_pulau_jawa.harga_reseller_lpjawa);
            });
        });
    });
}); 
</script>
@endsection
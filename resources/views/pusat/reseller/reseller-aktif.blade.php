@extends('pusat.template.app')

@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Reseller aktif</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('pusat.dashboard') }}" style="color: #f89520">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pusat.reseller.semua') }}" style="color: #f89520">Data Reseller</a></li>
                        <li class="breadcrumb-item active">Reseller aktif</li>
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
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-2">
                                    <a href="{{ route('pusat.reseller-aktif.export-excel') }}" type="button" class="btn btn-block btn-default btn-md" style="margin-bottom: 5px">
                                        <i class="fas fa-table"> </i>
                                        Export Excel
                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('pusat.reseller-aktif.export-pdf') }}" type="button" class="btn btn-block btn-default btn-md" style="margin-bottom: 5px">
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
                                        <th align="center">Foto</th>
                                        <th align="center">Nama lengkap</th>
                                        <th align="center">Email</th>
                                        <th align="center">Telepon</th>
                                        <th>Nama agen</th>
                                        <th>Status</th>
                                        <th></th>
                                        <th></th>                               
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($reseller as $key=>$row)
                                    <tr>
                                    <td align="center" style="vertical-align: middle">{{ $key+1 }}</td>
                                        <td style="vertical-align: middle">
                                            <a href="{{ asset('uploads/reseller/'. $row->image) }}" data-lightbox="photos">  
                                                <img src="{{ asset('uploads/reseller/'. $row->image) }}" alt="" style="height: 60px; width: 60px">
                                            </a>
                                        </td>
                                        <td style="vertical-align: middle">{{ $row->nama_lengkap }}</td>
                                        <td style="vertical-align: middle">{{ $row->email }}</td>
                                        <td style="vertical-align: middle">{{ $row->telepon }}</td>
                                        <td style="vertical-align: middle">{{ $row->agen->nama_lengkap }}</td>
                                        <td align="center" style="vertical-align: middle">
                                            <input style="font-size: 12px;" data-id="{{$row->id}}" class="toggle-class" type="checkbox" disabled data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Aktif" data-off="Non-aktif" {{ $row->status ? 'checked' : '' }}>
                                        </td>
                                        <td style="vertical-align: middle">
                                            <a href="{{ route('pusat.reseller.rekap-transaksi', $row->id) }}" type="button" class="btn btn-block btn-outline-success btn-sm" style="margin-bottom: 5px;">
                                                Rekap transaksi
                                            </a>
                                        </td>
                                        <td align="center" style="vertical-align: middle">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <a href="" id="detailReseller" data-toggle="modal" data-target="#modalDetail" data-id="{{ $row->id }}" class="btn btn-block btn-outline-info btn-sm" style="margin-bottom: 5px;">
                                                        <i class="fa fa-info"></i>
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



<div class="modal fade" id="modalDetail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail reseller</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table width="100%" border="0">
                    <tr>
                        <td colspan="4" align="center" style="padding-top: 10px; margin-bottom: 10px; background-color: #f89520; color: #fff"><h3 id="kode_id"></h3></td>
                    </tr>
                    <tr>
                        <td width="25%" style="padding-left: 10px; padding-top: 10px">Nama</td>
                        <td width="1%" style="padding-top: 10px">: </td>
                        <td width="34%" style="padding-top: 10px" id="nama_lengkap"></td>
                        <td width="40%" valign="top" rowspan="8" align="right" style="padding-right: 10px;">
                            <img src="" alt="" id="image" style="height: 300px; width: 250px;margin-top: 15px">
                        </td>
                    </tr>
                    <tr>
                        <td width="25%" style="padding-left: 10px">Username</td>
                        <td width="1%">: </td>
                        <td width="34%" id="username"></td>
                    </tr>
                    <tr>
                        <td width="25%" style="padding-left: 10px">Tempat, Tanggal lahir</td>
                        <td width="1%">: </td>
                        <td width="34%"><span id="tanggal_lahir"></span>, <span id="tempat_lahir"></span></td>
                    </tr>
                    <tr>
                        <td width="25%" style="padding-left: 10px">Profesi</td>
                        <td width="1%">: </td>
                        <td width="34%" id="pekerjaan"></td>
                    </tr>
                    <tr>
                        <td width="25%" style="padding-left: 10px">Jenis kelamin</td>
                        <td width="1%">: </td>
                        <td width="34%" id="jenis_kelamin"></td>
                    </tr>
                    <tr>
                        <td width="25%" style="padding-left: 10px">No.Telepon</td>
                        <td width="1%">: </td>
                        <td width="34%" id="telepon"></td>
                    </tr>
                    <tr>
                        <td width="25%" style="padding-left: 10px">Email</td>
                        <td width="1%">: </td>
                        <td width="34%" id="email"></td>
                    </tr>
                    <tr>
                        <td width="25%" style="padding-left: 10px" valign="top">Alamat</td>
                        <td width="1%" valign="top">: </td>
                        <td width="34%" valign="top"><span id="alamat_detail"></span>, <span id="kecamatan"></span>, <span id="kota"></span>, 
                        <span id="provinsi"></span>, <span>Indonesia</span>, <span id="kode_pos"></span></td>
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

    $('body').on('click', '#detailReseller', function (event) {

        event.preventDefault();
        var id = $(this).data('id');
        console.log(id)
        $('#id').val(id);

        $.get('/pusat/reseller/detail-reseller/' + id + '/get', function (data) {
            console.log(data);
            $.each(data, function(key, val){
                console.log(val);
                $('#kode_id').html(val.kode_id);
                
                $('#image').prop("src","{{asset('uploads/agen')}}"+'/'+val.image);
                $('#nama_lengkap').html(val.nama_lengkap);
                $('#username').html(val.username);
                $('#tempat_lahir').html(val.tempat_lahir);
                $('#tanggal_lahir').html(val.tanggal_lahir);
                $('#pekerjaan').html(val.pekerjaan);
                $('#jenis_kelamin').html(val.jenis_kelamin);
                $('#telepon').html(val.telepon);
                $('#email').html(val.email);
                $('#alamat_detail').html(val.alamat_detail);
                $('#kecamatan').html(val.subdistrict_name);
                $('#kota').html(val.city_name);
                $('#provinsi').html(val.province_name);
                $('#kode_pos').html(val.kode_pos);
            });
        });
    });
}); 
</script>
@endsection
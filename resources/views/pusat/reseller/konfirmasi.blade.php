@extends('pusat.template.app')

@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Konfirmasi akun reseller</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('pusat.dashboard') }}" style="color: #f89520">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pusat.reseller.semua') }}" style="color: #f89520">Data Reseller</a></li>
                        <li class="breadcrumb-item active">Konfirmasi akun</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

    <section class="content">
        <div class="container-fluid">
            <div class="callout callout-orange">
                <h5><i class="fas fa-info"></i> Data reseller :</h5>
                <b>{{ $detail_reseller->nama_lengkap }}</b><br>
                {{ $detail_reseller->alamat_detail }}, {{ $detail_reseller->subdistrict_name }}, {{ $detail_reseller->city_name }}, {{ $detail_reseller->province_name }}, {{ $detail_reseller->kode_pos }}<br>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%" align="center"></th>
                                        <th align="center" colspan="2">Agen terdekat</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($agen as $key=>$row)
                                        @if($row->kecamatan == $detail_reseller->kecamatan || $row->kota == $detail_reseller->kota || $row->provinsi == $detail_reseller->provinsi)
                                        <tr>
                                            <td>
                                                <input type="hidden" id="id_reseller" value="{{ $detail_reseller->id_reseller }}">
                                                <input type="hidden" id="id_{{ $row->id_agen }}" value="{{ $row->id_agen }}">
                                                <div id="pilih_{{ $row->id }}"><button type="submit" class="btn btn-sm bg-orange" onclick="pilih({{ $row->id_agen }})"><span class="text-white">Pilih</span></button></div>
                                            </td>
                                            <td id="nama_agen_{{ $row->id_agen }}">{{ $row->nama_lengkap }}</td>
                                            <td id="alamat_agen_{{ $row->id_agen }}">
                                                {{ $row->alamat_detail }}, {{ $row->subdistrict_name }}, {{ $row->city_name }}, {{ $row->province_name }}, {{ $row->kode_pos }}
                                                <span class="float-right" id="terpilih_{{ $row->id_agen }}" style="color:green; font-size: 13px;"></span>
                                            </td>
                                        </tr>
                                        @endif
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
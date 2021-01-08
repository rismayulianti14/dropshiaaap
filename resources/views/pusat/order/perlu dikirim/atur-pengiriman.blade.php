@extends('pusat.template.app')

@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
                    <h1 class="m-0">
                        Atur pengiriman
                        <span class="right badge bg-orange" style="font-size: 13px;"><span class="text-white">{{ $head_transaksi->no_pesanan }}<span></span>
                    </h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('pusat.dashboard') }}" style="color: #f89520">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pusat.order.perlu-dikirim') }}" style="color: #f89520">Pesanan perlu dikirim</a></li>
						<li class="breadcrumb-item active">Atur pengiriman</li>
					</ol>
				</div>
			</div>
		</div>
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!--
                    <div class="callout callout-info">
                        <h5><i class="fas fa-info"></i> Note:</h5>
                        This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                    </div>-->

                    <div class="invoice p-3 mb-3">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <small class="float-right">No.pesanan : <b>{{ $head_transaksi->no_pesanan }}</b></small>
                                </h4>
                            </div>
                        </div>
                        <div class="row invoice-info" style="margin-top: 30px">
                            <div class="col-sm-1 invoice-col"></div>
                            <div class="col-sm-1 invoice-col">
                                <address>
                                    <img src="{{ asset('/style-admin/dist/img/icon/bill.png') }}" alt="" style="height: 100px">
                                </address>
                            </div>

                            <div class="col-sm-1 invoice-col"></div>

                            @if($head_transaksi->ongkir == 0)
                            <div class="col-sm-8 invoice-col">
                                <b>Pilih jasa kirim</b>
                                
                                <form action="{{ route('pusat.order.store-atur-pengiriman', $head_transaksi->no_pesanan) }}" method="post">
                                @csrf
                                <address style="margin-top: 10px">
                                    Pilih kurir yang digunakan lalu masukkan No.resi pengiriman pesanan pada kolom di bawah ini, agar pesanan dapat dilacak dari rincian pesanan.
                                    Pesanan akan berpindah status menjadi "Sedang dikirim" jika resi sudah terverifikasi oleh sistem ekspedisi yang
                                    bersangkutan (Max: 1x24 jam).

                                    <div style="width: 100%; background-color: #ddd; padding: 10px 20px 30px 20px; margin-top: 20px">
                                        Alamat penerima : <br>
                                        @if($head_transaksi->id_reseller == null)
                                            <strong>{{ !empty($head_transaksi->agen) ? $head_transaksi->agen->nama_lengkap:'' }}</strong><br>
                                            {{ $detail_agen->alamat_detail }}, {{$detail_agen->subdistrict_name}}, {{ $detail_agen->city_name }},
                                            {{ $detail_agen->province_name }}, Indonesia, {{ $detail_agen->kode_pos }}<br>
                                            Telp : {{ $detail_agen->telepon }}<br>
                                            Email : {{ $detail_agen->email }}
                                        @else
                                            <strong>{{ !empty($head_transaksi->reseller) ? $head_transaksi->reseller->nama_lengkap:'' }}</strong><br>
                                            {{ $detail_reseller->alamat_detail }}, {{$detail_reseller->subdistrict_name}}, {{ $detail_reseller->city_name }},
                                            {{ $detail_reseller->province_name }}, Indonesia, {{ $detail_reseller->kode_pos }}<br>
                                            Telp : {{ $detail_reseller->telepon }}<br>
                                            Email : {{ $detail_reseller->email }}
                                        @endif

                                        <input type="hidden" name="kecamatan_asal" value="1471">
                                        <input type="hidden" name="kecamatan_tujuan" value="{{ $detail_agen->kecamatan }}">
                                        <input type="hidden" name="berat" id="subtotal_berat" value="{{ $detail_transaksi->sum('berat') }}">
                                        
                                        <div class="form-group" style="margin-top: 10px">
                                            Kurir
                                            <select class="form-control select2 @error('kurir') is-invalid @enderror" name="kurir" id="kurir" style="width: 100%; margin-top: 5px">
                                                <option>Pilih Ekspedisi</option>
                                                <option value="pos">POS Indonesia</option>
                                                <option value="lion">Lion Parcel</option>
                                                <option value="ninja">Ninja Express</option>
                                                <option value="sicepat">SiCepat Express</option>
                                                <option value="ide">ID Express</option>
                                                <option value="sap">SAP Express</option>
                                                <option value="ncs">Nusantara Card Semesta</option>
                                                <option value="rex">Royal Express Indonesia</option>
                                                <option value="sentral">Sentral Cargo</option>
                                                <option value="wahana">Wahana Prestasi Logistik</option>
                                                <option value="jnt">J&T Express</option>
                                                <option value="jet">JET Express</option>
                                                <option value="first">First Logistic</option>
                                                <option value="idl">IDL Cargo</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            Layanan
                                            <select class="form-control select2 @error('layanan') is-invalid @enderror" name="layanan" id="layanan" style="width: 100%;margin-top: 5px">
                                            
                                            </select>

                                            @error('layanan')
                                                <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            No. Resi
                                            <input type="text" class="form-control @error('no_resi') is-invalid @enderror" id="no_resi" name="no_resi" value="{{ old('no_resi') }}" style="margin-top: 5px">
                                            
                                            @error('no_resi')
                                                <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </address>
                                <button type="submit" class="btn btn-md btn-primary float-right">Konfirmasi</button>
                                </form>
                            </div>
                            @else
                            <div class="col-sm-8 invoice-col">
                                <b>Masukkan nomor resi <span style="text-transform: uppercase">{{ $head_transaksi->kurir }} - {{ $head_transaksi->layanan }}</span></b>

                                <form action="{{ route('pusat.order.store-atur-pengiriman', $head_transaksi->no_pesanan) }}" method="post">
                                @csrf
                                    <address style="margin-top: 10px">
                                        Masukkan No.resi pengiriman pesanan pada kolom di bawah ini, agar pesanan dapat dilacak dari rincian pesanan.
                                        Pesanan akan berpindah status menjadi "Sedang dikirim" jika resi sudah terverifikasi oleh sistem ekspedisi yang
                                        bersangkutan (Max: 1x24 jam).

                                        <div style="width: 100%; background-color: #ddd; padding: 10px 20px 30px 20px; margin-top: 20px">
                                            Alamat penerima : <br>
                                            <strong>{{ $head_transaksi->agen->nama_lengkap }}, {{ $detail_agen->telepon }}</strong><br>
                                            {{ $detail_agen->alamat_detail }}, {{$detail_agen->subdistrict_name}}, {{ $detail_agen->city_name }},
                                            {{ $detail_agen->province_name }}, Indonesia, {{ $detail_agen->kode_pos }}<br>

                                            <div class="form-group" style="margin-top: 10px">
                                                No. Resi
                                                <input type="text" class="form-control @error('no_resi') is-invalid @enderror" id="no_resi" name="no_resi" value="{{ old('no_resi') }}" style="margin-top: 5px">
                                                
                                                @error('no_resi')
                                                    <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </address>
                                    <button type="submit" class="btn btn-md bg-orange float-right"><span class="text-white">Konfirmasi</span></button>
                                </form>
                            </div>
                            @endif
                            <div class="col-sm-1 invoice-col"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.js"
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $('select[name="kurir"]').on('change', function(){
            let origin = $("input[name=kecamatan_asal]").val();
            let destination = $("input[name=kecamatan_tujuan]").val();
            let courier = $("select[name=kurir]").val();
            let weight = $("#subtotal_berat").val();
            //alert(weight);

            if(courier){
                jQuery.ajax({
                    url:"/agen/order/origin="+origin+"&destination="+destination+"&weight="+weight+"&courier="+courier,
                    type:'GET',
                    dataType:'json',
                    success:function(data){
                        console.log(data);

                        $('select[name="layanan"]').empty();
                        $.each(data, function(key, value){
                            $.each(value.costs, function(key1, value1){
                                $.each(value1.cost, function(key2, value2){
                                    $('select[name="layanan"]').append('<option value="'+value1.service+ '-' +value2.value+'">' + value1.service + ' - ' + value1.description + ' - ' +value2.value+ '</option>');
                                })
                            })
                        })
                    },
                });
            }
        });
    });
    </script>
@endsection
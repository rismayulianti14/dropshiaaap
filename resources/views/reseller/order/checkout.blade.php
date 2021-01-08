@section('js')
<script type="text/javascript">
    $('.hapus').on('click', function (event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Hapus data',
            text: 'Anda yakin akan menghapus produk ini dari keranjang?',
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

@extends('reseller.template.app')

@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Checkout</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('reseller.dashboard') }}" style="color: #f89520">Beranda</a></li>
						<li class="breadcrumb-item active">Pesanan baru</li>
					</ol>
				</div>
			</div>
		</div>
    </div>

    <div class="content">
		<div class="container">
            <div class="callout callout-default">
                <h5><i class="fas fa-info"></i> No.Pesanan : <span style="color: #777; font-size: 23px">{{ $no_pesanan }}</span> <span class="float-right">{{ $tanggal }}</span></h5>
                <b>{{ Session::get('nama_lengkap') }}</b><br>
                {{ $detail_reseller->alamat_detail }}, {{ $detail_reseller->subdistrict_name }}, {{ $detail_reseller->city_name }}, {{ $detail_reseller->province_name }}, {{ $detail_reseller->kode_pos }}<br>
                {{ Session::get('email') }} - {{ Session::get('telepon') }}
            </div>

            @if($message = Session::get('success'))
            <div id="global-alert" class="alert alert-success alert-dismissible" style="margin: 15px 15px 15px 15px; opacity: 70%;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Berhasil</h4>
                    <i style="margin-left: 42px;">{{ $message }}</i>
            </div>
            @endif

			<div class="card">
				<div class="card-body">
                @if($detail_reseller->kota == 151 || $detail_reseller->kota == 152 || $detail_reseller->kota == 153 || $detail_reseller->kota == 154 || $detail_reseller->kota == 155 ||
                $detail_reseller->kota == 78 || $detail_reseller->kota == 79 || $detail_reseller->kota == 54 || $detail_reseller->kota == 55 || $detail_reseller->kota == 115 ||
                $detail_reseller->kota == 455 || $detail_reseller->kota == 456 || $detail_reseller->kota == 457)
                <!-- JABODETABEK -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="invoice p-3 mb-3">
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Produk</th>
                                                <th>Harga</th>
                                                <th>Kuantitas</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($cart as $key=>$row)
                                            <form method="post" action="{{ route('reseller.order.update-cart', $row->id_reseller) }}">
                                            @csrf
                                            <tr>
                                                <td>
                                                    <a href="{{ route('reseller.order.destroy-produk', $row->id) }}" class="btn btn-sm btn-danger hapus">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                    <!--<button id="updateQty" data-id="{{ $row->id }}" class="btn btn-sm btn-danger">
                                                        <i class="fa fa-times"></i>
                                                    </button>-->
                                                </td>
                                                <td>{{ $row->produk->nama_produk }}</td>
                                                <td>Rp.{{ number_format( $row->harga, 0 ,'' , '.' ) }}</td>
                                                <td align="center">
                                                    <div class="quantity buttons_added">
                                                        <button id="kurang_qty" class="minus" type="button" onclick="kurangQty('{{ $row->id }}')"> - </button>
                                                        <input type="number" name="kuantitas" id="qty_{{ $row->id }}" maxlength="12" value="{{ $row->qty }}" title="Quantity:" class="input-text qty text" size="5" min="1" disabled>
                                                        <button id="tambah_qty" class="plus" type="button" onclick="tambahQty('{{ $row->id }}')"> + </button>
                                                    </div>
                                                </td>
                                                <td>
                                                    Rp.<span id="subtotal_{{ $row->id }}">{{ number_format( $row->subtotal, 0 ,'' , '.' ) }}</span>
                                                </td>
                                            </tr>
                                            <tr id="peringatanStok_{{ $row->id }}">
                                                
                                            </tr>

                                            <input type="hidden" name="id[]" value="{{ $row->id }}">

                                            <input type="hidden" name="qty[]" id="qty_fix_{{ $row->id }}" value="{{ $row->qty }}">

                                            <input type="hidden" name="harga" id="harga_{{ $row->id }}" value="{{ $row->harga }}">
                                            <input type="hidden" name="subtotal[]" id="subtotal_harga_{{$row->id}}" value="{{ $row->subtotal }}">

                                            <input type="hidden" name="harga_agen" id="harga_agen_{{ $row->id }}" value="{{ $row->subtotal_harga_agen }}">
                                            <input type="hidden" name="subtotal_harga_agen[]" id="subtotal_harga_agen_{{ $row->id }}" value="{{ $row->subtotal_harga_agen }}">

                                            <input type="hidden" name="berat_produk" id="berat_produk_{{ $row->id }}" value="{{ $row->produk->berat }}">
                                            <input type="hidden" name="brt" id="berat_{{$row->id}}" value="{{ $row->berat }}">
                                            <input type="hidden" name="berat[]" id="subtotal_berat_{{ $row->id }}" value="{{ $row->berat }}">

                                            <input type="hidden" id="stok" value="{{ $row->produk->stok }}">
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table" border="0">
                                            <tr>
                                                <td>
                                                    <button type="submit" class="btn btn-sm bg-orange">
                                                        <span class="text-white">
                                                            Perbaharui keranjang
                                                        </span>
                                                    </button>
                                                </form>
                                                </td>
                                                <td width="15%" align="right">
                                                    <span id="total">Rp.{{ number_format( $cart->sum('subtotal'), 0 ,'' , '.' ) }}</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-orange">
                            <div class="card-header">
                                <h3 class="card-title text-white">Catatan</h3>
                            </div>

                            <form method="post" action="{{ route('reseller.order.checkout-pjawa') }}">
                            @csrf
                            <div class="card-body">
                                <input type="hidden" name="no_pesanan" value="{{ $no_pesanan }}">
                                <input type="hidden" name="id_reseller" value="{{ Session::get('id') }}">
                                <input type="hidden" name="id_agen" value="{{ Session::get('id_agen') }}">
                                <input type="hidden" name="kecamatan_asal" value="1471">
                                <input type="hidden" name="kecamatan_tujuan" value="{{ $detail_reseller->kecamatan }}">
                                <input type="hidden" name="berat" id="subtotal_berat" value="{{ $cart->sum('berat') }}">
                                <input type="hidden" name="tgl_pesan" value="{{ $tanggal }}">

                                <div class="form-group">
                                    <textarea class="form-control" name="catatan" id="message" rows="3" placeholder="Tulis catatan untuk pesanan ini..."></textarea>
                                    <span style="color: red; font-size: 12px;">* catatan bersifat opsional</span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn bg-orange" style="width: 100%"><span class="text-white">Checkout</span></button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            @elseif($detail_reseller->provinsi == 9 || $detail_reseller->provinsi == 10 || $detail_reseller->provinsi == 11 || $detail_reseller->provinsi == 5 || $detail_reseller->provinsi == 3)
                <!-- PULAU JAWA -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="invoice p-3 mb-3">
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Produk</th>
                                                <th>Harga</th>
                                                <th>Kuantitas</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($cart as $key=>$row)
                                            <form method="post" action="{{ route('reseller.order.update-cart', $row->id_reseller) }}">
                                            @csrf
                                            <tr>
                                                <td>
                                                    <a href="{{ route('reseller.order.destroy-produk', $row->id) }}" class="btn btn-sm btn-danger hapus">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                    <!--<button id="updateQty" data-id="{{ $row->id }}" class="btn btn-sm btn-danger">
                                                        <i class="fa fa-times"></i>
                                                    </button>-->
                                                </td>
                                                <td>{{ $row->produk->nama_produk }}</td>
                                                <td>Rp.{{ number_format( $row->harga, 0 ,'' , '.' ) }}</td>
                                                <td align="center">
                                                    <div class="quantity buttons_added">
                                                        <button id="kurang_qty" class="minus" type="button" onclick="kurangQty('{{ $row->id }}')"> - </button>
                                                        <input type="number" name="kuantitas" id="qty_{{ $row->id }}" maxlength="12" value="{{ $row->qty }}" title="Quantity:" class="input-text qty text" size="5" min="1" disabled>
                                                        <button id="tambah_qty" class="plus" type="button" onclick="tambahQty('{{ $row->id }}')"> + </button>
                                                    </div>
                                                </td>
                                                <td>
                                                    Rp.<span id="subtotal_{{ $row->id }}">{{ number_format( $row->subtotal, 0 ,'' , '.' ) }}</span>
                                                </td>
                                            </tr>
                                            <tr id="peringatanStok_{{ $row->id }}">
                                                
                                            </tr>

                                            <input type="hidden" name="id[]" value="{{ $row->id }}">

                                            <input type="hidden" name="qty[]" id="qty_fix_{{ $row->id }}" value="{{ $row->qty }}">

                                            <input type="hidden" name="harga" id="harga_{{ $row->id }}" value="{{ $row->harga }}">
                                            <input type="hidden" name="subtotal[]" id="subtotal_harga_{{$row->id}}" value="{{ $row->subtotal }}">

                                            <input type="hidden" name="harga_agen" id="harga_agen_{{ $row->id }}" value="{{ $row->subtotal_harga_agen }}">
                                            <input type="hidden" name="subtotal_harga_agen[]" id="subtotal_harga_agen_{{ $row->id }}" value="{{ $row->subtotal_harga_agen }}">

                                            <input type="hidden" name="berat_produk" id="berat_produk_{{ $row->id }}" value="{{ $row->produk->berat }}">
                                            <input type="hidden" name="brt" id="berat_{{$row->id}}" value="{{ $row->berat }}">
                                            <input type="hidden" name="berat[]" id="subtotal_berat_{{ $row->id }}" value="{{ $row->berat }}">

                                            <input type="hidden" id="stok" value="{{ $row->produk->stok }}">
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table" border="0">
                                            <tr>
                                                <td>
                                                    <button type="submit" class="btn btn-sm bg-orange">
                                                        <span class="text-white">
                                                            Perbaharui keranjang
                                                        </span>
                                                    </button>
                                                </form>
                                                </td>
                                                <td width="15%" align="right">
                                                    <span id="total">Rp.{{ number_format( $cart->sum('subtotal'), 0 ,'' , '.' ) }}</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-orange">
                            <div class="card-header">
                                <h3 class="card-title text-white">Catatan</h3>
                            </div>

                            <form method="post" action="{{ route('reseller.order.checkout-pjawa') }}">
                            @csrf
                            <div class="card-body">
                                <input type="hidden" name="no_pesanan" value="{{ $no_pesanan }}">
                                <input type="hidden" name="id_reseller" value="{{ Session::get('id') }}">
                                <input type="hidden" name="id_agen" value="{{ Session::get('id_agen') }}">
                                <input type="hidden" name="kecamatan_asal" value="1471">
                                <input type="hidden" name="kecamatan_tujuan" value="{{ $detail_reseller->kecamatan }}">
                                <input type="hidden" name="berat" id="subtotal_berat" value="{{ $cart->sum('berat') }}">
                                <input type="hidden" name="tgl_pesan" value="{{ $tanggal }}">

                                <div class="form-group">
                                    <textarea class="form-control" name="catatan" id="message" rows="3" placeholder="Tulis catatan untuk pesanan ini..."></textarea>
                                    <span style="color: red; font-size: 12px;">* catatan bersifat opsional</span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn bg-orange" style="width: 100%"><span class="text-white">Checkout</span></button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <!-- LUAR PULAU JAWA -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="invoice p-3 mb-3">
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Produk</th>
                                                <th>Harga</th>
                                                <th>Kuantitas</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($cart as $key=>$row)
                                            <form method="post" action="{{ route('reseller.order.update-cart', $row->id_reseller) }}">
                                            @csrf
                                            <tr>
                                                <td>
                                                    <a href="{{ route('reseller.order.destroy-produk', $row->id) }}" class="btn btn-sm btn-danger hapus">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                    <!--<button id="updateQty" data-id="{{ $row->id }}" class="btn btn-sm btn-danger">
                                                        <i class="fa fa-times"></i>
                                                    </button>-->
                                                </td>
                                                <td>{{ $row->produk->nama_produk }}</td>
                                                <td>Rp.{{ number_format( $row->harga, 0 ,'' , '.' ) }}</td>
                                                <td align="center">
                                                    <div class="quantity buttons_added">
                                                        <button id="kurang_qty" class="minus" type="button" onclick="kurangQty('{{ $row->id }}')"> - </button>
                                                        <input type="number" name="kuantitas" id="qty_{{ $row->id }}" maxlength="12" value="{{ $row->qty }}" title="Quantity:" class="input-text qty text" size="5" min="1" disabled>
                                                        <button id="tambah_qty" class="plus" type="button" onclick="tambahQty('{{ $row->id }}')"> + </button>
                                                    </div>
                                                </td>
                                                <td>
                                                    Rp.<span id="subtotal_{{ $row->id }}">{{ number_format( $row->subtotal, 0 ,'' , '.' ) }}</span>
                                                </td>
                                            </tr>
                                            <tr id="peringatanStok_{{ $row->id }}">
                                                
                                            </tr>

                                            <input type="hidden" name="id[]" value="{{ $row->id }}">

                                            <input type="hidden" name="qty[]" id="qty_fix_{{ $row->id }}" value="{{ $row->qty }}">

                                            <input type="hidden" name="harga" id="harga_{{ $row->id }}" value="{{ $row->harga }}">
                                            <input type="hidden" name="subtotal[]" id="subtotal_harga_{{$row->id}}" value="{{ $row->subtotal }}">

                                            <input type="hidden" name="harga_agen" id="harga_agen_{{ $row->id }}" value="{{ $row->subtotal_harga_agen }}">
                                            <input type="hidden" name="subtotal_harga_agen[]" id="subtotal_harga_agen_{{ $row->id }}" value="{{ $row->subtotal_harga_agen }}">

                                            <input type="hidden" name="berat_produk" id="berat_produk_{{ $row->id }}" value="{{ $row->produk->berat }}">
                                            <input type="hidden" name="brt" id="berat_{{$row->id}}" value="{{ $row->berat }}">
                                            <input type="hidden" name="berat[]" id="subtotal_berat_{{ $row->id }}" value="{{ $row->berat }}">

                                            <input type="hidden" id="stok" value="{{ $row->produk->stok }}">
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table" border="0">
                                            <tr>
                                                <td>
                                                    <button type="submit" class="btn btn-sm bg-orange">
                                                        <span class="text-white">
                                                        Perbaharui keranjang
                                                        </span>
                                                    </button>
                                                </form>
                                                </td>
                                                <td width="15%" align="right">
                                                    <span id="total">Rp.{{ number_format( $cart->sum('subtotal'), 0 ,'' , '.' ) }}</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-orange">
                            <div class="card-header">
                                <h3 class="card-title text-white">Pilih jasa kirim</h3>
                            </div>

                            <form method="post" action="{{ route('reseller.order.checkout-ljawa') }}">
                            @csrf
                            <div class="card-body">
                                <input type="hidden" name="no_pesanan" value="{{ $no_pesanan }}">
                                <input type="hidden" name="id_reseller" value="{{ Session::get('id') }}">
                                <input type="hidden" name="id_agen" value="{{ Session::get('id_agen') }}">
                                <input type="hidden" name="kecamatan_asal" value="1471">
                                <input type="hidden" name="kecamatan_tujuan" value="{{ $detail_reseller->kecamatan }}">
                                <input type="hidden" name="berat" id="subtotal_berat" value="{{ $cart->sum('berat') }}">
                                <input type="hidden" name="tgl_pesan" value="{{ $tanggal }}">
                                <div class="form-group">
                                    <select class="form-control select2 @error('kurir') is-invalid @enderror" name="kurir" id="kurir" style="width: 100%;">
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
                                    <select class="form-control select2 @error('layanan') is-invalid @enderror" name="layanan" id="layanan" style="width: 100%;">
                                    
                                    </select>

                                    @error('layanan')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <textarea class="form-control" name="catatan" id="message" rows="3" placeholder="Tulis catatan untuk pesanan ini..."></textarea>
                                    <span style="color: red; font-size: 12px;">* catatan bersifat opsional</span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn bg-orange" style="width: 100%"><span class="text-white">Checkout</span></button>
                            </div>
                            </form>
                    </div>
                </div>
            @endif
			    </div>
		    </div>
	    </div>
        <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.js"
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>

    <script>
		function kurangQty(id){
			var qty = parseInt($('#qty_'+id).val(), 10);
            var harga = $('#harga_'+id).val();
            var berat_produk = parseInt($('#berat_produk_'+id).val(), 10);
            var berat = parseInt($('#berat_'+id).val(), 10);
            let stok = $('#stok').val();

            if (qty > 0) { 
                var qtt = qty-1;

                if(qtt <= stok){
                    $('#peringatanStok_'+id).html('');
                }
                var subtotal_harga = harga * qtt;
                var subtotal_berat = qtt * berat_produk;
                //console.log(totall);

                $('#qty_'+id).val(qtt);
                $('#qty_fix_'+id).val(qtt);
                $('#subtotal_harga_'+id).val(subtotal_harga);
                $('#subtotal_'+id).html(subtotal_harga);
                $('#subtotal_berat_'+id).val(subtotal_berat);
            }
        }
        
        function tambahQty(id){
            let qty = parseInt($('#qty_'+id).val(), 10);
            var harga = $('#harga_'+id).val();
            var harga_agen = $('#harga_agen_'+id).val();
            var berat_produk = parseInt($('#berat_produk_'+id).val(), 10);
            var berat = parseInt($('#berat_'+id).val(), 10);
            let stok = $('#stok').val();

            
            var qtt = qty+1;
            if(qtt > stok){
                $('#peringatanStok_'+id).html('<td colspan="5"><span style="color: red; font-size: 12px">produk tidak tersedia</span></td>');
            }else if(qtt <= stok){
                var subtotal_harga = harga * qtt;
                var subtotal_harga_agen = harga_agen * qtt;
                var subtotal_berat = qtt * berat_produk;
                console.log(subtotal_harga_agen);

                $('#qty_'+id).val(qtt);
                $('#qty_fix_'+id).val(qtt);
                $('#subtotal_harga_'+id).val(subtotal_harga);
                $('#subtotal_harga_agen_'+id).val(subtotal_harga_agen);
                $('#subtotal_'+id).html(subtotal_harga);
                $('#subtotal_berat_'+id).val(subtotal_berat);
            }
            
		}
	</script>

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
                    url:"/reseller/order/origin="+origin+"&destination="+destination+"&weight="+weight+"&courier="+courier,
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
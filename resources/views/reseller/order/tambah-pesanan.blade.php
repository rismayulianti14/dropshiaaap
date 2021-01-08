@extends('reseller.template.app')

@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Pesanan baru</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item active"><a href=""><span class="right badge badge-warning" style="font-size: 14px"><span class="right badge badge-info"  style="font-size: 12px">{{ $count_keranjang }}</span> Produk dalam keranjang</span></a></li>
                        <input type="hidden" id="countCart" value="{{ $count_keranjang }}">
					</ol>
				</div>
			</div>
		</div>
    </div>

    <div id="alert">
    
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @foreach($produk as $row)
                <div class="col-md-3" id="sid{{$row->id}}">
                    <div class="card card-primary">
                        <div class="card-body">
                            <center>
                            @if($row->foto_produk->id_produk == $row->id)
                                <a href="{{ asset('uploads/produk/'. $row->foto_produk->image) }}" data-lightbox="photos" >  
                                    <img src="{{ asset('uploads/produk/'. $row->foto_produk->image) }}" alt="" style="width: 200px;height: 220px;margin-bottom: 5px">
                                </a>
                            @endif
                            <hr>
                            </center>
                            <a href="{{ route('agen.order.detail-produk', $row->id) }}" style="color: #000">
                                <h6 style="margin-left: 10px">{{ $row->nama_produk }}</h6>
                            </a>
                            <span style="margin-left: 10px; color: #777; margin-top: -20px">
                                @if($detail_reseller->kota == 151 || $detail_reseller->kota == 152 || $detail_reseller->kota == 153 || $detail_reseller->kota == 154 || $detail_reseller->kota == 155 ||
                                    $detail_reseller->kota == 78 || $detail_reseller->kota == 79 || $detail_reseller->kota == 54 || $detail_reseller->kota == 55 || $detail_reseller->kota == 115 ||
                                    $detail_reseller->kota == 455 || $detail_reseller->kota == 456 || $detail_reseller->kota == 457)

                                    Rp.{{ number_format( $row->jabodetabek->harga_reseller_jabodetabek, 0 ,'' , '.' ) }}
                                    
                                @elseif($detail_reseller->provinsi == 9 || $detail_reseller->provinsi == 10 || $detail_reseller->provinsi == 11 || $detail_reseller->provinsi == 5 || $detail_reseller->provinsi == 3)

                                    Rp.{{ number_format( $row->pulau_jawa->harga_reseller_pjawa, 0 ,'' , '.' ) }}
                                   
                                @else

                                    Rp.{{ number_format( $row->luar_pulau_jawa->harga_reseller_lpjawa, 0 ,'' , '.' ) }}
                                    
                                @endif
                            <input class="icheck-primary float-right" type="checkbox" id="checklist" name="checklist[]" value="{{ $row->id }}">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-body">
                            <a href=""  id="pilihProduk" class="btn btn-md btn-primary" style="width: 100%">Selanjutnya</a>
                        </div>
                    </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(function(e){
        $('#pilihProduk').click(function(e){
            e.preventDefault();
            
            var cart = $('#countCart').val();
            var check = [];
            var checklist = $('input[name="checklist[]"]:checked');
            var len = checklist.length;
            for (var i=0; i<len; i++) {
                check[i] = checklist[i].value;
            }
            //alert(check);
            var element = $(this);

            if(len > 0){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type : "POST",
                    url : "{{ route('reseller.order.add-cart') }}",
                    data : {
                        ids:check
                    },
                    success: function(res){
                        console.log(res);

                        window.location.href = 'http://localhost:8000/reseller/order/cart';
                    }
                });
            }else if(cart > 0){
                window.location.href = 'http://localhost:8000/reseller/order/cart';
            }else{
                window.location.href = 'http://localhost:8000/reseller/order';
            }
        });
    });
</script>
@endsection
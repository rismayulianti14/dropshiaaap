@section('js')
<script type="text/javascript">

      function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#showgambar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image").change(function () {
        readURL(this);
    });

</script>
@stop

@extends('pusat.template.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        Lacak pesanan
                        <sub class="right badge bg-orange" style="font-size: 13px"><span class="text-white">{{ $head_transaksi->no_resi }}</span></sub>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('pusat.dashboard') }}" style="color: #f89520">Beranda</a></li>
                        <li class="breadcrumb-item active">Lacak pesanan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5"> 
                    <div class="card card-orange">
                        <div class="card-header">
                            <h3 class="card-title text-white">Lacak pesanan Anda</h3>
                        </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="kurir">Kurir</label>
                                    <select class="form-control select2 @error('kurir') is-invalid @enderror" name="kurir" id="kurir" style="width: 100%;" disabled>
                                        <option value="{{ $head_transaksi->kurir }}">{{ $head_transaksi->kurir }}</option>
                                    </select>
                                    @error('kurir')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="no_resi">No.Resi</label>
                                    <input type="text" class="form-control @error('no_resi') is-invalid @enderror" id="no_resi" name="no_resi" disabled value="{{ $head_transaksi->no_resi }}">
                                    
                                    @error('no_resi')
                                        <span style="color: red; font-size: 11px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn bg-orange" id="cek" style="width: 100%"><span class="text-white">Lacak</span></button>
                            </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card card-orange">
                        <div class="card-header">
                            <h3 class="card-title text-white">Status pengiriman</h3>
                        </div>
                        <div class="card-body" id="hasil_lacak">
                            
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
        $('#cek').on('click', function(){
            let waybill = $("input[name=no_resi]").val();
            let courier = $("select[name=kurir]").val();
            //alert(courier);

            if(courier){
                jQuery.ajax({
                    url:"/pusat/lacak-pesanan/waybill="+waybill+"&courier="+courier,
                    type:'GET',
                    dataType:'json',
                    success:function(data){
                        console.log(data);

                        $('#hasil_lacak').empty();
                        $.each(data, function(key, value){
                            $('#hasil_lacak').append('<span><b>"'+ value.date +'"</b></span><br> <span>"'+ value.desc +'"</span><br><hr>');
                            
                        });
                    },
                });
            }
        });
    });
</script>
@endsection
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Dropshiaaap - Data lengkap</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
    <link rel="stylesheet" type="image/png" href="{{ asset('style-login/images/icons/favicon.ico') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('style-login/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('style-login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('style-login/fonts/iconic/css/material-design-iconic-font.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('style-login/vendor/animate/animate.css') }}">
<!--===============================================================================================-->	
    <link rel="stylesheet" type="text/css" href="{{ asset('style-login/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('style-login/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('style-login/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->	
    <link rel="stylesheet" type="text/css" href="{{ asset('style-login/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('style-login/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('style-login/css/main.css') }}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">

		@if($message = Session::get('failed'))
			<div id="global-alert" class="alert alert-danger alert-dismissible" style="opacity: 70%; position:absolute;width: 900px;margin: 20px 0 0 230px;">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Gagal</h4>
				<i>{{ $message }}</i>
			</div>
		@endif

		@if($message = Session::get('success'))
			<div id="global-alert" class="alert alert-success alert-dismissible" style="opacity: 70%; position:absolute;width: 900px;margin: 20px 0 0 230px;">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Berhasil</h4>
				<i>{{ $message }}</i>
			</div>
		@endif

		<div class="container-login100" style="background-image: url('/style-login/images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54" style="width: 800px;">
				<form class="login100-form validate-form" method="POST" action="{{ route('reseller.register.store-detail', $reseller->id) }}" enctype="multipart/form-data">
				@csrf
					<span class="login100-form-title p-b-49">
						Data pribadi
                    </span>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="wrap-input100 validate-input m-b-23" data-validate = "Provinsi tidak boleh kosong">
                                <span style="background-color: orange; font-size: 14px; padding: 3px 10px 3px 10px; border-radius: 50%; margin-right: 2px">1</span><span class="label-input100">Provinsi</span>
                                <select class="input100" name="provinsi" id="provinsi" style="border: none;">
                                    <option value="">Pilih provinsi</option>
                                    @foreach($provinsi as $row)
                                    <option value="{{ $row['province_id'] }}">{{ $row['province'] }}</option>
                                    @endforeach
                                </select>
                                <span class="focus-input100" data-symbol="&#xf206;"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="wrap-input100 validate-input m-b-23" data-validate = "Kota/kabupaten tidak boleh kosong" id="kota">
                                <span style="background-color: orange; font-size: 14px; padding: 3px 10px 3px 10px; border-radius: 50%; margin-right: 2px">2</span><span class="label-input100">Kota / Kabupaten</span>
                                <select class="input100" name="kota" id="kota" style="border: none">
                                    <option value="">Pilih Kota/Kabupaten</option>
                                </select>
                                <span class="focus-input100" data-symbol="&#xf206;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="wrap-input100 validate-input m-b-23" data-validate = "Kecamatn tidak boleh kosong">
                                <span style="background-color: orange; font-size: 14px; padding: 3px 10px 3px 10px; border-radius: 50%; margin-right: 2px">3</span><span class="label-input100">Kecamatan</span>
                                <select class="input100" name="kecamatan" id="kecamatan" style="border: none">
                                    <option value="">Pilih kecamatan</option>
                                </select>
                                <span class="focus-input100" data-symbol="&#xf206;"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="wrap-input100 validate-input m-b-23" data-validate = "Alamat detail tidak boleh kosong">
                                <span style="background-color: orange; font-size: 14px; padding: 3px 10px 3px 10px; border-radius: 50%; margin-right: 2px">4</span><span class="label-input100">Alamat detail</span>
                                <input class="input100" type="text" name="alamat_detail" placeholder="Masukkan alamat lengkap lengkap Anda">
                                <span class="focus-input100" data-symbol="&#xf206;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="wrap-input100 validate-input m-b-23" data-validate = "Kode pos tidak boleh kosong">
                                <span style="background-color: orange; font-size: 14px; padding: 3px 10px 3px 10px; border-radius: 50%; margin-right: 2px">5</span><span class="label-input100">Kode pos</span>
                                <input class="input100" type="text" name="kode_pos" placeholder="Masukkan kode pos rumah Anda">
                                <span class="focus-input100" data-symbol="&#xf206;"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="wrap-input100 validate-input m-b-23" data-validate = "Pekerjaan tidak boleh kosong">
                                <span style="background-color: orange; font-size: 14px; padding: 3px 10px 3px 10px; border-radius: 50%; margin-right: 2px">6</span><span class="label-input100">Pekerjaan</span>
                                <input class="input100" type="text" name="pekerjaan" placeholder="Masukkan pekerjaan Anda">
                                <span class="focus-input100" data-symbol="&#xf206;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="wrap-input100 validate-input m-b-23" data-validate = "Tempat lahir tidak boleh kosong">
                                <span style="background-color: orange; font-size: 14px; padding: 3px 10px 3px 10px; border-radius: 50%; margin-right: 2px">7</span><span class="label-input100">Tempat lahir</span>
                                <input class="input100" type="text" name="tempat_lahir" placeholder="Masukkan tempat lahir Anda">
                                <span class="focus-input100" data-symbol="&#xf206;"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="wrap-input100 validate-input m-b-23" data-validate = "Tanggal lahir tidak boleh kosong">
                                <span style="background-color: orange; font-size: 14px; padding: 3px 10px 3px 10px; border-radius: 50%; margin-right: 2px">8</span><span class="label-input100">Tanggal lahir</span>
                                <input class="input100" type="date" name="tanggal_lahir" placeholder="Masukkan tanggal lahir Anda">
                                <span class="focus-input100" data-symbol="&#xf206;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="wrap-input100 validate-input m-b-23" data-validate = "Jenis kelamin tidak boleh kosong">
                                <span style="background-color: orange; font-size: 14px; padding: 3px 10px 3px 10px; border-radius: 50%; margin-right: 2px">9</span><span class="label-input100">Foto</span><br>
                                <input type="hidden" name="hidden_image" value="{{ $reseller->image }}">
                                <input type="file" class="input100" id="image" name="image" value="{{ old('image') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="wrap-input100 validate-input m-b-23" data-validate = "Jenis kelamin tidak boleh kosong">
                                <span style="background-color: orange; font-size: 14px; padding: 3px 8px 3px 8px; border-radius: 50%; margin-right: 2px">10</span><span class="label-input100">Jenis kelamin</span><br>
                                <div class="input50">
                                    <input type="radio" name="jenis_kelamin" value="Laki-laki"> Laki-laki
                                </div>
                                <div class="input50">
                                    <input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan
                                </div>
                            </div>
                        </div>
                    </div>
					
					<div class="text-right p-t-8 p-b-31">
						
					</div>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Daftar
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
    <script src="{{ asset('style-login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('style-login/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('style-login/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('style-login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('style-login/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('style-login/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('style-login/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('style-login/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('style-login/js/main.js') }}"></script>

	<script>
		$(document).ready(function(){
			$("#global-alert").fadeTo(2000, 1000).slideUp(1000, function(){
			$("#global-alert").slideUp(1000);
			});
		});
    </script>
    
    <script src="https://code.jquery.com/jquery-3.4.1.js"
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $('select[name="provinsi"]').on('change', function(){
                let provinceid = $(this).val();
                if(provinceid){
                    jQuery.ajax({
                        url:"/pusat/agen/get-kota/"+provinceid,
                        type:'GET',
                        dataType:'json',
                        success:function(data){
                            console.log(data);

                            $('select[name="kota"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="kota"]').append('<option value="'+ value.city_id +'">' + value.city_name + '</option>');
                            });
                        }
                    });
                }
            });
            
            $('select[name="kota"]').on('change', function(){
                let provinceid = $(this).val();
                if(provinceid){
                    jQuery.ajax({
                        url:"/pusat/agen/get-kecamatan/"+provinceid,
                        type:'GET',
                        dataType:'json',
                        success:function(data){
                            console.log(data);

                            $('select[name="kecamatan"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="kecamatan"]').append('<option value="'+ value.subdistrict_id +'">' + value.subdistrict_name + '</option>');
                                
                            });
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
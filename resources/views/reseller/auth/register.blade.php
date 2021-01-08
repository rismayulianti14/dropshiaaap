<!DOCTYPE html>
<html lang="en">
<head>
	<title>Dropshiaaap - Daftar reseller</title>
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

		<div class="container-login100" style="background-image: url('../style-login/images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" method="POST" action="{{ route('reseller.register.store') }}">
				@csrf
					<span class="login100-form-title p-b-49">
						Daftar reseller
					</span>

                    <input type="hidden" name="kode_id" value="{{ $kode_id }}">

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Nama lengkap tidak boleh kosong">
						<span class="label-input100">Nama lengkap</span>
						<input class="input100" type="text" name="nama_lengkap" placeholder="Masukkan nama lengkap Anda" value="{{ old('nama_lengkap') }}">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

                    <div class="wrap-input100 validate-input m-b-23" data-validate = "Username tidak boleh kosong">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" placeholder="Masukkan username Anda" value="{{ old('username') }}">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

                    <div class="wrap-input100 validate-input m-b-23" data-validate = "Telepon tidak boleh kosong">
						<span class="label-input100">Telepon</span>
						<input class="input100" type="text" name="telepon" placeholder="Masukkan No.Telepon Anda" value="{{ old('telepon') }}">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

                    <div class="wrap-input100 validate-input m-b-23" data-validate = "Email tidak boleh kosong">
						<span class="label-input100">Email</span>
						<input class="input100" type="email" name="email" placeholder="contoh: ex@gmail.com" value="{{ old('email') }}">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Kata sandi tidak boleh kosong">
						<span class="label-input100">Kata sandi</span>
						<input class="input100" type="password" name="password" placeholder="Masukkan kata sandi">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

                    <div class="text-right p-t-8 p-b-31">
						
					</div>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Selanjutnya
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
</body>
</html>
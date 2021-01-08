<!DOCTYPE html>
<html lang="en">
<head>
	<title>Dropshiaaap - Ganti kata sandi</title>
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

		<div class="container-login100" style="background-image: url('../style-login/images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" method="POST" action="{{ route('agen.lupa-sandi.post-ubah-password', ['token'=>$token, 'id'=>$user_id]) }}">
				@csrf
					<span class="login100-form-title p-b-49">
						Ganti kata sandi
					</span>

                    <div class="wrap-input100 validate-input m-b-23" data-validate = "Email tidak boleh kosong">
						<span class="label-input100">Kata sandi baru</span>
						<input class="input100" type="password" name="password" placeholder="Masukkan kata sandi">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

                    <div class="wrap-input100 validate-input m-b-23" data-validate = "Email tidak boleh kosong">
						<span class="label-input100">Konfirmasi kata sandi</span>
						<input class="input100" type="password" name="password" placeholder="Masukkan kata sandi sekali lagi">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Ganti kata sandi
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
</body>
</html>
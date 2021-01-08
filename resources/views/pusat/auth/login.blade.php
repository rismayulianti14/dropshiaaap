<!DOCTYPE html>
<html lang="en">
<head>
	<title>Dropshiaaap</title>
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
			<div id="global-alert" class="alert alert-danger alert-dismissible float-right" style="opacity: 70%; position:absolute; margin: 15px 10px 0 10px; height: 50px">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="fa fa-warning"></i> {{ $message }}
			</div>
		@endif

		@if($message = Session::get('success'))
		<div id="global-alert" class="alert alert-success alert-dismissible float-right" style="opacity: 70%; position:absolute; margin: 15px 10px 0 10px; height: 50px">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="fa fa-check"></i> {{ $message }}
			</div>
		@endif

		<div class="container-login100" style="background-image: url('../style-login/images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" method="POST" action="{{ route('pusat.login.store') }}">
				@csrf
					<span class="login100-form-title p-b-49">
						Login
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Email tidak boleh kosong">
						<span class="label-input100">Email</span>
						<input class="input100" type="email" name="email" placeholder="Masukkan email">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Kata sandi tidak boleh kosong">
						<span class="label-input100">Kata sandi</span>
						<input class="input100" type="password" name="password" placeholder="Masukkan kata sandi">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					
					<div class="text-right p-t-8 p-b-31">
						<a href="{{ route('pusat.lupa-sandi') }}">
							Lupa kata sandi ?
						</a>
					</div>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Login
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
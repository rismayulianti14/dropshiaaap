<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Dropshiaaap</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('style-admin/plugins/fontawesome-free/css/all.min.css') }}">

	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

	<!-- Tempusdominus Bootstrap 4 -->
	<link rel="stylesheet" href="{{ asset('style-admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

	<!-- iCheck -->
	<link rel="stylesheet" href="{{ asset('style-admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

	<!-- JQVMap -->
	<link rel="stylesheet" href="{{ asset('style-admin/plugins/jqvmap/jqvmap.min.css') }}">

	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('style-admin/dist/css/adminlte.min.css') }}">

	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="{{ asset('style-admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
	
	<!-- Daterange picker -->
	<link rel="stylesheet" href="{{ asset('style-admin/plugins/daterangepicker/daterangepicker.css') }}">

	<!-- summernote -->
	<link rel="stylesheet" href="{{ asset('style-admin/plugins/summernote/summernote-bs4.min.css') }}">

	<!-- datatables -->
	<link rel="stylesheet" href="{{ asset('style-admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('style-admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('style-admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

	<!-- Lightbox -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">

	<!-- Sweetalert -->
	<link rel="stylesheet" href="{{ asset('style-admin/plugins/sweetalert2/sweetalert2.min.css') }}"></link>

	<!-- Select2 -->
	<link rel="stylesheet" href="{{ asset('style-admin/plugins/select2/css/select2.min.css') }}">

	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

	<style>
		.pagination .page-item.active .page-link { background-color: #f89520; border: 1px solid #ddd }

		div.dataTables_wrapper div.dataTables_paginate ul.pagination .page-item.active .page-link:focus {
			background-color: #f89520;
		}

		.pagination .page-item.active .page-link:hover {
			background-color: #f89520;
		}
	</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

		@include('pusat.template.header')

		@include('pusat.template.sidebar')

		@yield('content')

		@include('pusat.template.footer')

		<aside class="control-sidebar control-sidebar-dark">

		</aside>
	</div>

	<script src="{{ asset('style-admin/plugins/jquery/jquery.min.js') }}"></script>

	<!-- jQuery UI 1.11.4 -->
	<script src="{{ asset('style-admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
	$.widget.bridge('uibutton', $.ui.button)
	</script>

	<!-- Bootstrap 4 -->
	<script src="{{ asset('style-admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

	<!-- ChartJS -->
	<script src="{{ asset('style-admin/plugins/chart.js/Chart.min.js') }}"></script>
	
	<!-- Sparkline -->
	<script src="{{ asset('style-admin/plugins/sparklines/sparkline.js') }}"></script>

	<!-- JQVMap -->
	<script src="{{ asset('style-admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>

	<script src="{{ asset('style-admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>

	<!-- jQuery Knob Chart -->
	<script src="{{ asset('style-admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
	
	<!-- daterangepicker -->
	<script src="{{ asset('style-admin/plugins/moment/moment.min.js') }}"></script>
	<script src="{{ asset('style-admin/plugins/daterangepicker/daterangepicker.js') }}"></script>

	<!-- Tempusdominus Bootstrap 4 -->
	<script src="{{ asset('style-admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

	<!-- Summernote -->
	<script src="{{ asset('style-admin/plugins/summernote/summernote-bs4.min.js') }}"></script>

	<!-- overlayScrollbars -->
	<script src="{{ asset('style-admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

	<!-- AdminLTE App -->
	<script src="{{ asset('style-admin/dist/js/adminlte.js') }}"></script>

	<!-- AdminLTE for demo purposes -->
	<script src="{{ asset('style-admin/dist/js/demo.js') }}"></script>

	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="{{ asset('style-admin/dist/js/pages/dashboard.js') }}"></script>

	<!-- Datatables -->
	<script src="{{ asset('style-admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('style-admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('style-admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('style-admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('style-admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('style-admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

	<!-- Lightbox -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-lightbox/0.7.0/bootstrap-lightbox.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>  

	<!-- Sweetalert -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<!-- Select2 -->
	<script src="{{ asset('style-admin/plugins/select2/js/select2.full.min.js') }}"></script>

	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

	@section('js')
	
	@show

	<script>
		$(function () {
			$('#table').DataTable({
				"paging": true,
				"lengthChange": true,
				"searching": true,
				"ordering": true,
				"info": true,
				"autoWidth": false,
				"responsive": true,
			});
		});
	</script>

	<script>
		$(document).ready(function(){
			$("#global-alert").fadeTo(2000, 1000).slideUp(1000, function(){
			$("#global-alert").slideUp(1000);
			});
		});
	</script>

	<script>
		$(function () {
			// Summernote
			$('#summernote').summernote()
		})
	</script>

	<script type="text/javascript">
		$(document).ready(function() {
			$(".add").click(function(){ 
				var html = $(".clone").html();
				$(".increment").after(html);
			});
			$("body").on("click",".remove",function(){ 
				$(this).parents(".control-group").remove();
			});
		});
	</script>

	<!-- UBAH STATUS PETUGAS -->
	<script>
		$('.toggle-class').change(function() {
			var status = $(this).prop('checked') == true ? 1 : 0; 
			var user_id = $(this).data('id'); 
			
			$.ajax({
				type: "GET",
				dataType: "json",
				url: '{{ route('pusat.petugas.ubah-status') }}',
				data: {'status': status, 'user_id': user_id},
				success: function(data){
				console.log(data.success)
				}
			});
		});
	</script>

	<!-- UBAH STATUS AGEN -->
	<script>
		$('.toggle-class').change(function() {
			var status = $(this).prop('checked') == true ? 1 : 0; 
			var user_id = $(this).data('id'); 
			
			$.ajax({
				type: "GET",
				dataType: "json",
				url: '{{ route('pusat.agen.ubah-status') }}',
				data: {'status': status, 'user_id': user_id},
				success: function(data){
				console.log(data.success)
				}
			});
		});
	</script>

	<!-- UPDATE PROFIL PUSAT-->
	<script>
		$('body').on('click', '#editPusat', function (event) {

			event.preventDefault();
			var id = $(this).data('id');
			console.log(id)

			$('#nama_lengkap').html('');
			$('#telepon').html('');

			$.get('/pusat/profil/' + id + '/get', function (data) {
				console.log(data);
				$.each(data, function(key, val){
					console.log(val);
					$('#nama_lengkap').html('<input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama baru" value="'+ val.nama_lengkap +'">');
					$('#username').html('<input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username baru" value="'+ val.username +'">');
					$('#posisi').html('<input type="text" class="form-control" id="posisi" name="posisi" placeholder="Masukkan posisi baru" value="'+val.posisi+'">');
					$('#telepon').html('<input type="text" class="form-control" id="telepon" name="telepon" placeholder="Masukkan No.Telepon baru" value="'+val.telepon+'">');
					$('#button').html('<button type="submit" id="submitPusat" class="btn bg-orange" style="width: 100%"><span class="text-white">Simpan</span></button> ');
					$('#btn_edit').html('<button class="btn btn-md btn-default float-right" id="closePusat" data-id="{{ Session::get('id') }}"><i class="fa fa-times"></i></button>')
				});
			});
		});

		$('body').on('click', '#closePusat', function (event) {
			event.preventDefault();
			var id = $(this).data('id');
			console.log(id)

			$('#btn_edit').html('<button class="btn btn-md btn-default float-right" id="edit" data-id="{{ Session::get('id') }}">Edit</button>')
			$("#nama_lengkap").html('<p> {{ Session::get('nama_lengkap') }} </p>');
			$("#username").html('<p> {{ Session::get('username') }} </p>');
			$("#posisi").html('<p> {{ Session::get('posisi') }} </p>');
			$("#email").html('<p> {{ Session::get('email') }} </p>');
			$("#telepon").html('<p> {{ Session::get('telepon') }} </p>');
			$('#button').html('');

		});

		$('body').on('click', '#submitPusat', function (event) {
			event.preventDefault();

			var form = $('#update');
			var url = $('#update').attr('action');
			var formData = $('#update').serializeArray();

			console.log(formData);
			$.ajax({
				type : 'post',
				url  : url,
				data : formData,
				success : function(data) {
					console.log(data);

					$('#alert').html('<div id="global-alert" class="alert alert-success alert-dismissible" style="margin: 15px 15px 15px 15px; opacity: 70%;"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="icon fa fa-check"></i> Berhasil</h4> <i style="margin-left: 42px;">Profil berhasil di ubah</i> </div>');
					$("#nama_lengkap").html('<p> {{ Session::get('nama_lengkap') }} </p>');
					$("#username").html('<p> {{ Session::get('username') }} </p>');
					$("#posisi").html('<p> {{ Session::get('posisi') }} </p>');
					$("#telepon").html('<p> {{ Session::get('telepon') }} </p>');
					$('#btn_edit').html('<button class="btn btn-md btn-default float-right" id="edit" data-id="{{ Session::get('id') }}">Edit</button>')
					$('#button').html('');
				}
			});
		});
  	</script>

	<script>
		jQuery(document).ready(function($) {
			$(".clickable-row").click(function() {
				window.location = $(this).data("href");
			});
		});
	</script>

	<script>
		function pilih(id_agen){
			var id_agen = $('#id_'+id_agen).val();
			var id_reseller = $('#id_reseller').val();
			console.log(id_reseller);

			$('#nama_agen_'+id_agen).css({'color':'black'}); 
			$('#alamat_agen_'+id_agen).css({'color':'black'}); 
			$('#terpilih_'+id_agen).append('');
			$('#pilih_'+id_agen).html('');
			
			$.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type : "POST",
                url : '/pusat/reseller/konfirmasi-akun/' + id_reseller + '/store',
                data : {
                    id_agen : id_agen,
					id_reseller : id_reseller
                },
                success: function(res){
                    console.log(res);

					$('#nama_agen_'+id_agen).css({'color':'green'}); 
					$('#alamat_agen_'+id_agen).css({'color':'green'}); 
					$('#terpilih_'+id_agen).append('<i class="fa fa-check"></i> Terpilih');
					$('#pilih_'+id_agen).html('');
                }
            });
        }
	</script>
</body>
</html>

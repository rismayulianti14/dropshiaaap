<html>
<head>
    <title></title>

    <link rel="stylesheet" href="{{ asset('style-admin/dist/css/adminlte.min.css') }}">
</head>
<body>
    <center>
        <h3>Halo,</h3>
        Kami menerima permintaan perubahan kata sandi<br>
        pada akun Anda.<br>
        <i style="font-size: 12px;">Tekan tombol dibawah untuk<br>mengubah kata sandi Anda</i><br><br>
        <a href="{{ route('agen.lupa-sandi.verifikasi-ubah-password', $token) }}" class="btn btn-info">Ubah kata sandi</a>
    </center>
</body>
</html>
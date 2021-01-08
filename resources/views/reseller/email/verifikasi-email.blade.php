<html>
<head>
    <title></title>

    <link rel="stylesheet" href="{{ asset('style-admin/dist/css/adminlte.min.css') }}">
</head>
<body>
    <center>
        <h3>Halo,</h3>
        <b>Selamat datang di Dropshiaaap</b><br><br>
        Anda sudah berhasil terdaftar sebagai Reseller Ashiaaap.<br>
        Sekarang, Anda perlu verifikasi Email ini terlebih<br>
        dahulu untuk mendapatkan akses.<br>
        <i style="font-size: 12px;">Tekan tombol dibawah untuk verifikasi Email</i><br><br>
        <a href="{{ route('agen.reseller.verifikasi-email', $token) }}" class="btn btn-info">Verifikasi Email</a>
    </center>
</body>
</html>
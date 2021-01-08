<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('style-admin/dist/css/adminlte.min.css') }}">
</head>
<body>
    <center>
        <img src="{{ asset('/style-admin/dist/img/logo1.png') }}" alt="" width="150px"><br>
        <p  style="font-size: 13px">Halo {{ $nama_lengkap }},</p>
        <p style="font-size: 13px">Agar pesanan <b>{{ $no_pesanan }}</b> segera Kami proses,<br>
        dimohon segera lakukan pembayaran sebesar :<br>
        <b>Rp.{{ number_format( $total, 0 ,'' , '.' ) }}</b></p>
        <a href="{{ route('agen.order.bayar', $no_pesanan) }}" class="btn btn-info">Bayar sekarang</a>
    </center>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
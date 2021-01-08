<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
</head>
<body>
    <center>
    <div style="width: 300px; border: 1px solid #ddd; padding: 20px 20px 40px 20px;">
        <h4 style=" font-family: sans-serif">Penarikan profit</h4>
        <p style=" font-family: sans-serif; font-size: 14px;">Haloo {{ $name }},<br>
        Profit yang Anda dapatkan dari transaksi Reseller sebesar <b>Rp.{{ number_format( $profit, 0 ,'' , '.' ) }}</b> sudah kami transfer, silahkan cek saldo rekening Anda.<br><br>
        Jika ada kekeliruan atau ada yang ingin ditanyakan silahkan hubungi admin melalui whatsapp<br> <b>+62 812-1116-8886</b></p>
    </div>
    </center>
</body>
</html>
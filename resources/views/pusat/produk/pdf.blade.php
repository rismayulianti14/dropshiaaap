<!DOCTYPE html>
<html>
<head>

</head>
<body>
    <table border="0">
        <tr>
            <td width="150px"><img src="./style-admin/dist/img/logo1.png" alt="" style="height:120px;"></td>
            <td>
                <table>
                    <tr>
                        <td align="center"><b style="font-size: 20px">PT.Ashiaaap Berkah Manfaat</b></td>
                    </tr>
                    <tr>
                        <td align="center" style="font-size: 15px">Jl.Kamarung RT.02/05, Kelurahan Citeurup, Kecamatan Cimahi Utara, Kota Cimahi, Jawa Barat, Indonesia, 40512</td>
                    </tr>
                    <tr>
                        <td align="center"><i style="font-size: 13px">Email : ashiaaap2018@gmail.com ; Ig : ashiaaapid ; Telp : (+62) 889-2715-313</i></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <center>
    <hr>
    <h3>Laporan data produk</h3>
    </center>

    <div style="page-break-after:always;">

    <table border="1" width="100%" style="border-collapse:collapse;">
        <tr style="background-color: #ddd;">
            <th width="5%" style="padding: 10px 0 10px 0">No.</th>
            <th>Produk</th>
        </tr>
        @foreach($produk as $key=>$row)
        <tr>
            <td align="center" valign="top">{{ $key+1 }}</td>
            <td>
                <table width="100%" border="0">
                    <tr>
                        <td width="270px" align="center" valign="top" style="padding-top: 20px">
                            <img src="" alt="" style="width: 250px">
                        </td>
                        <td style="padding: 10px">
                            <b>Nama produk :</b><br>
                            <span style="margin-bottom: 20px">{{ $row->nama_produk }}</span><br><br>

                            <b>Berat (gram) :</b><br>
                            <span>{{ $row->berat }}</span><br><br>

                            <b  style="width: 300px; word-break:break-all; word-wrap:break-word;">Deskripsi :</b><br>
                            <span style="text-align: left;">{!! $row->deskripsi !!}</span><br>
                        </td>
                        </td>
                    </tr>
                </table>

                <table width="100%" border="1" style="padding: 20px; border-collapse: collapse; margin-top: -30px">
                    <tr style="padding: 3px;background-color: #ddd">
                        <td></td>
                        <td align="center"><b>Jabodetabek</b></td>
                        <td align="center"><b>Pulau Jawa</b></td>
                        <td align="center"><b>Luar Pulau Jawa</b></td>
                    </tr>
                    <tr style="padding: 3px">
                        <td style="padding-left: 10px">Harga Agen</td>
                        <td align="center"><span>Rp.{{ number_format( $row->jabodetabek->harga_agen_jabodetabek, 0 ,'' , '.' ) }}</span></td>
                        <td align="center"><span>Rp.{{ number_format( $row->pulau_jawa->harga_agen_pjawa, 0 ,'' , '.' ) }}</span></td>
                        <td align="center"><span>Rp.{{ number_format( $row->luar_pulau_jawa->harga_agen_lpjawa, 0 ,'' , '.' ) }}</span></td>
                    </tr>
                    <tr style="padding: 3px">
                        <td style="padding-left: 10px">Harga Reseller</td>
                        <td align="center"><span>Rp.{{ number_format( $row->jabodetabek->harga_reseller_jabodetabek, 0 ,'' , '.' ) }}</span></td>
                        <td align="center"><span>Rp.{{ number_format( $row->pulau_jawa->harga_reseller_pjawa, 0 ,'' , '.' ) }}</span></td>
                        <td align="center"><span>Rp.{{ number_format( $row->luar_pulau_jawa->harga_reseller_lpjawa, 0 ,'' , '.' ) }}</span></td>
                    </tr>
                </table>
            </td>
        </tr>
        @endforeach
    </table>

    <br><br>

    <p style="text-align: right;">
        Cimahi, ..... ..... .....<br>
        CEO PT.Ashiaaap Berkah Manfaat<br>
        <br>
        <br>
        <br>
        <u>Lina Nur Afifah</u>
    </p>
</body>
</html>
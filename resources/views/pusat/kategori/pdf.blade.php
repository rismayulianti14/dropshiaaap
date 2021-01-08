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
    <h3>Laporan data kategori</h3>
    </center>
    <table border="1" width="100%" style="border-collapse:collapse;">
        <tr style="background-color: #ddd;">
            <th width="8%" style="padding: 10px 0 10px 0">No.</th>
            <th>Kategori</th>
            <th>Icon</th>
        </tr>
        @foreach($kategori as $key=>$row)
        <tr>
            <td align="center">{{ $key+1 }}</td>
            <td style="padding-left: 10px;">{{ $row->kategori }}</td>
            <td style="padding-left: 10px;">
                <img src="{{ public_path('./uploads/icon kategori/').$row->image }}" alt="" style="width: 60px;height: 60px; margin:5px 0 5px 0">
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
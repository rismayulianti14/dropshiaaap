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
    <h3>Laporan data petugas</h3>
    </center>
    <table border="1" width="100%" style="border-collapse:collapse">
        <tr style="background-color: #ddd;">
            <th width="5%" style="padding: 10px 0 10px 0">No.</th>
            <th width="8%">Foto</th>
            <th width="22%">Nama lengkap</th>
            <th width="27%">Email</th>
            <th width="18%">No.Telepon</th>
            <th width="10%">Posisi</th>
            <th width="15%">Status</th>
        </tr>
        @foreach($data as $key=>$row)
        <tr>
            <td align="center">{{ $key+1 }}</td>
            <td align="center" style="padding: 5px;">
                <img src="{{ public_path('./uploads/petugas/').$row->image }}" alt="" style="width: 60px;">
            </td>
            <td style="padding: 0 5px 0 5px;">{{ $row->nama_lengkap }}</td>
            <td style="font-size: 14px; padding: 0 5px 0 5px;">{{ $row->email }}</td>
            <td align="center">{{ $row->telepon }}</td>
            <td align="center">{{ $row->posisi }}</td>
            <td align="center">
                @if($row->status == 0)
                    Tidak aktif
                @else 
                    Aktif
                @endif
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
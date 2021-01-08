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
    <h3>Laporan data reseller</h3>
    </center>
    <table border="1" width="100%" style="border-collapse:collapse">
        <tr style="background-color: #ddd;">
            <th width="5%" style="padding: 10px 0 10px 0">No.</th>
            <th>Data reseller aktif</th>
        </tr>
        @foreach($data as $key=>$row)
        <tr>
            <td align="center">{{ $key+1 }}</td>
            <td style="padding: 10px">
                <table border="0" width="100%">
                    <tr>
                        <td width="25%" valign="top">
                                ID<br>
                                Nama lengkap<br>
                                Tanggal lahir<br>
                                Jenis kelamin<br>
                                Pekerjaan<br>
                                No.Telepon<br>
                                Email<br>
                                Alamat
                        </td>
                        <td width="2%" valign="top">
                            :<br>
                            :<br>
                            :<br>
                            :<br>
                            :<br>
                            :<br>
                            :<br>
                            :<br>
                        </td>
                        <td valign="top">
                            <b>{{ $row->kode_id }}</b><br>
                            {{ $row->nama_lengkap }}<br>
                            {{ $row->tempat_lahir }}, {{ $row->tanggal_lahir }}<br>
                            {{ $row->jenis_kelamin }}<br>
                            {{ $row->pekerjaan }}<br>
                            {{ $row->telepon }}<br>
                            {{ $row->email }}<br>
                            {{ $row->alamat_detail }}, {{ $row->subdistrict_name }}, {{ $row->city_name }}, {{ $row->province_name }}, Indonesia, {{ $row->kode_pos }}<br>
                        </td>
                        <td width="25%" valign="middle" align="center">
                            <img src="{{ public_path('./uploads/reseller/').$row->image }}" alt="" style="width: 100px;height: 120px; margin:5px 0 5px 0"><br>
                            @if($row->status == 1)
                            <span style="font-size: 13px; color: green">( Aktif )</span>
                            @endif
                        </td>
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
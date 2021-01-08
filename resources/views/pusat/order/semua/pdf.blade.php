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
    <h3>Laporan pesanan</h3>
    </center>
    <table border="1" width="100%" style="border-collapse: collapse">
        <thead>
            <tr>
                <th width="5%" align="center" height="40px">#</th>
                <th>Pesanan</th>
            </tr>
        </thead> 
        <tbody>
            @foreach($head_transaksi as $key=>$row)
            <tr>
                <td align="center">{{ $key+1 }}</td>
                <td>
                    <table border="0" width="100%" style="border-collapse: collapse; padding: 0 10px 0 10px">
                        <tr>
                            <td colspan="4" height="35px">
                                @if($row->id_reseller != null)
                                    <b><span style="color: #000">{{ !empty($row->agen) ? $row->reseller->nama_lengkap:'' }}</span><span style="font-size: 12px; color: #777"> ( Reseller )</span></b>
                                @else
                                    <b><span style="color: #000">{{ !empty($row->agen) ? $row->agen->nama_lengkap:'' }}</span><span style="font-size: 12px; color: #777"> ( Agen )</span></b>
                                @endif
                            </td>
                            <td align="right">
                                @if($row->id_reseller != null)
                                    <b><span class="float-right" style="color: #000">#{{ $row->no_pesanan }}</span></b>
                                @else
                                    <b><span class="float-right" style="color: #000">#{{ $row->no_pesanan }}</span></b>
                                @endif
                            </td>
                        </tr>
                    </table>
                    <table border="1" width="100%" style="border-collapse: collapse; padding: 0 10px 10px 10px">
                    <tr>
                            <td width="40%" style="color: #777; font-size: 14px; padding: 3px">Produk</td>
                            <td width="15%" style="color: #777; font-size: 14px" align="center">Subtotal</td>
                            <td width="15%" style="color: #777; font-size: 14px" align="center">Jasa kirim</td>
                            <td width="15%" style="color: #777; font-size: 14px" align="center">Ongkir</td>
                            <td width="15%" style="color: #777; font-size: 14px" align="center">Total bayar</td>
                            <td width="15%" style="color: #777; font-size: 14px" align="center">Status</td>
                        </tr>
                        <tr>
                            <td style="font-size: 14px; padding: 3px;">
                                @foreach($detail_transaksi as $det)
                                    @if($det->id_head == $row->id)
                                    - {{ isset($det->produk->nama_produk) ? $det->produk->nama_produk : ''  }} <span style="font-size: 13px; color: #777">( x {{ $det->qty }} )</span><br>
                                    @endif
                                @endforeach
                            </td>
                            <td style="font-size: 14px; padding: 3px;" align="center">
                                @foreach($detail_transaksi as $det)
                                    @if($det->id_head == $row->id)
                                    - Rp.{{ number_format( $det->subtotal, 0 ,'' , '.' ) }}<br>
                                    @endif
                                @endforeach
                            </td>
                            <td width="18%" style="vertical-align: middle; text-align: center;  font-size: 14px">
                                <b style="text-transform: uppercase;">{{ $row->kurir }}</b> - {{ $row->layanan }}<br>
                                @if($row->no_resi != null)
                                <span style="font-size: 12px; margin-top: 10px; color: #777">( {{ $row->no_resi }} )</span>
                                @endif
                            </td>
                            <td style="font-size: 14px; padding: 3px;" align="center">
                                Rp.{{ number_format( $row->ongkir, 0 ,'' , '.' ) }}<br>
                            </td>
                            <td width="15%" style="vertical-align: middle; text-align: center;  font-size: 14px">
                                <b>Rp.{{ number_format( $row->grand_total, 0 ,'' , '.' ) }}</b>
                            </td>
                            <td width="15%" style="vertical-align: middle; text-align: center;  font-size: 13px; color: #777">
                                {{ $row->status }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            @endforeach
        </tbody>                           
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
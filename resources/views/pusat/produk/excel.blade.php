<table border="1">
    <thead>
        <tr>
            <th rowspan="2" width="40px">No</th>
            <th rowspan="2" width="250px">Nama produk</th>
            <th rowspan="2" width="500px">Deskripsi</th>
            <th rowspan="2" width="80px">Berat (gram)</th>
            <th rowspan="2" width="80px">Stok</th>
            <th rowspan="2" width="120px">Kategori</th>
            <th colspan="2">Jabodetabek</th>
            <th colspan="2">Pulau Jawa</th>
            <th colspan="2">Luar Pulau Jawa</th>
        </tr>
        <tr>
            <th width="150px">Harga Agen</th>
            <th width="150px">Harga Reseller</th>
            <th width="150px">Harga Agen</th>
            <th width="150px">Harga Reseller</th>
            <th width="150px">Harga Agen</th>
            <th width="150px">Harga Reseller</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produk as $key=>$row)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $row->nama_produk }}</td>
            <td></td>
            <td>{{ $row->berat }}</td>
            <td>{{ $row->stok }}</td>
            <td>{{ $row->kategori->kategori }}</td>
            <td>{{ $row->jabodetabek->harga_agen_jabodetabek }}</td>
            <td>{{ $row->jabodetabek->harga_reseller_jabodetabek }}</td>
            <td>{{ $row->pulau_jawa->harga_agen_pjawa }}</td>
            <td>{{ $row->pulau_jawa->harga_reseller_pjawa }}</td>
            <td>{{ $row->luar_pulau_jawa->harga_agen_lpjawa }}</td>
            <td>{{ $row->luar_pulau_jawa->harga_reseller_lpjawa }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
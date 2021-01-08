<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pusat.email.notif-profit');
});

/* ================================= PUSAT =================================*/

/* --- LOGIN ---*/
Route::group(['prefix' => 'pusat/login'], function(){
    Route::get('/', 'App\Http\Controllers\Pusat\Auth\LoginController@index')->name('pusat.login');
    Route::post('/store', 'App\Http\Controllers\Pusat\Auth\LoginController@store')->name('pusat.login.store');
});

/* --- LUPA KATA SANDI ---*/
Route::group(['prefix' => 'pusat/forgot-password'], function(){
    Route::get('/', 'App\Http\Controllers\Pusat\Auth\ForgotPasswordController@index')->name('pusat.lupa-sandi');
    Route::post('/store', 'App\Http\Controllers\Pusat\Auth\ForgotPasswordController@store')->name('pusat.lupa-sandi.store');
});

/* --- EMAIL UBAH KATA SANDI ---*/
Route::group(['prefix' => 'pusat/lupa-kata-sandi'], function(){
    Route::get('verifikasi'."/".'{token}', 'App\Http\Controllers\Pusat\Auth\ForgotPasswordController@verifikasi_ubah_password')->name('pusat.lupa-sandi.verifikasi-ubah-password');
    Route::post('ubah/{token}/{id}', 'App\Http\Controllers\Pusat\Auth\ForgotPasswordController@post_ubah_password')->name('pusat.lupa-sandi.post-ubah-password');
});

/* --- LOGOUT ---*/
Route::post('/pusat/logout', 'App\Http\Controllers\Pusat\Auth\LoginController@logout')->name('pusat.logout');

/* --- DASHBOARD ---*/
Route::get('/pusat/dashboard', 'App\Http\Controllers\Pusat\AppController@dashboard')->name('pusat.dashboard');

/* --- PROFIL ---*/
Route::group(['prefix' => 'pusat/profil'], function(){
    Route::get('/', 'App\Http\Controllers\Pusat\AppController@profil')->name('pusat.profil');
    Route::post('/store/{id}', 'App\Http\Controllers\Pusat\AppController@ubah_foto')->name('pusat.profil.ubah-foto');
    Route::get('/{id}/get', 'App\Http\Controllers\Pusat\AppController@get_profil')->name('pusat.profil.get-profil');
    Route::post('/update', 'App\Http\Controllers\Pusat\AppController@ubah_profil')->name('pusat.profil.ubah-profil');
});

/* --- KATEGORI ---*/
Route::group(['prefix' => 'pusat/kategori'], function(){
    Route::get('/', 'App\Http\Controllers\Pusat\KategoriController@index')->name('pusat.kategori.index');
    Route::get('/tambah-data', 'App\Http\Controllers\Pusat\KategoriController@create')->name('pusat.kategori.create');
    Route::post('/tambah-data/store', 'App\Http\Controllers\Pusat\KategoriController@store')->name('pusat.kategori.store');
    Route::get('/ubah-data/{id}', 'App\Http\Controllers\Pusat\KategoriController@edit')->name('pusat.kategori.edit');
    Route::post('/ubah-data/{id}/store', 'App\Http\Controllers\Pusat\KategoriController@update')->name('pusat.kategori.update');
    Route::get('/hapus-data/{id}', 'App\Http\Controllers\Pusat\KategoriController@destroy')->name('pusat.kategori.hapus');
    Route::get('/export-excel', 'App\Http\Controllers\Pusat\KategoriController@export_excel')->name('pusat.kategori.export-excel');
    Route::get('/export-pdf', 'App\Http\Controllers\Pusat\KategoriController@export_pdf')->name('pusat.kategori.export-pdf');
});

/* --- PRODUK ---*/
Route::group(['prefix' => 'pusat/produk'], function(){
    Route::get('/', 'App\Http\Controllers\Pusat\ProdukController@index')->name('pusat.produk.index');
    Route::get('/tambah-data', 'App\Http\Controllers\Pusat\ProdukController@create')->name('pusat.produk.create');
    Route::post('/tambah-data/store', 'App\Http\Controllers\Pusat\ProdukController@store')->name('pusat.produk.store');
    Route::get('/ubah-data/{id}', 'App\Http\Controllers\Pusat\ProdukController@edit')->name('pusat.produk.edit');
    Route::post('/ubah-data/{id}/store', 'App\Http\Controllers\Pusat\ProdukController@update')->name('pusat.produk.update');
    Route::get('/hapus-data/{id}', 'App\Http\Controllers\Pusat\ProdukController@destroy')->name('pusat.produk.hapus');
    Route::get('/detail-produk/{id}/get', 'App\Http\Controllers\Pusat\ProdukController@detail_produk')->name('pusat.produk.detail-produk');

    Route::get('/cek-stok/{id}/get', 'App\Http\Controllers\Pusat\ProdukController@cek_stok')->name('pusat.produk.cek-stok');
    Route::post('/update-stok/store', 'App\Http\Controllers\Pusat\ProdukController@store_update_stok')->name('pusat.produk.update-stok');

    Route::get('/export-excel', 'App\Http\Controllers\Pusat\ProdukController@export_excel')->name('pusat.produk.export-excel');
    Route::get('/export-pdf', 'App\Http\Controllers\Pusat\ProdukController@export_pdf')->name('pusat.produk.export-pdf');
});

/* --- JABODETABEK ---*/
Route::group(['prefix' => 'pusat'], function(){
    Route::get('/list-harga-jabodetabek', 'App\Http\Controllers\Pusat\JabodetabekController@index')->name('pusat.jabodetabek.index');
});

/* --- PULAU JAWA ---*/
Route::group(['prefix' => 'pusat'], function(){
    Route::get('/list-harga-pulau-jawa', 'App\Http\Controllers\Pusat\PulauJawaController@index')->name('pusat.pulau-jawa.index');
});

/* --- LUAR PULAU JAWA ---*/
Route::group(['prefix' => 'pusat'], function(){
    Route::get('/list-harga-luar-jawa', 'App\Http\Controllers\Pusat\LuarPulauJawaController@index')->name('pusat.luar-jawa.index');
});

/* --- PETUGAS ---*/
Route::group(['prefix' => 'pusat/petugas'], function(){
    Route::get('/', 'App\Http\Controllers\Pusat\PetugasController@index')->name('pusat.petugas.index');
    Route::get('/tambah-data', 'App\Http\Controllers\Pusat\PetugasController@create')->name('pusat.petugas.create');
    Route::post('/tambah-data/store', 'App\Http\Controllers\Pusat\PetugasController@store')->name('pusat.petugas.store');
    Route::get('/ubah-data/{id}', 'App\Http\Controllers\Pusat\PetugasController@edit')->name('pusat.petugas.edit');
    Route::post('/ubah-data/{id}/store', 'App\Http\Controllers\Pusat\PetugasController@update')->name('pusat.petugas.update');
    Route::get('/hapus-data/{id}', 'App\Http\Controllers\Pusat\PetugasController@destroy')->name('pusat.petugas.hapus');
    Route::get('/ubah-status', 'App\Http\Controllers\Pusat\PetugasController@ubah_status')->name('pusat.petugas.ubah-status');
    Route::get('/export-excel', 'App\Http\Controllers\Pusat\PetugasController@export_excel')->name('pusat.petugas.export-excel');
    Route::get('/export-pdf', 'App\Http\Controllers\Pusat\PetugasController@export_pdf')->name('pusat.petugas.export-pdf');
});

/* --- VERIFIKASI EMAIL PETUGAS ---*/
Route::group(['prefix' => 'pusat/petugas'], function(){
    Route::get('verifikasi-email'."/".'{token}', 'App\Http\Controllers\Pusat\EmailController@email_verify')->name('pusat.email.verifikasi-email');
});

/* --- AGEN ---*/
Route::group(['prefix' => 'pusat/agen'], function(){
    Route::get('/', 'App\Http\Controllers\Pusat\AgenController@index')->name('pusat.agen.index');
    Route::get('/tambah-data', 'App\Http\Controllers\Pusat\AgenController@create')->name('pusat.agen.create');
    Route::post('/tambah-data/store', 'App\Http\Controllers\Pusat\AgenController@store')->name('pusat.agen.store');
    Route::get('/ubah-data/{id}', 'App\Http\Controllers\Pusat\AgenController@edit')->name('pusat.agen.edit');
    Route::post('/ubah-data/{id}/store', 'App\Http\Controllers\Pusat\AgenController@update')->name('pusat.agen.update');
    Route::get('/hapus-data/{id}', 'App\Http\Controllers\Pusat\AgenController@destroy')->name('pusat.agen.hapus');
    Route::get('/ubah-status', 'App\Http\Controllers\Pusat\AgenController@updateStatus')->name('pusat.agen.ubah-status');
    Route::get('/export-excel', 'App\Http\Controllers\Pusat\AgenController@exportExcel')->name('pusat.agen.export-excel');
    Route::get('/export-pdf', 'App\Http\Controllers\Pusat\AgenController@exportPdf')->name('pusat.agen.export-pdf');
    Route::get('/rekap-penjualan/{id}', 'App\Http\Controllers\Pusat\AgenController@rekapTransaksi')->name('pusat.agen.rekap-penjualan');
    Route::get('/rekap-penjualan/{id}/export-pdf', 'App\Http\Controllers\Pusat\AgenController@exportPdfRekapTransaksi')->name('pusat.agen.pdf-rekap-penjualan');
    //Route::get('/rekap-penjualan/{id}/transfer-profit', 'App\Http\Controllers\Pusat\AgenController@transferProfit')->name('pusat.agen.transfer-profit');
    Route::get('/rekap-penjualan/{id}/transfer-profit-store', 'App\Http\Controllers\Pusat\AgenController@storeTransferProfit')->name('pusat.agen.store-transfer-profit');
    Route::get('/detail-agen/{id}/get', 'App\Http\Controllers\Pusat\AgenController@show')->name('pusat.agen.detail-agen');
    
    Route::get('/get-kota/{id}', 'App\Http\Controllers\Pusat\AgenController@getCity')->name('pusat.agen.get-kota');
    Route::get('/get-kecamatan/{id}', 'App\Http\Controllers\Pusat\AgenController@getSubdistrict')->name('pusat.agen.get-kecamatan');
});

/* --- VERIFIKASI EMAIL AGEN ---*/
Route::group(['prefix' => 'pusat/agen'], function(){
    Route::get('verifikasi-email'."/".'{token}', 'App\Http\Controllers\Pusat\AgenController@emailVerify')->name('pusat.agen.verifikasi-email');
});

/* --- RESELLER ---*/
Route::group(['prefix' => 'pusat/reseller'], function(){
    /*SEMUA RESELLER */
    Route::get('/', 'App\Http\Controllers\Pusat\Reseller\SemuaResellerController@index')->name('pusat.reseller.semua');
    Route::get('/detail-reseller/{id}/get', 'App\Http\Controllers\Pusat\Reseller\SemuaResellerController@show')->name('pusat.reseller.detail');
    
    Route::get('/perlu-dikonfirmasi', 'App\Http\Controllers\Pusat\Reseller\KonfirmasiResellerController@index')->name('pusat.reseller.belum-dikonfirmasi');
    Route::get('/konfirmasi-akun- {id}', 'App\Http\Controllers\Pusat\Reseller\KonfirmasiResellerController@confirmationAccount')->name('pusat.reseller.konfirmasi');
    Route::post('/konfirmasi-akun/{id_reseller}/store', 'App\Http\Controllers\Pusat\Reseller\KonfirmasiResellerController@storeConfirmation')->name('pusat.reseller.konfirmasi-store');

    Route::get('/reseller-aktif', 'App\Http\Controllers\Pusat\Reseller\ResellerAktifController@index')->name('pusat.reseller.aktif');
    Route::get('/reseller-aktif/export-pdf', 'App\Http\Controllers\Pusat\Reseller\ResellerAktifController@exportPdf')->name('pusat.reseller-aktif.export-pdf');
    Route::get('/reseller-aktif/export-excel', 'App\Http\Controllers\Pusat\Reseller\ResellerAktifController@exportExcel')->name('pusat.reseller-aktif.export-excel');
    Route::get('/rekap-transaksi/{id}', 'App\Http\Controllers\Pusat\Reseller\ResellerAktifController@rekapTransaksi')->name('pusat.reseller.rekap-transaksi');
    Route::get('/rekap-transaksi/{id}/export-pdf', 'App\Http\Controllers\Pusat\Reseller\ResellerAktifController@exportPdfRekapTransaksi')->name('pusat.reseller.pdf-rekap-transaksi');
    
});

/* --- ORDER ---*/
Route::group(['prefix' => 'pusat'], function(){
    /* Semua pesanan */
    Route::get('/semua-pesanan', 'App\Http\Controllers\Pusat\Transaksi\SemuaPesananController@index')->name('pusat.order.semua-pesanan');
    Route::get('/semua-pesanan/detail- {no_pesanan}', 'App\Http\Controllers\Pusat\Transaksi\SemuaPesananController@detail')->name('pusat.order.semua-pesanan.detail');
    Route::get('/semua-pesanan/export-pdf', 'App\Http\Controllers\Pusat\Transaksi\SemuaPesananController@exportPdf')->name('pusat.order.semua-pesanan.pdf');
    Route::get('/semua-pesanan/export-excel', 'App\Http\Controllers\Pusat\Transaksi\SemuaPesananController@exportExcel')->name('pusat.order.semua-pesanan.excel');

    /* belum bayar */
    Route::get('/pesanan-belum-bayar', 'App\Http\Controllers\Pusat\Transaksi\BelumBayarController@index')->name('pusat.order.belum-bayar');
    Route::get('/pesanan-belum-bayar/detail- {no_pesanan}', 'App\Http\Controllers\Pusat\Transaksi\BelumBayarController@detail')->name('pusat.order.belum-bayar.detail');
    Route::get('/pesanan-belum-bayar/kirim-email- {no_pesanan}', 'App\Http\Controllers\Pusat\Transaksi\BelumBayarController@sendEmail')->name('pusat.order.kirim-email');
    Route::get('/pesanan-belum-bayar/export-pdf', 'App\Http\Controllers\Pusat\Transaksi\BelumBayarController@exportPdf')->name('pusat.order.belum-bayar-pdf');
    
    /* perlu dikirim */
    Route::get('/pesanan-perlu-dikirim', 'App\Http\Controllers\Pusat\Transaksi\PerluDikirimController@index')->name('pusat.order.perlu-dikirim');
    Route::get('/pesanan-perlu-dikirim/detail- {no_pesanan}', 'App\Http\Controllers\Pusat\Transaksi\PerluDikirimController@detail')->name('pusat.order.perlu-dikirim.detail');
    Route::get('/pesanan-perlu-dikirim/atur-pengiriman- {no_pesanan}', 'App\Http\Controllers\Pusat\Transaksi\PerluDikirimController@aturPengiriman')->name('pusat.order.atur-pengiriman');
    Route::post('/pesanan-perlu-dikirim/atur-pengiriman- {no_pesanan}/store', 'App\Http\Controllers\Pusat\Transaksi\PerluDikirimController@storeAturPengiriman')->name('pusat.order.store-atur-pengiriman');
    Route::get('/pesanan-perlu-dikirim/export-pdf', 'App\Http\Controllers\Pusat\Transaksi\PerluDikirimController@exportPdf')->name('pusat.order.perlu-dikirim-pdf');

    /* Dikirim */
    Route::get('/sedang-dikirim', 'App\Http\Controllers\Pusat\Transaksi\DikirimController@index')->name('pusat.order.dikirim');
    Route::get('/pesanan-dikirim/detail- {no_pesanan}', 'App\Http\Controllers\Pusat\Transaksi\DikirimController@detail')->name('pusat.order.dikirim.detail');
    Route::get('/pesanan-dikirim/tracking- {no_pesanan}', 'App\Http\Controllers\Pusat\Transaksi\DikirimController@tracking')->name('pusat.order.tracking');
    Route::get('/pesanan-dikirim/export-pdf', 'App\Http\Controllers\Pusat\Transaksi\DikirimController@exportPdf')->name('pusat.order.dikirim-pdf');

    /* Selesai */
    Route::get('/pesanan-selesai', 'App\Http\Controllers\Pusat\Transaksi\SelesaiController@index')->name('pusat.order.selesai');
    Route::get('/pesanan-selesai/detail- {no_pesanan}', 'App\Http\Controllers\Pusat\Transaksi\SelesaiController@detail')->name('pusat.order.selesai.detail');
    Route::get('/pesanan-selesai/export-pdf', 'App\Http\Controllers\Pusat\Transaksi\SelesaiController@exportPdf')->name('pusat.order.selesai.pdf');
});

/* --- TRACKING ---*/
Route::group(['prefix' => 'pusat/lacak-pesanan'], function(){
    Route::get('/', 'App\Http\Controllers\Pusat\TrackingController@index')->name('pusat.tracking');
    Route::get('/waybill={city_origin}&courier={courier}','App\Http\Controllers\Pusat\TrackingController@lacak_paket');
});


/* ================================= AGEN =================================*/
/* --- LOGIN ---*/
Route::group(['prefix' => 'agen/login'], function(){
    Route::get('/', 'App\Http\Controllers\Agen\Auth\LoginController@index')->name('agen.login');
    Route::post('/store', 'App\Http\Controllers\Agen\Auth\LoginController@store')->name('agen.login.store');
});

/* --- LUPA KATA SANDI ---*/
Route::group(['prefix' => 'agen/forgot-password'], function(){
    Route::get('/', 'App\Http\Controllers\Agen\Auth\ForgotPasswordController@index')->name('agen.lupa-sandi');
    Route::post('/store', 'App\Http\Controllers\Agen\Auth\ForgotPasswordController@store')->name('agen.lupa-sandi.store');
});

/* --- EMAIL UBAH KATA SANDI ---*/
Route::group(['prefix' => 'agen/forgot-password'], function(){
    Route::get('verifikasi'."/".'{token}', 'App\Http\Controllers\Agen\Auth\ForgotPasswordController@verifikasi_ubah_password')->name('agen.lupa-sandi.verifikasi-ubah-password');
    Route::post('ubah/{token}/{id}', 'App\Http\Controllers\Agen\Auth\ForgotPasswordController@post_ubah_password')->name('agen.lupa-sandi.post-ubah-password');
});

/* --- LOGOUT ---*/
Route::post('/agen/logout', 'App\Http\Controllers\Agen\Auth\LoginController@logout')->name('agen.logout');

/* --- PROFIL ---*/
Route::group(['prefix' => 'agen/profil'], function(){
    /* Profile */
    Route::get('/', 'App\Http\Controllers\Agen\AppController@profil')->name('agen.profil');

    /* Update profile */
    Route::post('/store/{id}', 'App\Http\Controllers\Agen\AppController@ubah_foto')->name('agen.profil.ubah-foto');
    Route::get('/{id}/get', 'App\Http\Controllers\Agen\AppController@get_profil')->name('agen.profil.get-profil');
    Route::post('/update', 'App\Http\Controllers\Agen\AppController@ubah_profil')->name('agen.profil.ubah-profil');
});

/* --- DASHBOARD ---*/
Route::get('/agen/dashboard', 'App\Http\Controllers\Agen\AppController@dashboard')->name('agen.dashboard');

/* --- RESELLER ---*/
Route::group(['prefix' => 'agen/reseller'], function(){
    /* Read */
    Route::get('/', 'App\Http\Controllers\Agen\ResellerController@index')->name('agen.reseller.index');
    
    /* Create */
    Route::get('/tambah-data', 'App\Http\Controllers\Agen\ResellerController@create')->name('agen.reseller.create');
    Route::get('/get-kota/{id}', 'App\Http\Controllers\Agen\ResellerController@get_kota')->name('agen.reseller.get-kota');
    Route::post('/tambah-data/store', 'App\Http\Controllers\Agen\ResellerController@store')->name('agen.reseller.store');

    /* Update */
    Route::get('/ubah-data/{id}', 'App\Http\Controllers\Agen\ResellerController@edit')->name('agen.reseller.edit');
    Route::post('/ubah-data/{id}/store', 'App\Http\Controllers\Agen\ResellerController@update')->name('agen.reseller.update');

    /* Delete */
    Route::get('/hapus-data/{id}', 'App\Http\Controllers\Agen\ResellerController@destroy')->name('agen.reseller.hapus');

    /* Update status */
    Route::get('/ubah-status', 'App\Http\Controllers\Agen\ResellerController@ubah_status')->name('agen.reseller.ubah-status');
    
    /* Export */
    Route::get('/export-excel', 'App\Http\Controllers\Agen\ResellerController@export_excel')->name('agen.reseller.export-excel');
    Route::get('/export-pdf', 'App\Http\Controllers\Agen\ResellerController@export_pdf')->name('agen.reseller.export-pdf');
    
    /* About agen */
    Route::get('/rekap-transaksi/{id}', 'App\Http\Controllers\Agen\ResellerController@rekapTransaksi')->name('agen.reseller.rekap-transaksi');
    Route::get('/rekap-transaksi/{id}/export-pdf', 'App\Http\Controllers\Agen\ResellerController@exportPdfRekapTransaksi')->name('agen.reseller.pdf-rekap-transaksi');
    Route::get('/detail/{id}/get', 'App\Http\Controllers\Agen\ResellerController@show')->name('agen.reseller.detail-agen');
});

/* --- VERIFIKASI EMAIL RESELLER ---*/
Route::group(['prefix' => 'agen/reseller'], function(){
    Route::get('verifikasi-email'."/".'{token}', 'App\Http\Controllers\Agen\ResellerController@email_verify')->name('agen.reseller.verifikasi-email');
});

/* --- TRACKING ---*/
Route::group(['prefix' => 'agen/lacak-pesanan'], function(){
    Route::get('/', 'App\Http\Controllers\Agen\TrackingController@index')->name('agen.tracking');
    Route::get('/waybill={city_origin}&courier={courier}','App\Http\Controllers\Agen\TrackingController@lacak_paket');
});

/* --- ORDER ---*/
Route::group(['prefix' => 'agen/order'], function(){
    /* Product */
    Route::get('/', 'App\Http\Controllers\Agen\OrderController@product')->name('agen.order.index');
    Route::get('/detail-produk/get {id}', 'App\Http\Controllers\Agen\OrderController@detailProduct')->name('agen.order.detail-produk');

    /* Add cart */
    Route::post('/add-cart/store', 'App\Http\Controllers\Agen\OrderController@addCart')->name('agen.order.add-cart');

    /* Cart & cekongkir */
    Route::get('/cart', 'App\Http\Controllers\Agen\OrderController@cart')->name('agen.order.cart');
    Route::get('/origin={city_origin}&destination={city_destination}&weight={weight}&courier={courier}','App\Http\Controllers\Agen\OrderController@getOngkir');

    /* Manage cart */
    Route::post('/perbaharui- {id_agen} store', 'App\Http\Controllers\Agen\OrderController@updateCart')->name('agen.order.update-cart');
    Route::get('/hapus-produk- {id} hapus', 'App\Http\Controllers\Agen\OrderController@destroyProduct')->name('agen.order.destroy-produk');

    /* Checkout */
    Route::post('/checkout-luar-jawa', 'App\Http\Controllers\Agen\OrderController@checkoutLJawa')->name('agen.order.checkout-ljawa');
    Route::post('/checkout-pulau-jawa', 'App\Http\Controllers\Agen\OrderController@checkoutPJawa')->name('agen.order.checkout-pjawa');
    Route::get('/invoice -{no_pesanan}', 'App\Http\Controllers\Agen\OrderController@invoice')->name('agen.order.invoice');
    Route::get('/pembayaran -{no_pesanan}', 'App\Http\Controllers\Agen\OrderController@payment')->name('agen.order.bayar');
    Route::get('/konfirmasi-pembayaran -{no_pesanan}', 'App\Http\Controllers\Agen\OrderController@confirmationPaymet')->name('agen.order.konfirmasi-pembayaran');
    Route::post('/konfirmasi-pembayaran -{no_pesanan} store', 'App\Http\Controllers\Agen\OrderController@storeConfirmationPayment')->name('agen.order.store-konfirmasi-pembayaran');
    Route::get('/konfirmasi-pembayaran/berhasil', 'App\Http\Controllers\Agen\OrderController@successConfirmation')->name('agen.order.berhasil-konfirmasi');
});

/* --- RIWAYAT PESANAN ---*/
Route::group(['prefix' => 'agen'], function(){
    /* Semua pesanan */ 
    Route::get('/semua-pesanan', 'App\Http\Controllers\Agen\RiwayatPembelian\SemuaPesananController@index')->name('agen.riwayat.semua-pesanan');
    Route::get('/semua-pesanan/detail- {no_pesanan}', 'App\Http\Controllers\Agen\RiwayatPembelian\SemuaPesananController@detail')->name('agen.riwayat.semua-pesanan.detail');
    
    /* belum bayar */
    Route::get('/pesanan-belum-bayar', 'App\Http\Controllers\Agen\RiwayatPembelian\BelumBayarController@index')->name('agen.riwayat.belum-bayar');
    Route::get('/pesanan-belum-bayar/detail- {no_pesanan}', 'App\Http\Controllers\Agen\RiwayatPembelian\SemuaPesananController@detail')->name('agen.riwayat.belum-bayar.detail');
    
    /* Dikemas */
    Route::get('/pesanan-dikemas', 'App\Http\Controllers\Agen\RiwayatPembelian\DikemasController@index')->name('agen.riwayat.dikemas');
    Route::get('/pesanan-dikemas/detail- {no_pesanan}', 'App\Http\Controllers\Agen\RiwayatPembelian\SemuaPesananController@detail')->name('agen.riwayat.dikemas.detail');
    //Route::get('/pesanan-perlu-dikirim/atur-pengiriman- {no_pesanan}', 'App\Http\Controllers\Pusat\Transaksi\PerluDikirimController@aturPengiriman')->name('pusat.order.atur-pengiriman');
    //Route::post('/pesanan-perlu-dikirim/atur-pengiriman- {no_pesanan}/store', 'App\Http\Controllers\Pusat\Transaksi\PerluDikirimController@storeAturPengiriman')->name('pusat.order.store-atur-pengiriman');

    /* Dikirim */
    Route::get('/sedang-dikirim', 'App\Http\Controllers\Agen\RiwayatPembelian\DikirimController@index')->name('agen.riwayat.dikirim');
    Route::get('/pesanan-dikirim/detail- {no_pesanan}', 'App\Http\Controllers\Agen\RiwayatPembelian\SemuaPesananController@detail')->name('agen.riwayat.dikirim.detail');
    Route::get('/pesanan-dikirim/tracking- {no_pesanan}', 'App\Http\Controllers\Agen\RiwayatPembelian\DikirimController@tracking')->name('agen.riwayat.dikirim.tracking');
    Route::post('/sedang-dikirim- {no_pesanan}/diterima', 'App\Http\Controllers\Agen\RiwayatPembelian\DikirimController@OrdersAccepted')->name('agen.riwayat.dikirim.diterima');

    /* Selesai */
    Route::get('/pesanan-diterima', 'App\Http\Controllers\Agen\RiwayatPembelian\DiterimaController@index')->name('agen.riwayat.diterima');
    Route::get('/pesanan-diterima/detail- {no_pesanan}', 'App\Http\Controllers\Agen\RiwayatPembelian\SemuaPesananController@detail')->name('agen.riwayat.diterima.detail');
});

/* ================================= RESELLER =================================*/
/* --- REGISTER ---*/
Route::group(['prefix' => 'reseller/registrasi'], function(){
    Route::get('/', 'App\Http\Controllers\Reseller\Auth\RegistController@register')->name('reseller.register');
    Route::post('/store', 'App\Http\Controllers\Reseller\Auth\RegistController@store')->name('reseller.register.store');

    Route::get('/{id}/detail', 'App\Http\Controllers\Reseller\Auth\RegistController@register_detail')->name('reseller.register-detail');
    Route::post('/{id}/store-detail', 'App\Http\Controllers\Reseller\Auth\RegistController@store_detail')->name('reseller.register.store-detail');

    Route::get('/{id}/berhasil', 'App\Http\Controllers\Reseller\Auth\RegistController@berhasil')->name('reseller.register.berhasil');
});

/* --- LOGIN ---*/
Route::group(['prefix' => 'reseller/login'], function(){
    Route::get('/', 'App\Http\Controllers\Reseller\Auth\LoginController@index')->name('reseller.login');
    Route::post('/store', 'App\Http\Controllers\Reseller\Auth\LoginController@store')->name('reseller.login.store');
});

/* --- LOGOUT ---*/
Route::post('/reseller/logout', 'App\Http\Controllers\Reseller\Auth\LoginController@logout')->name('reseller.logout');

/* --- PROFIL ---*/
Route::group(['prefix' => 'reseller/profil'], function(){
    Route::get('/', 'App\Http\Controllers\Reseller\AppController@profil')->name('reseller.profil');
    Route::post('/store/{id}', 'App\Http\Controllers\Reseller\AppController@ubah_foto')->name('reseller.profil.ubah-foto');
    Route::get('/{id}/get', 'App\Http\Controllers\Reseller\AppController@get_profil')->name('reseller.profil.get-profil');
    Route::post('/update', 'App\Http\Controllers\Reseller\AppController@ubah_profil')->name('reseller.profil.ubah-profil');
});

/* --- LUPA KATA SANDI ---*/
Route::group(['prefix' => 'reseller/lupa kata sandi'], function(){
    Route::get('/', 'App\Http\Controllers\Reseller\Auth\ForgotPasswordController@index')->name('reseller.lupa-sandi');
    Route::post('/store', 'App\Http\Controllers\Reseller\Auth\ForgotPasswordController@store')->name('reseller.lupa-sandi.store');
});

/* --- EMAIL UBAH KATA SANDI ---*/
Route::group(['prefix' => 'reseller/lupa-kata-sandi'], function(){
    Route::get('verifikasi'."/".'{token}', 'App\Http\Controllers\Reseller\Auth\ForgotPasswordController@verifikasi_ubah_password')->name('reseller.lupa-sandi.verifikasi-ubah-password');
    Route::post('ubah/{token}/{id}', 'App\Http\Controllers\Reseller\Auth\ForgotPasswordController@post_ubah_password')->name('reseller.lupa-sandi.post-ubah-password');
});

/* --- DASHBOARD ---*/
Route::get('/reseller/dashboard', 'App\Http\Controllers\Reseller\AppController@dashboard')->name('reseller.dashboard');

/* --- ORDER ---*/
Route::group(['prefix' => 'reseller/order'], function(){
    /* Product */
    Route::get('/', 'App\Http\Controllers\Reseller\OrderController@product')->name('reseller.order.index');
    Route::get('/detail-produk/get {id}', 'App\Http\Controllers\Reseller\OrderController@detailProduct')->name('reseller.order.detail-produk');

    /* Add cart */
    Route::post('/add-cart/store', 'App\Http\Controllers\Reseller\OrderController@addCart')->name('reseller.order.add-cart');

    /* Cart & cekongkir */
    Route::get('/cart', 'App\Http\Controllers\Reseller\OrderController@cart')->name('reseller.order.cart');
    Route::get('/origin={city_origin}&destination={city_destination}&weight={weight}&courier={courier}','App\Http\Controllers\Reseller\OrderController@getOngkir');

    /* Manage cart */
    Route::post('/perbaharui- {id_reseller} store', 'App\Http\Controllers\Reseller\OrderController@updateCart')->name('reseller.order.update-cart');
    Route::get('/hapus-produk- {id} hapus', 'App\Http\Controllers\Reseller\OrderController@destroyProduct')->name('reseller.order.destroy-produk');

    /* Checkout */
    Route::post('/checkout-luar-jawa', 'App\Http\Controllers\Reseller\OrderController@checkoutLJawa')->name('reseller.order.checkout-ljawa');
    Route::post('/checkout-pulau-jawa', 'App\Http\Controllers\Reseller\OrderController@checkoutPJawa')->name('reseller.order.checkout-pjawa');
    Route::get('/invoice -{no_pesanan}', 'App\Http\Controllers\Reseller\OrderController@invoice')->name('reseller.order.invoice');
    Route::get('/pembayaran -{no_pesanan}', 'App\Http\Controllers\Reseller\OrderController@payment')->name('reseller.order.bayar');
    Route::get('/konfirmasi-pembayaran -{no_pesanan}', 'App\Http\Controllers\Reseller\OrderController@confirmationPaymet')->name('reseller.order.konfirmasi-pembayaran');
    Route::post('/konfirmasi-pembayaran -{no_pesanan} store', 'App\Http\Controllers\Reseller\OrderController@storeConfirmationPayment')->name('reseller.order.store-konfirmasi-pembayaran');
    Route::get('/konfirmasi-pembayaran/berhasil', 'App\Http\Controllers\Reseller\OrderController@successConfirmation')->name('reseller.order.berhasil-konfirmasi');
});

/* --- RIWAYAT PESANAN ---*/
Route::group(['prefix' => 'reseller'], function(){
    /* Semua pesanan */
    Route::get('/semua-pesanan', 'App\Http\Controllers\Reseller\RiwayatPembelian\SemuaPesananController@index')->name('reseller.riwayat.semua-pesanan');
    Route::get('/semua-pesanan/detail- {no_pesanan}', 'App\Http\Controllers\Reseller\RiwayatPembelian\SemuaPesananController@detail')->name('reseller.order.semua-pesanan.detail');
    
    /* belum bayar */
    Route::get('/pesanan-belum-bayar', 'App\Http\Controllers\Reseller\RiwayatPembelian\BelumBayarController@index')->name('reseller.riwayat.belum-bayar');
    Route::get('/pesanan-belum-bayar/detail- {no_pesanan}', 'App\Http\Controllers\Reseller\RiwayatPembelian\SemuaPesananController@detail')->name('reseller.riwayat.belum-bayar.detail');
    
    /* Dikemas */
    Route::get('/pesanan-dikemas', 'App\Http\Controllers\Reseller\RiwayatPembelian\DikemasController@index')->name('reseller.riwayat.dikemas');
    Route::get('/pesanan-dikemas/detail- {no_pesanan}', 'App\Http\Controllers\Reseller\RiwayatPembelian\SemuaPesananController@detail')->name('reseller.riwayat.dikemas.detail');
    //Route::get('/pesanan-perlu-dikirim/atur-pengiriman- {no_pesanan}', 'App\Http\Controllers\Pusat\Transaksi\PerluDikirimController@aturPengiriman')->name('pusat.order.atur-pengiriman');
    //Route::post('/pesanan-perlu-dikirim/atur-pengiriman- {no_pesanan}/store', 'App\Http\Controllers\Pusat\Transaksi\PerluDikirimController@storeAturPengiriman')->name('pusat.order.store-atur-pengiriman');

    /* Dikirim */
    Route::get('/sedang-dikirim', 'App\Http\Controllers\Reseller\RiwayatPembelian\DikirimController@index')->name('reseller.riwayat.dikirim');
    Route::get('/sedang-dikirim/detail- {no_pesanan}', 'App\Http\Controllers\Reseller\RiwayatPembelian\SemuaPesananController@detail')->name('reseller.riwayat.dikirim.detail');
    Route::get('/sedang-dikirim/tracking- {no_pesanan}', 'App\Http\Controllers\Reseller\RiwayatPembelian\DikirimController@tracking')->name('reseller.riwayat.dikirim.tracking');
    Route::get('/waybill={waybill}&courier={courier}','App\Http\Controllers\Reseller\RiwayatPembelian\DikirimController@trackOrders');
    Route::post('/sedang-dikirim- {no_pesanan}/diterima', 'App\Http\Controllers\Reseller\RiwayatPembelian\DikirimController@OrdersAccepted')->name('reseller.riwayat.dikirim.diterima');

    /* Selesai */
    Route::get('/pesanan-diterima', 'App\Http\Controllers\Reseller\RiwayatPembelian\DiterimaController@index')->name('reseller.riwayat.diterima');
    Route::get('/pesanan-diterima/detail- {no_pesanan}', 'App\Http\Controllers\Reseller\RiwayatPembelian\SemuaPesananController@detail')->name('reseller.riwayat.diterima.detail');
});

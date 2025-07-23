<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PembelianDetailController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenjualanDetailController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('level')->group(function () {
        Route::get('kategori/data', [KategoriController::class, 'data'])->name('kategori.data');
        Route::resource('kategori', KategoriController::class);

        Route::get('produk/data', [ProdukController::class, 'data'])->name('produk.data');
        Route::resource('produk', ProdukController::class);
        Route::post('produk/delete-selected', [ProdukController::class, 'deleteSelected'])->name('produk.delete-selected');
        Route::post('produk/cetak-barcode', [ProdukController::class, 'cetakBarcode'])->name('produk.cetak');

        Route::get('member/data', [MemberController::class, 'data'])->name('member.data');
        Route::resource('member', MemberController::class);
        Route::post('member/cetak-kartu', [MemberController::class, 'cetakKartu'])->name('member.cetak-kartu');

        Route::get('supplier/data', [SupplierController::class, 'data'])->name('supplier.data');
        Route::resource('supplier', SupplierController::class);

        Route::get('pengeluaran/data', [PengeluaranController::class, 'data'])->name('pengeluaran.data');
        Route::resource('pengeluaran', PengeluaranController::class);

        Route::get('pembelian/data', [PembelianController::class, 'data'])->name('pembelian.data');
        Route::get('pembelian/{id}/create', [PembelianController::class, 'create'])->name('pembelian.create');
        Route::resource('pembelian', PembelianController::class)->except('create');

        Route::get('pembelian_detail/{id}/data', [PembelianDetailController::class, 'data'])->name('pembelian_detail.data');
        Route::get('pembelian_detail/loadform/{diskon}/{total}', [PembelianDetailController::class, 'loadForm'])->name('pembelian_detail.loadForm');
        Route::resource('pembelian_detail', PembelianDetailController::class)->except('create', 'show', 'edit');

        Route::get('penjualan/data', [PenjualanController::class, 'data'])->name('penjualan.data');
        Route::get('penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
        Route::get('penjualan/{id}', [PenjualanController::class, 'show'])->name('penjualan.show');
        Route::delete('penjualan/{id}/delete', [PenjualanController::class, 'destroy'])->name('penjualan.delete');

        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('laporan/data/{awal}/{akhir}', [LaporanController::class, 'data'])->name('laporan.data');
        Route::get('laporan/cetak/{awal}/{akhir}', [LaporanController::class, 'cetak'])->name('laporan.cetak');

        Route::get('user/data', [UserController::class, 'data'])->name('user.data');
        Route::resource('user', UserController::class);

        Route::get('pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
        Route::get('pengaturan/show', [PengaturanController::class, 'show'])->name('pengaturan.show');
        Route::post('pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');
    });

    Route::get('transaksi/baru', [PenjualanController::class, 'create'])->name('transaksi.baru');
    Route::post('transaksi/simpan', [PenjualanController::class, 'store'])->name('transaksi.simpan');
    Route::get('print', [PenjualanController::class, 'print'])->name('transaksi.print');
    Route::get('print/nota-kecil', [PenjualanController::class, 'notaKecil'])->name('transaksi.notaKecil');
    Route::get('print/nota-besar', [PenjualanController::class, 'notaBesar'])->name('transaksi.notaBesar');

    Route::get('transaksi/{id}/data', [PenjualanDetailController::class, 'data'])->name('transaksi.data');
    Route::get('transaksi/loadform/{diskon}/{total}/{cash}', [PenjualanDetailController::class, 'loadForm'])->name('transaksi.loadForm');
    Route::resource('/transaksi', PenjualanDetailController::class)->except('show');

    Route::get('profil', [UserController::class, 'profil'])->name('user.profil');
    Route::post('profil', [UserController::class, 'updateProfil'])->name('user.updateProfil');
});

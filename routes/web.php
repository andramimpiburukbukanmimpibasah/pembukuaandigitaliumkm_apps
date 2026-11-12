<?php

use App\Http\Controllers\CashController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UmkmProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('products', ProductController::class)->only(['index', 'show']);

    // Kas & transaksi: pegawai boleh melihat dan menambah
    Route::get('/kas', [CashController::class, 'index'])->name('cashes.index');
    Route::post('/kas', [CashController::class, 'store'])->name('cashes.store');

    Route::get('/transaksi', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transaksi', [TransactionController::class, 'store'])->name('transactions.store');

    // Aksi khusus admin (kelola pegawai, edit/hapus produk, kas, transaksi, profil usaha)
    Route::middleware(['admin'])->group(function () {
        Route::get('/profil-usaha', [UmkmProfileController::class, 'index'])->name('umkm-profile.index');
        Route::put('/profil-usaha', [UmkmProfileController::class, 'update'])->name('umkm-profile.update');

        Route::get('/pegawai', [EmployeeController::class, 'index'])->name('employees.index');
        Route::post('/pegawai', [EmployeeController::class, 'store'])->name('employees.store');
        Route::delete('/pegawai/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

        Route::resource('products', ProductController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);

        Route::get('/kas/{cash}/edit', [CashController::class, 'edit'])->name('cashes.edit');
        Route::put('/kas/{cash}', [CashController::class, 'update'])->name('cashes.update');
        Route::delete('/kas/{cash}', [CashController::class, 'destroy'])->name('cashes.destroy');

        Route::delete('/transaksi/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');

        Route::put('/profil-usaha', [UmkmProfileController::class, 'update'])->name('umkm-profile.update');
    });

    Route::get('/laporan', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/laporan/pdf', [ReportController::class, 'exportPdf'])->name('reports.export-pdf');
    Route::get('/laporan/excel', [ReportController::class, 'exportExcel'])->name('reports.export-excel');

    Route::get('/pengaturan', [SettingController::class, 'index'])->name('settings.index');
});

require __DIR__.'/auth.php';

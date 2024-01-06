<?php

use Illuminate\Support\Facades\Route;

// controller all
use App\Http\Controllers\Home;

Route::get('/', [Home::class, 'index']);
Route::get('tambah_komik', [Home::class, 'tambah_komik']);
Route::get('tambah_komik', [Home::class, 'tambah_komik']);
Route::get('/detail_komik/{id}', [Home::class, 'detail_komik'])->name('detail_komik.detail_komik');
Route::get('/update_komik/{id}', [Home::class, 'update_komik'])->name('update_komik.detail_komik');

Route::post('proses_tambah_komik', [Home::class, 'proses_tambah_komik']);
Route::post('proses_update_komik', [Home::class, 'proses_update_komik']);
Route::get('proses_delete_komik/{id}', [Home::class, 'proses_delete_komik'])->name('proses_delete_komik.detail_komik');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminContactController;
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

// Route::get('/', function () {
//     return view('welcome');
Route::get('/', [ContactController::class, 'form'])->name('contact.form');
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/thanks', [ContactController::class, 'send'])->name('contact.send');
Route::post('/contact/fix', [ContactController::class, 'fix'])->name('contact.fix'); // 修正用
Route::get('/thanks', function () {
    return view('thanks');
})->name('contact.thanks');
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminContactController::class, 'index'])->name('admin.index');
});
Route::get('/admin/export', [AdminContactController::class, 'export'])->name('admin.export'); //エクスポート用
Route::delete('/admin/{id}', [AdminContactController::class, 'destroy'])->name('admin.destroy');//modelウィンドウの削除ボタン
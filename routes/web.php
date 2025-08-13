<?php


use App\Http\Controllers\ApiController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrintDebitNoteController;
use App\Http\Controllers\PrintInvoiceController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\ThumbnailController;
use App\Wizard\InstallWizardComponent;
use App\Wizard\Steps\UserStep;
use Illuminate\Support\Facades\Route;
use Ycs77\LaravelWizard\Facades\Wizard;
use Livewire\Livewire;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('contact-us', [ContactController::class, 'index']);
Route::post('contact-us', [ContactController::class, 'store'])->name('contact.us.store');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/buletin', [HomeController::class, 'buletin'])->name('buletin');
Route::get('/penghargaan', [HomeController::class, 'penghargaan'])->name('penghargaan');
Route::get('/punggawa', [HomeController::class, 'punggawa'])->name('punggawa');
Route::get('/direksi', [HomeController::class, 'direksi'])->name('direksi');
Route::get('/perkenalan', [HomeController::class, 'perkenalan'])->name('perkenalan');
Route::get('/kantor', [HomeController::class, 'kantor'])->name('kantor');
Route::get('/legalitas', [HomeController::class, 'legalitas'])->name('legalitas');
Route::get('/testi', [HomeController::class, 'testi'])->name('testi');

Route::get('/{record}/print/invoice', [PrintInvoiceController::class, 'print'])->name('print.invoice');
Route::get('/{record}/print/debit', [PrintDebitNoteController::class, 'print'])->name('print.debit');
Route::get('/print/invoice/preview', [PrintInvoiceController::class, 'index']);

Route::get('term', [PrivacyController::class, 'term']);

Route::get('privacy', [PrivacyController::class, 'privacy']);

Route::get('thumbnail', [ThumbnailController::class, 'create']);

Route::get('api/plusview', [ApiController::class, 'plusView']);

Route::get('api/cathash', [ApiController::class, 'catHash']);

Route::get('api/app-colors', [ApiController::class, 'color']);

Route::get('api/setting', [ApiController::class, 'setting']);

Route::get('api/categories', [ApiController::class, 'categories']);

Route::get('api/hashtag', [ApiController::class, 'hashtag']);

Route::get('api/home', [ApiController::class, 'home']);
Route::get('api/latest', [ApiController::class, 'latest']);
Route::get('api/live', [ApiController::class, 'live']);
Route::get('api/premium', [ApiController::class, 'premium']);
Route::get('api/free', [ApiController::class, 'free']);

Route::get('api/search', [ApiController::class, 'search']);

Route::get('api/cid', [ApiController::class, 'cid']);

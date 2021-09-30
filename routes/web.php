<?php

use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\ArticleController;
use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\ConfigController;
use App\Http\Controllers\backend\PageController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\frontend\HomeController;
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

    //Maintanence Route
Route::get('bakimdayiz', function(){
    return view('frontend.offline');
});

/**
 * Backend Routes
 */
Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function(){

    //Login
    Route::get('giris', [AuthController::class, 'login'])->name('login');
    Route::post('giris', [AuthController::class, 'loginPost'])->name('login.post');
});

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function(){
    Route::get('panel', [AdminController::class, 'index'])->name('dashboard');

    //Article Routes
    Route::get('makaleler/silinenler', [ArticleController::class, 'trashed'])->name('trashed.article');
    Route::resource('makaleler', ArticleController::class);
    Route::get('/switch', [ArticleController::class, 'switch'])->name('switch');
    Route::get('/delete/{id}', [ArticleController::class, 'delete'])->name('delete.article');
    Route::get('/hard-delete/{id}', [ArticleController::class, 'hardDelete'])->name('hard.delete.article');
    Route::get('/recover/{id}', [ArticleController::class, 'recover'])->name('recover.article');

    //Category Routes
    Route::get('/kategoriler', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/kategori/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/kategori/update', [CategoryController::class, 'update'])->name('category.update');
    Route::post('/kategori/delete', [CategoryController::class, 'delete'])->name('category.delete');
    Route::get('/kategori/status', [CategoryController::class, 'switch'])->name('category.switch');
    Route::get('/kategori/getData', [CategoryController::class, 'getData'])->name('category.getdata');

    //Page Routes
    Route::get('sayfalar', [PageController::class, 'index'])->name('pages.index');
    Route::get('sayfa/olustur', [PageController::class, 'create'])->name('pages.create');
    Route::post('sayfa/olustur', [PageController::class, 'createPost'])->name('pages.create.post');
    Route::get('sayfa/duzenle/{id}', [PageController::class, 'update'])->name('pages.edit');
    Route::post('sayfa/duzenle/{id}', [PageController::class, 'updatePost'])->name('pages.edit.post');
    Route::get('sayfa/sil/{id}', [PageController::class, 'delete'])->name('pages.delete');
    Route::get('sayfa/siralama', [PageController::class, 'orders'])->name('pages.orders');
    Route::get('/sayfa/switch', [PageController::class, 'switch'])->name('page.switch');

    //Config Routes
    Route::get('ayarlar', [ConfigController::class, 'index'])->name('config.index');
    Route::post('ayarlar/guncelle', [ConfigController::class, 'update'])->name('config.update');

    //Admin Routes
    Route::get('profil', [ProfileController::class, 'adminProfile'])->name('profile');
    Route::post('profil', [ProfileController::class, 'adminPost'])->name('profile.post');

    //Logout
    Route::get('cikis', [AuthController::class, 'logout'])->name('logout');
});

/**
 * Frontend Routes
 */
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sayfa', [HomeController::class, 'index']);
Route::get('/iletisim', [HomeController::class, 'contact'])->name('contact');
Route::post('/iletisim', [HomeController::class, 'contactPost'])->name('contactPost');
Route::get('/kategori/{category}' ,[HomeController::class, 'category'])->name('category');
Route::get('/{category}/{slug}', [HomeController::class, 'single'])->name('single');
Route::get('/{sayfa}', [HomeController::class, 'pages'])->name('pages');


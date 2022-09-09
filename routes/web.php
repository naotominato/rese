<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\managerController;
use App\Http\Controllers\StripeController;

//ユーザー共通画面（認証前 / 認証後）
Route::get('/', [ShopController::class, 'index'])
->name('index');
Route::get('/search', [ShopController::class, 'search'])->name('search');
Route::get('/detail/{shop_id}', [ShopController::class, 'detail'])->name('detail');
Route::get('/back', [ShopController::class, 'back'])->name('back');
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'create'])->name('create');
Route::get('/thanks', [RegisterController::class, 'thanks'])->name('thanks');
Route::get('/login', [AuthController::class, 'auth'])->name('auth');
Route::post('/login', [AuthController::class, 'login'])->name('login');

//仮登録中ユーザー（メール認証前）
Route::middleware(['auth:user'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/email/verify', [AuthController::class, 'mailVerify'])->name('verification.notice');
});

//認証メール再送
Route::post('/email/verification-notification', [AuthController::class, 'mailResend'])->middleware('auth', 'throttle:6,1')->name('verification.send');

//認証メール リンクURL
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'mailLink'])->middleware(['auth', 'signed'])->name('verification.verify');

//メール認証済みユーザー
Route::middleware(['auth:user', 'verified'])->group(function () {
    Route::get('/email/auth', [AuthController::class, 'mailAuth'])->name('mail.auth');
    Route::get('/mypage', [MypageController::class, 'mypage'])->name('mypage');
    Route::get('/mypage/past', [MypageController::class, 'past'])->name('past');
    Route::get('/mypage/today', [MypageController::class, 'today'])->name('today');
    Route::post('/done', [ReserveController::class, 'reserve'])->name('reserve');
    Route::post('/reserve/update', [ReserveController::class, 'update'])->name('update');
    Route::get('/reserve/cancel/{reserve_id}', [ReserveController::class, 'cancel'])->name('cancel');
    Route::post('/favorite/change', [FavoriteController::class, 'change'])->name('change');
    Route::post('/favorite/delete', [FavoriteController::class, 'delete'])->name('delete');
    Route::post('mypage/qr', [MypageController::class, 'qrcode'])->name('qrcode');
    Route::post('/mypage/review', [ReviewController::class, 'review'])->name('review');
    Route::post('/stripe', [StripeController::class, 'stripe'])->name('stripe');
    Route::get('/paid', [StripeController::class, 'paid'])->name('paid');
});

//管理者（認証前）
Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
Route::post('/admin/login', [AdminController::class, 'adminLogin'])->name('adminlogin');

//管理者（認証後）
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('/shoplist', [AdminController::class, 'shopList'])->name('shop.list');
    Route::get('/managerlist', [AdminController::class, 'managerList'])->name('manager.list');
    Route::get('/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::post('/shop/create', [AdminController::class, 'shopCreate'])->name('shopname.create');
    Route::post('manager/create', [AdminController::class, 'managerCreate'])->name('manager.create');
});

//店舗代表者（認証前）
Route::get('/manager', [ManagerController::class, 'manager'])->name('manager');
Route::post('/manager/login', [ManagerController::class, 'managerLogin'])->name('manager.login');

//店舗代表者（認証後）
Route::middleware(['auth:manager'])->prefix('manager')->group(function () {
    Route::get('/shop', [ManagerController::class, 'managerShop'])->name('manager.shop');
    Route::get('/reserved', [ManagerController::class, 'Reserved'])->name('manager.reserved');
    Route::get('/logout', [ManagerController::class, 'managerLogout'])->name('manager.logout');
    Route::post('/shop/create', [ManagerController::class, 'shopCreate'])->name('shop.create');
    Route::get('/mail', [ManagerController::class, 'managerMail'])->name('manager.mail');
    Route::post('/mail/sent', [ManagerController::class, 'mailSent'])->name('mail.sent');
    Route::get('/mail/completion', [ManagerController::class, 'completion'])->name('completion');
    Route::get('/reserved/{reserved_id}/{user_id}/{shop_id}', [ManagerController::class, 'reservedQr'])->name('manager.qr');
});

require __DIR__.'/auth.php';

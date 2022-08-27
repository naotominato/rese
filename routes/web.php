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
use App\Http\Controllers\StripePaymentsController;

//メール認証用
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

//メール送信用
use App\Http\Controllers\MailSendController;

//メール認証用
Route::get('/dashboard', function () {
    return view('dashboard');
    // })->middleware(['auth'])->name('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/email/verify', function () {
    return view('emails.email-send');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/mailauth');
})->middleware(['auth', 'signed'])->name('verification.verify');
// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
    
//     return redirect()->route('mailauth');//メール認証完了画面にする！
// })->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware('auth', 'throttle:6,1')->name('verification.send');

//ユーザー登録後、表示画面
// Route::get('/registered/email', [RegisterController::class, 'registered'])->name('registered');

//ユーザー登録後、表示画面
Route::get('/registered', [RegisterController::class, 'registered'])->name('registered');


//メール送信用
Route::get('/mailauth', [AuthController::class, 'mailAuth'])->name('mailauth');
//認証前後 共通画面
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

//管理者ログインページ
Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
Route::post('/admin/login', [AdminController::class, 'adminLogin'])->name('adminlogin');

//店舗代表者用ログインページ
Route::get('/manager', [ManagerController::class, 'manager'])->name('manager');
Route::post('/manager/login', [ManagerController::class, 'managerLogin'])->name('managerlogin');

Route::middleware(['auth:user'])->group(function () {
    // Route::get('/index', [AuthController::class, 'kari'])->name('kari');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth:user', 'verified'])->group(function () {
    Route::get('/mypage', [MypageController::class, 'mypage'])->name('mypage');
    Route::post('/done', [ReserveController::class, 'reserve'])->name('reserve');
    Route::post('/reserve/update', [ReserveController::class, 'update'])->name('update');
    Route::get('/reserve/cancel/{reserve_id}', [ReserveController::class, 'cancel'])->name('cancel');
    Route::post('/favorite/change', [FavoriteController::class, 'change'])->name('change');
    Route::post('/favorite/delete', [FavoriteController::class, 'delete'])->name('delete');
    // //QRコードページへのリンク先
    Route::get('reserve/qr/{reserved_id}', [MypageController::class, 'qrcode'])->name('qrcode');
    Route::post('/mypage/review', [ReviewController::class, 'review'])->name('review');
});

//管理者用
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('/shop', [AdminController::class, 'shop'])->name('shoppage');
    Route::get('/page', [AdminController::class, 'adminPage'])->name('adminpage');
    Route::get('/logout', [AdminController::class, 'adminLogout'])->name('adminlogout');
    Route::post('/shop/create', [AdminController::class, 'shopCreate'])->name('shopCreate');
    Route::post('manager/create', [AdminController::class, 'managerCreate'])->name('adminCreate');
});

//店舗代表者用
Route::middleware(['auth:manager'])->prefix('manager')->group(function () {
    Route::get('/page', [ManagerController::class, 'managerPage'])->name('managerpage');
    Route::get('/reserved', [ManagerController::class, 'Reserved'])->name('managerreserved');
    Route::get('/logout', [ManagerController::class, 'managerLogout'])->name('managerlogout');
    Route::post('/create', [ManagerController::class, 'shopCreate'])->name('shopcreate');
    // お気に入り（メール送信画面）
    Route::get('/mail/sent', [ManagerController::class, 'sent'])->name('sentmail');
    // メール送信用
    Route::get('/mail', [ManagerController::class, 'send'])->name('sendmail');

    Route::get('/reserved/{reserved}/{user}/{shop}', [ManagerController::class, 'reservedQr'])->name('managerreservedqr');
});


//決済テスト
Route::post('/stripe', [StripePaymentsController::class, 'stripe'])->name('stripe');


//削除予定
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


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

//Breezeではログアウトするとルートに飛ぶ
Route::get('/', function () {
    return redirect()->route('posts.index');
});

//Breezeではログイン成功するとdashboardに飛ぶ
Route::get('/dashboard', function () {
    return redirect()->route('posts.index');
});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

//Laravel Breeze 認証状態をmiddlewareがチェック 未ログインならログイン画面へ飛ばされる
Route::middleware('auth')->group(function () {
    Route::get('/profile', 
    [ProfileController::class, 'edit'])->name('profile.edit');
    
    Route::patch('/profile',
    [ProfileController::class, 'update'])->name('profile.update');
    
    Route::delete('/profile',
    [ProfileController::class, 'destroy'])->name('profile.destroy');

    //投稿
    Route::get('/post/create',
    [PostController::class, 'create']);

    Route::post('/post/store',
    [PostController::class, 'store'])->name('post.store');

    //編集
    Route::get('/post/edit/{post}',
    [PostController::class, 'edit'])->name('post.edit');

    Route::post('/post/update',
    [PostController::class, 'update'])->name('post.update');

    //削除
    Route::post('/post/delete/{post}',
    [PostController::class, 'destroy'])->name('post.delete');

    //画像投稿
    Route::post('/post/images/{post}',
    [PostController::class, 'storeImage'])->name('post.images.store');
});

//OAuth
Route::get('/auth/github',
[SocialLoginController::class, 'redirectToGithub'])->name('auth.github');
Route::get('/auth/github/callback',
[SocialLoginController::class, 'handleGithubCallback']);

//一覧表示
Route::get('/posts',
[PostController::class, 'index'])->name('posts.index');

//表示
Route::get('/post/{post}',
[PostController::class, 'show'])->name('post.show');

//Admin prefixはURLだけでなく名前付きルートも可能 ->name('admin.')の部分
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login',
    [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login',
    [AdminAuthController::class, 'login']);
    Route::post('logout',
    [AdminAuthController::class, 'logout']);

    //認証状態チェック
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
    });
});

require __DIR__.'/auth.php';


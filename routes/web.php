<?php

use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\VedioController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\CommentController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Route::get('image', function () {
    Artisan::call('storage:link');
    return back();
});

Route::get('/clear', function () {
    Artisan::call('optimize:clear');
    return back();
});


Route::get('/', [HomeController::class, 'homeIndex']);

Route::get('/post/{slug}', [HomeController::class, 'singlePost'])->name('singlePost');

Route::get('/pusher', function(){
    return view('pusher');
});

// login register route
Route::get('register', [RegisterController::class, 'registerForm'])->name('registerForm');
Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::get('login', [LoginController::class, 'loginForm'])->name('loginForm');
Route::post('login', [LoginController::class, 'login'])->name('login');


// forgot password route
Route::get('forgot-password', [ForgotPasswordController::class, 'linkRequestForm'])->name('linkRequestForm');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('sendResetLinkEmail');
Route::get('reset-password-form', [ForgotPasswordController::class, 'resetPasswordForm'])->name('resetPasswordForm');
Route::post('reset-password', [ForgotPasswordController::class, 'reset'])->name('passwordReset');

// logout route
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');


//user route
// verified
Route::group(['prefix' => 'user','middleware' => ['auth']], function() {
    Route::get('dashboard', [UserDashboardController::class, 'dashboard'])->name('user.dashboard');

    // user comment route
    Route::get('comment/type/{type}/id/{id}', [CommentController::class, 'comment'])->name('comment');
    Route::get('comments/paginate/{post}', [CommentController::class, 'comments'])->name('comments');
});


//admin route
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isAdmin']], function() {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/posts', [PostController::class, 'index'])->name('admin.posts.index');

    // post route

    Route::get('/posts/create', [PostController::class, 'create'])->name('admin.posts.create');
    Route::post('/posts/store', [PostController::class, 'store'])->name('admin.posts.store');
    Route::get('/posts/edit/{post}', [PostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('/posts/update/{post}', [PostController::class, 'update'])->name('admin.posts.update');
    Route::delete('/posts/destroy/{post}', [PostController::class, 'destroy'])->name('admin.posts.destroy');
    Route::get('/posts/status/{post}', [PostController::class, 'status'])->name('admin.posts.status');
    Route::get('/posts/search', [PostController::class, 'search'])->name('admin.posts.search');

    // category route

    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/edit/{category}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categories/update/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/destroy/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    Route::get('/categories/status/{category}', [CategoryController::class, 'status'])->name('admin.categories.status');
    Route::get('/categories/search', [CategoryController::class, 'search'])->name('admin.categories.search');


    // vedio route
    Route::get('/vedios', [VedioController::class, 'index'])->name('admin.vedios.index');
    Route::get('/vedios/create', [VedioController::class, 'create'])->name('admin.vedios.create');
    Route::post('/vedios/store', [VedioController::class, 'store'])->name('admin.vedios.store');
    Route::get('/vedios/edit/{vedio}', [VedioController::class, 'edit'])->name('admin.vedios.edit');
    Route::put('/vedios/update/{vedio}', [VedioController::class, 'update'])->name('admin.vedios.update');
    Route::delete('/vedios/destroy/{vedio}', [VedioController::class, 'destroy'])->name('admin.vedios.destroy');
    Route::get('/vedios/status/{vedio}', [VedioController::class, 'status'])->name('admin.vedios.status');
    Route::get('/vedios/search', [VedioController::class, 'search'])->name('admin.vedios.search');

});




// email_verified route start

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function () {
    $user = Auth::user();
    $user->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth'])->name('verification.send');

// email_verified route end

// google login route
Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('login/google/callback', [LoginController::class, 'handleGoogleCallback']);

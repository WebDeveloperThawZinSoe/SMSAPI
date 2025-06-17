<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteCheckController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Auth;


Route::get("/", fn() => redirect('/dashboard'));
Route::get("/register", fn() => redirect('/login'));
Route::get("/forgot-password", fn() => redirect('/login'));
Route::get("/faq",[RouteCheckController::class,"faq"]);

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/dashboard', [RouteCheckController::class, 'redirect'])->name('dashboard');

    // Admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::resource('users', UserController::class);
        Route::resource('orders', OrderController::class);
        Route::get("/logs", [LogController::class, 'index'])->name('logs.index');
    });

    // User-only routes
    Route::middleware('user')->group(function () {
        Route::get('/user/dashboard', [UserController::class, 'userIndex'])->name('user.dashboard');
        Route::get('/user/orders', [OrderController::class,"userOrders"]);
        Route::get("/user/logs", [LogController::class, 'userIndex'])->name('logs.index');
        Route::get("/user/api",[UserController::class, 'api'])->name('user.api');
        Route::get("/user/help",[UserController::class, 'help'])->name('user.help');
        Route::get("/user/price",[UserController::class, 'price'])->name('user.price');
    });

    // Password Change
    Route::get('/change-password', [UserController::class, 'changePassword'])->name('change.password');
    Route::post('/update-password', [UserController::class, 'updatePassword'])->name('update.password');
    // API Key Regeneration
    Route::post('/regenerate-api-key', [UserController::class, 'regenerateApiKey'])->name('regenerate.api.key');

    // Logout route
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');
});


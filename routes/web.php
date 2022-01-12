<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Models\Role;
use App\Models\User;
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

Route::get('/', fn () => redirect()->route('dashboard'));

Route::get('/login', LoginController::class)->name('login');
Route::get('/register', RegisterController::class)->name('register');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);

Route::post('logout', LogoutController::class)->name('logout');

Route::middleware(['auth', 'role:admin,donatur'])->group(function () {

    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::middleware('role:admin')->group(function () {
        Route::prefix('dashboard')->group(function () {
            Route::resource('category', CategoryController::class);
            Route::resource('campaign', CampaignController::class)->except('create', 'edit');
        });
    });

    Route::middleware('role:donatur')->group(function () {
    });
});

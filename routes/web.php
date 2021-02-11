<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TalentController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserTalentController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('featured-brands-more', [App\Http\Controllers\HomeController::class, 'allFeaturedBrands'])->name('featured-brands-more');

// Start Frontend Controller Sections

Route::get('new-talent', [\App\Http\Controllers\NewTalentController::class, 'index'])->name('new-talent');

// User Dashboard Route
Route::get('user/profile', [UserProfileController::class, 'edit'])->name('user.profile');
Route::get('user/talent/{user}', [UserTalentController::class, 'index'])->name('user.talent');
Route::put('user/profile/update', [UserProfileController::class, 'update'])->name('user.update.profile');
Route::put('user/profile/update/password', [UserProfileController::class, 'changePassword'])->name('user.update.profile.password');

// talent controller
Route::resource('talents', TalentController::class);

// message controller
Route::resource('messages', MessageController::class);

//

//Socialite
Route::get('login/{provider}', [LoginController::class, 'redirectToProvider'])->name('login.social');
Route::get('login/{provider}/callback', [LoginController::class, 'handleProviderCallback']);

// For Admin
require __DIR__ . '/admin.php';


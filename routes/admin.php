<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;

use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeaturedBrandsController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\MissionAndValueController;
use App\Http\Controllers\Admin\PermissionManageController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\ReplyController;
use App\Http\Controllers\Admin\RoleManageController;
use App\Http\Controllers\Admin\SettingController;

use App\Http\Controllers\Admin\SliderBgController;
use App\Http\Controllers\Admin\SlidersController;
use App\Http\Controllers\Admin\SocialController;

use App\Http\Controllers\Admin\TalentController;
use App\Http\Controllers\Admin\TalentDescriptionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WhatWeDoController;
use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return redirect()->route('admin.login');
});

/******************************* Start => auth sections *********************************/
Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');

    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');

    Route::post('password/reset', [ResetPasswordController::class, 'reset'])
        ->name('password.update');
});
/******************************* End => auth sections *********************************/

Route::group(['middleware' => ['auth:admin'], 'as' => 'admin.', 'prefix' => 'admin'], function () {
    // dashboard v_2
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::resource('roles', RoleManageController::class);
    Route::resource('permissions', PermissionManageController::class);


    /******************************* Start => Slider sections *********************************/
    Route::resource('sliders', SlidersController::class)->except('show');
    Route::get('sliders/change-status/{slider}', [SlidersController::class, 'changeStatus'])
        ->name('sliders.status.change');
    /******************************* End => Slider sections *********************************/

    /******************************* Start => Slider  bg sections *********************************/
    Route::resource('slider-bg', SliderBgController::class)->except('show');
    /******************************* End => Slider  bg sections *********************************/

    /******************************* Start => Social sections *********************************/
    Route::resource('socials', SocialController::class);
    Route::get('socials/change-status/{social}', [SocialController::class, 'changeStatus'])
        ->name('socials.status.change');
    /******************************* End => Social sections *********************************/

    /******************************* Start => setting sections *********************************/
    Route::resource('settings', SettingController::class);
    /******************************* End => setting sections *********************************/


    /******************************* Start => Admin Profile sections *********************************/
    Route::get('/profile', [AdminProfileController::class, 'profile'])->name('profile');
    Route::PATCH('/profile/{admin}/update', [AdminProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::PATCH('/password/change', [AdminProfileController::class, 'changePassword'])->name('password.change');
    /******************************* End => Admin Profile sections *********************************/

    /******************************* Start => admins sections *********************************/
    Route::resource('admins', AdminController::class);
    /******************************* End => admins sections *********************************/


    /******************************* Start => Contact sections *********************************/
    Route::resource('contacts', ContactController::class);
    /******************************* End => Contact sections *********************************/

    /******************************* Start => talents sections *********************************/
    Route::get('talents', [TalentController::class, 'index'])->name('talents.index');
    Route::get('talents/details/{talent}', [TalentController::class, 'show'])->name('talents.show');
    Route::resource('talent_descriptions', TalentDescriptionController::class);
    Route::post('talent/send/message', [TalentController::class, 'talentMessageSend'])->name('send.message.to-talent');

    /******************************* End => talents sections *********************************/

    /******************************* Start => Message sections *********************************/
    Route::resource('messages', MessageController::class)->only(['index', 'show', 'destroy']);
    /******************************* End => Message sections *********************************/

    /******************************* Start => Message sections *********************************/
    Route::resource('replies', ReplyController::class);
    Route::get("message-replies/{message}", [ReplyController::class, 'messageReplies'])->name('message.replies');
    /******************************* End => Message sections *********************************/

    /******************************* Start => featured-brand sections *********************************/
    Route::resource('featured-brands', FeaturedBrandsController::class);
    /******************************* End => featured-brand sections *********************************/

    /******************************* Start => portfolio sections *********************************/
    Route::resource('portfolios', PortfolioController::class);
    /******************************* End => portfolio sections *********************************/

    /******************************* Start => what-we-do sections *********************************/
    Route::resource('what-we-do', WhatWeDoController::class)->except('show');
    /******************************* End => what-we-do sections *********************************/

    /******************************* Start => mission_and_values sections *********************************/
    Route::resource('mission_and_values', MissionAndValueController::class);
    /******************************* End => mission_and_values sections *********************************/

    /******************************* Start => users sections *********************************/
    Route::resource('users', UserController::class);
    /******************************* End => users sections *********************************/

});

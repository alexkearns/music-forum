<?php

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

// Authentication Routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout')->middleware('auth');
Route::post('login/2fa', function () {
    return redirect(URL()->previous());
})->name('2fa')->middleware('auth.2fa');

// Registration Routes
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::get('/complete-registration', 'Auth\RegisterController@finishRegistrationAfter2fa')
    ->name('register.completeAfter2fa');

// Password Reset Routes
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// Logged In Application Routes
Route::middleware(['auth', 'auth.banned', 'auth.2fa'])->group(function () {
    Route::get('/', 'HomeController@index')->name('root');
    Route::get('/home', 'HomeController@index')->name('home');

    // Thread Routes
    Route::get('/thread/new', 'HomeController@showNewThreadForm')->name('showNewThreadForm');
    Route::post('/thread/new/save', 'HomeController@saveNewThread')->name('saveNewThread');
    Route::get('/thread/delete/{thread}', 'HomeController@deleteThread')->name('deleteThread');

    // Post Routes
    Route::get('/thread/{thread}', 'HomeController@showThreadPosts')->name('thread');
    Route::post('/thread/post/new', 'HomeController@saveNewPost')->name('saveNewPost');
    Route::get('/thread/post/edit/{post}', 'HomeController@showEditPostForm')->name('showEditThreadForm');
    Route::post('/thread/post/edit/save', 'HomeController@updatePost')->name('updatePost');
    Route::get('/thread/post/delete/{post}', 'HomeController@deletePost')->name('deletePost');

    // Profile Routes
    Route::get('/profile/{profile}', 'ProfileController@index')
        ->name('profile')
        ->where(['profile' => '[0-9]+']);
    Route::get('/profile/enable-2fa', 'TwoFactorController@enable2fa')->name('profile.enable2FA');
    Route::get('/profile/complete-2fa', 'TwoFactorController@complete2fa')->name('profile.updateAfter2fa');
    Route::get('/profile/disable-2fa', 'TwoFactorController@disable2fa')->name('profile.disable2FA');

    // Manage User Routes
    Route::middleware(['can:manage-users'])->prefix('/manage/users')->group(function () {
        Route::get('/', 'ManageUsersController@index')->name('manage-users');
        Route::get('/{id}', 'ManageUsersController@single')->name('manage-user');
        Route::post('/{id}/save', 'ManageUsersController@singleSave')->name('manage-user-action');
    });
});

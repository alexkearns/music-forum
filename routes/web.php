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
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');

// Logged In Application Routes
Route::middleware(['auth', 'auth.banned'])->group(function () {
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
    Route::get('/profile/{profile}', 'ProfileController@index')->name('profile');

    // Manage User Routes
    Route::middleware(['can:manage-users'])->prefix('/manage/users')->group(function () {
        Route::get('/', 'ManageUsersController@index')->name('manage-users');
        Route::get('/{id}', 'ManageUsersController@single')->name('manage-user');
        Route::post('/{id}/save', 'ManageUsersController@singleSave')->name('manage-user-action');
    });
});

// Package Routes
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

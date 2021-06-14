<?php

use App\Http\Controllers\DetailsPageController;
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

Route::get('/', 'HomePageController@index');
Route::get('/listing', 'ListingPageController@index');
Route::get('/category/{id}', 'ListingPageController@listing');
Route::get('/author/{id}', 'ListingPageController@listing');
Route::get('/details', 'DetailsPageController@index');
Route::get('/details/{slug}', 'DetailsPageController@index')->name('details');
Route::post('/comments', 'DetailsPageController@comment');

Route::group(['prefix' => 'back', 'middleware' => 'auth'], function () {
    Route::get('/', 'Admin\DashboardController@index');
    Route::get('/category', 'Admin\CategoryController@index');
    Route::get('/category/create', 'Admin\CategoryController@create');
    Route::get('/category/edit', 'Admin\CategoryController@edit');

    Route::get('/permission', ['uses' => 'Admin\PermissionController@index', 'as' => 'permission-list', 'middleware' => ['permission:Permission List|All']]);
    Route::get('/permission/create', ['uses' => 'Admin\PermissionController@create', 'as' => 'permission-create']);
    Route::post('/permission/store', ['uses' => 'Admin\PermissionController@store', 'as' => 'permission-store']);
    Route::get('/permission/edit/{id}', ['uses' => 'Admin\PermissionController@edit', 'as' => 'permission-edit']);
    Route::put('/permission/update/{id}', ['uses' => 'Admin\PermissionController@update', 'as' => 'permission-update']);
    Route::delete('/permission/delete/{id}', ['uses' => 'Admin\PermissionController@destroy', 'as' => 'permission-delete']);

    Route::get('/roles', 'Admin\RoleController@index');
    Route::get('/roles/create', 'Admin\RoleController@create');
    Route::post('/roles/store', 'Admin\RoleController@store');
    Route::get('/roles/edit/{id}', ['uses' => 'Admin\RoleController@edit', 'as' => 'role-edit']);
    Route::put('/roles/update/{id}', ['uses' => 'Admin\RoleController@update', 'as' => 'role-update']);
    Route::delete('/roles/delete/{id}', ['uses' => 'Admin\RoleController@destroy', 'as' => 'role-delete']);

    Route::get('/authors', 'Admin\AuthorController@index');
    Route::get('/authors/create', 'Admin\AuthorController@create');
    Route::post('/authors/store', 'Admin\AuthorController@store');
    Route::get('/authors/edit/{id}', ['uses' => 'Admin\AuthorController@edit', 'as' => 'author-edit']);
    Route::put('/authors/update/{id}', ['uses' => 'Admin\AuthorController@update', 'as' => 'author-update']);
    Route::delete('/authors/delete/{id}', ['uses' => 'Admin\AuthorController@destroy', 'as' => 'author-delete']);


    Route::get('/categories', ['uses' => 'Admin\CategoryController@index', 'as' => 'category-list', 'middleware' => ['permission:Category List|All']]);
    Route::get('/category/create', ['uses' => 'Admin\CategoryController@create', 'as' => 'category-create']);
    Route::post('/category/store', ['uses' => 'Admin\CategoryController@store', 'as' => 'category-store']);
    Route::get('/category/edit/{id}', ['uses' => 'Admin\CategoryController@edit', 'as' => 'category-edit']);
    Route::put('/category/update/{id}', ['uses' => 'Admin\CategoryController@update', 'as' => 'category-update']);
    Route::delete('/category/delete/{id}', ['uses' => 'Admin\CategoryController@destroy', 'as' => 'category-delete']);
    Route::put('/category/status/{id}', ['uses' => 'Admin\CategoryController@status', 'as' => 'category-status']);

    Route::get('/posts', ['uses' => 'Admin\PostController@index', 'as' => 'post-list', 'middleware' => ['permission:Post List|All']]);
    Route::get('/post/create', ['uses' => 'Admin\PostController@create', 'as' => 'post-create']);
    Route::post('/post/store', ['uses' => 'Admin\PostController@store', 'as' => 'post-store']);
    Route::get('/post/edit/{id}', ['uses' => 'Admin\PostController@edit', 'as' => 'post-edit']);
    Route::put('/post/update/{id}', ['uses' => 'Admin\PostController@update', 'as' => 'post-update']);
    Route::delete('/post/delete/{id}', ['uses' => 'Admin\PostController@destroy', 'as' => 'post-delete']);
    Route::put('/post/status/{id}', ['uses' => 'Admin\PostController@status', 'as' => 'post-status']);
    Route::put('/post/hot/news/{id}', ['uses' => 'Admin\PostController@hot_news', 'as' => 'post-hot-news']);

    Route::get('/comments/{id}', ['uses' => 'Admin\CommentController@index', 'as' => 'comment-list']);
    Route::get('/comment/reply/{id}', ['uses' => 'Admin\CommentController@reply', 'as' => 'comment-view']);
    Route::post('/comment/reply', ['uses' => 'Admin\CommentController@store', 'as' => 'comment-reply']);
    Route::put('/comment/status/{id}', ['uses' => 'Admin\CommentController@status', 'as' => 'comment-status']);

    Route::get('/setting', ['uses' => 'Admin\SettingController@index', 'as' => 'setting']);
    Route::put('/settings/update', ['uses' => 'Admin\SettingController@update', 'as' => 'setting-update']);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

<?php

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

Route::get('/', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Post'], function() {
    Route::get('/posts', 'IndexController')->name('post.index');
    Route::get('/posts/create', 'CreateController')->name('post.create');

    Route::post('/posts', 'StoreController')->name('post.store');
    Route::get('/posts/{post}', 'ShowController')->name('post.show');
    Route::get('/posts/{post}/edit', 'EditController')->name('post.edit');
    Route::patch('/posts/{post}', 'UpdateController')->name('post.update');
    Route::delete('/posts/{post}', 'DestroyController')->name('post.delete');

    

    Route::get('/posts/update', 'PostController@update');
    
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function() {

    //Route::get('/admin', 'IndexController')->name('main.index');

    Route::group(['namespace' => 'Post'], function() {
        Route::get('/post', 'IndexController')->name('admin.post.index');
    });

});


Route::get('/posts/delete', 'PostController@delete');
Route::get('/posts/first_or_create', 'PostController@firtOrCreate');
Route::get('/posts/update_or_create', 'PostController@updateOrCreate');


Route::get('/main', 'MainController@index')->name('main.index');
Route::get('/contact', 'ContactController@index')->name('contact.index');
Route::get('/about', 'AboutController@index')->name('about.index');


// Route::get('/my_first_page', function () {
//     return '<a href="http://localhost/laravel/example-app/public/jojo">Перейти</a>';
// });

// Route::get('/jojo', function () {
//     return '<a href="http://localhost/laravel/example-app/public/my_first_page">Back</a>';
// });

// Route::get('/page', 'MyPlaceController@index');

// Route::get('/site', 'SiteController@site');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

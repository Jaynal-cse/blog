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

Route::get('/', function () {
    return view('public.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/anypath','HomeController@index')->where('path','.*');


Route::group(['middleware' => ['auth']], function () {
   //category related route
    Route::get('/category','CategoryController@all_category');
    Route::POST('/add-category','CategoryController@add_category');
    Route::get('/category/{id}','CategoryController@delete_category');
    Route::get('/editcategory/{id}','CategoryController@edit_category');
    Route::post('/update-category/{id}','CategoryController@update_category');
    Route::get('/delete-categories/{id}','CategoryController@selected_category_deletion');

    //post related route
    Route::get('/post','PostController@all_post');
    Route::post('/add-post','PostController@add_post');
    Route::get('/post/{id}','PostController@delete_post');
    Route::get('/edit-post/{id}','PostController@edit_post');
    Route::post('/update-post/{id}','PostController@update_post');
});


Route::get('/blog-post','BlogController@get_all_blog_posts');
Route::get('/blog-post/{id}','BlogController@get_posts_by_id');
Route::get('/categories','BlogController@all_categories');
Route::get('/category-post/{id}','BlogController@posts_by_category');
Route::get('/search','BlogController@search_posts');
Route::get('/latest-post','BlogController@latest_post');


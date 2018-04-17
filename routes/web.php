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

Auth::routes();

Route::namespace('LeeAdmin')->group(function(){

    Route::get('admin/', 'HomeController@index')->name('admin');
    Route::resource('admin/users','UsersController',['only' => ['edit', 'update','show'] ]);
    Route::resource('admin/categories','CategoriesController',['only' => ['index','store']]);
    Route::get('admin/del/{id}','CategoriesController@del');
    Route::post('admin/categories/update','CategoriesController@update')->name('update');
    Route::resource('admin/articles','ArticlesController');
    Route::resource('AdminComments','AdminCommentsController');
    Route::get('admin/comments/index/{id}','AdminCommentsController@index')->name('index');
});

Route::namespace('LeeHome')->group(function(){
    Route::get('/', 'HomeArticlesController@index')->name('home');
    Route::get('articleIndex/{id}', 'HomeArticlesController@articleIndex')->name('articleIndex');
    Route::resource('homeArticles','HomeArticlesController');
    Route::resource('comments','CommentsController');
});

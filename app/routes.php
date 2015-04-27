<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('uses' => 'HomeController@hello', 'as' => 'home'));

Route::group(array('prefix' => '/forum'), function()
{
    Route::get('/', array('uses' => 'ForumController@index', 'as' => 'forum-home'));
    Route::get('/category/{id}', array('uses' => 'CategoryController@getCategory', 'as' => 'forum-category'));
    Route::get('/thread/{id}', array('uses' => 'ThreadController@getThread', 'as' => 'forum-thread'));
    Route::get('/tag/{name}', array('uses' => 'TagController@getTag', 'as' => 'get-tag'));

    Route::group(array('before' => 'csrf'), function()
    {
        Route::post('/search', array('uses' => 'ForumController@search', 'as' => 'forum-search'));
    });

    Route::group(array('before' => 'admin'), function()
    {
        Route::get('/group/{id}/delete', array('uses' => 'GroupController@delete', 'as' => 'forum-delete-group'));
        Route::get('/category/{id}/delete', array('uses' => 'CategoryController@delete', 'as' => 'forum-delete-category'));
        Route::get('/thread/{id}/delete', array('uses' => 'ThreadController@delete', 'as' => 'forum-delete-thread'));
        Route::get('/comment/{id}/delete', array('uses' => 'CommentController@delete', 'as' => 'forum-delete-comment'));
        Route::get('/tag/{name}/delete', array('uses' => 'TagController@delete', 'as' => 'forum-delete-tag'));

        Route::group(array('before' => 'csrf'), function()
        {
            Route::post('/category/{id}/new', array('uses' => 'CategoryController@store', 'as' => 'forum-store-category'));
            Route::post('/group', array('uses' => 'GroupController@store', 'as' => 'forum-store-group'));
        });
    });

    Route::group(array('before' => 'auth'), function()
    {
        Route::get('/thread/{id}/new', array('uses' => 'ThreadController@create', 'as' => 'forum-get-new-thread'));
        Route::post('/comment/{id}/edit', array('uses' => 'CommentController@edit', 'as' => 'forum-edit-comment'));
        Route::get('/thread/{id}/tag/{name}/delete', array('uses' => 'TagController@deleteOne', 'as' => 'forum-delete-tag-from-thread'));
        Route::get('/thread/{id}/tag/{name}/add', array('uses' => 'TagController@add', 'as' => 'forum-add-tag'));
        Route::post('/thread/{id}/edit', array('uses' => 'ThreadController@edit', 'as' => 'forum-edit-thread'));

        Route::group(array('before' => 'csrf'), function()
        {
            Route::post('/thread/{id}/new', array('uses' => 'ThreadController@store', 'as' => 'forum-store-thread'));
            Route::post('/comment/{id}/new', array('uses' => 'CommentController@store', 'as' => 'forum-store-comment'));
        });
    });
});

Route::group(array('before' => 'guest'), function()
{
    Route::get('/user/create', array('uses' => 'UserController@getCreate', 'as' => 'getCreate'));
    Route::get('/user/login', array('uses' => 'UserController@getLogin', 'as' => 'getLogin'));

    Route::group(array('before' => 'csrf'), function()
    {
       Route::post('/user/create', array('uses' => 'UserController@postCreate', 'as' => 'postCreate'));
       Route::post('/user/login', array('uses' => 'UserController@postLogin', 'as' => 'postLogin'));
    });
});

Route::group(array('before' => 'auth'), function()
{
   Route::get('/user/logout', array('uses' => 'UserController@getLogout', 'as' => 'getLogout'));
});

Route::get('/reminder', array('uses' => 'RemindersController@getRemind', 'as' => 'forgotten-pass'));
Route::post('/reminder', array('uses' => 'RemindersController@postRemind'));
Route::post('/reset', array('uses' => 'RemindersController@postReset'));
Route::get('/password/reset/{token}', array('uses' => 'RemindersController@getReset'));
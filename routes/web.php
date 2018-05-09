<?php

Route::get('/',[
    'uses'=>'HomeController@getIndex',
    'as'=>'/'
]);
Route::get('/category{cat_id}',[
    'uses'=>'HomeController@getCategory',
    'as'=>'category'
]);
Route::get('/clear-cart',[
    'uses'=>'HomeController@getClearCart',
    'as'=>'clear-cart'
]);
Route::get('/getImage/{image}',[
    'uses'=>'HomeController@getImage',
    'as'=>'getImage'
]);

Route::get('/login', [
    'uses' => 'AuthController@getLogin',
    'as' => 'login'
]);
Route::post('/login', [
    'uses' => 'AuthController@PostLogin',
    'as' => 'login'
]);


Route::group(['middleware'=>'auth'],function () {
    Route::get('/signUp', [
        'uses' => 'AuthController@getSignUp',
        'as' => 'signUp'
    ]);
    Route::post('/SignUp', [
        'uses' => 'AuthController@PostSignUp',
        'as' => 'SignUp'
    ]);

    Route::get('/dashboard', [
        'uses' => 'AdminController@getDashboard',
        'as' => 'dashboard'
    ]);
    Route::get('/logout', [
        'uses' => 'AuthController@getLogout',
        'as' => 'logout'
    ]);
    Route::get('/userAdd', [
        'uses' => 'AdminController@getUserAdd',
        'as' => 'userAdd',
    ]);
    Route::get('/newCategory', [
        'uses' => 'ProductController@getCategory',
        'as' => 'newCategory'
    ]);
    Route::post('/newCategory', [
        'uses' => 'ProductController@PostNewCategory',
        'as' => 'newCategory'
    ]);
    Route::get('/delete-Category/{categoryName}', [
        'uses' => 'ProductController@DeleteCategory',
        'as' => 'delete-Category'
    ]);
    Route::get('/edit-user/{id}', [
        'uses' => 'AdminController@getEditUser',
        'as' => 'edit-user'
    ]);
    Route::get('/newProduct', [
        'uses' => 'ProductController@getNewProduct',
        'as' => 'newProduct'
    ]);
    Route::post('/newProduct', [
        'uses' => 'ProductController@postNewProduct',
        'as' => 'newProduct'
    ]);
    Route::post('/updateRole', [
        'uses' => 'AdminController@postUpdateRole',
        'as' => 'updateRole'
    ]);
    Route::get('/delete-product/{id}', [
        'uses' => 'ProductController@DeleteProduct',
        'as' => 'delete-product'
    ]);
    Route::get('/coverImage/{cover}', [
        'uses' => 'ProductController@getCoverImage',
        'as' => 'coverImage'
    ]);
    Route::post('/updateProduct', [
        'uses' => 'ProductController@postUpdateProduct',
        'as' => 'updateProduct'
    ]);

    Route::get('add.to.cart/{id}', [
        'uses' => 'CartController@getCart',
        'as' => 'add.to.cart'
    ]);


    Route::get('/decreaseCart/{id}', [
        'uses' => 'CartController@getDecreaseCart',
        'as' => 'decreaseCart'
    ]);
    Route::get('/increaseCart/{id}', [
        'uses' => 'CartController@getIncreaseCart',
        'as' => 'increaseCart'
    ]);
    Route::post('/order-table', [
        'uses' => 'CartController@postCheck',
        'as' => 'order-table'
    ]);
    Route::get('/reportOrder', [
        'uses' => 'CartController@getReport',
        'as' => 'reportOrder'
    ]);
    Route::get('/printOrder{id}',[
        'uses'=>'CartController@getPrintOrder',
        'as'=>'printOrder'
    ]);
});
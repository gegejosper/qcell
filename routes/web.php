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
    return view('welcome');
});

Route::get('/thank-you', 'HomeController@thankyou');

Auth::routes();
Auth::routes(['register' => false, 'verify' => true]);
Route::get('/log-in', 'HomeController@log_in');
Route::get('/admin', 'HomeController@log_in');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' =>'admin_auth','prefix' => 'admin'], function(){
    Route::get('/dashboard', 'AdminController@index');
    Route::get('/credit', 'AdminController@credit');
    Route::get('/dues', 'BillController@dues');
    Route::post('/credit/add', 'CreditController@add_credit')->name('add_credit');
    Route::get('/credit/view/{credit_id}', 'CreditController@view_credit')->name('view_credit');
    Route::get('/accounts', 'AdminController@accounts');
    Route::post('/account/add', 'AccountController@add_account')->name('add_account');
    Route::get('/account/{account_id}', 'AccountController@view_account')->name('view_account');

    Route::post('/bill/pay', 'BillController@bill_pay')->name('bill_pay');
    Route::get('/account/bill/history/{account_id}', 'AccountController@view_account_bill_history');
    Route::get('/account/payment/history/{account_id}', 'AccountController@view_account_payment_history');
    Route::get('/account_search', 'AccountController@account_search');
    
    
    Route::get('/payments', 'AdminController@payments');
    Route::get('/items', 'AdminController@items');
    Route::post('/item/add', 'ItemController@add_item')->name('add_item');
    Route::post('/item/add/picture', 'ItemController@add_product_image')->name('add_product_image');
    
    Route::get('/stocks', 'StockController@stocks');
    Route::post('/stock/add', 'StockController@add_stocks')->name('add_stocks');
    Route::get('/stock/add_stock/{batch_id}', 'StockController@add_stocks_record');
    Route::get('/stock/remove_stock/{stock_id}', 'StockController@remove_stocks_record');
    Route::get('/stock/save/{batch_id}', 'StockController@save_stock');
    Route::get('/stock/view/{batch_id}', 'StockController@view_stock');

    Route::post('/item/edit', 'ItemController@edit_item')->name('edit_item');
    Route::get('/item/view/{item_id}', 'ItemController@view_item')->name('view_item');
    
    Route::get('/reports', 'AdminController@reports');
    Route::get('/settings', 'AdminController@settings');

    Route::get('/brands', 'BrandController@read_brand')->name('read_brand');
    Route::post('/brands/addbrands', 'BrandController@add_brand')->name('add_brand');
    Route::post('/brands/editbrands', 'BrandController@edit_brand')->name('edit_brand');
    Route::post('/brands/deletebrands', 'BrandController@delete_brand')->name('delete_brand');

    Route::get('/users', 'AdminController@users');
    Route::post('/user/add', 'UserController@add_user')->name('add_user');
    Route::post('/user/edit', 'UserController@edit_user');
});

Route::group(['middleware' =>'collector_auth','prefix' => 'collector'], function(){

    
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

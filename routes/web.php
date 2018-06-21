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

Route::get('/',['as'=>'root','uses'=>'PageController@getIndexPage']);

Route::get('index',['as'=>'getIndexPage','uses'=>'PageController@getIndexPage']);
Route::get('sanpham/{id}',['as'=>'getProductPage','uses'=>'PageController@getProductPage']);
Route::get('loaisanpham/{id}',['as'=>'getLoaiSanPhamPage','uses'=>'PageController@getLoaiSanPhamPage']);
Route::get('lienhe',['as'=>'getLienHePage', 'uses' => 'PageController@getLienHePage']);
Route::get('gioithieu',['as'=>'getGioiThieuPage', 'uses' => 'PageController@getGioiThieuPage']);
Route::post('search', ['as' => ' searchItem', 'uses' => 'PageController@searchItem']);
//-----------------------------------USER ROUTE--------------------------------------------------
Route::group(['prefix' => 'user'], function() {
    Route::get('login',['as' => 'getLogin', 'uses' => 'PageController@getLogin']);
    Route::get('logout',['as' => 'getLogOut', 'uses' => 'PageController@getLogOut']);
    Route::get('register',['as' => 'getSignup', 'uses' => 'PageController@getSignup']);
    Route::post('login',['as' => 'postLogin', 'uses' => 'PageController@postLogin']);
    Route::post('register',['as' => 'postSignup', 'uses' => 'PageController@postSignup']);
    Route::get('profile', ['as' =>'getUserProfile', 'uses' => 'PageController@getUserProfile']);
    Route::post('edit-user', ['as' => 'postEditUser', 'uses' => 'PageController@postEditUser']);
    Route::post('change-password', ['as' => 'postChangePassWord', 'uses' => 'PageController@postChangePassWord']);
    Route::post('chage-avata', ['as' => 'postChangeAvata', 'uses' => 'PageController@postChangeAvata']);
});
//----------------------------------SHOPING CART ROUTE--------------------------------------------
Route::group(['prefix' => 'cart'], function() {
    Route::get('addcart',['as'=>'addTocart','uses'=>'CartController@addCart']);
    Route::get('viewcart',['as'=>'viewCart','uses'=>'CartController@viewCart']);
    Route::post('remove-item',['as'=>'removeItem','uses'=>'CartController@removeItem']);
    Route::post('payment',['as' => 'postPayment', 'uses' => 'CartController@postPayment']);
    Route::post('update',['as' => 'postUpdateItem', 'uses' => 'CartController@postUpdateItem']);
    Route::post('user-payment',['as' => 'postUserPayment', 'uses' => 'CartController@postUserPayment']);
});
//----------------------------------ADMIN ROUTE------------------------------------------------------
Route::group(['prefix' => 'admin','middleware' => 'check.admin'], function() {
    Route::get('/',['as' => 'getAdminPanel', 'uses' => 'AdminController@getAdminPanel']);
    Route::get('chart',['as' => 'getChartData','uses' => 'AdminController@getChartData']);
    Route::get('statistic',['as' => 'getStatisticPage', 'uses' => 'AdminController@getStatisticPage']);
    Route::get('pice-chart-data', ['as' => 'getPiceChartData', 'uses' => 'AdminController@getPiceChartData']);
    Route::group(['prefix' => 'product'], function() {
        Route::get('add',['as' => 'getProductAdd', 'uses' => 'AdminController@getProductAdd']);
        Route::post('add',['as' => 'postProductAdd', 'uses' => 'AdminController@postProductAdd']);
        Route::get('list',['as' => 'getListProduct', 'uses' => 'AdminController@getListProduct']);
        Route::get('delete/{id}',['as' => 'getDeleteProduct', 'uses' => 'AdminController@getDeleteProduct']);
        Route::get('edit/{id}',['as' => 'getEditProduct', 'uses' => 'AdminController@getEditProduct']);
        Route::post('edit/{id}',['as' => 'postEditProduct', 'uses' => 'AdminController@postEditProduct']);
    });

    Route::group(['prefix' => 'cate'], function() {
        Route::get('list', ['as' => 'getCateList', 'uses' => 'AdminController@getCateList']);
        Route::post('add', ['as' => 'postAddCate', 'uses' => 'AdminController@postAddCate']);
        Route::post('edit', ['as' => 'postEditCate', 'uses' => 'AdminController@postEditCate']);
        Route::post('edit-data', ['as' => 'postEditDataCate', 'uses' => 'AdminController@postEditDataCate']);
        Route::get('delete-cate/{id}', 'AdminController@getDeleteCate')->name('getDeleteCate');
    });

    Route::group(['prefix' => 'oders'], function() {
        Route::get('today-report',['as' => 'getTodayReport', 'uses' => 'AdminController@getTodayReport']);
        Route::get('oder-cancel',['as' => 'getOderCancel', 'uses' => 'AdminController@getOderCancel']);
        Route::get('update-status', ['as' => 'getupdateStatus', 'uses' => 'AdminController@getupdateStatus']);
        Route::get('week-report', ['as' => 'getWeekReport', 'uses' => 'AdminController@getWeekReport']);
        Route::get('month-report', ['as' => 'getMonthReport', 'uses' => 'AdminController@getMonthReport']);
        Route::post('start-end-date-report', ['as' => 'getStartEndDateReport', 'uses' => 'AdminController@getStartEndDateReport']);
        Route::get('processing-report', ['uses' => 'getProcessingReport', 'uses' => 'AdminController@getProcessingReport']);
        Route::get('week-processing', ['as' => 'getWeekProcessing', 'uses' => 'AdminController@getWeekProcessing']);
        Route::get('week-done',['as' => 'getWeekDone', 'uses' => 'AdminController@getWeekDone']);
        Route::get('month-processing',['as' => 'getMonthProcessing', 'uses' => 'AdminController@getMonthProcessing']);
        Route::get('month-done', ['as' => 'getMonthDone', 'uses' => 'AdminController@getMonthDone']);
        Route::post('start-end-processing', ['as' => 'getStartEndProcessing', 'uses' => 'AdminController@getStartEndProcessing']);
        Route::post('start-end-done',['as' => 'getStartEndDone', 'uses' => 'AdminController@getStartEndDone']);
    });
});

Route::get('user-cancel-order/{oderId}', 'CartController@userCancelOrder')->name('userCancelOrder');
//----------------------------------------------------------------------------------------
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
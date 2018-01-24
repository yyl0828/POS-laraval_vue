<?php


//路由基础
/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return "hi,world!";
});



Route::get('/user/{id}/{name}', function ($id, $name) {
    return 'user' . $id . '-' . $name;
})->where(['id' => '[0-9]+', 'name' => '[A-Za-z]+']);

Route::group(['prefix' => 'foods'], function () {

    Route::match(['get', 'post'], 'fruit', function () {
        $arr = ['香蕉', '橘子', '苹果', '梨子'];
        return $arr;
    });

});

Route::get('apple',function (){
    return view('welcome');
});*/
Route::get('/', function () {
    return view('welcome');
});
/*Route::get('/', function () {
    return view('regex');
});*/
//Route::get('user/{id}', 'UserController@info');

//Route::post('user/addUser/{firname}/{laname}/{email}', 'UserController@addUser');
Route::any('user/addUser', 'UserController@addUser');
Route::get('user/info', 'UserController@userinfoPage');
Route::get('user/userList', 'UserController@userList');
Route::post('user/editUser', 'UserController@editUser');
Route::post('user/deleteUser', 'UserController@deleteUser');

//跨域访问
Route::group(['middleware' => 'cors'], function () {
    Route::get('good/all', 'GoodController@getAllGoods');
    Route::get('good/common', 'GoodController@getCommonGoods');
    Route::any('order/insertOrder', 'OrderController@insertOrder');
    Route::get('order/getPendOrder', 'OrderController@getPendOrder');
    Route::any('order/pendUpdate', 'OrderController@pendUpdate');
    Route::any('order/deleteOrder', 'OrderController@deleteOrder');
    Route::get('shop/getShop', 'ShopController@getShop');
    Route::get('order/getOrderPage/{pageNo}', 'OrderController@getOrderPage');
    Route::get('order/getOrderGood', 'OrderController@getOrderGood');


    Route::get('set/getWaiter', 'SettingController@getWaiter');
    Route::get('set/getSet', 'SettingController@getSet');
    Route::any('set/updateWaiter', 'SettingController@updateWaiter');
    Route::any('set/updateSet', 'SettingController@updateSet');
});

Route::any('sql','UserController@sql');



